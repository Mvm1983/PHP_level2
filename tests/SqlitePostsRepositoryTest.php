<?php

namespace mvm\less1;

use mvm\less1\Blog\Post;
use mvm\less1\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use mvm\less1\Blog\User;
use mvm\less1\Blog\UUID;
use mvm\less1\Person\Name;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class SqlitePostsRepositoryTest extends TestCase
{
    public function testItThrowsAnExceptionWhenPostNotFound(): void
    {

    }

    public function testItSavesPostToDatabase(): void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementMock = $this->createMock(PDOStatement::class);

        //TODO Настроить стабы и моки

        $repository = new SqlitePostsRepository($connectionStub);

        $user = new User(
            new UUID('123e4567-e89b-12d3-a456-426614174000'),
            new Name('first_name', 'last_name'),
            'name',
        );

        $repository->save(
            new Post(
                new UUID('123e4567-e89b-12d3-a456-426614174000'),
                $user,
                'Ivan',
                'Nikitin'
            )
        );
    }

    public function testItGetPostByUuid(): void
    {
        $connectionStub = $this->createStub(\PDO::class);
        $statementMock = $this->createMock(\PDOStatement::class);

        //TODO соединить

        $postRepository = new SqlitePostsRepository($connectionStub);
        $post = $postRepository->get(new UUID('9dba7ab0-93be-4ff4-9699-165320c97694'));

        $this->assertSame('9dba7ab0-93be-4ff4-9699-165320c97694', (string)$post->getUuid());
    }
}