 /*creates the table players*/
CREATE TABLE IF NOT EXISTS players (
memberid int(10) NOT NULL PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
familyname VARCHAR(30) NOT NULL,
email VARCHAR(50),
phone VARCHAR(20)
)


/*creates the table board_games*/
CREATE TABLE IF NOT EXISTS board_games (
memberid int(10) NOT NULL,
FOREIGN KEY(memberid) REFERENCES players(memberid) ON DELETE CASCADE,
boardgameid int(10) NOT NULL,
FOREIGN KEY(boardgameid) REFERENCES boardgames(boardgameid) ON DELETE CASCADE,
scheduleid int(10) NOT NULL,
FOREIGN KEY(scheduleid) REFERENCES schedule(scheduleid) ON DELETE CASCADE,
scoringid int(10) NOT NULL,
FOREIGN KEY(scoringid)REFERENCES scoring(scoringid) ON DELETE CASCADE
)

/*creates the table boardgames*/
CREATE TABLE IF NOT EXISTS boardgames (
boardgameid int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
boardGameName VARCHAR(40) NOT NULL
)

/*creates the table schedule*/
CREATE TABLE IF NOT EXISTS schedule (
scheduleid int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
scheduleDate date,
scheduleVenue VARCHAR(40)
)

/*creates the table scoring*/
CREATE TABLE IF NOT EXISTS scoring (
scoringid int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
memberid int(10) NOT NULL, 
FOREIGN KEY(memberid) REFERENCES players(memberid),
score int(10) NOT NULL
) 

/*creates a temporary table when members join a game*/
CREATE TABLE IF NOT EXISTS temp_boardgames (
memberid int(10) NOT NULL,
boardgameid int(10) NOT NULL,
scheduleid int(10) NOT NULL
)