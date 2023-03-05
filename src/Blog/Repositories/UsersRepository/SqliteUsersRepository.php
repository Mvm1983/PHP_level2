<?php

namespace mvm\less1\blog\Repositories\UsersRepository;

use mvm\less1\Blog\Exceptions\InvalidArgumentException;
use mvm\less1\Blog\Exceptions\UserNotFoundException;
use mvm\less1\Blog\User;
use mvm\less1\Blog\UUID;
use mvm\less1\Person\Name;
use \PDO;
use \PDOStatement;


class SqliteUsersRepository implements UsersRepositoryInterface
{

    public function __construct(
        private PDO $connection
        ) 
    {

    }

    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users (first_name, last_name, uuid, username)
            VALUES (:first_name, :last_name, :uuid, :username)'
        );
        $statement->execute([
            ':first_name' => $user->name()->first(),
            ':last_name' => $user->name()->last(),
            // Это работает, потому что класс UUID
            // имеет магический метод __toString(),
            // который вызывается, когда объект
            // приводится к строке с помощью (string)
            ':uuid' => (string)$user->uuid(),
            ':username' => $user->username(),
        ]);
    }

    // Также добавим метод для получения
    // пользователя по его UUID
    /**
     * @throws UserNotFoundException
     * @throws InvalidArgumentException
     */
    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = ?'
        );

        $statement->execute([(string)$uuid]);
        //$result = $statement->fetch(PDO::FETCH_ASSOC);
        // Бросаем исключение, если пользователь не найден
        //if (false === $result) {
            //throw new UserNotFoundException("Cannot get user: $uuid");
        //}

        return $this->getUser($statement, $uuid);
    }

    /**
     * @throws UserNotFoundException
     * @throws InvalidArgumentException
     */
    public function getByUsername(string $username): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE username = :username'
        );
        $statement->execute([
            ':username' => $username,
        ]);

       return $this->getUser($statement, $username);
    }

        /**
     * @throws UserNotFoundException
     * @throws InvalidArgumentException
     */
    private function getUser(PDOStatement $statement, string $errorString): User
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new UserNotFoundException(
                "Cannot find user: $errorString"
            );
        }
        // Создаём объект пользователя с полем username
        return new User(
            new UUID($result['uuid']),
            new Name($result['first_name'], $result['last_name']),
            $result['username'],
        );
    }

}