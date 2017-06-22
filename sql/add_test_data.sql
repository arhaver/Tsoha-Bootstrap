-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Person-taulun testidata
INSERT INTO Person (username, password) VALUES ('Arha', 'Kissa123');
INSERT INTO Person (username, password) VALUES ('Kapy', 'Olli123');
INSERT INTO Person (username, password) VALUES ('tsoha', 'tsoha2017');

-- Exam-taulun testidata
INSERT INTO Exam (owner, topic, testdate, testtime, room, tester) VALUES (1, 'TestiTesti', '05/06/2017', '16:00', 'Excatum B123', 'Joku Proffa');
INSERT INTO Exam (owner, topic, testdate, testtime, room, tester) VALUES (2, 'TestiTesti2', '25/11/2017', '9:00', 'Excatum B111', 'Liina Lehtori');

-- Material-taulun testidata
INSERT INTO Material (topic, writer, kind, lang, info) VALUES ('Testauksen ABC', 'Toimi Toimittaja', 'Artikkeli', 'suomi', 'Testilehti, 2014, nro. 5');
INSERT INTO Material (topic) VALUES ('Tentti Kirja 1');

-- ExamMaterial-taulun testidata
INSERT INTO ExamMaterial (exam, material, limitation, pages) VALUES (1, 2, 'Sivut 35-97', 63);
INSERT INTO ExamMaterial (exam, material, pages) VALUES (2, 1, 15);
