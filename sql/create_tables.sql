-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Memo (
    id SERIAL PRIMARY KEY,
    title varchar(64) NOT NULL,
    content varchar(256) NOT NULL,
    priority INTEGER NOT NULL
);

CREATE TABLE Category (
    id SERIAL PRIMARY KEY,
    title varchar(64) NOT NULL
);

CREATE TABLE Joint (
    id SERIAL PRIMARY KEY,
    memo_id INTEGER REFERENCES Memo(id),
    category_id INTEGER REFERENCES Category(id)
);

CREATE TABLE UserAccount (
    id SERIAL PRIMARY KEY,
    username varchar(64) NOT NULL,
    password varchar(64) NOT NULL
);