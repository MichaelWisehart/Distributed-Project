
/* song entity table */
CREATE TABLE song (
    song_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    song_name VARCHAR(60) NOT NULL,
    artist VARCHAR(60) NOT NULL,
    bpm INT UNSIGNED,
    key_sig VARCHAR(10),
    clean BOOLEAN,
    remix BOOLEAN,
    genre VARCHAR(60),
    song_price VARCHAR(60),
    name_file VARCHAR(60),
    located VARCHAR(180),
    PRIMARY KEY (song_id)
);

/* first line to set the auto_increment to 3000 for songs
   next lines to insert into table */
INSERT INTO song(song_id, song_name, artist, bpm, key_sig, clean, remix, genre, song_price, name_file, located) VALUES('3000', 'Blue (Da Ba Dee)', 'Eiffel 65', '128', 'A10', '0', '1', 'Eurodance', '3.99', 'blue.mp3', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_id, song_name, artist, bpm, key_sig, clean, remix, genre, song_price, name_file, located) VALUES('3000', 'Blue (Da Ba Dee)', 'Eiffel 65', '128', 'A10', '0', '1', 'Eurodance', '3.99', 'blue.mp3', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, key_sig, clean, remix, song_price, located) VALUES('Lil Boat', '88GLAM', '75', '12A', '1', '0', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, key_sig, clean, remix, song_price, located) VALUES('Lil Boat', '88GLAM', '75', '12A', '0', '0', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, key_sig, song_price, located) VALUES('One Night', 'Arno Cost & Norman Doray', '126', '6B', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, key_sig, remix, song_price, located) VALUES('Swoopin  (RL Grime Edit)', 'Baauer & RL Grime', '76', '10A', '1', '3.99', 'folder/folder/songs');
INSERT INTO song(song_name, artist, clean, song_price, located) VALUES('Back to the Streets', 'HMC Hype', '1', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, clean, song_price, located) VALUES('Back to the Streets', 'HMC Hype', '0', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, clean, song_price, located) VALUES('Big Slimes', 'Chris Brown', '1', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, clean, song_price, located) VALUES('Big Slimes', 'Chris Brown', '0', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, song_price, located) VALUES('Bind', 'unknown artist', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, key_sig, remix, song_price, located) VALUES('From The Start', 'Biscits', '123', '4A', '0', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, key_sig, remix, song_price, located) VALUES('From The Start', 'Biscits', '123', '4A', '1', '3.99', 'folder/folder/otherFolder/songs');
INSERT INTO song(song_name, artist, bpm, remix, song_price, located) VALUES('MAMACITA', 'Black Eyes Peas, Ozuna J. Rey', '100', '1', '3.99', 'folder/songs');
INSERT INTO song(song_name, artist, bpm, song_price) VALUES('Can\'t Get You Out Of My Head', 'Block & Crown feat. Omni Waters', '124', '3.99');

/* user table */
CREATE TABLE user (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
    username VARCHAR(30) NOT NULL, 
    email VARCHAR(30) NOT NULL, 
    password VARCHAR(300) NOT NULL, 
    payment ENUM('credit', 'debit', 'paypal'), 
    PRIMARY KEY(user_id)
);

/* first line to set the auto_increment to 5000 for users
   next lines to insert into table */
/* PASSWORD() is used to hash user passwords on table */
INSERT INTO user(user_id, username, email, password) VALUES('5000', 'test_user', 'email@domain.com', PASSWORD('lajenny'));
INSERT INTO user(username, email, password) VALUES('frog-beats', 'croaking@pond.com', PASSWORD('frogge123'));

/*This is the table that holds subscription prices*/
CREATE TABLE subprices (
	sub_type enum('1', '2') NOT NULL,
	price DECIMAL(19,2) UNSIGNED DEFAULT NULL,
	PRIMARY KEY(sub_type)
);

/* The prices for the subscription */
INSERT INTO subprices(sub_type, price) VALUES('1', '30.00');
INSERT INTO subprices(sub_type, price) VALUES('2', '72.00');

/* Holds user subscriptions */
CREATE TABLE subscription (
	usrID INT UNSIGNED NOT NULL,
	sub_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	subtype enum('1', '2') NOT NULL,
	FOREIGN KEY (usrID) REFERENCES user(user_id),
	FOREIGN KEY (subtype) REFERENCES subprices(sub_type),
	PRIMARY KEY(sub_id)
);

/* Creates the relationship 'PURCHASES' */
CREATE TABLE purchases (
	order_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	usrID INT UNSIGNED NOT NULL,
	song_id INT UNSIGNED NOT NULL,
	FOREIGN KEY (usrID) REFERENCES user(user_id),
	FOREIGN KEY (song_id) REFERENCES song(song_id),
	PRIMARY KEY(order_id)
);

/* Table to hold items in cart */
CREATE TABLE cart (
	usrID INT UNSIGNED NOT NULL,
	song_id INT UNSIGNED NOT NULL,
	FOREIGN KEY (usrID) REFERENCES user(user_id),
	FOREIGN KEY (song_id) REFERENCES song(song_id)
);

/* basic play table */
CREATE TABLE sodapop (
     id INT  NOT NULL AUTO_INCREMENT,
     name CHAR(60) NOT NULL,
     price DECIMAL(19,2) NOT NULL,
     PRIMARY KEY (id)
 );

/* some reminder commands */
SHOW TABLES;
SELECT * FROM table_name;
ALTER TABLE song CHANGE radio_mix clean boolean;
DELETE FROM song WHERE song_id = '3005'
select * from song where bpm > '100';
UPDATE song SET key_sig = '8A' WHERE song_id = '3015';

