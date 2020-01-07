create DATABASE
    IF NOT EXISTS DecryptedGames;

drop table IF EXISTS images;
drop table IF EXISTS likes;
drop table IF EXISTS comments;
drop table IF EXISTS articles;
drop table IF EXISTS users;
drop table IF EXISTS categories;
drop procedure IF EXISTS IncrementaVisualizzazioni;


create TABLE users
(
    nickname VARCHAR(50) PRIMARY KEY,
    pwd      VARCHAR(50) NOT NULL,
    email    VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    surname  VARCHAR(50) NOT NULL,
    usertype VARCHAR(5)  NOT NULL,
    ref      VARCHAR(50),
    img_src  VARCHAR(50) default 'default.jpg'
);

create TABLE categories
(
    id    INT(5) PRIMARY KEY AUTO_INCREMENT,
    names VARCHAR(50) UNIQUE NOT NULL
);

create TABLE articles
(
    id             INT PRIMARY KEY AUTO_INCREMENT,
    path           VARCHAR(50)  NOT NULL,
    creation_date  DATE DEFAULT CURRENT_TIMESTAMP(),
    title          VARCHAR(300) NOT NULL,
    description    VARCHAR(300),
    category_title VARCHAR(75)  NOT NULL,
    article_type   VARCHAR(50)  NOT NULL,
    views          INT(10)      NOT NULL,
    category       INT(5),
    editor         VARCHAR(50),

    CONSTRAINT FK_editor FOREIGN KEY(editor) REFERENCES users(nickname)
        ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_category_art FOREIGN KEY(category) REFERENCES categories(id)
        ON delete CASCADE ON update CASCADE
);

create TABLE comments
(
    id            INT(5) PRIMARY KEY AUTO_INCREMENT,
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP(),
    txt           VARCHAR(300) NOT NULL,
    user          VARCHAR(50),
    article       INT(5),

    CONSTRAINT FK_user FOREIGN KEY(user) REFERENCES users(nickname)
        ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_article FOREIGN KEY(article) REFERENCES articles(id)
        ON delete CASCADE ON update CASCADE
);

create TABLE likes
(
    nickname VARCHAR(50) NOT NULL,
    id       INT(5)      NOT NULL,

    PRIMARY KEY (nickname, id),
    CONSTRAINT FK_nick_like FOREIGN KEY (nickname) REFERENCES users (nickname) ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_comments FOREIGN KEY (id) REFERENCES comments (id) ON delete CASCADE ON update CASCADE
);

create TABLE images
(
    src     VARCHAR(50) PRIMARY KEY,
    alt     VARCHAR(10) NOT NULL,
    article INT(5),
    CONSTRAINT FK_art_img FOREIGN KEY (article) REFERENCES articles (id) ON delete CASCADE ON update CASCADE
);

DELIMITER ]
CREATE PROCEDURE IncrementaVisualizzazioni(_id int)
BEGIN

    UPDATE articles a
    SET a.views = a.views + 1
    WHERE a.id = _id;

END ]
DELIMITER ;

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
values (1, 'categoriaHardware');
/*1*/
insert into categories
    (id, names)
values (2, 'categoriaEventi');/*2*/
insert into categories
    (id, names)
values (3, 'categoriaConsole');/*3*/
insert into categories
    (id, names)
values (4, 'categoriaVideogiochi');/*4*/
insert into categories
    (id, names)
values (5, 'categoriaAltro');/*5*/


