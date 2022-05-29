<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function viewAllUsers();
    public function findUser($id);
    public function getDataforTable();
    public function createUser($data);
    public function editDeleteUser();
    public function editUserRequest($data);
    public function deleteUserRequest($data);
}
