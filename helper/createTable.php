<?php
const SQLS = [
    '
        CREATE TABLE IF NOT EXISTS users (
            user_id INTEGER PRIMARY KEY,
            username VARCHAR (255) NOT NULL,
            password VARCHAR (255) NOT NULL
        )
    ',
    '
        CREATE TABLE IF NOT EXISTS book (
            book_id INTEGER PRIMARY KEY,
            title VARCHAR (255) NOT NULL,
            author VARCHAR (255) NOT NULL,
            genre VARCHAR (255) NOT NULL
        )
    ',
];

function createTable($SQLS = SQLS) {
    $db = new SQLite3("./db.sqlite3");
    foreach ($SQLS as $sql)
    {
        $db->exec($sql);
    }
}


?>