insert into articles
    /*Lucca comics*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (1, 'html/News/LuccaRecord.html', '2019-11-03', 'Lucca Comics. Oltre 88mila biglietti: è record assoluto',
        'Nella giornata di ieri, 02/11/19, nonostante il maltempo, è stato record di biglietti per LuccaC&amp;G 2019',
        'Lucca C&amp;G 19', 'News', '0', '2', null);
insert into articles
    /*Whatsapp News*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (2, 'html/News/WhatsappNews.html', '2020-01-01',
        'Whatsapp: il virus di Capodanno con un messaggio ruba i dati dai telefoni iOs e Android',
        'Whatsapp: il virus di Capodanno si nasconde in un semplice messaggio, ma dopo un click ruba i dati dai telefoni iOS e Android.',
        'Whatsapp', 'News', '0', '5', null);
insert into articles
    /*Fortnite Guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (3, 'html/Altro/guidaFortnite.html', '2020-01-02', 'Fortnite: come ottenere il deltaplano 2020 gratis ',
        'Epic Games sta regalando un deltaplano 2020 gratis a tutti i giocatori, per festeggiare l''anno nuovo: ecco come ottenerlo facilmente.',
        'Fortnite', 'Altro', '0', '4', null);
insert into articles
    /*PokemonGO Guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (4, 'html/Altro/guidaPokemonGo.html', '2019-12-30',
        'Pokémon GO, come sconfiggere Sierra del Team Rocketcon un solo Pokémon',
        'Questo video vi mostra come sconfiggere Sierra del Team GO Rocket di Pokémon GO utilizzando uno ed un solo Pokémon, ecco la guida.',
        'Pokemon Go', 'Altro', '0', '4', null);
insert into articles
    /*Dead Stranding Recensione*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (5, 'html/Recensioni/recensioneDeathStranding.html', '2019-12-04', 'Death Stranding, la recensione - PS4',
        'La recensione di Death Stranding: dopo tre anni di misteri e domande arriva su PS4 l''ultima opera, ma anche un po'' la rinascita di Hideo Kojima. È davvero rivoluzione?',
        'Dead Stranding - recensione', 'Recensione', '18', '4', null);
insert into articles
    /*Vampyr*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (6, 'html/Recensioni/recensioneVampyr.html', '2018-06-05', 'Vampyr: la recensione',
        'L''atteso action RPG di <span xml:lang="en">Dontnod Entertainment</span> ci porta nella Londra del 1918, fra vampiri ed epidemie',
        'Vampyr - recensione', 'Recensioni', '0', '4', null);
insert into articles
    /*Cyberpunk*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (7, 'html/News/Cyberpunk-2077.html', '2019-11-28',
        '<span xml:lang="en">Cyberpunk 2077 "You are breathtaking!"</span>',
        'Dopo che <span xml:lang="en">Keanu Reevs</span> è salito sul palco dell''<span xml:lang="en">E3</span> 2019 per la presentazione di <span xml:lang="en">Cyberpunk 2077</span>, "<span xml:lang="en">You''re Breathtaking</span>" è il tormentone del momento',
        '<span xml:lang="en">Cyberpunk 2077</span>', 'News', '0', '4', null);
insert into articles
    /*Cod*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (8, 'html/Recensioni/Call-of-duty-MW-2019.html', '2019-09-25',
        'Recensione: <span xml:lang="en">Call of Duty: Modern Warfare</span>',
        'ritorno al passato certo, ma soprattutto un nuovo, grande inizio',
        'Call of Duty MW', 'Recensioni', '0', '4', null);
insert into articles
    /*monitor*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (9, 'html/News/Xiaomimonitor.html', '2019-10-18',
        'Xiaomi entra nel mondo dei monitor con<span xml:lang="en"> Mi Surface Display</span>, un 34 pollici <span xml:lang="en"><abbr title="Wide Quad HD">WQHD</abbr></span> con <span xml:lang="en">FreeSync</span>',
        '',
        'Xiaomi Monitor', 'News', '0', '1', null);
insert into articles
    /*star wars*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (10, 'html/Recensioni/recensioneStarWars.html', '2019-11-16',
        '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, la recensione - <span xml:lang="en"><abbr title="Play Station 4">PS4</abbr></span>',
        'La recensione di Star Wars Jedi: Fallen Order. Con vari prodotti altalenanti all''attivo e i frutti della scommessa Motive ancora ignoti, EA affida a Respawn la licenza Star Wars. Riuscirà il team a rendere giustizia al marchio? Scopriamolo insieme',
        '<span xml:lang="en"><abbr title="Play Station 4">PS4</abbr></span>', 'Recensioni', '20', '4', null);
insert into articles
    /*death stranding*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (11, 'html/News/DeathStrandingPC.html', '2019-10-30',
        '<span xml:lang="en "> Death Stranding</span>: versione PC e periodo di uscita confermati',
        '',
        'Death Stranding PC', 'News', '0', '4', null);
insert into articles
    /*StarWars vendite*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (12, 'html/News/StarWarsPCSell.html', '2019-11-27',
        '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, versione PC oltre le aspettative, battuti diversi record',
        'Vendite PC, battuti molti record', 'Star Wars vendite PC', 'News', '0', '4', null);

insert into articles
    /*StarWars guida*/
    (id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values
    (13, 'html/Altro/guidaStarWars.html', '2019-11-24', '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, consigli per godersi il gioco <span xml:lang="en">Respawn</span>', 'Ecco una manciata di piccoli consigli per chi ha appena cominciato o intende iniziare il suo viaggio in Star Wars Jedi: Fallen Order.', 'gaming', 'Altro', '27', '4', null);

insert into articles
    /*Monster Hunter News*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (14, 'html/News/newsMonsterHunterIceborn.html', '2019-12-7',
        '<span xml:lang="en">Monster Hunter World: Iceborn</span>, le novità dell''aggiornamento di dicembre - <span xml:lang="en"><abbr title="Play Station 4">PS4</abbr>, Xbox One</span>',
        '', 'gaming', 'News', '0', '5', null);

insert into articles
    /*Asgard Wrath review*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (15, 'html/Recensioni/recensioneAsgardWrath.html', '2019-12-7',
        '<span xml:lang="en">Asgard''s Wrath</span>, la recensione',
        'Loki dice che c''è una nuova divinità in giro, sei per caso tu?', 'gaming', 'Recensioni', '0', '4', null);

insert into articles
    /*Clash Royale guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (16, 'html/Altro/guidaClashRoyale.html', '2020-1-5',
        '<span xml:lang="en">Clash Royale</span>, come creare un mazzo vincente',
        'Come creare un mazzo vincente? Scopriamolo assieme', 'gaming', 'Altro', '0', '3', null);
insert into articles
    /*PS5 news*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (17, 'html/News/ps5.html', '2020-1-7',
        '<abbr xml:lang="en" title="Playstation 5">PS5</abbr>: le nuove informazioni del 2020',
        'supporto al <span xml:lang="en">Ray Tracing</span> e finestra di lancio confermata',
        '<abbr xml:lang="en" title="Playstation 5">PS5</abbr>', 'News', '0', '3', null);
insert into articles
    /*Code vein recensione*/
(id, path, creation_date, title, description, category_title, article_type, views, category, editor)
values (18, 'html/Recensioni/code-vein.html', '2019-10-26',
        'Recensione: <span xml:lang="en">Code Vein</span>',
        'La recensione di <span xml:lang="en">Code Vein</span> per <span xml:lang="en">PlayStation 4</span>: Vampiri, <span xml:lang="en">Soulslike</span> ed <abbr xml:lang="en" title="Role play game">RPG</abbr> nel nuovo gioco targato <span xml:lang="en">Bandai Namco</span>',
        '<span xml:lang="en">Code Vein</span>', 'Recensioni', '0', '4', null);



insert into images
    (src, alt, article)
values ('images/Lucca-Comics-Games-982x540.jpg', '', '1');

insert into images
    (src, alt, article)
values ('images/News/whatsapp.jpg', '', '2');
insert into images
    (src, alt, article)
values ('images/Altro/fortnite/fortniteDeltaplano.jpg', '', '3');
insert into images
    (src, alt, article)
values ('images/Altro/pokemon/sierra.jpg', '', '4');
insert into images
    (src, alt, article)
values ('images/Recensioni/dead-stranding/img0.jpg', '', '5');
insert into images
    (src, alt, article)
values ('images/Recensioni/vampyr/vampyr.jpg', '', '6');
insert into images
    (src, alt, article)
values ('images/News/Cyberpunk/CP20771-lowRes.jpg', '', '7');
insert into images
    (src, alt, article)
values ('images/Recensioni/cod-mw-2019/codmw.png', '', '8');
insert into images
    (src, alt, article)
values ('images/mi-surface-display.jpg', '', '9');
insert into images
    (src, alt, article)
values ('images/Recensioni/Star-Wars/StarWarsCopertina.jpg', '', '10');
insert into images
    (src, alt, article)
values ('images/death-stranding-image.jpg', '', '11');
insert into images
    (src, alt, article)
values ('images/News/StarWars/StarWarsNews.jpg', '', '12');
insert into images
    (src, alt, article)
values ('images/Altro/StarWars/Copertina.jpg', '', '13');
insert into images
    (src, alt, article)
values ('images/News/monsterHunterWorld/monsterHunter.jpg', '', '14');
insert into images
    (src, alt, article)
values ('images/Recensioni/asgardsWrath/asgardsWrath.jpeg', '', '15');
insert into images
    (src, alt, article)
values ('images/Altro/clash_royale.jpg', '', '16');
insert into images
(src, alt, article)
values ('images/News/PS5/logo-ps5.png', '', '17');
insert into images
(src, alt, article)
values ('images/Recensioni/code-vein/code-vein-low-res.jpg', '', '18');
