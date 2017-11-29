DROP TABLE chosen;
DROP TABLE users;
DROP TABLE books;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    person_name VARCHAR(50),
    is_teacher BOOLEAN,
    UNIQUE(person_name),
    PRIMARY KEY(id)
);

CREATE TABLE books(
	id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(50),
    author VARCHAR(50),
    lexile INT,
    page_length INT,
    genre VARCHAR(20),
    trait1 VARCHAR(30),
    trait2 VARCHAR(30),
    recommendations INT,
    PRIMARY KEY(id, title, author)
);

CREATE TABLE chosen(
    user_id INT,
    book_id INT,
    recommended BOOLEAN,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(book_id) REFERENCES books(id) ON DELETE CASCADE,
    PRIMARY KEY(user_id,book_id) 
);

