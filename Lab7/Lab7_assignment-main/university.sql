-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 09:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_number` varchar(20) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_number`, `full_name`, `email`, `department`, `date_of_birth`, `phone_number`) VALUES
(1, 'STU001', 'Mohamed Elamin', 'mohamed.elamin@nileuniversity.edu.sd', 'Computer Science', '2000-01-01', '0912345678'),
(2, 'STU002', 'Aisha Abdelrahman', 'aisha.abdelrahman@nileuniversity.edu.sd', 'Information Technology', '2000-01-01', '0912345678'),
(3, 'STU003', 'Ahmed Babikir', 'ahmed.babikir@nileuniversity.edu.sd', 'Software Engineering', '2000-01-01', '0912345678'),
(4, 'STU004', 'Rania Omer', 'rania.omer@nileuniversity.edu.sd', 'Computer Science', '2000-01-01', '0912345678'),
(5, 'STU005', 'Yasir Mohamed Ahmed', 'yasir.mohamed@nileuniversity.edu.sd', 'Information Systems', '2000-01-01', '0912345678'),
(6, 'STU006', 'Hala Hassan', 'hala.hassan@nileuniversity.edu.sd', 'Business Administration', '2000-01-01', '0912345678'),
(7, 'STU007', 'Abdulrahman Musa', 'abdulrahman.musa@nileuniversity.edu.sd', 'Computer Engineering', '2000-01-01', '0912345678'),
(8, 'STU008', 'Nada Othman', 'nada.othman@nileuniversity.edu.sd', 'Software Engineering', '2000-01-01', '0912345678'),
(9, 'STU009', 'Omer Salah', 'omer.salah@nileuniversity.edu.sd', 'Data Science', '2000-01-01', '0912345678'),
(10, 'STU010', 'Samah Ali', 'samah.ali@nileuniversity.edu.sd', 'Computer Science', '2000-01-01', '0912345678'),
(11, 'STU011', 'Ismail Fadlallah', 'ismail.fadlallah@nileuniversity.edu.sd', 'Information Technology', '2000-01-01', '0912345678'),
(12, 'STU012', 'Reem Khalid', 'reem.khalid@nileuniversity.edu.sd', 'Cyber Security', '2000-01-01', '0912345678'),
(13, 'STU013', 'Hisham Adam', 'hisham.adam@nileuniversity.edu.sd', 'Software Engineering', '2000-01-01', '0912345678'),
(14, 'STU014', 'Manal Ibrahim', 'manal.ibrahim@nileuniversity.edu.sd', 'Business Information Systems', '2000-01-01', '0912345678'),
(15, 'STU015', 'Taha Elzubair', 'taha.elzubair@nileuniversity.edu.sd', 'Computer Science', '2000-01-01', '0912345678'),
(16, 'STU016', 'Eman Ahmed', 'eman.ahmed@nileuniversity.edu.sd', 'Artificial Intelligence', '2000-01-01', '0912345678'),
(17, 'STU017', 'Mazin Abdelaziz', 'mazin.abdelaziz@nileuniversity.edu.sd', 'Information Systems', '2000-01-01', '0912345678'),
(18, 'STU018', 'Sahar Yousif', 'sahar.yousif@nileuniversity.edu.sd', 'Data Science', '2000-01-01', '0912345678'),
(19, 'STU019', 'Mustafa Idris', 'mustafa.idris@nileuniversity.edu.sd', 'Computer Engineering', '2000-01-01', '0912345678'),
(20, 'STU020', 'Huda Elhassan', 'huda.elhassan@nileuniversity.edu.sd', 'Cyber Security', '2000-01-01', '0912345678'),
(21, 'STU021', 'Test', 'test@gmail.com', 'IT', '2026-01-15', '0507585358');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
