-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2020 at 10:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bugtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentId` int(11) NOT NULL,
  `IssueId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CommentDateTime` datetime NOT NULL,
  `CommentText` text NOT NULL,
  `IsDeleted` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentId`, `IssueId`, `UserId`, `CommentDateTime`, `CommentText`, `IsDeleted`) VALUES
(1, 3, 2, '2020-10-10 07:54:51', 'Change the heading colors', '0'),
(2, 17, 1, '0000-00-00 00:00:00', 'Change the styles of Navigation Bar', '0'),
(3, 17, 1, '0000-00-00 00:00:00', 'Add option to change password', '0'),
(4, 17, 1, '0000-00-00 00:00:00', 'There is error in tax calculation', '0'),
(5, 17, 1, '0000-00-00 00:00:00', 'There is error in interest calculation', '0'),
(6, 17, 2, '0000-00-00 00:00:00', '\"show all investment\" page not loading', '0'),
(7, 17, 2, '2020-10-11 01:44:24', 'show all deposits page not working', '0'),
(8, 17, 2, '2020-10-11 02:35:38', 'show all points page not working', '0'),
(9, 1, 2, '2020-10-11 02:36:40', 'Allow users to download images', '0'),
(10, 5, 3, '2020-10-11 05:24:01', 'invalid username error', '0'),
(11, 5, 9, '2020-10-12 02:35:22', 'Change the styles of Navigation Bar', '0'),
(12, 5, 5, '2020-10-12 06:50:42', 'There is error in expense calculation', '0'),
(13, 5, 5, '2020-10-12 06:50:50', 'There is error in expense calculation', '0'),
(14, 5, 5, '2020-10-12 06:51:13', 'There is error in total spent calculation', '0'),
(15, 14, 5, '2020-10-12 06:54:21', 'Add option to change password', '0'),
(16, 15, 5, '2020-10-12 07:28:10', 'Error in total spent count', '0'),
(17, 5, 5, '2020-10-13 09:59:34', 'Allow users to download images', '0'),
(18, 21, 2, '2020-10-13 11:12:07', 'Add option to change password', '0');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `IssueId` int(11) NOT NULL,
  `ProjectId` int(11) NOT NULL,
  `CreatedByUser` int(11) NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Description` text NOT NULL,
  `Steps` text NOT NULL,
  `DefectType` char(1) NOT NULL,
  `Priority` char(1) NOT NULL,
  `Version` varchar(50) NOT NULL,
  `AssignedTo` int(11) NOT NULL,
  `Status` char(1) NOT NULL,
  `IsDeleted` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`IssueId`, `ProjectId`, `CreatedByUser`, `CreateDateTime`, `Title`, `Description`, `Steps`, `DefectType`, `Priority`, `Version`, `AssignedTo`, `Status`, `IsDeleted`) VALUES
(1, 2, 1, '2020-10-01 12:49:58', 'Profile upload error', 'Not able to add profile picturesssssssssssss', 'Allow users to add profile picturess', 'B', 'H', 'v15', 3, 'E', '0'),
(2, 4, 1, '2020-10-01 06:54:46', 'appointment error', 'Not able to book appointment', 'provide an option to book appointment', 'B', 'H', 'v2', 7, 'E', '0'),
(3, 4, 1, '2020-10-01 06:57:03', 'receipts error', 'Not able to view my receipts', 'provide an option to view receipts', 'B', 'H', 'v2', 1, 'D', '0'),
(4, 3, 1, '2020-10-01 06:59:45', 'Location error', 'Unable to track location', 'Provide option to track location', 'B', 'H', 'V3', 1, 'E', '0'),
(5, 5, 3, '2020-10-02 12:25:07', 'User Registration error', 'User (House-Wife) Registration module not functioning properly', 'Fix User (House-Wife) Registration module', 'B', 'H', 'v1', 5, 'R', '0'),
(6, 5, 3, '2020-10-02 12:26:02', 'User Registration error', 'User (House-Wife) Registration module not functioning properly', 'Fix User (House-Wife) Registration section', 'B', 'H', 'v1', 5, 'D', '0'),
(8, 6, 1, '2020-10-06 06:28:05', 'Assign descriptive names to your variables, functions, parameters, and methods.', 'The first line has a typo, the add method is not clear about what has been added, the variable $req is not clear enough.\r\n\r\nMany temporary variables used.', 'Reduce the number of temporary variables.\r\nAdd comments inside add() method.', 'B', 'H', 'V1', 6, 'N', '0'),
(9, 6, 1, '2020-10-06 07:11:43', '	Garbage collection cycles documentation needs update.', 'The GC cycle root buffer setup was changed in 7.3, and instead of being limited to 10000 root buffer items, it now allows more, and the collection mechanism is dynamic (starts at 10000 but adjusts to various situations).', 'All the details should be reflected in the documentation.\r\n', 'B', 'H', 'v2', 7, 'N', '0'),
(14, 1, 1, '2020-10-09 11:38:48', 'Dropdown for bug status', 'Unable to change bug status', 'add Dropdown to change bug status', 'B', 'H', 'v1', 5, 'F', '0'),
(15, 5, 1, '2020-10-09 12:16:11', 'Error in total spent count', 'Error in total spent count', 'fix Error in total spent count', 'B', 'H', 'V1', 5, 'N', '0'),
(16, 6, 1, '2020-10-09 12:17:36', 'Not showing similar products ', 'Not showing similar products ', 'show similar products ', 'T', 'M', 'v2', 7, 'N', '0'),
(17, 1, 2, '2020-10-10 07:54:51', 'Cannot change password', 'Cannot change my password', 'Allow users to change password', 'B', 'M', 'v1', 6, 'O', '0'),
(18, 13, 2, '2020-10-12 02:55:45', 'Complaint registration error', 'Not able to register complaint', 'Register user complaints', 'B', 'M', 'v1', 6, 'O', '0'),
(19, 13, 2, '2020-10-13 10:54:51', 'Appointment error', 'Not able to book appointments', 'View steps to book appointment', 'T', 'M', 'v1', 5, 'O', '0'),
(20, 13, 2, '2020-10-13 11:03:31', 'Cannot change password', 'Cannot change user password', 'Update user password', 'B', 'H', 'v1', 6, 'O', '0'),
(21, 13, 2, '2020-10-13 11:05:27', 'Cannot change username', 'Cannot change username', 'Give option to change username', 'B', 'H', 'v1', 6, 'E', '0');

-- --------------------------------------------------------

--
-- Table structure for table `issue_files`
--

CREATE TABLE `issue_files` (
  `FileId` int(11) NOT NULL,
  `IssueId` int(11) NOT NULL,
  `FileName` varchar(200) NOT NULL,
  `LinkedTo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_files`
--

INSERT INTO `issue_files` (`FileId`, `IssueId`, `FileName`, `LinkedTo`) VALUES
(1, 5, '5f82f2c0db36d3.16517743.png', 3),
(2, 2, '5f84234162e7d1.20809951.png', 2),
(3, 20, '5f853c2b8a2135.86988030.png', 2),
(4, 21, '5f853c9fa5c446.62883344.jpg', 2),
(5, 21, '5f853cff82e294.47360067.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectId` int(11) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `CreatedByUser` int(11) NOT NULL,
  `CreateDateTime` datetime(6) NOT NULL,
  `IsDeleted` char(1) NOT NULL DEFAULT '0',
  `ProjectStatus` char(1) NOT NULL,
  `Description` text NOT NULL,
  `Platform` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectId`, `ProjectName`, `CreatedByUser`, `CreateDateTime`, `IsDeleted`, `ProjectStatus`, `Description`, `Platform`) VALUES
(1, 'Bug tracking software', 1, '2020-09-29 11:35:48.000000', '0', 'P', 'A bug tracking system or defect tracking system is a software application that keeps track of reported software bugs in software development projects. It may be regarded as a type of issue tracking system.\r\n\r\nMany bug tracking systems, such as those used by most open-source software projects, allow end-users to enter bug reports directly.[1] Other systems are used only internally in a company or organization doing software development. Typically bug tracking systems are integrated with other project management software.\r\n\r\nA bug tracking system is usually a necessary component of a professional software development infrastructure, and consistent use of a bug or issue tracking system is considered one of the \"hallmarks of a good software team\".', 'W'),
(2, 'Portfolio Website', 2, '2020-09-29 11:56:00.000000', '0', 'P', 'Photography portfolio', 'M'),
(3, 'Location tracking tool', 2, '2020-09-29 12:56:27.000000', '0', 'P', 'Track user Location ', 'B'),
(4, 'Portal for Doctors', 1, '2020-09-30 01:52:40.000000', '0', 'P', 'Portal for doctors and patients where they can interact. Patients can book appointments on the portal according to their schedule and the available timings of the doctors. \r\nThis portal can reduce a lot of hassle from the appointment booking process and enhance its efficiency. Doctors would also have the benefit of managing their various appointments on the portal quickly. The system would display available slots to the patients, and they can select which one they want to choose. \r\nthe portal could allow doctors to save a patient’s medical records in the database. This way, the patient’s profile would have a consistent medical record whenever he/she logs in to their account.\r\n\r\nYou can add an organ donor section where people can register for organ donation. It can allow medical professionals to find urgent organ donors in cases of emergencies within a few seconds. ', 'W'),
(5, 'Daily Expense Tracker ', 3, '2020-10-02 12:22:43.000000', '0', 'P', 'Daily Expense Tracker System is designed to keep a track of Income-Expense of a Housewife on a day-to-day basis. This System divides the Income based on daily expenses. If you exceed day’s expense, system will cut it from your income and will provide new daily expense allowed amount. If that day’s expense is less, system will add it in savings. Daily expense tracking System will generate report at the end of month to show Income-Expense Curve. It will let you add the savings amount, which you had saved for some particular Festivals or days like Birthday or Anniversary.', 'W'),
(6, ' Health Shopping Portal With Product Recommendation', 1, '2020-10-06 01:33:36.000000', '0', 'P', 'This project helps the users in curing its disease by giving the list of fruits and herbs that the user should consume in order to get rid of its disease. The main purpose of this project is to help the user to easily search for herbs and fruits that will be good for the health of the user depending on any health issue or disease that he/she is suffering from. This system helps the user to reduce its searching time to a great extent by allowing the user to enter its health problem and search accordingly. The admin can add fruits and herbs to the system and its information. This system also allows the user to view the selected fruit or the herb’s description which describes how the fruit or the herb will help to improve the user’s health. This system also allows the user to place order which will add the items to the user’s cart and make payment for the same. The system also includes a module in which the user can search for the hospitals depending on the name of the disease that user enters. Thus, this system helps to to get food products best suited for user health to a great extent. System can recommended some product to the user.', 'M'),
(7, 'Automate Time Table Creation', 2, '2020-10-11 02:59:35.000000', '0', 'P', 'Time management is a significant issue for students. To manage their different courses and subjects, they create time tables. A time table has to fit in all of the classes and courses a student attends while making sure that none of them coincide. Apart from this problem, it should also ensure that all the subjects get the required amount of time so the student can study them properly.', 'D'),
(8, 'Android Book Store Shopping Mobile', 8, '2020-10-12 10:29:45.000000', '0', 'P', 'Novel shopping Program allows users to look after Different Books Instruments and may buy them. The job is made up of a list of Books displayed in a variety of models and layouts. The user can browse through the products according to groups. If the user enjoys a product he might add it into his cart. The User may see the items according to their titles & Price in decreasing or increasing order.\r\nSo the online publications shopping endeavor brings the whole Books Store online and makes it simple for the seller and buyer to make bargains on Books. The User can assess his purchase history or the condition of the present order in my requests column. Admin accounts for altering the status of their orders.', 'M'),
(9, 'Garbage Management System for Smart City', 1, '2020-10-12 12:28:20.000000', '0', 'P', 'Smart cities integrate multiple mobile or web solutions to build a comfortable human habitation. One of these solutions is to provide an environmentally friendly, efficient and effective garbage management system. The current garbage collection system includes routine garbage trucks doing rounds daily or weekly, which not only doesn’t cover every zone of the city but is a completely inefficient use of government resources. This paper proposes a cost-effective mobile or web based system for the government to utilize available resources to efficiently manage the overwhelming amounts of garbage collected each day, while also providing a better solution for the inconvenience of garbage disposal for the citizens. Garbage Management System Project This is done by a network of smart bins which integrates cloud-based techniques to monitor and analyze data collected to provide predictive routes generated through algorithms for garbage trucks. An android or web app is developed for the workforce and the citizens, which primarily provides the generated routes for the workforce and finds the nearest available smart bin for citizens.', 'W'),
(10, 'Farmer Information Application For Agriculture', 1, '2020-10-12 12:54:32.000000', '0', 'P', 'Farmer Info App is a very important feature used to assist people Make new Research similar to Agriculture. Agriculture is backbone of our country. This system is used for common user. They also can post their research report though this website. This system is used to farmer and user. User uploads their research document after that admin verify this document and provide approval for publishing document. After that public can view this new research document uploaded by user.', 'M'),
(11, 'Ambulance & Police Application', 1, '2020-10-12 01:19:39.000000', '0', 'P', ' We are familiar with the concept of an emergency ambulance, an ambulance which is used to move patients rapidly to critical care in an emergency room under required medical condition. They can also be used for routine transport of non-urgent cases, such as transfers between hospitals and nursing homes and accidents. In most nations, ambulances are given priority on the road, in recognition to the fact that time is important when moving a critically ill or seriously injured patients. Ambulance Mobile App So Ambulances are critical tools in helping EMTs and other trained first responders not only quickly arrive at an emergency but also provide potentially life-saving measures.', 'M'),
(12, 'Toll Gate Application', 2, '2020-10-12 02:41:02.000000', '0', 'P', 'Toll gate payment system have been of great assistance in lessening the over congestion that has become a part of the metropolitan cities these days. It is one of the uncomplicated ways to manage the great rum of traffic. The travelers passing through this mode of transport, carried by their transport that allows them to be aware of the account of the money that has been paid and the money left in the tag. It relieves the traveler of the burden of waiting in the queue to make the toll payment, which decreases the fuel-consumption and also taking cash with them can be avoided. Our system avoids this type of problems, user he gate pass from online so user doesn’t need to wait the tollgate. In this system users will be having the separate wallet to make payments and transactions. So that they can make their toll gate pass payment from one wallet to another thorugh online this makes their trip more easy and convenient.', 'W'),
(13, 'Online Complaint Registration – Street-Pipe-Road', 2, '2020-10-12 02:53:38.000000', '0', 'P', 'The main purpose of this project is to help the public in knowing their place details and getting their problems solved in online without going to the officer regularly until the problem is solved. By this system the public can save his time and eradicate corruption in government offices. Its main purpose is to provide a smart and easy way through web Application for Complaint registration and its Tracking and eradicating system and thus to prevent Corruption. We want to develop an we application for complaint management system where public can register complaints for street light, water pipe leakage, rain water drainage, road reconstruction and garbage system. Online Road Complaints Registration System To transform the existing manual compliant management system into an automate system. For the better management of complaints to improve efficiency. android projects ideas All the peoples living in housing schemes societies can used our android application for the registration of their complaints within India.', 'W'),
(14, 'Predict User Behaviour', 1, '2020-10-13 01:57:51.000000', '0', 'P', 'Data cleaning will help you in getting rid of unnecessary bits of information because they can hinder the performance of your system. After you’ve cleaned the data, you’ll need to associate different sessions with different users. You can then analyze user behaviors by studying how long they stayed on a page and how much time they spent on a particular section of it. ', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `projectid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`projectid`, `userid`) VALUES
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(1, 5),
(4, 7),
(5, 5),
(5, 6),
(1, 6),
(6, 7),
(6, 6),
(7, 6),
(7, 7),
(8, 6),
(9, 5),
(10, 5),
(10, 6),
(11, 5),
(11, 7),
(12, 6),
(13, 6),
(13, 5),
(14, 12),
(14, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `IsActive` char(1) NOT NULL,
  `IsDeleted` char(1) NOT NULL,
  `UserType` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `FullName`, `Email`, `Password`, `IsActive`, `IsDeleted`, `UserType`) VALUES
