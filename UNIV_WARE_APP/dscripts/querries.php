<?php


$get_base_data_query = "SELECT student_dim.stud_matricule, student_dim.stud_full_name, 
					residence_dim.quarter, residence_dim.akmd_to_school,
					religion_dim.religion, religion_dim.church_name,	
					time_dim.semester_number, time_dim.school_year,			
					score_facts.mark, 										
					course_dim.course_code, course_dim.course_title, course_dim.course_lecturer_name
					FROM score_facts
					JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
					JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
					JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
					JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
					JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn;";

//roll up to department
$roll_up_to_department = "SELECT GROUP_CONCAT(DISTINCT student_dim.stud_matricule SEPARATOR'& ') AS Stud_Matricules,
								GROUP_CONCAT(DISTINCT student_dim.stud_full_name SEPARATOR'& ') AS Stud_Names, 
								GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Stud_Quarters, 
								
								student_dim.stud_department_name Department,
								student_dim.stud_faculty_name Faculty,

								SUM(residence_dim.akmd_to_school) AS Total_distance,
								GROUP_CONCAT(DISTINCT religion_dim.religion SEPARATOR'& ') AS Religions,
								GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Stud_Churches,	
								GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semester_Numbers,
								GROUP_CONCAT(DISTINCT time_dim.school_year SEPARATOR'& ') AS Academic_Years,			
								SUM(score_facts.mark) AS Total_Marks, 										
								GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
								GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Titles, 
								GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lecturers
							FROM score_facts
							JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
							JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
							JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							GROUP BY Department;";

//roll up to faculty
$roll_up_to_faculty = "SELECT	GROUP_CONCAT(DISTINCT student_dim.stud_matricule SEPARATOR'& ') AS Stud_Matricules,
								GROUP_CONCAT(DISTINCT student_dim.stud_full_name SEPARATOR'& ') AS Stud_Names, 
								GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Stud_Quarters, 
								
								GROUP_CONCAT(DISTINCT student_dim.stud_department_name SEPARATOR'& ') AS Departments,
								student_dim.stud_faculty_name Faculty,

								SUM(residence_dim.akmd_to_school) AS Total_distance,
								GROUP_CONCAT(DISTINCT religion_dim.religion SEPARATOR'& ') AS Religions,
								GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Stud_Churches,	
								GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semester_Numbers,
								GROUP_CONCAT(DISTINCT time_dim.school_year SEPARATOR'& ') AS Academic_Years,			
								SUM(score_facts.mark) AS Total_Marks, 										
								GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
								GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Titles, 
								GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lecturers
							FROM score_facts
							JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
							JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
							JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							GROUP BY Faculty;";

//roll up to religion
$roll_up_to_religion = "SELECT	GROUP_CONCAT(DISTINCT student_dim.stud_matricule SEPARATOR'& ') AS Stud_Matricules,
							GROUP_CONCAT(DISTINCT student_dim.stud_full_name SEPARATOR'& ') AS Stud_Names, 
							GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Stud_Quarters, 

							GROUP_CONCAT(DISTINCT student_dim.stud_department_name SEPARATOR'& ') AS Departments,
							GROUP_CONCAT(DISTINCT student_dim.stud_faculty_name SEPARATOR'& ') AS Faculties,

							SUM(residence_dim.akmd_to_school) AS Total_distance,
							religion_dim.religion Religion,
							GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Stud_Churches,	
							GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semester_Numbers,
							GROUP_CONCAT(DISTINCT time_dim.school_year SEPARATOR'& ') AS Academic_Years,			
							SUM(score_facts.mark) AS Total_Marks, 										
							GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
							GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Titles, 
							GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lecturers
						FROM score_facts
						JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
						JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
						JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
						JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
						JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
						GROUP BY Religion;";

//roll up from to school year
$roll_up_to_school_year = "SELECT GROUP_CONCAT(DISTINCT student_dim.stud_matricule SEPARATOR'& ') AS Student_Matricules,
							GROUP_CONCAT(DISTINCT student_dim.stud_full_name SEPARATOR'& ') AS Student_Names, 
							GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Student_Quarters, 
								
							GROUP_CONCAT(DISTINCT student_dim.stud_department_name SEPARATOR'& ') AS Departments,
							GROUP_CONCAT(DISTINCT student_dim.stud_faculty_name SEPARATOR'& ') AS Faculties,

							
							SUM(residence_dim.akmd_to_school) AS Total_dist,
							GROUP_CONCAT(DISTINCT religion_dim.religion SEPARATOR'& ') AS Religions,
							GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Stud_Churches,	
							GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semester_Numbers,
							time_dim.school_year Academic_Year,			
							SUM(score_facts.mark) AS Total_Marks, 										
							GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
							GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Titles, 
							GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lecturers
						FROM score_facts
						JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
						JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
						JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
						JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
						JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
						GROUP BY Academic_Year";

//drill-down is opposite of roll up

//Slice query THIS QUERY IS UNSAFE, IT DOES NOT PREVENT SQL INJECTION
$slice_query=" SELECT * FROM ";

//dice querry UNSAFE, LIABLE TO SQL INJECTION
$dice_query= "SELECT * FROM student_dim ";

//pivot query
//NOT IMPLEMENTED

//functions

?>