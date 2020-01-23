-- the script containing entities and the queries uses

-- IF NOT EXISTS DATABASE university_warehouse;
CREATE DATABASE university_warehouse;
USE university_warehouse;

CREATE TABLE student_dim(
	stud_sn integer PRIMARY KEY AUTO_INCREMENT,
	stud_matricule char(7)  NOT NULL,
	stud_full_name varchar(25),
	-- for faculty
	stud_faculty_name varchar(25),
	stud_department_name varchar(25),
	stud_department_tsc int
);
-- create data for one student
INSERT INTO student_dim(stud_matricule) VALUES('FE00Z999');

CREATE TABLE course_dim(
	course_sn integer PRIMARY KEY AUTO_INCREMENT,
	course_code char(6) NOT NULL,
	course_title varchar(20),
	-- for lecturer
	course_lecturer_name varchar(25),
	course_lecturer_email varchar(20),
	course_lecturer_highest_qualification varchar(20)
);
-- create data for one course
INSERT INTO course_dim(course_code) VALUES('ZZT999');

CREATE TABLE religion_dim (
	religion_sn integer PRIMARY KEY AUTO_INCREMENT,
	religion varchar(10),
	church_name varchar(30)
);
-- create test religion
INSERT INTO religion_dim(church_name) VALUES ('... Baptist Church');

CREATE TABLE residence_dim (
	residence_sn integer PRIMARY KEY AUTO_INCREMENT,
	quarter varchar(35) NOT NULL,
	akmd_to_school decimal(8,2) -- average kilomenter distance to school
);
-- create test residence
INSERT INTO residence_dim(quarter) VALUES ('quarter-foo');

CREATE TABLE time_dim (
	time_sn integer PRIMARY KEY AUTO_INCREMENT,
	semester_number integer, -- CHECK semester_number IN {1, 2},
	school_year char(9) NOT NULL
);
INSERT INTO time_dim(school_year) VALUES ('0000-0001');

CREATE TABLE score_facts (
	course_sn integer,
	religion_sn integer NOT NULL,
	residence_sn integer NOT NULL,
	time_sn integer NOT NULL,
	stud_sn integer NOT NULL,

	-- measure
	mark decimal(5,2)
	-- could add a grade, which is determined by mark
);
-- insert some test data into score_facts table
INSERT INTO score_facts() VALUES(1,1,1,1,1, 50.6);

-- add foreign keys for the fact table
ALTER TABLE score_facts
	ADD CONSTRAINT FK_course FOREIGN KEY(course_sn) REFERENCES course_dim(course_sn) ON DELETE CASCADE,
	ADD CONSTRAINT FK_religion FOREIGN KEY(religion_sn) REFERENCES religion_dim(religion_sn) ON DELETE CASCADE,
	ADD CONSTRAINT FK_residence FOREIGN KEY(residence_sn) REFERENCES residence_dim(residence_sn) ON DELETE CASCADE,
	ADD CONSTRAINT FK_time FOREIGN KEY(time_sn) REFERENCES time_dim(time_sn) ON DELETE CASCADE,
	ADD CONSTRAINT FK_student FOREIGN KEY(stud_sn) REFERENCES student_dim(stud_sn) ON DELETE CASCADE;

-- SET DEFAULTS VALUES
-- default values within student
ALTER TABLE student_dim
	ALTER stud_full_name SET DEFAULT 'empty',
	ALTER stud_faculty_name SET DEFAULT 'empty',
	ALTER stud_department_name SET DEFAULT 'empty';
-- default values within course
ALTER TABLE course_dim
	ALTER course_title SET DEFAULT 'empty',
	ALTER course_lecturer_name SET DEFAULT 'empty',
	ALTER course_lecturer_email SET DEFAULT 'empty',
	ALTER course_lecturer_highest_qualification SET DEFAULT 'empty';
-- default values within religion
ALTER TABLE religion_dim
	ALTER religion SET DEFAULT 'empty',
	ALTER church_name SET DEFAULT 'empty';
-- default values within residence
ALTER TABLE residence_dim
	ALTER akmd_to_school SET DEFAULT 0.5;
-- default values within fact table (scores)
ALTER TABLE score_facts
	ALTER mark SET DEFAULT 0.0;

-- insert more test data
INSERT INTO course_dim(course_code) VALUES ('xxx999');
INSERT INTO score_facts() VALUES(2, 1,1,1,1,60.56);

