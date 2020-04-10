


CREATE DATABASE connect4;


USE connect4;



CREATE TABLE games
(
    game_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    add_time DATETIME NOT NULL
);







CREATE PROCEDURE create_game()
BEGIN


    INSERT INTO games (add_time) VALUES (NOW());

    SELECT LAST_INSERT_ID() AS 'game_id';


END;

















