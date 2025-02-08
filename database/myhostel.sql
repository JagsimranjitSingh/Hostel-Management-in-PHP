-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 01:41 PM
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
-- Database: `myhostel`
--
CREATE DATABASE IF NOT EXISTS `myhostel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `myhostel`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `changepwd` (IN `CMS` INT, IN `np` VARCHAR(50))   BEGIN
    update studentlogin set password=np where cms=CMS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `comp` (IN `id` INT)   BEGIN
    
        SELECT * FROM complaints,room WHERE room.RHID = id and complaints.Rno=room.RNo;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletestudent` (IN `ms` INT)   BEGIN
    
    DELETE FROM studentlogin WHERE cms=ms;
    
    DELETE from student where cms=ms;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `free` (IN `id` INT)   BEGIN
    
        SELECT rno FROM room,student where rhid=id and shid=id GROUP by rno,rcapacity HAVING count(rno)<=rcapacity;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_visitors` (IN `id` INT)   BEGIN
Select * from visitor,student where visitor.cms=student.cms and student.shid=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `in_out` (IN `hid` INT)   BEGIN
Select * from studentin_out as i,student as s where i.cms=s.cms and s.shid=hid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `manager` (IN `id` INT)   BEGIN
    
        SELECT * FROM manager,hostel WHERE MID = id and MHID = HID;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mess_off` (IN `hid` INT)   BEGIN
Select * from mess_off as i,student as s where i.cms=s.cms and s.shid=hid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register` (IN `CMS` INT, IN `Name` VARCHAR(50), IN `FName` VARCHAR(50), IN `Address` VARCHAR(50), IN `mail` VARCHAR(50), IN `Phone` VARCHAR(11), IN `Cnic` VARCHAR(15), IN `Gender` VARCHAR(6), IN `sDept` VARCHAR(50), IN `HID` VARCHAR(10), IN `RNo` INT, IN `pwd` VARCHAR(50))   BEGIN
INSERT INTO `student` (`CMS`, `SName`, `S_FName`, `SAddress`, `SEmail`, `SPhone`, `SCnic`, `SGender`, `Dept`, `SHID`, `SRNo`) VALUES (CMS, Name, FName, Address, mail, Phone, Cnic, Gender, sDept, HID, RNo);
        INSERT INTO `studentlogin` (`email`, `PASSWORD`, `CMS`) VALUES (mail, pwd, CMS);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `StudentDetails` (IN `CMS` INT)   BEGIN

SELECT * FROM Student,hostel,room WHERE Student.CMS = CMS and SRno = RNo and Student.SHID=HID;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `MID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`username`, `password`, `MID`) VALUES
('manager.at1@gmail.com', 'f4cba934d76a80a7381ba45e1142bdd9', 1234),
('manager.at2@gmail.com', '41d10fdbfcb7298747ce6c6c04b52011', 1235);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `ID` int(11) NOT NULL,
  `CDate` date NOT NULL,
  `CType` varchar(50) NOT NULL,
  `CDescription` varchar(50) NOT NULL,
  `Rno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `HID` varchar(10) NOT NULL,
  `HName` varchar(50) NOT NULL,
  `HCapacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`HID`, `HName`, `HCapacity`) VALUES
('1', 'Hostel Block 1', 400),
('2', 'Hostel Block 2', 400);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `IID` int(11) NOT NULL,
  `IType` varchar(20) NOT NULL,
  `IDueDate` date NOT NULL,
  `IAmount` int(11) NOT NULL,
  `CMS` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`IID`, `IType`, `IDueDate`, `IAmount`, `CMS`, `Status`) VALUES
