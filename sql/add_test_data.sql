-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Person-taulun testidata
INSERT INTO Person (name, password) VALUES ('Arha', 'Kissa123');
INSERT INTO Person (name, password) VALUES ('Kapy', 'Olli123');

-- Exam-taulun testidata
INSERT INTO Exam (owner, topic, testdate, testtime, room, tester, publicity) VALUES (1, 'TestiTesti', '05/06/2017', '16:00', 'Excatum B123', 'Joku Proffa', true);
INSERT INTO Exam (owner, topic, testdate, testtime, room, tester) VALUES (2, 'TestiTesti2', '06/05/2017', '9:00', 'Excatum B111', 'Liina Lehtori');

-- Material-taulun testidata
INSERT INTO Material (topic, writer, kind, publication, published) VALUES ('Testauksen ABC', 'Toimi Toimittaja', 'Artikkeli', 'Testaus raamaattu', 2014);
INSERT INTO Material (topic) VALUES ('Tentti Kirja 1');

-- ExamMaterial-taulun testidata
INSERT INTO Material (exam, material, limitation, pages) VALUES (1, 2, 'Sivut 35-97', 63);
INSERT INTO Material (exam, material, pages) VALUES (2, 1, 15);

-- Testee-taulun testidata
INSERT INTO Material (exam, person) VALUES (1, 2);
INSERT INTO Material (exam, person) VALUES (2, 1);