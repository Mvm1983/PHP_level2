<?php

namespace mvm\less1\Blog\Repositories\CommentsRepository;


use mvm\less1\Blog\Comments;
use mvm\less1\Blog\UUID;

interface CommentsRepositoryInterface
{
    public function save(Comments $comments): void;
    public function get(UUID $uuid): Comments;
}