(1, 'siya shetgaonkar', 'siyashetgaonkar@gmail.com', 'siya1111', '1', '0', 'A'),
(2, 'Sanil shet', 'sanilshet@gmail.com', 'sanil111', '1', '0', 'T'),
(3, 'deepa shetgaonkar', 'deepashet@gmail.com', 'deepa111', '1', '0', 'T'),
(4, 'dattaram shetgaonkar', ' dattaramshet@gmail.com', 'datta1111', '', '0', 'T'),
(5, 'Ashish Shirodkar', 'ashish@gmail.com', 'ashish111', '1', '0', 'D'),
(6, 'Vrushali Haldankar', 'vrushali@gmail.com', 'vrushali111', '1', '0', 'D'),
(7, 'Sailee naik', ' sailee@gmail.com', 'sailee111', '0', '1', 'D'),
(8, 'pooja shet', 'poo@gmail.com', 'poo111', '1', '1', 'T'),
(10, 'Akanshaa suktankar', ' akanshaa@gmail.com', 'akansha1111', '0', '0', 'T'),
(9, 'neha roy', 'neha@gmail.com', 'neha11', '1', '1', 'A'),
(11, 'Anishaa suktankar', ' anisha@gmail.com', '$2y$10$leRo8wsCzH4bNRUtSfjwQ.OwBJdBJxP0kVyudO9oWFw1tdC0cRbMS', '0', '1', 'D'),
(12, 'kalpitaaa naik', ' kalpitaaa@gmail.com', 'kalpita1111', '0', '1', 'D'),
(13, 'Arjun naik', ' arjun@gmail.com', 'arjun1111', '1', '0', 'D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentId`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`IssueId`);

--
-- Indexes for table `issue_files`
--
ALTER TABLE `issue_files`
  ADD PRIMARY KEY (`FileId`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `IssueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `issue_files`
--
ALTER TABLE `issue_files`
  MODIFY `FileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
