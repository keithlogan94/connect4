


CREATE DATABASE IF NOT EXISTS connect4;


USE connect4;










CREATE TABLE games
(
    game_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    add_time DATETIME NOT NULL
);


DROP PROCEDURE IF EXISTS create_game;

DELIMITER $$


CREATE PROCEDURE create_game()
BEGIN


    INSERT INTO games (add_time) VALUES (NOW());

    SELECT LAST_INSERT_ID() AS 'game_id';


END


$$


DELIMITER ;



















CREATE TABLE game_data
(
    game_data_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `game_id` INT,
    `key` VARCHAR(100),
    `value` VARCHAR(200),
    add_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX game_data_key_index ON game_data (`game_id`, `key`);


DROP PROCEDURE IF EXISTS set_game_data;

DELIMITER $$


CREATE PROCEDURE set_game_data(p_game_id INT, p_key VARCHAR(100), p_value VARCHAR(200))
BEGIN


    INSERT INTO game_data (`game_id`, `key`, `value`)
    VALUES
        (p_game_id, p_key, p_value)
        ON DUPLICATE KEY UPDATE
        `game_id` = VALUES(`game_id`),
        `key` = VALUES(`key`),
        `value` = VALUES(`value`)
        ;

    SELECT LAST_INSERT_ID() AS 'game_data_id';


END


$$


DELIMITER ;







DROP PROCEDURE IF EXISTS get_game_data;

DELIMITER $$


CREATE PROCEDURE get_game_data(p_game_id INT, p_key VARCHAR(100))
BEGIN

    SELECT * FROM game_data WHERE game_id = p_game_id AND `key` = p_key
    LIMIT 1
    ;


END


$$


DELIMITER ;


















CREATE TABLE board_positions
(
    board_position_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_id INT,
    position_code VARCHAR(10),
    x_position INT,
    y_position INT,
    is_filled BOOL DEFAULT FALSE,
    filled_color ENUM('red','yellow'),
    turn_number INT,
    add_time DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE UNIQUE INDEX board_positions_key_index ON board_positions (`game_id`, `position_code`, `turn_number`);



DROP PROCEDURE IF EXISTS add_board_position;

DELIMITER $$


CREATE PROCEDURE add_board_position(p_game_id INT, p_position_code VARCHAR(10), p_x_position INT, p_y_position INT,
        p_is_filled BOOL, p_filled_color ENUM('red','yellow'), p_turn_number INT)
BEGIN


    INSERT INTO board_positions (game_id,position_code,x_position,y_position,is_filled,filled_color,turn_number)
    VALUES
       (
           p_game_id, p_position_code, p_x_position, p_y_position,
           p_is_filled, p_filled_color, p_turn_number
       );

    SELECT LAST_INSERT_ID() AS 'game_id';


END


$$


DELIMITER ;












DROP PROCEDURE IF EXISTS get_game_board_positions;

DELIMITER $$


CREATE PROCEDURE get_game_board_positions(p_game_id INT)
BEGIN



    DECLARE turnNumber INT DEFAULT 0;


    SELECT `value` INTO turnNumber FROM game_data WHERE game_id = p_game_id AND `key` = 'turn_number';



    SELECT * FROM board_positions WHERE game_id = p_game_id AND turn_number = turnNumber;



END



$$


DELIMITER ;

































