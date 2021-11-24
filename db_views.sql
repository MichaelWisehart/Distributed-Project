/* This view shows songs going from lowest bpm to highest */
CREATE VIEW bpm_asc 
AS SELECT * 
FROM song 
ORDER BY bpm ASC;

/* This view shows songs going from highest bpm to lowest */
CREATE VIEW bpm_desc 
AS SELECT * 
FROM song 
ORDER BY bpm DESC;

/***************************************************************************************/

/* This Function is used in conjuction with the following view 'artist_music' */
CREATE FUNCTION artist_name() 
RETURNS VARCHAR(60) 
RETURN @artist_name;

CREATE VIEW artist_music 
AS SELECT * 
FROM song 
WHERE artist = artist_name();

/* have to set the artist name before selecting view so use 
	SET @artist_name = 'Artist Name'; */
	
/***************************************************************************************/	
	
/* This Function is used in conjuction with the following view 'music_name' */
CREATE FUNCTION search_song() 
RETURNS VARCHAR(60) 
RETURN @search_song;

CREATE VIEW music_name 
AS SELECT * 
FROM song 
WHERE song_name = search_song();

/* have to set the artist name before selecting view so use 
	SET @search_song = 'Song Name'; */	
	
/***************************************************************************************/

/* This view displays all the clean music available */
CREATE VIEW clean_music 
AS SELECT * 
FROM song 
WHERE clean = 1;
