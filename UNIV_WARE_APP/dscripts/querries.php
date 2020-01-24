<?php


$get_base_data_query = "SELECT student_dim.stud_matricule Matricule, student_dim.stud_full_name Full_Name, 
					residence_dim.quarter Residence, student_dim.stud_department_name Department,
					student_dim.stud_faculty_name Faculty, residence_dim.akmd_to_school Distance,
					religion_dim.religion Religion, religion_dim.church_name Church,	
					time_dim.semester_number Semester, time_dim.school_year Academic_Year,			
					score_facts.mark Mark, 										
					course_dim.course_code Course_Code, course_dim.course_title Course_Name, course_dim.course_lecturer_name Lecturer 
					FROM score_facts
					JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
					JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
					JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
					JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
					JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn;";

//roll up to department
$roll_up_to_department = "SELECT GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Residences, 
								GROUP_CONCAT(student_dim.stud_matricule SEPARATOR '& ') AS Matricules,
								GROUP_CONCAT(student_dim.stud_full_name SEPARATOR '& ') AS Names,

								student_dim.stud_department_name Department,
								student_dim.stud_faculty_name Faculty,

								SUM(residence_dim.akmd_to_school) AS Total_dist,
								GROUP_CONCAT(DISTINCT religion_dim.religion SEPARATOR'& ') AS Religions,
								GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Churches,	
								GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semesters,
								GROUP_CONCAT(DISTINCT time_dim.school_year SEPARATOR'& ') AS Academic_Years,			
								SUM(score_facts.mark) AS Marks, 										
								GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
								GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Names, 
								GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lects
							FROM score_facts
							JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
							JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
							JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							GROUP BY Department;";

//roll up to faculty
$roll_up_to_faculty = "SELECT	 GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Residences, 
								
								student_dim.stud_faculty_name Faculty,
								GROUP_CONCAT(DISTINCT student_dim.stud_department_name SEPARATOR '& ') AS Departments,

								SUM(residence_dim.akmd_to_school) AS Total_dist,
								GROUP_CONCAT(DISTINCT religion_dim.religion SEPARATOR'& ') AS Religions,
								GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Churches,	
								GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semesters,
								GROUP_CONCAT(DISTINCT time_dim.school_year SEPARATOR'& ') AS Academic_Years,			
								SUM(score_facts.mark) AS Marks, 										
								GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
								GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Names, 
								GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lects
							FROM score_facts
							JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
							JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
							JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							GROUP BY Faculty;";

//roll up to religion
$roll_up_to_religion = "SELECT	GROUP_CONCAT(DISTINCT student_dim.stud_matricule SEPARATOR'& ') AS Matricules,
							GROUP_CONCAT(DISTINCT student_dim.stud_full_name SEPARATOR'& ') AS Names, 
							GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Residences, 

							GROUP_CONCAT(DISTINCT student_dim.stud_department_name SEPARATOR'& ') AS Departments,
							GROUP_CONCAT(DISTINCT student_dim.stud_faculty_name SEPARATOR'& ') AS Faculties,

							SUM(residence_dim.akmd_to_school) AS Tot_Dist,
							religion_dim.religion Religion,	
							GROUP_CONCAT(DISTINCT time_dim.semester_number SEPARATOR'& ') AS Semesters,
							GROUP_CONCAT(DISTINCT time_dim.school_year SEPARATOR'& ') AS Academic_Year,			
							SUM(score_facts.mark) AS Marks, 										
							GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
							GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Names, 
							GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lects
						FROM score_facts
						JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
						JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
						JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
						JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
						JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
						GROUP BY Religion;";

//roll up from to school year
$roll_up_to_school_year = "SELECT GROUP_CONCAT(DISTINCT student_dim.stud_matricule SEPARATOR'& ') AS Matricules,
							GROUP_CONCAT(DISTINCT student_dim.stud_full_name SEPARATOR'& ') AS Stud_Names, 
							GROUP_CONCAT(DISTINCT residence_dim.quarter SEPARATOR'& ') AS Residences, 
								
							GROUP_CONCAT(DISTINCT student_dim.stud_department_name SEPARATOR'& ') AS Departments,
							GROUP_CONCAT(DISTINCT student_dim.stud_faculty_name SEPARATOR'& ') AS Faculties,

							
							SUM(residence_dim.akmd_to_school) AS Total_dist,
							GROUP_CONCAT(DISTINCT religion_dim.religion SEPARATOR'& ') AS Religions,
							GROUP_CONCAT(DISTINCT religion_dim.church_name SEPARATOR'& ') AS Churches,
							time_dim.school_year Academic_Year,			
							SUM(score_facts.mark) AS Marks, 										
							GROUP_CONCAT(DISTINCT course_dim.course_code SEPARATOR'& ') AS Course_Codes, 
							GROUP_CONCAT(DISTINCT course_dim.course_title SEPARATOR'& ') AS Course_Names, 
							GROUP_CONCAT(DISTINCT course_dim.course_lecturer_name SEPARATOR'& ') AS Course_Lects
						FROM score_facts
						JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
						JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
						JOIN time_dim ON time_dim.time_sn = score_facts.time_sn
						JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn
						JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
						GROUP BY Academic_Year";

//drill-down is opposite of roll up
$slice_query=" SELECT * FROM ";

$dice_query= "SELECT * FROM student_dim ";


?>