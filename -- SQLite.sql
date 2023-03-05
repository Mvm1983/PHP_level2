-- SQLite
/*
CREATE table posts (
    uuid TEXT NOT NULL 
        CONSTRAINT uuid_primary_key PRIMARY KEY,
    author_uuid TEXT NOT NULL,
    title TEXT NOT NULL,
    text TEXT NOT NULL); */

Create table comments (
    uuid TEXT NOT NULL 
        CONSTRAINT uuid_primary_key PRIMARY KEY,
    post_uuid TEXT not null,
    author_uuid text not null,
    text TEXT NOT NULL);