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
    ref VARCHAR (50),

    /*ON UPDATE CASCADE -----------SE SI VUOLE CAMBIARE IL NICKNAME CHE SUCCEDE?*/
    ON DELETE CASCADE
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

CREATE TABLE Articles
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

CREATE TABLE Comments
(
    id INT (5) PRIMARY KEY AUTO_INCREMENT,
    creation_date CHAR (32) NOT NULL,
    txt VARCHAR (296) NOT NULL,
<<<<<<< HEAD
    user VARCHAR(50) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE,
    article INT (5) REFERENCES Articles (id) ON DELETE CASCADE ON UPDATE CASCADE
=======
    user VARCHAR(50) REFERENCES Users(nickname),
    article INT (5) REFERENCES Articles (id)
>>>>>>> 2f6685e7b8410c71072266a965adabcd344074a9
);

CREATE TABLE Likes
(
    nickname VARCHAR(50) NOT NULL,
    id INT (5) NOT NULL,

    PRIMARY KEY (nickname, id),
<<<<<<< HEAD
    FOREIGN KEY (nickname) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id) REFERENCES Comments (id) ON DELETE CASCADE ON UPDATE CASCADE
=======
    FOREIGN KEY (nickname) REFERENCES Users(nickname),
    FOREIGN KEY (id) REFERENCES Comments (id)

>>>>>>> 2f6685e7b8410c71072266a965adabcd344074a9
);

CREATE TABLE Images
(
    link VARCHAR (50) PRIMARY KEY,
<<<<<<< HEAD
    alt VARCHAR (10) NOT NULL,
    article INT (5) REFERENCES Articles (id) ON DELETE CASCADE ON UPDATE CASCADE
=======
    article INT (5) REFERENCES Articles (id),
    alt VARCHAR (10) NOT NULL
>>>>>>> 2f6685e7b8410c71072266a965adabcd344074a9
);

CREATE TABLE Categories
(
    id INT (5) PRIMARY KEY,
<<<<<<< HEAD
    names VARCHAR (50) UNIQUE NOT NULL
=======
    names VARCHAR (50) UNIQUE NOT NULL,
>>>>>>> 2f6685e7b8410c71072266a965adabcd344074a9
);

CREATE TABLE Follows
(
    nickname VARCHAR(50) NOT NULL,
    id INT (5) NOT NULL,

    PRIMARY KEY (nickname, id),
<<<<<<< HEAD
    FOREIGN KEY (nickname) REFERENCES Users(nickname) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id) REFERENCES Categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);
=======
    FOREIGN KEY (nickname) REFERENCES Users(nickname),
    FOREIGN KEY (id) REFERENCES Categories(id)
);
>>>>>>> 2f6685e7b8410c71072266a965adabcd344074a9
