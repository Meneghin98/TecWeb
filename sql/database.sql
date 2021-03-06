
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
    creation_date  DATE,
    title          VARCHAR(300) NOT NULL,
    description    VARCHAR(300),
    category_title VARCHAR(75)  NOT NULL,
    article_type   VARCHAR(50)  NOT NULL,
    views          INT(10)      NOT NULL,
    category       INT(5),

    CONSTRAINT FK_category_art FOREIGN KEY (category) REFERENCES categories (id)
        ON delete CASCADE ON update CASCADE
);

create TABLE comments
(
    id            INT(5) PRIMARY KEY AUTO_INCREMENT,
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP(),
    txt           VARCHAR(300) NOT NULL,
    user          VARCHAR(50),
    article       INT(5),

    CONSTRAINT FK_user FOREIGN KEY (user) REFERENCES users (nickname)
        ON delete CASCADE ON update CASCADE,
    CONSTRAINT FK_article FOREIGN KEY (article) REFERENCES articles (id)
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
    alt     VARCHAR(100) NOT NULL,
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
values ('Simone', 'admin', 'simone.meneghin@studenti.unipd.it', 'Simone', 'Meneghin', 'admin', null);
insert into users
(nickname, pwd, email, username, surname, usertype, ref)
values ('Nicolo', 'admin', 'nicolo.giaccone@studenti.unipd.it', 'Nicol&ograve;', 'Giaccone', 'admin', null);
insert into users
(nickname, pwd, email, username, surname, usertype, ref)
values ('Enrico', 'admin', 'enrico.salmaso.2@studenti.unipd.it', 'Enrico', 'Salmaso', 'admin', null);
insert into users
(nickname, pwd, email, username, surname, usertype, ref)
values ('Edoardo', 'admin', 'edoardo.tinto@studenti.unipd.it', 'Edoardo', 'Tinto', 'admin', null);



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
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (1, 'html/News/newLuccaRecord.html', '2019-11-03', 'Lucca Comics. Oltre 88mila biglietti: &egrave; record assoluto',
        'Nella giornata di ieri, 02/11/19, nonostante il maltempo, &egrave; stato record di biglietti per LuccaC&amp;G 2019',
        'Lucca C&amp;G 19', 'News', '0', '2');
insert into articles
    /*Whatsapp News*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (2, 'html/News/newWhatsapp.html', '2020-01-01',
        'Whatsapp: il virus di Capodanno con un messaggio ruba i dati dai telefoni iOs e Android',
        'I virus di Capodanno si nasconde in un semplice messaggio, ma dopo un click ruba i dati dai telefoni iOS e Android.',
        'Whatsapp', 'News', '0', '5');
insert into articles
    /*Fortnite Guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (3, 'html/Altro/guidaFortnite.html', '2020-01-02', 'Fortnite: come ottenere il deltaplano 2020 gratis ',
        'Epic Games sta regalando un deltaplano 2020 gratis a tutti i giocatori, per festeggiare l&apos;anno nuovo: ecco come ottenerlo facilmente.',
        'Fortnite', 'Altro', '0', '4');
insert into articles
    /*PokemonGO Guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (4, 'html/Altro/guidaPokemonGo.html', '2019-12-30',
        'Pok&eacute;mon GO, come sconfiggere Sierra del Team Rocket con un solo Pok&eacute;mon',
        'Questo video vi mostra come sconfiggere Sierra del Team GO Rocket di Pok&eacute;mon GO utilizzando uno ed un solo Pok&eacute;mon, ecco la guida.',
        'Pokemon Go', 'Altro', '0', '4');
insert into articles
    /*Death Stranding Recensione*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (5, 'html/Recensioni/recensioneDeathStranding.html', '2019-12-04', 'Death Stranding, la recensione - PS4',
        'La recensione di Death Stranding: dopo tre anni di misteri e domande arriva su PS4 l&apos;ultima opera, ma anche un po&apos; la rinascita di Hideo Kojima. &Egrave; davvero rivoluzione?',
        'Death Stranding', 'Recensioni', '18', '4');
insert into articles
    /*Vampyr*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (6, 'html/Recensioni/recensioneVampyr.html', '2018-06-05', 'Vampyr: la recensione',
        'L&apos;atteso action RPG di <span xml:lang="en">Dontnod Entertainment</span> ci porta nella Londra del 1918, fra vampiri ed epidemie',
        'Vampyr', 'Recensioni', '0', '4');
insert into articles
    /*Cyberpunk*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (7, 'html/News/newCyberpunk2077.html', '2019-11-28',
        '<span xml:lang="en">Cyberpunk 2077 "You are breathtaking!"</span>',
        'Dopo che <span xml:lang="en">Keanu Reevs</span> &egrave; salito sul palco dell&apos;<span xml:lang="en">E3</span> 2019 per la presentazione di <span xml:lang="en">Cyberpunk 2077</span>, "<span xml:lang="en">You&apos;re Breathtaking</span>" &egrave; il tormentone del momento',
        '<span xml:lang="en">Cyberpunk 2077</span>', 'News', '0', '4');
insert into articles
    /*Cod*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (8, 'html/Recensioni/recensioneCallOfDutyMW.html', '2019-09-25',
        'Recensione: <span xml:lang="en">Call of Duty: Modern Warfare</span>',
        'ritorno al passato certo, ma soprattutto un nuovo, grande inizio',
        'Call of Duty MW', 'Recensioni', '0', '4');
insert into articles
    /*monitor*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (9, 'html/News/newXiaomimonitor.html', '2019-10-18',
        'Xiaomi entra nel mondo dei monitor con<span xml:lang="en"> Mi Surface Display</span>, un 34 pollici <span xml:lang="en"><abbr title="Wide Quad HD">WQHD</abbr></span> con <span xml:lang="en">FreeSync</span>',
        'Xiaomi non si ferma! Arrivano i primi monitor da gaming dell&apos;azienda cinese.',
        'Xiaomi Monitor', 'News', '0', '1');
insert into articles
    /*star wars*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (10, 'html/Recensioni/recensioneStarWars.html', '2019-11-16',
        '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, la recensione - <span xml:lang="en"><abbr title="Play Station 4">PS4</abbr></span>',
        'La recensione di Star Wars Jedi: Fallen Order. Con vari prodotti altalenanti all&apos;attivo e i frutti della scommessa Motive ancora ignoti, EA affida a Respawn la licenza Star Wars. Riuscir&agrave; il team a rendere giustizia al marchio? Scopriamolo insieme',
        '<span xml:lang="en"><abbr title="Play Station 4">PS4</abbr></span>', 'Recensioni', '20', '4');
insert into articles
    /*death stranding*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (11, 'html/News/newDeathStrandingPC.html', '2019-10-30',
        '<span xml:lang="en"> Death Stranding</span>: versione PC e periodo di uscita confermati',
        'Annunciata la veriosne pc del gioco di <span xml:lang="ja">Hideo Kojima</span>, uscir&agrave; nell&apos;estate del 2020.',
        'Death Stranding PC', 'News', '0', '4');
insert into articles
    /*StarWars vendite*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (12, 'html/News/newStarWarsPCSell.html', '2019-11-27',
        '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, versione PC oltre le aspettative, battuti diversi record',
        'Il titolo <span xml:lang="en">Respawn</span> ha gi&agrave; battuto molti record. Questo &egrave; un ottimo periodo per la saga di <span xml:lang="en">Star Wars</span>', '<span xml:lang="en">Star Wars</span>', 'News', '0', '4');

insert into articles
    /*StarWars guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (13, 'html/Altro/guidaStar-Wars.html', '2019-11-24',
        '<span xml:lang="en">Star Wars Jedi: Fallen Order</span>, consigli per godersi il gioco <span xml:lang="en">Respawn</span>',
        'Ecco una manciata di piccoli consigli per chi ha appena cominciato o intende iniziare il suo viaggio in Star Wars Jedi: Fallen Order.',
        'Star Wars', 'Altro', '27', '4');

insert into articles
    /*Monster Hunter News*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (14, 'html/News/newMonsterHunterIceborn.html', '2019-12-7',
        '<span xml:lang="en">Monster Hunter World: Iceborn</span>, le novit&agrave; dell&apos;aggiornamento di dicembre - <span xml:lang="en"><abbr title="Play Station 4">PS4</abbr>, Xbox One</span>',
        'Notizie novit&agrave; sulla nuova uscita di dicembre', 'Monster Hunter', 'News', '0', '5');

insert into articles
    /*Asgard Wrath review*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (15, 'html/Recensioni/recensioneAsgardWrath.html', '2019-12-7',
        '<span xml:lang="en">Asgard&apos;s Wrath</span>, la recensione',
        'Loki dice che c&apos;&egrave; una nuova divinit&agrave; in giro, sei per caso tu?', 'Asgard Wrath', 'Recensioni', '0', '4');

insert into articles
    /*Clash Royale guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (16, 'html/Altro/guidaClashRoyale.html', '2020-1-5',
        '<span xml:lang="en">Clash Royale</span>, come creare un mazzo vincente',
        'Come creare un mazzo vincente? Scopriamolo assieme', 'Clash royale', 'Altro', '0', '3');

insert into articles
    /*PS5 news*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (17, 'html/News/newPS5.html', '2020-1-7',
        '<abbr xml:lang="en" title="Playstation 5">PS5</abbr>: le nuove informazioni del 2020',
        'supporto al <span xml:lang="en">Ray Tracing</span> e finestra di lancio confermata',
        '<abbr xml:lang="en" title="Playstation 5">PS5</abbr>', 'News', '0', '3');

insert into articles
    /*Code vein recensione*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (18, 'html/Recensioni/recensioneCodeVein.html', '2019-10-26',
        'Recensione: <span xml:lang="en">Code Vein</span>',
        'La recensione di <span xml:lang="en">Code Vein</span> per <span xml:lang="en">PlayStation 4</span>: Vampiri, <span xml:lang="en">Soulslike</span> ed <abbr xml:lang="en" title="Role play game">RPG</abbr> nel nuovo gioco targato <span xml:lang="en">Bandai Namco</span>',
        '<span xml:lang="en">Code Vein</span>', 'Recensioni', '0', '4');

insert into articles
    /*Witcher guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (19, 'html/Altro/guidaTheWitcher.html', '2020-1-7',
        '<span xml:lang="en">The Witcher 3</span>: guida per chi si avvicina dopo la serie <span xml:lang="en">Netflix</span>',
        'Dopo aver visto lo <span xml:lang="en">show</span> su <span xml:lang="en">Netflix</span> vi siete
                    precipitati su <span xml:lang="en">The Witcher 3</span> ma non sapete cosa aspettarvi? Ecco alcuni
                    utili consigli per i neofiti', 'The Witcher', 'Altro', '0', '3');
insert into articles
    /*AMD CES 2020*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (20, 'html/News/newAMD.html', '2020-1-10',
        'Le novit&agrave; AMD: <span xml:lang="en">Ryzen Mobile</span> 4000, RX 5600 XT e <span
                        xml:lang="en">Threadripper</span> 3990X',
        'Le novit&agrave; che AMD ha portato al CES 2020 di <span xml:lang="en">Las Vegas</span>', 'AMD', 'News', '50', '1');

insert into articles
    /*Skyrim guida*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (21, 'html/Altro/guidaSkyrim.html', '2020-1-9',
        '<span xml:lang="en">Skyrim Mods</span>: Guida e Consigli',
        'Come scaricare ed installare il miglior pacchetto di <span xml:lang="en">mod</span>', 'gaming', 'Altro', '0',
        '3');
insert into articles
    /*GTA V Rew*/
(id, path, creation_date, title, description, category_title, article_type, views, category)
values (22, 'html/Recensioni/recensioneGTAV.html', '2013-9-27',
        'GTA V, cinque volte GTA',
        'Il titolo pi&ugrave; atteso degli ultimi anni &egrave; finalmente arrivato. L&apos;abbiamo giocato a
                    lungo, senza un minuto di sosta e quello che segue &egrave; il nostro dettagliato giudizio',
        'GTA <abbr title="cinque">V</abbr>', 'Recensioni', '200', '4');


insert into images
    (src, alt, article)
values ('images/News/LuccaComics/LCcopertina.jpg', 'Locandina della fiera con due personaggi che danzano', '1');

insert into images
    (src, alt, article)
values ('images/News/Whatsapp/whatsapp.jpg', 'Immagine del messaggio su whatsapp', '2');

insert into images
    (src, alt, article)
values ('images/Altro/fortnite/fortniteDeltaplano.jpg', 'Deltaplano di Fortnite', '3');

insert into images
    (src, alt, article)
values ('images/Altro/pokemon/sierra.jpg', 'viene mostrata Sierra', '4');

insert into images
    (src, alt, article)
values ('images/Recensioni/death-stranding/img0.jpg', 'Immagine di copertina del videogioco', '5');

insert into images
    (src, alt, article)
values ('images/Recensioni/vampyr/vampyr.jpg', 'Immagine di copertina del videogioco', '6');

insert into images
    (src, alt, article)
values ('images/News/Cyberpunk/CP20771-lowRes.jpg', 'Copertina cyberpunk', '7');

insert into images
    (src, alt, article)
values ('images/Recensioni/cod-mw-2019/codmw.png', 'Gruppo di soldati dietro un riparo', '8');

insert into images
    (src, alt, article)
values ('images/News/Xiaomi/mi-surface-display.jpg', 'Viene mostrato il monitor', '9');

insert into images
    (src, alt, article)
values ('images/Recensioni/Star-Wars/StarWarsCopertina.jpg', 'Copertina del gioco', '10');

insert into images
    (src, alt, article)
values ('images/News/DeathStranding/DScopertina.jpg', 'Il protagonista del gioco in primo piano', '11');

insert into images
    (src, alt, article)
values ('images/News/StarWars/StarWarsNews.jpg', 'Il protagonista entra in un palazzo monumentale', '12');

insert into images
    (src, alt, article)
values ('images/Altro/StarWars/Copertina.jpg', 'Immagine di pubblicit&agrave; di un gioco', '13');

insert into images
    (src, alt, article)
values ('images/News/monsterHunterWorld/monsterHunter.jpg', 'Locandina del gioco', '14');

insert into images
    (src, alt, article)
values ('images/Recensioni/asgardsWrath/asgardsWrath.jpeg', 'Locandina del gioco', '15');

insert into images
    (src, alt, article)
values ('images/Altro/ClashRoyale/clash_royale.jpg', 'Scheletro gigante', '16');

insert into images
    (src, alt, article)
values ('images/News/PS5/logo-ps5.png', 'Logo della console, ps5', '17');

insert into images
    (src, alt, article)
values ('images/Recensioni/code-vein/code-vein-low-res.jpg', 'Immagine di copertina del videogioco', '18');

insert into images
    (src, alt, article)
values ('images/Altro/TheWitcher/witcher1.jpg', 'Immagine dalla serie', '19');

insert into images
    (src, alt, article)
values ('images/News/AMD-CES2020/Ryzen-4000.jpg', 'Immagine del nuovo processore', '20');

insert into images
    (src, alt, article)
values ('images/Altro/Skyrim/skyrim1.jpg', 'Immagine di una mod', '21');

insert into images
(src, alt, article)
values ('images/Recensioni/GTA-V/GTA5Copertina.jpg', 'Copertina del gioco', '22');
