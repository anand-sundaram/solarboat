CREATE TABLE sample (
	date DATE NOT NULL,
	time TIME NOT NULL,
	battery_voltage INTEGER NOT NULL,
	battery_current INTEGER NOT NULL,
	panel_voltage INTEGER NOT NULL,
	panel_power INTEGER NOT NULL,
	PRIMARY KEY (date, time, panel_voltage)
);


LOAD DATA INFILE 'bobodata.csv' 
INTO TABLE sample 
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n';