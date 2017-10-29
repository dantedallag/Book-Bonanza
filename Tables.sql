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
    lexile VARCHAR(20),
    page_length VARCHAR(20),
    genre VARCHAR(20),
    trait1 VARCHAR(30),
    trait2 VARCHAR(30),
    recommended INT,
    PRIMARY KEY(id)
);

CREATE TABLE chosen(
    user_id INT,
    book_id INT,
    recommended BOOLEAN,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(book_id) REFERENCES books(id),
    PRIMARY KEY(user_id,book_id) 
);

-- --Teacher Page
-- SELECT books.title, books.author, books.lexile, books.page_length, books.genre, books.trait1, books.trait2, books.recommended 
--     FROM books;

-- --Teacher Add
-- INSERT INTO books VALUE();

-- --Student Page
-- SELECT books.title, books.author, books.lexile, books.page_length, books.genre, books.trait1, books.trait2, books.recommended
--     FROM books,chosen,users WHERE (chosen.user_id = "person" AND books.id = chosen.book_id); 

