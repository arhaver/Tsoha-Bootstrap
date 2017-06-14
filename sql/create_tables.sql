-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Person(
    id SERIAL PRIMARY KEY,
    name varchar(25) NOT NULL,
    password varchar(25) NOT NULL,
    teatcher boolean DEFAULT FALSE
);

CREATE TABLE Exam(
    id SERIAL PRIMARY KEY,
    owner INTEGER REFERENCES Person(id),
    topic varchar(120) NOT NULL,
    testdate date NOT NULL,
    testtime time,
    room varchar(120),
    tester varchar(120),
    publicity boolean DEFAULT FALSE
);

CREATE TABLE Material(
    id SERIAL PRIMARY KEY,
    topic varchar(120) NOT NULL,
    writer varchar(120),
    kind varchar(25),
    publication varchar(120),
    published INTEGER
);

CREATE TABLE ExamMaterial(
    exam INTEGER REFERENCES Exam(id),
    material INTEGER REFERENCES Material(id),
    limitation varchar(120),
    pages INTEGER NOT NULL,
    PRIMARY KEY (exam, material)
);

CREATE TABLE Testee(
    exam INTEGER REFERENCES Exam(id),
    person INTEGER REFERENCES Person(id),
    PRIMARY KEY (exam, person)
);