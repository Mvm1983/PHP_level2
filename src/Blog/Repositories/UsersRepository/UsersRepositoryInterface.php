<?php

namespace mvm\less1\Blog\Repositories\UsersRepository;

use mvm\less1\Blog\User;
use mvm\less1\Blog\UUID;

interface UsersRepositoryInterface
{
    public function save(User $user): void;
    public function get(UUID $uuid): User;
    public function getByUsername(string $username): User;
}