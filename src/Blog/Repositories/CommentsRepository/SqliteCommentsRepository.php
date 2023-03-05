<?php

namespace mvm\less1\Blog\Repositories\CommentsRepository;
use mvm\less1\Blog\Exceptions\InvalidArgumentException;
use mvm\less1\Blog\Exceptions\PostNotFoundException;
use mvm\less1\Blog\Exceptions\UserNotFoundException;
use mvm\less1\Blog\Post;
use mvm\less1\Blog\Comments;
use mvm\less1\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use mvm\less1\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use mvm\less1\Blog\UUID;


class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Comments $comments): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO comments (uuid, post_uuid, author_uuid, text) 
            VALUES (:uuid, post_uuid, :author_uuid, :text)'
        );

        $statement->execute([
            ':uuid' => $comments->getUuid(),
            ':post_uuid' => $comments->getPost()->getUuid(),
            ':author_uuid' => $comments->getAuthor()->uuid(),
            ':text' => $comments->getText()
        ]);

    }

    public function get(UUID $uuid): Comments
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM comments WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);

        return $this->getComment($statement, $uuid);
    }

    /**
     * @throws PostNotFoundException
     * @throws InvalidArgumentException|UserNotFoundException
     */
    private function getComment(\PDOStatement $statement, string $postUuId): Comments
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PostNotFoundException(
                "Cannot find post: $postUuId"
            );
        }

        $userRepository = new SqliteUsersRepository($this->connection);
        $author = $userRepository->get(new UUID($result['author_uuid']));

        $postRepository = new SqlitePostsRepository($this->connection);
        $post = $postRepository->get(new UUID($result['post_uuid']));

        return new Comments (
            new UUID($result['uuid']),
            $post,
            $author,
            $result['text']
        );

    }
}