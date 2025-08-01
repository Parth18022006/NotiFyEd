DROP DATABASE IF EXISTS NotiFyEd;

CREATE DATABASE NotiFyEd;

USE NotiFyEd;

CREATE TABLE `User`(
    id int AUTO_INCREMENT PRIMARY KEY,
    Username varchar(255) NOT NULL,
    Email varchar(255) NOT NULL UNIQUE,
    Password varchar(255) NOT NULL,
    role ENUM('Admin', 'student') NOT NULL DEFAULT 'Admin'
);

CREATE TABLE `student`(
    id int AUTO_INCREMENT PRIMARY KEY,
    Username varchar(255) NOT NULL,
    Email varchar(255) NOT NULL UNIQUE,
    Class varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    role ENUM('Admin', 'student') NOT NULL DEFAULT 'student'
);

INSERT INTO `user`(`Username`, `Email`, `Password`, `role`) VALUES ('Khushal Rajani','admin@gmail.com','admin12345','Admin');

CREATE TABLE `issue_notice`(
    id int AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) NOT NULL,
    noticeCategory varchar(255) NOT NULL,
    facultyName varchar(255) NOT NULL,
    targetClass varchar(255) NOT NULL,
    noticeBody varchar(255) NOT NULL,
    noticeDay varchar(255) NOT NULL,
    publishDate varchar(255) NOT NULL
);

CREATE TABLE `issue_personal_notice`(
    id int AUTO_INCREMENT PRIMARY KEY,
    student_name varchar(255) NOT NULL,
    student_email varchar(255) NOT NULL,
    notice_title varchar(255) NOT NULL,
    category varchar(255) NOT NULL,
    faculty varchar(255) NOT NULL,
    noticeBody varchar(255) NOT NULL,
    dateInput varchar(255) NOT NULL,
    dayInput varchar(255) NOT NULL
);

CREATE TABLE `feedback`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category ENUM('General','Request','Feedback') NOT NULL,
    description TEXT NOT NULL,
    submitted_by VARCHAR(255) NOT NULL,
    submit_date DATE NOT NULL
);