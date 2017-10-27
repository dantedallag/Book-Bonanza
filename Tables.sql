DROP TABLE chosen;
DROP TABLE users;
DROP TABLE books;

CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    is_teacher BOOLEAN,
    PRIMARY KEY(id)
);

CREATE TABLE books(
    id int NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    author VARCHAR(50),
    popularity VARCHAR(20),
    length VARCHAR(20),
    genre VARCHAR(20),
    trait1 VARCHAR(30),
    trait2 VARCHAR(30),
    PRIMARY KEY(id)
);

CREATE TABLE chosen(
    id int NOT NULL AUTO_INCREMENT,
    user_id int,
    book_id int,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(book_id) REFERENCES books(id),
    PRIMARY KEY(id) 
);