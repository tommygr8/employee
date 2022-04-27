<?php


namespace App\Interfaces;


use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterface
{
    public function index() : LengthAwarePaginator;
    public function create(array $data) : User;
    public function show(int $user_id) : User;
    public function update(array $data, int $user_id) : User;
    public function delete(int $user_id) : bool;

}