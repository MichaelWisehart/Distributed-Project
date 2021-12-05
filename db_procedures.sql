/* This is the procedure for registering a user */
DELIMITER //
CREATE OR REPLACE PROCEDURE createAccount (uname varchar(30), em varchar(30), pword varchar(300))
BEGIN
    SELECT COUNT(*) INTO @usernameCount
    FROM user
    WHERE username = uname;
	
    SELECT COUNT(*) INTO @emailCount
    FROM user
    WHERE email = em;
	
    IF @usernameCount > 0 THEN
        SELECT NULL as user_id, "Username already exists" AS 'Error';
	ELSEIF @emailCount > 0 THEN
		SELECT NULL as user_id, "Email already exists" AS 'Error';
    ELSE
        INSERT INTO user (username, email, password) VALUES (uname, em, PASSWORD(pword));
        SELECT user_id AS user_id, NULL as 'Error' FROM user WHERE username=uname;
    END IF;
END;
DELIMITER ;

/***************************************************************************************/

/* This is the procedure for a user to view their subscription */
DELIMITER //
CREATE OR REPLACE PROCEDURE view_sub (usrID varchar(30))
BEGIN
	SELECT * FROM user_sub WHERE usrID = usrID; 
END; //
DELIMITER ;

/***************************************************************************************/

/* This is the procedure to add a song to cart */
DELIMITER //
CREATE OR REPLACE PROCEDURE addCart (usrID varchar(30), song_id varchar(30))
BEGIN
	INSERT INTO cart (usrID, song_id) VALUES (usrID, song_id);
END; //
DELIMITER ;

/***************************************************************************************/

/* This is the procedure to remove a song from cart */
DELIMITER //
CREATE OR REPLACE PROCEDURE removeCart (usrid varchar(30), songid varchar(30))
BEGIN
	DELETE FROM cart WHERE (cart.usrID = usrid) AND (cart.song_id = songid);
END; //
DELIMITER ;

/***************************************************************************************/

/* This is the procedure to checkout cart */
DELIMITER //
CREATE OR REPLACE PROCEDURE checkout (usrid varchar(30))
BEGIN
	INSERT INTO purchases (usrID, song_id)
	SELECT *
	FROM cart WHERE cart.usrID = usrid;
END; //
DELIMITER ;

CREATE OR REPLACE PROCEDURE checkout (usrid varchar(30)) BEGIN INSERT INTO purchases (usrID, song_id) SELECT * FROM cart WHERE cart.usrID = usrid; END; //

/* This is the trigger to remove items from cart after checkout */
DELIMITER //
CREATE OR REPLACE TRIGGER emptyCart
AFTER INSERT
ON purchases FOR EACH ROW
BEGIN
	DELETE FROM cart WHERE cart.usrID = NEW.usrID;
END; //
DELIMITER ;

CREATE OR REPLACE TRIGGER emptyCart AFTER INSERT ON purchases FOR EACH ROW BEGIN DELETE FROM cart WHERE cart.usrID = NEW.usrID; END; // 