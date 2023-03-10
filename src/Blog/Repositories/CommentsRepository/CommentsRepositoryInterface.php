<?php

namespace mvm\less1\Blog\Repositories\CommentsRepository;


use mvm\less1\Blog\Comment;
use mvm\less1\Blog\UUID;

interface CommentsRepositoryInterface
{
    public function save(Comment $comments): void;
    public function get(UUID $uuid): Comment;
}