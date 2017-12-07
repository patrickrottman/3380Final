INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('case manager', 'sburnett', '$2y$10$ubqRT/9rQgjTk3/e4U2v8uzYVQ9B5FBqZkczWv1bpLUByIn/0wD9m', 'Stefan', null, 'Burnett');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('case manager', 'amorin', '$2y$10$tvVsW.bfEvE9uFDk2iCYwef9X29.pwt/blzIsHItEF37hlc5nfLzK', 'Andy', null, 'Morin');

INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('case worker', 'jbrose', '$2y$10$o9ER9NueuqlWYoz03Mebqua6JMvTsJ.en0p8HIUEBe/jnRmOhlCAe', 'Julia', null, 'Brose');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('case worker', 'cphan', '$2y$10$Lyeho5eiTsqkLp6xfUtGZ.9xe9R2KEOZ4gZx/uc04B/w8SkMfANpi', 'Chris', null, 'Phan');

INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('therapist', 'pmcgraw', '$2y$10$uhhuEd2v002muBB0PflMiuwQMUoW/WQzVuOFe1dVtpPuEdbc/1gDG', 'Phil', null, 'McGraw');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('therapist', 'zhill', '$2y$10$1tO6wRoYniKhqEimcAk/D.gUdOJgOdAcA408j/EbYx4HXl1bNb1QG', 'Zach', null, 'Hill');

INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('psychiatrist', 'zbackes', '$2y$10$Wwoq3OHEKrmIACkp5/oa8enNGRInOC1O9zLfXN2Nja.GVqmwxYXoS', 'Zach', null, 'Backes');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('psychiatrist', 'ssmith', '$2y$10$1tO6wRoYniKhqEimcAk/D.gUdOJgOdAcA408j/EbYx4HXl1bNb1QG', 'Sue', null, 'Smith');

INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('doctor', 'mmcfarland', '$2y$10$xWH80PLY6lbHKtVTwmPaU.rkolHpUX.WO6OGL7fL9EhD.o7wg7.LS', 'Madeline', 'Claire', 'McFarland');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('doctor', 'moz', '$2y$10$/m.JlGiQvKJQT4VTx7FW1./yh9GV6OnCXKl7agPkgkMp3WRemCYOC', 'Mehmet', 'Cengiz', 'Oz');

INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('foster parent', 'jhalpert', '$2y$10$v19TCw3UgBWiXYo6nzcK9u3ovjhzQROxfE.Lu1ZNItnHVbOBmNBQ.', 'Jim', null, 'Halpert');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('foster parent', 'phalpert', '$2y$10$VNfcpvrVlvSy58pBqTEOJeCK2bFLaYTieIB13huDs34lZIigm8mXW', 'Pam', null, 'Halpert');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('foster parent', 'lknope', '$2y$10$8.JJQrNfMxjaa2r6.FC5SOCuFL.6igyXWnpzLLzQfF5bbPEER5qRy', 'Leslie', null, 'Knope');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('foster parent', 'bwyatt', '$2y$10$jTM0tflSzOR3LAkxn9RxCe.2jObK7/msuOzmyxIn.vuTEx6mCTk36', 'Ben', null, 'Wyatt');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('foster parent', 'dreynolds', '$2y$10$KAvitUcjTWKdbW8twRZfIuL3lSH6FvGif02/zKlgp1zBnIPc4M3Lq', 'Dee', null, 'Reynolds');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('foster parent', 'bhorseman', '$2y$10$naz4BsZ.2xFqlkQLFWNr7ubJ18KJLivt6o87owV3RvS07p5xqGP/2', 'Bojack', null, 'Horseman');

INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('biological parent', 'mmuenks', '$2y$10$1W5l9O8TMblw1ESTZy3k5eHc4NAX.jFsSdJ9yd/Hm5aP/9Yt5FfNW', 'Mary', null, 'Muenks');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('biological parent', 'pmuenks', '$2y$10$CqIzNJhfiikJvw59v5x/9.4L4fDhCM4snL88mrFyn4zhZM5xm.krO', 'Patrick', null, 'Muenks');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('biological parent', 'pdad', '$2y$10$FXSgTG99rOIN9qk1kbDiSO9gZh96pt1As7CPWb0yiJdrCcalP0VoS', 'Patrick', null, 'Dad');
INSERT INTO workers (role, username, password, firstName, middleName, lastName) values ('biological parent', 'jmom', '$2y$10$SZN4Q2N6XJ.LUiAyOSXR2OHFX7XYiAt5WDANJtczjQ7O1Kk/O23t6', 'Jenny', null, 'Mom');

INSERT INTO children (firstName, middleName, lastName, dateOfBirth, caseManagerID, caseWorkerID, therapistID, psychiatrisID, doctorID, fosterParent1ID, fosterParent2ID, biologicalParent1ID, biologicalParent2ID) VALUES ('Jennifer', 'Jean', 'Zulovich', DATE'1996-04-22', '2', '4', '6', '8', '10', '14', '15', '20', '21' );
INSERT INTO children (firstName, lastName, dateOfBirth, caseManagerID, caseWorkerID, therapistID, psychiatristID, doctorID, fosterParent1ID, fosterParent2ID, biologicalParent1ID, biologicalParent2ID) VALUES ('Andrew', 'Muenks', DATE'1995-04-23', '3', '5', '7', '9', '10', '12', '13', '18', '19' );
INSERT INTO children (firstName, lastName, dateOfBirth, caseManagerID, caseWorkerID, therapistID, psychiatristID, doctorID, fosterParent1ID, fosterParent2ID, biologicalParent1ID, biologicalParent2ID) VALUES ('Patrick', 'Rottman', DATE'1997-10-24', '2', '5', '6', '9', '11', '16', '17', '20', '21' );
INSERT INTO children (firstName, lastName, caseManagerID, caseWorkerID, therapistID, psychiatrisID, doctorID, fosterParent1ID, fosterParent2ID, biologicalParent1ID, biologicalParent2ID) VALUES ('Shravan', 'Dommaraju', '3', '4', '7', '8', '11', '14', '15', '20', '21' );

INSERT INTO children (firstName, lastName, dateOfBirth, caseManagerID, caseWorkerID, therapistID, psychiatrisID, doctorID, fosterParent1ID, fosterParent2ID, biologicalParent1ID, biologicalParent2ID) VALUES ('Dale', 'Musser', DATE'2001-01-01','2', '5', '6', '8', '11', '14', '15', '18', '19' );