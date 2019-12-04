CREATE DATABASE IF NOT EXISTS DecryptedGames;

DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS follows;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS comments;


CREATE TABLE users(
    nickname VARCHAR (50) PRIMARY KEY,
    pwd VARCHAR (50) NOT NULL,
    email VARCHAR (50) NOT NULL,
    username VARCHAR (50) NOT NULL,
    surname VARCHAR (50) NOT NULL,
    usertype VARCHAR (5) NOT NULL,
    ref VARCHAR (50)
);

CREATE TABLE articles
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    link VARCHAR (50) NOT NULL,
    creation_date TIMESTAMP DEFAULT(CURRENT_TIMESTAMP()),
    title VARCHAR(50) NOT NULL,
    article_type VARCHAR(50) NOT NULL,
    views INT(10) NOT NULL,
    category INT (5) REFERENCES Categories (id),
    editor VARCHAR(50) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE comments
(
    id INT (5) PRIMARY KEY AUTO_INCREMENT,
    creation_date CHAR (32) NOT NULL,
    txt VARCHAR (296) NOT NULL,
    user VARCHAR(50) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE,
    article INT (5) REFERENCES Articles (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE likes
(
    nickname VARCHAR(50) NOT NULL,
    id INT (5) NOT NULL,

    PRIMARY KEY (nickname, id),
    FOREIGN KEY (nickname) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id) REFERENCES Comments (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE images
(
    link VARCHAR (50) PRIMARY KEY,
    alt VARCHAR (10) NOT NULL,
    article INT (5) REFERENCES Articles (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE categories
(
    id INT (5) PRIMARY KEY,
    names VARCHAR (50) UNIQUE NOT NULL
);

CREATE TABLE follows
(
    nickname VARCHAR(50) NOT NULL,
    id INT (5) NOT NULL,

    PRIMARY KEY (nickname, id),
    FOREIGN KEY (nickname) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id) REFERENCES Categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO users (nickname, pwd, email, username, surname, usertype, ref) VALUES ('admin', 'admin', 'admin@admin.it', 'admin', 'admin', 'admin', NULL);
INSERT INTO users (nickname, pwd, email, username, surname, usertype, ref) VALUES ('user', 'user', 'user@user.it', 'user', 'user', 'user', NULL);