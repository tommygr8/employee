<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use View;

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

    public function delete($user_id)
    {
        $response = $this->user->delete($user_id);
        if(!$response) {
            throw new CustomException("Could not delete user", Response::HTTP_BAD_REQUEST);
        }

        return Response::success("User has been deleted successfully", Response::HTTP_BAD_REQUEST);

    }

    public function edit($user_id)
    {
        $user = $this->user->show($user_id);
        if(!$user) {
            throw new CustomException("Could not get user information", Response::HTTP_BAD_REQUEST);
        }
        $roles = Role::all();

        $contents = View::make('partials.edit_user', compact('user','roles'))->render();

        return Response::success("Fetched user information successfully", $contents);


    }

    public function update(UpdateUserRequest $request, $user_id)
    {
        $response = $this->user->update($request->all(), $user_id);

        if(!$response) {
            throw new CustomException("Could not update user", Response::HTTP_BAD_REQUEST);
        }

        return (new UserResource($response))->additional([
            "message" => "User has been updated successfully",
            "status" => "success"
        ]);
    }
}
