
/* song entity table */
CREATE TABLE song (
    song_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    artist VARCHAR(60) NOT NULL,
    song_name VARCHAR(60) NOT NULL,
    genre VARCHAR(60) NOT NULL,
    song_price VARCHAR(60),
    remix BOOLEAN NOT NULL,
    radio_mix BOOLEAN NOT NULL,
    bpm INT UNSIGNED NOT NULL,
    name_file VARCHAR(60) NOT NULL,
    located VARCHAR(180) NOT NULL,
    PRIMARY KEY (song_id)
);

/* first line to set the auto_increment to 3000 for songs
   next lines to insert into table */
INSERT INTO song(song_id, artist, song_name, genre, remix, radio_mix, bpm, name_file, located) VALUES('3000', 'Eiffel 65', 'Blue (Da Ba Dee)', 'Eurodance', '0', '1', '128', 'blue.mp3', 'folder/folder/otherFolder/songs' );				
INSERT INTO song(artist, song_name, genre, remix, radio_mix, bpm, name_file, located) VALUES('Mariah Cary??', 'My heart will go on', 'Christmas classics', '0', '1', '500', 'mcmhwgo.mp3', 'folder/folder/otherFolder/songs' );				

/* user table */


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