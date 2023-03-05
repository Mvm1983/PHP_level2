<?php

namespace mvm\less1\Blog;

class Comments
{
    public function __construct(
        private UUID $uuid,
        private Post $post,
        private User $author,
        private string $text
    )
    {
    }


    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function __toString()
    {
        return $this->author . " пишет комментарий " . $this->text;
    }
}