(5, 'Mess', '2025-01-30', 35, 2104124, 'unpaid'),
(6, 'Hostel', '2025-01-02', 35, 2104124, 'unpaid'),
(7, 'Mess', '2025-01-10', 3500, 2104124, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `MID` int(11) NOT NULL,
  `MName` varchar(50) NOT NULL,
  `M_FName` varchar(50) NOT NULL,
  `MAddress` varchar(50) NOT NULL,
  `MPhone` varchar(11) NOT NULL,
  `MEmail` varchar(50) NOT NULL,
  `MGender` varchar(6) NOT NULL,
  `MCnic` varchar(15) NOT NULL,
  `MHID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`MID`, `MName`, `M_FName`, `MAddress`, `MPhone`, `MEmail`, `MGender`, `MCnic`, `MHID`) VALUES
(1234, 'Jagsimranjit Singh', '...', '...', '...', 'manager.at1@gmail.com', 'Male', '...', '1'),
(1235, 'Jaspreet Singh', '...', '...', '...', 'manager.at2@gmail.com', 'Male', '...', '2');

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu`
-- (See below for the actual view)
--
CREATE TABLE `menu` (
`Day` varchar(10)
,`BREAKFAST` varchar(50)
,`LUNCH` varchar(50)
,`DINNER` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `mess_off`
--

CREATE TABLE `mess_off` (
  `ID` int(11) NOT NULL,
  `MSDate` date NOT NULL,
  `MEDate` date NOT NULL,
  `MReason` varchar(50) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mess_weekly_menu`
--

CREATE TABLE `mess_weekly_menu` (
  `Day` varchar(10) NOT NULL,
  `BREAKFAST` varchar(50) NOT NULL,
  `LUNCH` varchar(50) NOT NULL,
  `DINNER` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mess_weekly_menu`
--

INSERT INTO `mess_weekly_menu` (`Day`, `BREAKFAST`, `LUNCH`, `DINNER`) VALUES
('Monday', 'Paratha, Tea', 'Daal Mash, Roti', 'Daal Channa, Roti'),
('Tuesday', 'Chany, Roti, Tea', 'Kari Pakora, Roti/Rice', 'Chicken, Roti'),
('Wednesday', 'Paratha, Tea', 'Daal Mash, Roti', 'Chicken Rice'),
('Thursday', 'Paratha, Tea', 'Aloo Palak, Roti', 'Daal Mong, Roti'),
('Friday', 'Paratha, Tea', 'Rice, Dall Mong/Masar', 'Chicken, Roti'),
('Saturday', 'Aloo Paratha, Tea', 'Daal Masar, Rice/Roti', 'Daal Channa, Roti'),
('Sunday', 'Puri Chany, Tea', 'Red Beans, roti', 'Chicken Rice');

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `ID` int(11) NOT NULL,
  `PDate` date NOT NULL,
  `PType` varchar(50) NOT NULL,
  `PStatus` varchar(50) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RNo` int(11) NOT NULL,
  `RCapacity` int(11) NOT NULL,
  `RHID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RNo`, `RCapacity`, `RHID`) VALUES
(1, 3, '1'),
(2, 3, '1'),
(3, 3, '1'),
(4, 3, '1'),
(5, 3, '2'),
(6, 3, '1'),
(7, 3, '1'),
(8, 3, '1'),
(9, 3, '1'),
(10, 3, '1'),
(11, 3, '1'),
(12, 3, '1'),
(13, 3, '1'),
(14, 3, '1'),
(15, 3, '1'),
(16, 3, '1'),
(17, 3, '1'),
(18, 3, '1'),
(19, 3, '1'),
(20, 3, '1'),
(21, 3, '1'),
(22, 3, '1'),
(23, 3, '1'),
(24, 3, '1'),
(25, 3, '1'),
(26, 3, '1'),
(27, 3, '1'),
(28, 3, '1'),
(29, 3, '1'),
(30, 3, '1'),
(31, 3, '1'),
(32, 3, '1'),
(33, 3, '1'),
(34, 3, '1'),
(35, 3, '1'),
(36, 3, '1'),
(37, 3, '1'),
(38, 3, '1'),
(39, 3, '1'),
(40, 3, '1'),
(41, 3, '1'),
(42, 3, '1'),
(43, 3, '1'),
(44, 3, '1'),
(45, 3, '1'),
(46, 3, '1'),
(47, 3, '1'),
(48, 3, '1'),
(49, 3, '1'),
(50, 3, '1'),
(51, 3, '1'),
(52, 3, '1'),
(53, 3, '1'),
(54, 3, '1'),
(55, 3, '1'),
(101, 3, '2'),
(102, 3, '2'),
(103, 3, '2'),
(104, 3, '2'),
(105, 3, '2'),
(106, 3, '2'),
(107, 3, '2'),
(108, 3, '2'),
(109, 3, '2'),
(110, 3, '2'),
(111, 3, '2'),
(112, 3, '2'),
(113, 3, '2'),
(114, 3, '2'),
(115, 3, '2'),
(116, 3, '2'),
(117, 3, '2'),
(118, 3, '2'),
(119, 3, '2'),
(120, 3, '2'),
(121, 3, '2'),
(122, 3, '2'),
(123, 3, '2'),
(124, 3, '2'),
(125, 3, '2'),
(126, 3, '2'),
(127, 3, '2'),
(128, 3, '2'),
(129, 3, '2'),
(130, 3, '2'),
(131, 3, '2'),
(132, 3, '2'),
(133, 3, '2'),
(134, 3, '2'),
(135, 3, '2'),
(136, 3, '2'),
(137, 3, '2'),
(138, 3, '2'),
(139, 3, '2'),
(140, 3, '2'),
(141, 3, '2'),
(142, 3, '2'),
(143, 3, '2'),
(144, 3, '2'),
(145, 3, '2'),
(146, 3, '2'),
(147, 3, '2'),
(148, 3, '2'),
(149, 3, '2'),
(150, 3, '2'),
(151, 3, '2'),
(152, 3, '2'),
(153, 3, '2'),
(154, 3, '2'),
(155, 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `CMS` int(11) NOT NULL,
  `SName` varchar(50) NOT NULL,
  `S_FName` varchar(50) NOT NULL,
  `SAddress` varchar(50) NOT NULL,
  `SEmail` varchar(50) NOT NULL,
  `SPhone` varchar(11) NOT NULL,
  `SCnic` varchar(15) NOT NULL,
  `SGender` varchar(6) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `SHID` varchar(10) NOT NULL,
  `SRNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`CMS`, `SName`, `S_FName`, `SAddress`, `SEmail`, `SPhone`, `SCnic`, `SGender`, `Dept`, `SHID`, `SRNo`) VALUES
(2104124, 'Jaskaran Singh', 'Balbir Singh', 'Ludhiana', 'jaskaran@gmail.com', '9316098722', '919316098722', 'Male', 'CSE', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentin_out`
--

CREATE TABLE `studentin_out` (
  `ID` int(11) NOT NULL,
  `CMS` int(11) NOT NULL,
  `LeaveDate` date NOT NULL,
  `ReturnDate` date NOT NULL,
  `Reason` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `email` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`email`, `PASSWORD`, `CMS`) VALUES
('jagjeetpaneser000@gmail.com', '5b119a961fcb523c81c25e8f79de2380', 366885),
('jaskaran@gmail.com', '48f22f2a23fecdc0a5acf3c87ed4d721', 2104124);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `SAID` int(11) NOT NULL,
  `SADate` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`SAID`, `SADate`, `Status`, `CMS`) VALUES
(1, '2024-12-26', 'Present', 2104124),
(2, '2025-01-02', 'Present', 2104124),
(6, '2025-01-05', 'Present', 2104124);

-- --------------------------------------------------------

--
-- Table structure for table `student_violation`
--

CREATE TABLE `student_violation` (
  `VID` int(11) NOT NULL,
  `VDate` date NOT NULL,
  `VType` varchar(50) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `ID` int(11) NOT NULL,
  `SUGDate` date NOT NULL,
  `SUGType` varchar(50) NOT NULL,
  `SUGDescription` varchar(50) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `VID` int(11) NOT NULL,
  `VName` varchar(50) NOT NULL,
  `VRelation` varchar(50) NOT NULL,
  `VPhone` varchar(11) NOT NULL,
  `VCnic` varchar(15) NOT NULL,
  `VDate` date NOT NULL,
  `VReason` varchar(50) NOT NULL,
  `CMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `menu`
--
DROP TABLE IF EXISTS `menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu`  AS SELECT `mess_weekly_menu`.`Day` AS `Day`, `mess_weekly_menu`.`BREAKFAST` AS `BREAKFAST`, `mess_weekly_menu`.`LUNCH` AS `LUNCH`, `mess_weekly_menu`.`DINNER` AS `DINNER` FROM `mess_weekly_menu` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `MID` (`MID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Rno` (`Rno`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`HID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`IID`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`MID`),
  ADD KEY `MHID` (`MHID`);

--
-- Indexes for table `mess_off`
--
ALTER TABLE `mess_off`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RNo`),
  ADD KEY `RHID` (`RHID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`CMS`),
  ADD KEY `SRNo` (`SRNo`),
  ADD KEY `student_ibfk_4` (`SHID`);

--
-- Indexes for table `studentin_out`
--
ALTER TABLE `studentin_out`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id` (`ID`),
  ADD KEY `studentin_out_ibfk_1` (`CMS`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`email`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`SAID`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `student_violation`
--
ALTER TABLE `student_violation`
  ADD PRIMARY KEY (`VID`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CMS` (`CMS`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`VID`),
  ADD KEY `CMS` (`CMS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `IID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mess_off`
--
ALTER TABLE `mess_off`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentin_out`
--
ALTER TABLE `studentin_out`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `SAID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `VID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD CONSTRAINT `adminlogin_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `manager` (`MID`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`Rno`) REFERENCES `room` (`RNo`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`MHID`) REFERENCES `hostel` (`HID`);

--
-- Constraints for table `mess_off`
--
ALTER TABLE `mess_off`
  ADD CONSTRAINT `mess_off_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`RHID`) REFERENCES `hostel` (`HID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`SRNo`) REFERENCES `room` (`RNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_4` FOREIGN KEY (`SHID`) REFERENCES `hostel` (`HID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentin_out`
--
ALTER TABLE `studentin_out`
  ADD CONSTRAINT `studentin_out_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD CONSTRAINT `studentlogin_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `student_attendance_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_violation`
--
ALTER TABLE `student_violation`
  ADD CONSTRAINT `student_violation_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD CONSTRAINT `suggestions_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitor`
--
ALTER TABLE `visitor`
  ADD CONSTRAINT `visitor_ibfk_1` FOREIGN KEY (`CMS`) REFERENCES `student` (`CMS`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
