DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Likes;
DROP TABLE IF EXISTS Article;
DROP TABLE IF EXISTS Imgs;
DROP TABLE IF EXISTS Category;

CREATE TABLE Users
(
    nickname VARCHAR (50) PRIMARY KEY,
    pwd VARCHAR (50) not null,
    email VARCHAR (50) not null,
    username VARCHAR (50) not null,
    surname VARCHAR (50) not null,
    usertype VARCHAR (5) not null,
    ref VARCHAR (50)
);

CREATE TABLE Article
(
    id int PRIMARY KEY AUTO_INCREMENT,
    link VARCHAR(50) not null,
    creation_date CHAR(32) not null,
    title VARCHAR(50) not null,
    artType VARCHAR(50) not null,
    views int(10) not null,
    Editor varchar(50) REFERENCES Users(nickname)
);

CREATE TABLE Comment
(
    id int (5) PRIMARY KEY AUTO_INCREMENT,
    creation_date CHAR(32) not null,
    txt varchar(296) not null,
    Article int(5) REFERENCES Article(id),
    User varchar(50) REFERENCES Users(nickname)
);

CREATE TABLE Likes
(
    nickname VARCHAR(50) not null,
    commID int (5) not null,

    PRIMARY KEY (nickname, commID),
    FOREIGN KEY (nickname) REFERENCES Users(nickname),
    FOREIGN KEY (commID) REFERENCES Comment(id)

);

CREATE TABLE Imgs
(
    link VARCHAR (50) PRIMARY KEY,
    Article int(5) REFERENCES Article(id),
    alt VARCHAR(10) not null
);

CREATE TABLE Category
(
    names VARCHAR (50) not NULL
);