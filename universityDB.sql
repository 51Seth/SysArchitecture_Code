CREATE DATABASE UniversityDB;
USE UniversityDB;



CREATE TABLE college (
    CollegeID INT PRIMARY KEY AUTO_INCREMENT,
    CollegeName VARCHAR(255) NOT NULL,
    CollegeCode VARCHAR(50) NOT NULL,
    IsActive BIT(1) NOT NULL
);



CREATE TABLE Department (
    DepartmentID INT PRIMARY KEY AUTO_INCREMENT,
    CollegeID INT,
    DepartmentName VARCHAR(255) NOT NULL,
    DepartmentCode VARCHAR(50) NOT NULL,
    IsActive BIT(1) NOT NULL,
    FOREIGN KEY (CollegeID) REFERENCES College(CollegeID)
);

CREATE TABLE Year(
    YearID INT PRIMARY KEY AUTO_INCREMENT,
    DepartmentID INT,
    CollegeID INT,
    YearLevel VARCHAR(255) NOT NULL,
    IsActive BIT(1) NOT NULL,
    FOREIGN KEY (DepartmentID) REFERENCES Department(DepartmentID)
);