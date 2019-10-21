DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Likes;
DROP TABLE IF EXISTS Articles;
DROP TABLE IF EXISTS Images;
DROP TABLE IF EXISTS Categories;

CREATE TABLE Users
(
    nickname VARCHAR (50) PRIMARY KEY,
    pwd VARCHAR (50) NOT NULL,
    email VARCHAR (50) NOT NULL,
    username VARCHAR (50) NOT NULL,
    surname VARCHAR (50) NOT NULL,
    usertype VARCHAR (5) NOT NULL,
    ref VARCHAR (50)
);

CREATE TABLE Articles
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    link VARCHAR (50) NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_DATE(),
    title VARCHAR(50) NOT NULL,
    article_type VARCHAR(50) NOT NULL,
    views INT(10) NOT NULL,
    category INT (5) REFERENCES Categories (id),
    Editor VARCHAR(50) REFERENCES Users(nickname)
);

CREATE TABLE Comments
(
    id INT (5) PRIMARY KEY AUTO_INCREMENT,
    creation_date CHAR (32) NOT NULL,
    txt VARCHAR (296) NOT NULL,
    article INT (5) REFERENCES Articles (id)
);

CREATE TABLE Likes
(
    nickname VARCHAR(50) NOT NULL,
    id INT (5) NOT NULL,

    PRIMARY KEY (nickname, id),
    FOREIGN KEY (nickname) REFERENCES Users(nickname),
    FOREIGN KEY (id) REFERENCES Comments (id)

);

CREATE TABLE Images
(
    link VARCHAR (50) PRIMARY KEY
    article INT (5) REFERENCES Articles (id)
    alt VARCHAR (10) NOT NULL
);

CREATE TABLE Categories
(
    id INT (5) PRIMARY KEY
    names VARCHAR (50) UNIQUE NOT NULL
);

CREATE TABLE Follows
(
    nickname VARCHAR(50) NOT NULL,
    id INT (5) NOT NULL,

    PRIMARY KEY (nickname, id),
    FOREIGN KEY (nickname) REFERENCES Users(nickname),
    FOREIGN KEY (id) REFERENCES Categories(id)
);
