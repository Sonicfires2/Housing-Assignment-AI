# Housing-Assignment-AI

If the below commands give errors off the bat, then run this first:
1. mysql -u root -p
2. enter your password
3. create.sql

This creates the tables
1. mysql -u root -p AnimeInterestFloor < create.sql

Command to load the data from csv files into the tables
1. mysql --local-infile=1 -u root -p AnimeInterestFloor < load.sql
If that causes errors then run the following beforehand:
1. mysql -u root -p
enter your password
once logged in run: 
1. SET GLOBAL local_infile=1;
2. quit
3. mysql --local-infile=1 -u root -p AnimeInterestFloor < load.sql

Command to start the php local development server (assuming you have php already installed)
If you are unsure about php installation, do php -V to check
1. php -S localhost:8000
2. go to browser and type localhost:8000 and it will bring you to index.php

General SQL commands to start,stop, and restart server on UNIX
Start MySQL
1. sudo /usr/local/mysql/support-files/mysql.server start

Stop MySQL
1. sudo /usr/local/mysql/support-files/mysql.server stop

Restart MySQL
1. sudo /usr/local/mysql/support-files/mysql.server restart