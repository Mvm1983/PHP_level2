<?php

require_once __DIR__ . '/vendor/autoload.php';

use mvm\less1\blog\Commands\CreateUserCommand;
use mvm\less1\Blog\Post;
use mvm\less1\Person\Name;
use mvm\less1\Blog\User;
use mvm\less1\Blog\comment;
use mvm\less1\Blog\Exceptions\UserNotFoundException;
use mvm\less1\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use mvm\less1\Blog\UUID;
use mvm\less1\Blog\Commands\Arguments;
use mvm\less1\Blog\Repositories\CommentsRepository\SqliteCommentsRepository;
use mvm\less1\Blog\Repositories\PostsRepository\SqlitePostsRepository;

//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

/*
//Создание комментов
$usersRepository = new SqliteUsersRepository($connection);
$postsRepository = new SqlitePostsRepository($connection);
$commentsRepository = new SqliteCommentsRepository($connection);

$user = $usersRepository->get(new UUID("da75dfb1-b22e-49b8-a63d-0402bb9569a7"));

echo $user;

$post = $postsRepository->get(new UUID("c7e767fc-2dc7-4400-9b1c-21c3ce2b2ee5"));

print_r($post);

$faker = Faker\Factory::create('ru_RU');

try {

$comment = new Comment(
    UUID::random(),
    $post,
    $user,
    $faker->realText(rand(50, 300))
);

print_r($comment);

$commentsRepository->save($comment);

} catch (Exception $err) {
    echo $err->getMessage();
}

*/

//Создание Постов
/*
$usersRepository = new SqliteUsersRepository($connection);

$postsRepository = new SqlitePostsRepository($connection);

$user = $usersRepository->get(new UUID("6edae623-9862-4f0a-bd4d-4bba72079e94"));

$faker = Faker\Factory::create('ru_RU');

try {

$post = new Post(
    UUID::random(),
    $user, 
    $faker->realText(rand(10, 50)), 
    $faker->realText(rand(50, 300))
);

$postsRepository->save($post); 

} catch (Exception $err) {
    echo $err->getMessage();
}*/


/*
//создание объекта USER
//Создаём объект репозитория для пользователя
$usersRepository = new SqliteUsersRepository($connection);

//$usersRepository->save(new User(UUID::random(), new Name('Михаил', 'Можаев'), 'admin'));
//$usersRepository->save(new User(UUID::random(), new Name('Таня', 'Лазарева'), 'NoAdmin'));

$command = new CreateUserCommand($usersRepository);


//php cli.php username=Venik first_name=Вениамин last_name=Веникович
try {
    $command->handle(Arguments::fromArgv($argv));
} catch (Exception $err) {
    echo $err->getMessage();
}
*/

//Получение пользователя по UUID
/*
try {
    echo $usersRepository->get(new UUID("6edae623-9862-4f0a-bd4d-4bba72079e94"));
} catch (Exception $err) {
    echo $err->getMessage();
}
*/

/*
$faker = Faker\Factory::create('ru_RU');

$name = new Name($faker->firstName('femele'), $faker->lastName('femele'));
$user = new User($faker->randomDigitNotNull(), $name, $faker->sentence());

$route = $argv[1] ?? null;

//echo $route . PHP_EOL;

switch ($route) {
    case "user":
        echo $user;
    break;
    case "post":
        $post = new Post(
            $faker->randomDigitNotNull(),
            $user,
            $faker->realText(rand(50, 150))
        );
        echo $post;
    break;
    case "comment":
        $post = new Post(
            $faker->randomDigitNotNull(),
            $user,
            $faker->realText(rand(50, 150))
        );
        $comment = new Comment(
            $faker->randomDigitNotNull(),
            $user,
            $post,
            $faker->realText(rand(50, 150))
        );
        echo $comment;
    break;
    default:
        echo "Неверный параметр";
}
*/
