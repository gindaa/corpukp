-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2018 at 04:02 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room_corpu`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` varchar(10) NOT NULL,
  `building_name` varchar(50) NOT NULL,
  `building_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`, `building_desc`) VALUES
('cacuk', 'CACUK SUDARIJANTO', ''),
('gpdc', 'GREAT PEOPLE DEVELOPMENT CENTER', ''),
('indigo', 'INDIGO', ''),
('insync', 'INSYNC LAB', ''),
('mlr', 'MEDIA LECTURE ROOM', '');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `room_id` varchar(20) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `room_desc` varchar(50) NOT NULL,
  `building_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`room_id`, `room_name`, `capacity`, `room_desc`, `building_id`) VALUES
('cacuk_201', 'CACUK SUDARIJANTO 201', 15, '', 'cacuk'),
('cacuk_202', 'CACUK SUDARJANTO 202', 15, '', 'cacuk'),
('cacuk_203', 'CACUK SUDARIJANTO 203', 15, '', 'cacuk'),
('cacuk_204', 'CACUK SUDARIJANTO 204', 15, '', 'cacuk'),
('cacuk_205', 'CACUK SUDARIJANTO 205', 15, '', 'cacuk'),
('gpdc_101', 'GREAT PEOPLE DEVELOPMENT  CENTER 101', 10, '', 'gpdc');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `room_id` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `tanggal_mulai`, `tanggal_selesai`, `status`, `keterangan`, `room_id`) VALUES
(1, 'A', '2018-06-01', '2018-06-02', 'a', 'a', 'cacuk_201'),
(2, 'a', '2018-06-22', '2018-06-30', 'a', 'saldnaslfsadkasd', 'gpdc_101'),
(3, 'ASD', '2018-06-29', '2019-01-02', 'Terjadwal', 'lantai 1', 'cacuk_201'),
(4, 'Workshop Mater Plan Development BPK Corpu', '2018-07-02', '2018-07-18', 'terjadwal', 'Lantai 1', 'cacuk_205');

-- --------------------------------------------------------

--
-- Table structure for table `training_support`
--

CREATE TABLE `training_support` (
  `ts_id` int(11) NOT NULL,
  `ts_name` varchar(33) NOT NULL,
  `ts_hp` varchar(15) NOT NULL,
  `ts_alamat` text NOT NULL,
  `ts_foto` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_support`
--

INSERT INTO `training_support` (`ts_id`, `ts_name`, `ts_hp`, `ts_alamat`, `ts_foto`) VALUES
(5, 'gasdasdsa', 'gjjbaa', 'ugsmksakdasd', 'uaaaa.jpg'),
(6, 'jh', 'vvjhv', 'jvjvhj', 'vj.jgp'),
(7, 'TT', '99', 'ii', ''),
(8, 'jnj', 'jb', 'jb', '19717_en_1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `room_id_2` (`room_id`),
  ADD KEY `building_id` (`building_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `training_support`
--
ALTER TABLE `training_support`
  ADD PRIMARY KEY (`ts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `training_support`
--
ALTER TABLE `training_support`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `classroom` (`room_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
