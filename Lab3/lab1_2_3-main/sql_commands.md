#For creating table:


CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_number VARCHAR(20),
    full_name VARCHAR(100),
    email VARCHAR(100),
    department VARCHAR(100)
);















#For inserting demo data in the table:


INSERT INTO students (student_number, full_name, email, department) VALUES
('STU001', 'Mohamed Elamin', 'mohamed.elamin@nileuniversity.edu.sd', 'Computer Science'),
('STU002', 'Aisha Abdelrahman', 'aisha.abdelrahman@nileuniversity.edu.sd', 'Information Technology'),
('STU003', 'Ahmed Babikir', 'ahmed.babikir@nileuniversity.edu.sd', 'Software Engineering'),
('STU004', 'Rania Omer', 'rania.omer@nileuniversity.edu.sd', 'Computer Science'),
('STU005', 'Yasir Mohamed Ahmed', 'yasir.mohamed@nileuniversity.edu.sd', 'Information Systems'),
('STU006', 'Hala Hassan', 'hala.hassan@nileuniversity.edu.sd', 'Business Administration'),
('STU007', 'Abdulrahman Musa', 'abdulrahman.musa@nileuniversity.edu.sd', 'Computer Engineering'),
('STU008', 'Nada Othman', 'nada.othman@nileuniversity.edu.sd', 'Software Engineering'),
('STU009', 'Omer Salah', 'omer.salah@nileuniversity.edu.sd', 'Data Science'),
('STU010', 'Samah Ali', 'samah.ali@nileuniversity.edu.sd', 'Computer Science'),
('STU011', 'Ismail Fadlallah', 'ismail.fadlallah@nileuniversity.edu.sd', 'Information Technology'),
('STU012', 'Reem Khalid', 'reem.khalid@nileuniversity.edu.sd', 'Cyber Security'),
('STU013', 'Hisham Adam', 'hisham.adam@nileuniversity.edu.sd', 'Software Engineering'),
('STU014', 'Manal Ibrahim', 'manal.ibrahim@nileuniversity.edu.sd', 'Business Information Systems'),
('STU015', 'Taha Elzubair', 'taha.elzubair@nileuniversity.edu.sd', 'Computer Science'),
('STU016', 'Eman Ahmed', 'eman.ahmed@nileuniversity.edu.sd', 'Artificial Intelligence'),
('STU017', 'Mazin Abdelaziz', 'mazin.abdelaziz@nileuniversity.edu.sd', 'Information Systems'),
('STU018', 'Sahar Yousif', 'sahar.yousif@nileuniversity.edu.sd', 'Data Science'),
('STU019', 'Mustafa Idris', 'mustafa.idris@nileuniversity.edu.sd', 'Computer Engineering'),
('STU020', 'Huda Elhassan', 'huda.elhassan@nileuniversity.edu.sd', 'Cyber Security');
