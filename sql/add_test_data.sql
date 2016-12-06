/* Set categories */

INSERT INTO Category (title) VALUES ('CS');

INSERT INTO Category (title) VALUES ('Kiireelliset');

INSERT INTO Category (title) VALUES ('Ei-kiireelliset');

INSERT INTO Category (title) VALUES ('Sekalaiset');

INSERT INTO Category (title) VALUES ('Jonninjoutavat');

INSERT INTO Category (title) VALUES ('Tärkeät');

INSERT INTO Category (title) VALUES ('Tietokantasovelluksen TODO-lista');

INSERT INTO Category (title) VALUES ('Kissat');

/* Set users */

INSERT INTO UserAccount (username, password) VALUES ('Linus', '1234');

INSERT INTO UserAccount (username, password) VALUES ('Turing', '4321');

/* Linus's files */
/* Set memos and joints to category 1 */

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Koodaa NP-C algoritmeja', 
    'Etsi tietoa hakusanalla NP-completeness ja ratkaise suuria mysteerejä', 
    10, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (1, 1);

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Toteuta roolipeli', 
    'Tehdään javalla tekstipohjainen roolipeli jota voi pelata tylsinä sadepäivinä', 
    99, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (2, 1);

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Haavoittuvuus Linuxin kernelissä', 
    'CVE-2016-5195 tapahtui, tutki haavoittuvuutta ja toteuta asianmukaiset korjaukset', 
    100, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (3, 1);

/* Set memos and joints to category 2 */

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Aja nurmikko', 
    'Käytä ruohonleikkuria', 
    200, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (4, 2);

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Vaihda Ferrarin etulasi', 
    'Lisätietoja: ei ole', 
    199, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (5, 2);

/* Set memos and joints to categories 6 and 8 */

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Rapsuta kissaa', 
    'Kissa tykkää rapsuttamisesta, rapsuta sitä jossain vaiheessa', 
    2, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (6, 6);
INSERT INTO Joint (memo_id, category_id) VALUES (6, 8);

/* Set memos and joints to categories 3, 4 and 5 */

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Maalaa piha-aita punaiseksi', 
    'Muista ostaa punaista maalia rautakaupasta ennen maalaamista', 
    2, 
    1
);
INSERT INTO Joint (memo_id, category_id) VALUES (7, 3);
INSERT INTO Joint (memo_id, category_id) VALUES (7, 4);
INSERT INTO Joint (memo_id, category_id) VALUES (7, 5);


/* Turing's files */
/* Set memos and joints to category 2 */

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Syö omppuja', 
    'Mielellään punaisia', 
    3, 
    2
);
INSERT INTO Joint (memo_id, category_id) VALUES (8, 2);

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Harrasta ruutuhyppelyä', 
    'Tee se', 
    4, 
    2
);
INSERT INTO Joint (memo_id, category_id) VALUES (9, 2);

/* Set memos and joints to category 2 and 7 */

INSERT INTO Memo (title, content, priority, user_id) VALUES (
    'Paranna muistilistan tietoturvaa', 
    'Kirjautumattomien käyttäjien ei tulisi päästä tarkastelemaan sovelluksen tietoja', 
    100, 
    2
);
INSERT INTO Joint (memo_id, category_id) VALUES (10, 2);
INSERT INTO Joint (memo_id, category_id) VALUES (10, 7);