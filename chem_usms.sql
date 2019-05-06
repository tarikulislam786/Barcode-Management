-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2018 at 06:59 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chem_usms`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcodedetails`
--

CREATE TABLE IF NOT EXISTS `barcodedetails` (
  `id` int(11) NOT NULL,
  `barcode` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `formula` varchar(255) NOT NULL,
  `characteristics` longtext NOT NULL,
  `category` varchar(255) NOT NULL,
  `warningMark` varchar(255) NOT NULL,
  `steps` longtext NOT NULL,
  `procedures` longtext NOT NULL,
  `notes` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barcodedetails`
--

INSERT INTO `barcodedetails` (`id`, `barcode`, `subject`, `formula`, `characteristics`, `category`, `warningMark`, `steps`, `procedures`, `notes`) VALUES
(19, 112200, 'dfsdf d', 'dsfs', 'dsf', 'cat', 'bulb.jpg', 'ste ddd', 'dsffs ', 'dsfds'),
(20, 747710, 'ggg', 'dsfsdf', ' sdd', 'df', 'fish.jpg', 'v vvv', 'dfdsf hh', 'sdffdhj'),
(21, 2001479, 'dfdfd df', 'jjjjj', 'sdgfasdf sdgfsd', 'sdfsdf sdfsd', 'fishfive.jpg', 'hhjj', 'jhj', 'dfgf'),
(22, 3014789, 'mhjkh ff', 'fff', 'dsfsdf', 'dsfsdf', 'fishfour.jpg', 'bbb', 'dsfsdf', 'dfsdd'),
(23, 205874, 'mmm', ' kk jjj', 'fff', 'vvv', 'fishthree.jpg', 'hhhh', 'sdfds', 'hjkkkk'),
(24, 9001478, 'djghh', 'yyyy', 'fghfdh', 'sdfsd', 'fishtwo.jpg', 'yyyy', 'dffsdf', 'sdf'),
(25, 60014325, 'ff', 'fhh', 'dssgfsd', 'dsfsdf', 'flower.jpg', 'cc', 'xxxx', 'zzz'),
(26, 50037925, 'aaa', 'vvv', 'gdfg', 'yyy', 'moon.jpg', 'ttt', 'tt', 'tt'),
(27, 20032014, 'rr', 'xs', 'gb', 'tr', 'watch.jpg', 'bb', 'nb', 'yuu'),
(28, 3900147, 'bdfhh', 'sdfsdf sdfdsf', 'sdfsdf', 'hhgt', 'fishsix.jpg', 'jj', 'fgdf', 'xcvv'),
(29, 400310249, 'sfd h', 'dd', 'bb', 'bff', 'fishseven.jpg', 'hhgdf', 'dsfsdf', 'ty'),
(31, 444402, 'aaaaaaaa', 'ssss', ' bbbb   ddddddddd', ' vvv  ffffffffff', 'fisheight.jpg', 'ggg g', '   xxxx j ggghhh', 'zz  nnn  jj'),
(32, 905024, 'gfdgh gfd', 'drde', 'fhfh', 'qwww', 'fishnine.jpg', 'gvg hghg', 'fg', 'gff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `role`) VALUES
(1, 'Mohammad', 'ali', 'user@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(2, 'Tarikul', 'Islam', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcodedetails`
--
ALTER TABLE `barcodedetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barcodedetails`
--
ALTER TABLE `barcodedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
