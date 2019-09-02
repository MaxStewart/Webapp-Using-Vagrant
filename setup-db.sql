CREATE TABLE purchases (
    name VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    amount VARCHAR(10) NOT NULL,
    category VARCHAR(50) NOT NULL,
    notes VARCHAR(100)
);

CREATE TABLE categories (
    name VARCHAR(50) PRIMARY KEY
);

INSERT INTO categories VALUES ("Food/Drink");
INSERT INTO categories VALUES ("Bills to Pay");
INSERT INTO categories VALUES ("Petrol");
INSERT INTO categories VALUES ("Personal Items");