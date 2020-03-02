DROP TABLE IF EXISTS member
DROP TABLE IF EXISTS interest;
DROP TABLE IF EXISTS member-interest;

/*Creating member table*/
CREATE TABLE member (
    member_id int NOT NULL AUTO_INCREMENT primary key,
    fname varchar(20) NOT NULL,
    lname varchar(20) NOT NULL,
    age int NOT NULL,
    gender varchar(6),
    phone int(15),
    email varchar(50) NOT NULL,
    state varchar(10),
    seeking varchar(5) NOT NULL,
    bio varchar(255),
    premium tinyInt(3),
    image blob
);

/*Creating interest table*/
CREATE TABLE interest (
    interest_id int NOT NULL AUTO_INCREMENT primary key,
    interest varchar(25),
    type varchar(25)
);

/*Creating member-interest table */
CREATE TABLE member-interest(
    member_id int NOT NULL,
    interest_id int NOT NULL,
    PRIMARY KEY (member_id, interest_id),
    FOREIGN KEY (member_id) REFERENCES member(member_id) ON DELETE CASCADE,
    FOREIGN KEY (interest_id) REFERENCES interest(interest_id) ON DELETE CASCADE
);