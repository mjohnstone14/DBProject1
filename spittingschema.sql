
.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;

CREATE TABLE User(
    username TEXT PRIMARY KEY NOT NULL,
    password TEXT UNIQUE NOT NULL ,
    flag INT NOT NULL CHECK(flag=1 OR flag=0),
    level INTEGER NOT NULL CHECK(level>0)    
);

CREATE TABLE Card(
    cardID INTEGER PRIMARY KEY NOT NULL,
    cardName TEXT UNIQUE NOT NULL,
    imagePath TEXT NOT NULL,
    creator TEXT,

    foreign key (creator) references User(username) on update cascade on delete set NULL
);

CREATE TABLE Owns(
    username TEXT NOT NULL,
    cardID INTEGER NOT NULL,
    amount INTEGER NOT NULL CHECK(amount>=1),

    primary key(username,cardID),
    foreign key (username) references User(username) on update cascade on delete cascade,
    foreign key (cardID) references Card(cardID) on update cascade on delete cascade
);

CREATE TABLE Trades(
	tradeID INTEGER PRIMARY KEY NOT NULL,
    initiator TEXT NOT NULL,
    receiver TEXT NOT NULL,
    cardID1 INTEGER NOT NULL,
    cardID2 INTEGER NOT NULL,

    foreign key (initiator,reciever) references User(username) on update cascade on delete cascade,
    foreign key (cardID1,cardID2) references Card(cardID) on update cascade on delete cascade

);