<?php

namespace mvm\less1\Blog\Repositories\UsersRepository;

use mvm\less1\Blog\Exceptions\UserNotFoundException;
use mvm\less1\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use mvm\less1\Blog\User;
use mvm\less1\Blog\UUID;
use mvm\less1\Person\Name;

class DummyUsersRepository implements UsersRepositoryInterface
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function get(UUID $uuid): User
    {
        throw new UserNotFoundException("Not found");
    }

    public function getByUsername(string $username): User
    {
        return new User(UUID::random(), new Name("first", "last"), "user123");
    }
}