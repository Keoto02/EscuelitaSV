-- Create the database
CREATE DATABASE MiEscuelaDB;
USE MiEscuelaDB;

-- User types table
CREATE TABLE user_types (
    id_user_type INT AUTO_INCREMENT PRIMARY KEY,
    user_type VARCHAR(20) UNIQUE NOT NULL
);

-- Insert user types
INSERT INTO user_types (user_type) VALUES ('administrator'), ('teacher');

-- Users table
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    first_name_user VARCHAR(50) NOT NULL,
    last_name_user VARCHAR(50) NOT NULL,
    email_user VARCHAR(100) UNIQUE NOT NULL,
    username_user VARCHAR(50) UNIQUE,
    password_user VARCHAR(255) NOT NULL,
    user_type_id INT NOT NULL,
    FOREIGN KEY (user_type_id) REFERENCES user_types(id_user_type)
);

INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Admin', 'Admin', 'admin@gmail.com', 'admin', '123', 1);
INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Carlos', 'Guerrero', 'guerrero@gmail.com', 'cguerrero', '123', 2);
INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Josue', 'Montoya', 'montoya@gmail.com', 'jmontoya', '123', 2);
INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Williams', 'Rodriguez', 'rodriguez@gmail.com', 'wrodriguez', '123', 2);

-- Program types table
CREATE TABLE career_course_types (
    id_career_course_type INT AUTO_INCREMENT PRIMARY KEY,
    career_course_type VARCHAR(20) UNIQUE NOT NULL
);

-- Insert program types
INSERT INTO career_course_types (career_course_type) VALUES ('career'), ('course');

-- Programs/Courses table
CREATE TABLE careers_courses (
    id_career_course INT AUTO_INCREMENT PRIMARY KEY,
    name_career_course VARCHAR(100) NOT NULL,
    career_course_type_id INT NOT NULL,
    FOREIGN KEY (career_course_type_id) REFERENCES career_course_types(id_career_course_type)
);

-- Study modes table
CREATE TABLE study_modes (
    id_study_mode INT AUTO_INCREMENT PRIMARY KEY,
    study_mode VARCHAR(20) UNIQUE NOT NULL
);

-- Insert study modes
INSERT INTO study_modes (study_mode) VALUES ('on-site'), ('virtual');

-- Students table
CREATE TABLE students (
    id_students INT AUTO_INCREMENT PRIMARY KEY,
    first_name_students VARCHAR(50) NOT NULL,
    last_name_students VARCHAR(50) NOT NULL,
    email_students VARCHAR(100) UNIQUE NOT NULL,
    phone_students VARCHAR(20),
    carnet_students VARCHAR(20) UNIQUE NOT NULL,
    program_id INT,
    study_mode_id INT NOT NULL,
    FOREIGN KEY (program_id) REFERENCES careers_courses(id_career_course),
    FOREIGN KEY (study_mode_id) REFERENCES study_modes(id_study_mode)
);

-- Problem reports table
CREATE TABLE problem_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    teacher_id INT NOT NULL,
    career_course_id INT NOT NULL,
    report_date DATE NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id_students),
    FOREIGN KEY (teacher_id) REFERENCES users(id_user),
    FOREIGN KEY (career_course_id) REFERENCES careers_courses(id_career_course)
);