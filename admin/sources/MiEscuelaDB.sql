-- Create the database
Create DATABASE MiEscuelaDB;
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

INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Admin', 'Admin', 'admin@gmail.com', 'admin', '$2y$10$iGvoAImFkl3wYVYF7UyPGu6oyI2YUCkaHTXfie44o8BYGtYhhEkIO', 1);
INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Carlos', 'Guerrero', 'guerrero@gmail.com', 'cguerrero', '$2y$10$iGvoAImFkl3wYVYF7UyPGu6oyI2YUCkaHTXfie44o8BYGtYhhEkIO', 2);
INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Josue', 'Montoya', 'montoya@gmail.com', 'jmontoya', '$2y$10$iGvoAImFkl3wYVYF7UyPGu6oyI2YUCkaHTXfie44o8BYGtYhhEkIO', 2);
INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) VALUES ('Williams', 'Rodriguez', 'rodriguez@gmail.com', 'wrodriguez', '$2y$10$iGvoAImFkl3wYVYF7UyPGu6oyI2YUCkaHTXfie44o8BYGtYhhEkIO', 2);

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

INSERT INTO careers_courses (name_career_course, career_course_type_id)
VALUES
('Ingeniería en Sistemas', 1),
('Administración de Empresas', 2),
('Derecho', 2);

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

INSERT INTO students (first_name_students, last_name_students, email_students, phone_students, carnet_students, program_id, study_mode_id)
VALUES 
('Carlos', 'Martínez', 'carlosmartinez@gmail.com', '555-1234', 'CM2023001', 1, 1),
('Ana', 'García', 'anagarcia@gmail.com', '555-5678', 'AG2023002', 2, 2),
('Luis', 'Rodríguez', 'luisrodriguez@gmail.com', '555-9101', 'LR2023003', 3, 1),
('María', 'Pérez', 'mariaperez@gmail.com', '555-1122', 'MP2023004', 1, 1),
('Jorge', 'Hernández', 'jorgehernandez@gmail.com', '555-3344', 'JH2023005', 2, 2);


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


INSERT INTO problem_reports (student_id, teacher_id, career_course_id, report_date, description)
VALUES (
    6, 
    2,  
    1,  
    '2024-10-06', 
    'El estudiante fue encontrado en estado de ebriedad sosteniendo la foto de una estudiante (La colocha).'  
);

INSERT INTO problem_reports (student_id, teacher_id, career_course_id, report_date, description)
VALUES (
    6,
    1,  
    1,  
    '2024-10-06',  
    'El estudiante fue encontrado en estado de ebriedad sosteniendo la foto de una estudiante (La colocha).'  
);

select * from problem_reports;
SELECT 
    PR.id, 
    S.first_name_students, 
    U.first_name_user, 
    C.name_career_course, 
    PR.report_date, 
    PR.description
FROM 
    problem_reports PR
INNER JOIN 
    students S ON PR.student_id = S.id_students
INNER JOIN 
    users U ON PR.teacher_id = U.id_user
INNER JOIN 
    careers_courses C ON PR.career_course_id = C.id_career_course
WHERE 
    U.id_user = 2; -- Cambia esto por el ID del profesor en sesión
