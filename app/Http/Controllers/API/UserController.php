<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    public function add(AddUserRequest $request)
    {
        $response = $this->user->create($request->all());

        if(!$response) {
            throw new CustomException("Could not create user", Response::HTTP_BAD_REQUEST);
        }

        return (new UserResource($response))->additional([
            "message" => "User has been created successfully",
            "status" => "success"
        ]);
    }
}
