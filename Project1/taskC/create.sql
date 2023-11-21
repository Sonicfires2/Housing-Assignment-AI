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
    `isAdmin` BOOLEAN NOT NULL DEFAULT 0,
    `Name` VARCHAR(255) NOT NULL,
    `Seniority` VARCHAR(255),
    `isInEboard` BOOLEAN NOT NULL DEFAULT 0,
    `SuitePreference` VARCHAR(255),
    `RoomNumberPreference` VARCHAR(255),
    `RoomSizePreference` VARCHAR(255),
    `NumberOfAttendance` INT NOT NULL DEFAULT 0,
    `NumberOfStrikes` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`ID`)
);

CREATE TABLE `Room` (
    `RoomNumber` VARCHAR(255) NOT NULL,
    `SuiteType` VARCHAR(255) NOT NULL,
    `Doubles` BOOLEAN NOT NULL,
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