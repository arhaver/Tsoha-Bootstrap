-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Person(
    id SERIAL PRIMARY KEY,
    username varchar(25) NOT NULL,
    password varchar(25) NOT NULL
);

CREATE TABLE Exam(
    id SERIAL PRIMARY KEY,
    owner INTEGER REFERENCES Person(id),
    topic varchar(120) NOT NULL,
    testdate date NOT NULL,
    testtime time,
    room varchar(120),
    tester varchar(120)
);

CREATE TABLE Material(
    id SERIAL PRIMARY KEY,
    topic varchar(120) NOT NULL,
    writer varchar(120),
    kind varchar(25),
    lang varchar(25),
    info varchar(250)
);

CREATE TABLE ExamMaterial(
    exam INTEGER REFERENCES Exam(id) ON DELETE CASCADE,
    material INTEGER REFERENCES Material(id),
    limitation varchar(120),
    pages INTEGER NOT NULL,
    PRIMARY KEY (exam, material)
);