CREATE TABLE children (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(128) NOT NULL,
	middleName VARCHAR(128),
	lastName VARCHAR(128) NOT NULL,
	dateOfBirth DATE,
	caseManagerID INT NOT NULL,
	caseWorkerID INT,
	therapistID INT,
	psychiatristID INT,
	doctorID INT,
	fosterParent1ID INT,
	fosterParent2ID INT,
	biologicalParent1ID INT,
	biologicalParent2ID INT,
);

CREATE TABLE workers (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	role ENUM('case manager', 'case worker', 'therapist', 'psychiatrist', 'doctor', 'foster parent', 'biological parent') NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	firstName VARCHAR(128) NOT NULL,
	middleName VARCHAR(128),
	lastName VARCHAR(128) NOT NULL,
	UNIQUE(username)
);

CREATE TABLE documents (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	childID INT NOT NULL,
	uploaderID INT NOT NULL,
	documentText MEDIUMTEXT NOT NULL,
	uploadTime DATETIME NOT NULL
);