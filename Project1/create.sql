DROP DATABASE IF EXISTS `AnimeInterestFloor`;
CREATE DATABASE `AnimeInterestFloor`;
USE `AnimeInterestFloor`;

CREATE TABLE `Suites` (
    `SuiteType` VARCHAR(255) NOT NULL,
    `Description` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`SuiteType`)
);

CREATE TABLE `Students` (
    `ID` INT NOT NULL AUTO_INCREMENT,
    `Password` VARCHAR(255) NOT NULL,
    `isAdmin` BOOLEAN NOT NULL,
    `Name` VARCHAR(255) NOT NULL,
    `Seniority` VARCHAR(255) NOT NULL,
    `isInEboard` BOOLEAN NOT NULL,
    `SuitePreference` VARCHAR(255) NOT NULL,
    `RoomSizePreference` VARCHAR(255) NOT NULL,
    `NumberOfAttendance` INT NOT NULL,
    `NumberOfStrikes` INT NOT NULL,
    PRIMARY KEY (`ID`)
);

CREATE TABLE `Room` (
    `RoomNumber` VARCHAR(255) NOT NULL,
    `SuiteType` VARCHAR(255) NOT NULL,
    `Double` BOOLEAN NOT NULL,
    `OnePointFive` BOOLEAN NOT NULL,
    PRIMARY KEY (`RoomNumber`),
    FOREIGN KEY (`SuiteType`) REFERENCES `Suites`(`SuiteType`)
);

CREATE TABLE `RoomPreferences` (
    `PreferencesID` INT NOT NULL AUTO_INCREMENT,
    `StudentID` INT NOT NULL,
    `PreferredRoomNumber` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`PreferencesID`),
    FOREIGN KEY (`StudentID`) REFERENCES `Students`(`ID`),
    FOREIGN KEY (`PreferredRoomNumber`) REFERENCES `Room`(`RoomNumber`)
);

CREATE TABLE `Assignments` (
    `AssignmentID` INT NOT NULL AUTO_INCREMENT,
    `StudentID` INT NOT NULL,
    `AssignedRoomNumber` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`AssignmentID`),
    FOREIGN KEY (`StudentID`) REFERENCES `Students`(`ID`),
    FOREIGN KEY (`AssignedRoomNumber`) REFERENCES `Room`(`RoomNumber`)
);