<?php

namespace mvm\less1\Blog\Repositories\PostsRepository;

use mvm\less1\Blog\Post;
use mvm\less1\Blog\UUID;

interface PostsRepositoryInterface
{
    public function save(Post $post): void;
    public function get(UUID $uuid): Post;
}