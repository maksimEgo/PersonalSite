<?php

require_once __DIR__ . '/../public/autoload.php';

$db = new \models\DB();

try {
    $db->execute('CREATE TABLE IF NOT EXISTS info(
    info_id serial PRIMARY KEY NOT NULL,
    text_info TEXT
    );');

    $db->execute('CREATE TABLE IF NOT EXISTS users (
    user_id serial PRIMARY KEY NOT NULL,
    user_login VARCHAR(28) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_rights INT NOT NULL,
    user_hash_password varchar(255) NOT NULL
        );');

    $db->execute('CREATE TABLE IF NOT EXISTS guestBook (
    entry_id serial PRIMARY KEY NOT NULL,
    user_name VARCHAR(28) NOT NULL,
    entry_text TEXT NOT NULL
        );');

    $db->execute('CREATE TABLE IF NOT EXISTS gallery (
    image_id serial PRIMARY KEY NOT NULL,
    image_path text NOT NULL
        );');
} catch ( \Exception $exception ) {
    echo $exception->getMessage();
}
