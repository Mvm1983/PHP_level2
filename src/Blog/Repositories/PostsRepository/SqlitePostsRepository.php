<?php

namespace mvm\less1\Blog\Repositories\PostsRepository;

use mvm\less1\Blog\Exceptions\InvalidArgumentException;
use mvm\less1\Blog\Exceptions\PostNotFoundException;
use mvm\less1\Blog\Exceptions\UserNotFoundException;
use mvm\less1\Blog\Post;
use mvm\less1\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use mvm\less1\Blog\UUID;


class SqlitePostsRepository implements PostsRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO posts (uuid, author_uuid, title, text) VALUES (:uuid, :author_uuid, :title, :text)'
        );

        $statement->execute([
            ':uuid' => $post->getUuid(),
            ':author_uuid' => $post->getUser()->uuid(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText()
        ]);

    }


    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );
        $statement->execute([(string)$uuid]);

        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws PostNotFoundException
     * @throws InvalidArgumentException|UserNotFoundException
     */
    private function getPost(\PDOStatement $statement, string $postUuId): Post
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PostNotFoundException(
                "Cannot find post: $postUuId"
            );
        }

        $userRepository = new SqliteUsersRepository($this->connection);
        $user = $userRepository->get(new UUID($result['author_uuid']));

        return new Post(
            new UUID($result['uuid']),
            $user,
            $result['title'],
            $result['text']
        );

    }

}