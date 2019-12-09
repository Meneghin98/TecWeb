create DATABASE IF NOT EXISTS DecryptedGames;

drop table IF EXISTS images;
drop table IF EXISTS follows;
drop table IF EXISTS likes;
drop table IF EXISTS comments;
drop table IF EXISTS articles;
drop table IF EXISTS users;
drop table IF EXISTS categories;


create TABLE users
(
    nickname VARCHAR(50) PRIMARY KEY,
    pwd      VARCHAR(50) NOT NULL,
    email    VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    surname  VARCHAR(50) NOT NULL,
    usertype VARCHAR(5)  NOT NULL,
    ref      VARCHAR(50)
);

create TABLE categories
(
    id    INT(5) PRIMARY KEY AUTO_INCREMENT,
    names VARCHAR(50) UNIQUE NOT NULL
);

create TABLE follows
(
    nickname VARCHAR(50) NOT NULL,
    id       INT(5)      NOT NULL,

    PRIMARY KEY (nickname, id),
    CONSTRAINT FK_nick FOREIGN KEY (nickname) REFERENCES Users (nickname) ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_category FOREIGN KEY (id) REFERENCES Categories (id) ON delete CASCADE ON update CASCADE
);

create TABLE articles
(
    id             INT PRIMARY KEY AUTO_INCREMENT,
    path           VARCHAR(50)  NOT NULL,
    creation_date  DATE DEFAULT (CURRENT_TIMESTAMP()),
    title          VARCHAR(300) NOT NULL,
    description    VARCHAR(300),
    category_title VARCHAR(50)  NOT NULL,
    article_type   VARCHAR(50)  NOT NULL,
    views          INT(10)      NOT NULL,
    category       INT(5),
    editor         VARCHAR(50),

    CONSTRAINT FK_editor FOREIGN KEY (editor) REFERENCES Users (nickname) ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_category_art FOREIGN KEY (category) REFERENCES Categories (id) ON delete CASCADE ON update CASCADE
);

create TABLE comments
(
    id            INT(5) PRIMARY KEY AUTO_INCREMENT,
    creation_date CHAR(32)     NOT NULL,
    txt           VARCHAR(296) NOT NULL,
    user          VARCHAR(50),
    article       INT(5),

    CONSTRAINT FK_user FOREIGN KEY (user) REFERENCES Users (nickname) ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_article FOREIGN KEY (article) REFERENCES articles (id) ON delete CASCADE ON update CASCADE
);

create TABLE likes
(
    nickname VARCHAR(50) NOT NULL,
    id       INT(5)      NOT NULL,

    PRIMARY KEY (nickname, id),
    CONSTRAINT FK_nick_like FOREIGN KEY (nickname) REFERENCES Users (nickname) ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_comments FOREIGN KEY (id) REFERENCES Comments (id) ON delete CASCADE ON update CASCADE
);

create TABLE images
(
    src     VARCHAR(50) PRIMARY KEY,
    alt     VARCHAR(10) NOT NULL,
    article INT(5),
    CONSTRAINT FK_art_img FOREIGN KEY (article) REFERENCES Articles (id) ON delete CASCADE ON update CASCADE
);

insert into users
    (nickname, pwd, email, username, surname, usertype, ref)
values ('admin', 'admin', 'admin@admin.it', 'admin', 'admin', 'admin', null);
insert into users
    (nickname, pwd, email, username, surname, usertype, ref)
values ('user', 'user', 'user@user.it', 'user', 'user', 'user', null);
insert into users
(nickname, pwd, email, username, surname, usertype, ref)
values ('Simone', 'user', 'simone.meneghin@studenti.unipd.it', 'Simone', 'Meneghin', 'admin', null);




insert into categories
    (id, names)
values (null, 'categoriaHardware'); /*1*/
insert into categories
    (id, names)
values (null, 'categoriaEventi');/*2*/
insert into categories
    (id, names)
values (null, 'categoriaConsole');/*3*/
insert into categories
    (id, names)
values (null, 'categoriaVideogiochi');/*4*/
insert into categories
    (id, names)
values (null, 'categoriaAltro');/*5*/


insert into articles /*Lucca comics*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/News/LuccaRecord.html', '2019-11-03', 'Lucca Comics. Oltre 88mila biglietti: è record assoluto',
        'Nella giornata di ieri, 02/11/19, nonostante il maltempo, è stato record di biglietti per LuccaC&amp;G 2019',
        'Lucca C&amp;G 19', 'News', '0', '2', null);
insert into articles/*Vampyr*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/Recensioni/recensioneVampyr.html', '2018-06-05', 'Vampyr: la recensione',
        'L''atteso action RPG di <span xml:lang="en">Dontnod Entertainment</span> ci porta nella Londra del 1918, fra vampiri ed epidemie',
        'Vampyr - recensione', 'Recensioni', '0', '4', null);
insert into articles/*Cyberpunk*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/News/Cyberpunk-2077.html', '2019-11-28',
        '<span xml:lang="en">Cyberpunk 2077 "You are breathtaking!"</span>',
        'Dopo che <span xml:lang="en">Keanu Reevs</span> è salito sul palco dell''<span xml:lang="en">E3</span> 2019 per la presentazione di <span xml:lang="en">Cyberpunk 2077</span>, "<span xml:lang="en">You''re Breathtaking</span>" è il tormentone del momento',
        '<span xml:lang="en">Cyberpunk 2077</span>', 'News', '0', '4', null);
insert into articles/*Cod*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/Recensioni/Call-of-duty-MW-2019.html', '2019-09-25', 'Recensione: <span xml:lang="en">Call of Duty: Modern Warfare</span>',
        'ritorno al passato certo, ma soprattutto un nuovo, grande inizio',
        'Call of Duty MW', 'Recensioni', '0', '4', null);
insert into articles/*monitor*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/News/Xiaomimonitor.html', '2019-10-18', 'Xiaomi entra nel mondo dei monitor con<span xml:lang="en"> Mi Surface Display, un 34 pollici <span xml:lang="en"><abbr title="Wide Quad HD">WQHD</abbr></span> con <span xml:lang="en">FreeSync</span></span>',
        '',
        'Xiaomi Monitor', 'News', '0', '1', null);
insert into articles/*star wars*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/Recensioni/recensioneStarWars.html', '2019-11-16', '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, la recensione - <span xml:lang="en"><abbr title="Play Station 4">PS4</abbr></span>',
        '',
        'Star Wars - PS4', 'Recensioni', '0', '4', null);
insert into articles/*death stranding*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (null, 'html/News/DeathStrandingPC.html', '2019-10-30', '<span xml:lang="en "> Death Stranding</span>: versione PC e periodo di uscita confermati',
        '',
        'Death Stranding PC', 'News', '0', '4', null);




insert into images
    (src, alt, article)
values ('images/Lucca-Comics-Games-982x540.jpg', '', '1');
insert into images
    (src, alt, article)
values ('images/Recensioni/vampyr/vampyr.jpg', '', '2');
insert into images
    (src, alt, article)
values ('images/News/Cyberpunk/CP20771-lowRes.jpg', '', '3');
insert into images
(src, alt, article)
values ('images/Recensioni/cod-mw-2019/codmw.png', '', '4');
insert into images
(src, alt, article)
values ('images/mi-surface-display.jpg', '', '5');
insert into images
(src, alt, article)
values ('images/Recensioni/Star-Wars/starwars.png', '', '6');
insert into images
(src, alt, article)
values ('images/death-stranding-image.jpg', '', '7');