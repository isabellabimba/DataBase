-- create an empty database. Name of the database:
SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE IF NOT EXISTS Cycling_Championship;

-- use CHAMPIONSHIP
use Cycling_Championship;


-- drop tables if they already exist
DROP TABLE IF EXISTS Cyclist;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Stage;
DROP TABLE IF EXISTS Individual_Classification;

SET AUTOCOMMIT=0;
START TRANSACTION;

-- create tables

CREATE TABLE Team (
	CodT CHAR(20) ,
	NameT CHAR(50) NOT NULL ,
	FoundationYear INTEGER NOT NULL ,
	LegalAddress CHAR(50) NOT NULL,
	PRIMARY KEY (CodT)
);

CREATE TABLE Cyclist (
	CodC CHAR(20) ,
	Name CHAR(50) NOT NULL ,
	Surname CHAR(50) NOT NULL ,
	Nationality CHAR(50) NOT NULL ,
	CodT CHAR(20) NOT NULL ,
	BirthYear INTEGER NOT NULL ,
	PRIMARY KEY (CodC),
	FOREIGN KEY (CodT)
		REFERENCES Team(CodT)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Stage (
	Edition INTEGER,
	CodS INTEGER ,
	StartingCity CHAR(50) NOT NULL ,
	ArrivalCity CHAR(50) NOT NULL ,
	Length FLOAT NOT NULL,
	HeightDifference FLOAT NOT NULL,
	DifficultyLevel INTEGER NOT NULL,
	PRIMARY KEY (Edition,CodS),
	CONSTRAINT chk_Lv1 CHECK (Edition>0),
	CONSTRAINT chk_Lv2 CHECK (CodS>0),
	CONSTRAINT chk_Lv3 CHECK (DifficultyLevel>=1 and DifficultyLevel<=10)
);

CREATE TABLE Individual_Classification (
	CodC CHAR(20) ,
	CodS INTEGER ,
	Edition INTEGER,
	Ranking INTEGER NOT NULL,
	CONSTRAINT chk_Lv6 CHECK (Ranking>0),
	PRIMARY KEY (CodC,CodS,Edition),
	FOREIGN KEY (CodC)
		REFERENCES Cyclist(CodC)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (Edition,CodS)
		REFERENCES Stage(Edition,CodS)
		ON DELETE CASCADE
		ON UPDATE CASCADE

);

COMMIT;
START TRANSACTION;

INSERT INTO Team VALUES('RR151217', 'Love Team', 2019, 'Torino');
INSERT INTO Team VALUES('RR151218', 'Best Friends', 2000, 'Alessandria');
INSERT INTO Team VALUES('RR151219', 'Villaggio Globale', 2018, 'Torino');
INSERT INTO Team VALUES('RR151220', 'La Dolce Vita', 1999, 'Novi Ligure');
INSERT INTO Team VALUES('RR151221', 'Brutos', 1960, 'Ovada');
INSERT INTO Team VALUES('RR151222', 'Skiantos', 1970, 'Ovada');
INSERT INTO Team VALUES('RR151223', 'Occhi Di Gatto', 1980, 'Genova');

INSERT INTO Cyclist VALUES('s256745', 'Elia', 'Pirrello', 'Italian', 'RR151217', 1998);
INSERT INTO Cyclist VALUES('s256746', 'Marina', 'Mastellaro', 'Italian', 'RR151218', 1964);
INSERT INTO Cyclist VALUES('s256747', 'Massimo', 'Priano', 'Italian', 'RR151219', 1968);
INSERT INTO Cyclist VALUES('s256748', 'Emiliano', 'Mascherpa', 'Italian', 'RR151220', 1993);
INSERT INTO Cyclist VALUES('s256749', 'Graziella', 'Mastellaro', 'Italian', 'RR151221', 1960);
INSERT INTO Cyclist VALUES('s256750', 'Isabella', 'Priano', 'Italian', 'RR151222', 1999);
INSERT INTO Cyclist VALUES('s256751', 'Carla', 'Camera', 'Italian', 'RR151223', 1998);

INSERT INTO Stage VALUES(1, 1, 'Torino', 'Ovada', 1211.19, 23.4, 8);
INSERT INTO Stage VALUES(2, 2, 'Torino', 'Genova', 4000.19, 21.4, 7);
INSERT INTO Stage VALUES(1, 3, 'Torino', 'Novi Ligure', 1000.19, 22.4, 6);
INSERT INTO Stage VALUES(3, 4, 'Genova', 'Ovada', 3040.49, 13.4, 6);
INSERT INTO Stage VALUES(2, 5, 'Novi Ligure', 'Ovada', 101.14, 24.4, 5);
INSERT INTO Stage VALUES(1, 6, 'Alessandria', 'Ovada', 1222.19, 26.4, 9);
INSERT INTO Stage VALUES(1, 7, 'Torino', 'Alessandria', 3021.19, 12.4, 3);

INSERT INTO Individual_Classification VALUES('s256745', 1, 1, 1);
INSERT INTO Individual_Classification VALUES('s256746', 2, 2, 3);
INSERT INTO Individual_Classification VALUES('s256747', 3, 1, 4);
INSERT INTO Individual_Classification VALUES('s256748', 4, 3, 2);
INSERT INTO Individual_Classification VALUES('s256749', 5, 2, 6);
INSERT INTO Individual_Classification VALUES('s256750', 6, 1, 14);
INSERT INTO Individual_Classification VALUES('s256751', 7, 1, 3);

COMMIT;

--query to do
USE Cycling_Championship;

SELECT Cyclist.Name, Cyclist.Surname, Team.NameT,
        Stage.Edition, Stage.StartingCity, Stage.ArrivalCity, Stage.Length, Stage.HeightDifference,
				Stage.DifficultyLevel, Individual_classification.Ranking
FROM Cyclist, Individual_Classification, Stage, Team
WHERE Individual_Classification.CodC = 's256745' AND Individual_Classification.CodS = '1'
      AND Stage.CodS = '1' AND Cyclist.CodC = 's256745' AND Cyclist.CodT = Team.CodT
ORDER BY Stage.Edition
