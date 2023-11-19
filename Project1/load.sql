LOAD DATA LOCAL INFILE 'data-files/student.csv' INTO TABLE Students
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (ID, Password, isAdmin, Name, Seniority, isInEboard, SuitePreference, RoomSizePreference, NumberOfAttendance, NumberOfStrikes);

LOAD DATA LOCAL INFILE 'data-files/room.csv' INTO TABLE Room
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (RoomNumber, SuiteType, `Double`, `OnePointFive`);

LOAD DATA LOCAL INFILE 'data-files/room-preferences.csv' INTO TABLE RoomPreferences
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (PreferencesID, StudentID, PreferredRoomNumber);

LOAD DATA LOCAL INFILE 'data-files/assignments.csv' INTO TABLE Assignments
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (AssignmentID, StudentID, AssignedRoomNumber);

LOAD DATA LOCAL INFILE 'data-files/suites.csv' INTO TABLE Suites
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (SuiteType, Description);
