<?php

namespace mvm\less1\blog\Commands;

use mvm\less1\Person\Name;
use mvm\less1\Blog\Exceptions\ArgumentsException;
use mvm\less1\Blog\Exceptions\CommandException;
use mvm\less1\Blog\Exceptions\InvalidArgumentException;
use mvm\less1\Blog\Exceptions\UserNotFoundException;
use mvm\less1\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use mvm\less1\Blog\Commands\Arguments;
use mvm\less1\Blog\User;
use mvm\less1\Blog\UUID;

class CreateUserCommand
{

    // Команда зависит от контракта репозитория пользователей,
    // а не от конкретной реализации
    public function __construct(private UsersRepositoryInterface $usersRepository) 
    {
    }

    /**
     * @throws CommandException
     * @throws InvalidArgumentException|ArgumentsException
     */
    public function handle(Arguments $arguments): void
    {
        $username = $arguments->get('username');

        // Проверяем, существует ли пользователь в репозитории
        if ($this->userExists($username)) {
        // Бросаем исключение, если пользователь уже существует
            throw new CommandException("User already exists: $username");
        }
        // Сохраняем пользователя в репозиторий
        $this->usersRepository->save(new User(
            UUID::random(),
            new Name(
                $arguments->get('first_name'),
                $arguments->get('last_name')),
            $username,
        ));
    }
    private function userExists(string $username): bool
    {
        try {
        // Пытаемся получить пользователя из репозитория
            $this->usersRepository->getByUsername($username);
        } catch (UserNotFoundException) {
            return false;
        }
        return true;
    }

}