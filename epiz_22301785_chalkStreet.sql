-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql305.byetcluster.com
-- Generation Time: Jun 29, 2018 at 01:01 AM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_22301785_chalkStreet`
--

-- --------------------------------------------------------

--
-- Table structure for table `cS_article_map`
--

CREATE TABLE IF NOT EXISTS `cS_article_map` (
  `map_id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `added_tym` datetime NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cS_article_map`
--

INSERT INTO `cS_article_map` (`map_id`, `article_id`, `user_id`, `added_tym`) VALUES
(1, 1, 2, '2018-06-13 04:18:18'),
(2, 2, 2, '2018-06-20 06:15:00'),
(3, 3, 1, '2018-06-28 14:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `cS_artilce`
--

CREATE TABLE IF NOT EXISTS `cS_artilce` (
  `article_id` int(10) NOT NULL AUTO_INCREMENT,
  `article_headline` text NOT NULL,
  `article_body` text NOT NULL,
  `article_images` text NOT NULL,
  `article_date` date NOT NULL,
  `article_publisher` varchar(250) NOT NULL,
  `article_author` varchar(250) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cS_artilce`
--

INSERT INTO `cS_artilce` (`article_id`, `article_headline`, `article_body`, `article_images`, `article_date`, `article_publisher`, `article_author`) VALUES
(2, 'Ministers, officers won''t be allowed to come near PM', '', '', '2018-06-07', 'TOI', 'Vikas'),
(1, 'Army chief Bipin Rawat dismisses UN report on alleged rights violations in Jammu and Kashmir as ''motivated''', 'NEW DELHI: Army Chief General Bipin Rawat on Wednesday dismissed the recent UN report on alleged human rights violations in Kashmir as "motivated" and asserted that Indian Army''s record in this regard is "absolutely above board".\r\n\r\n"I don''t need to speak about the human rights record of the Indian Army. It is well known to all of you, it is well known to the people of Kashmir, and to the international community," Gen. Rawat told reporters on the sidelines of a conference on cyber security here.\r\n\r\n"The human rights record of the Indian Army is absolutely above board," he said.', '', '2018-06-27', 'The Hindu', 'Shefaali'),
(3, 'Fifa World Cupa', '', '../images/article_img/ea.png', '2018-06-29', 'TOI', 'Abhishel');

-- --------------------------------------------------------

--
-- Table structure for table `cS_comments`
--

CREATE TABLE IF NOT EXISTS `cS_comments` (
  `cmt_id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cS_comments`
--

INSERT INTO `cS_comments` (`cmt_id`, `article_id`, `user_id`, `comment`) VALUES
(1, 1, 2, 'Good Job'),
(2, 2, 2, '\n            Goof decision'),
(3, 2, 2, '\n            ');

-- --------------------------------------------------------

--
-- Table structure for table `cS_likes`
--

CREATE TABLE IF NOT EXISTS `cS_likes` (
  `like_id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cS_likes`
--

INSERT INTO `cS_likes` (`like_id`, `article_id`, `user_id`) VALUES
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cS_users`
--

CREATE TABLE IF NOT EXISTS `cS_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(250) NOT NULL,
  `user_pwd` text NOT NULL,
  `user_fname` varchar(250) NOT NULL,
  `user_lname` varchar(250) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '0' COMMENT '1->Admin, 0-> User',
  `user_isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cS_users`
--

INSERT INTO `cS_users` (`user_id`, `user_email`, `user_pwd`, `user_fname`, `user_lname`, `user_type`, `user_isactive`) VALUES
(1, 'portal@chalkstreet.com', '202cb962ac59075b964b07152d234b70', 'Chalk', 'Street', 1, 1),
(2, 'riturajreso@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Ritu', 'Raj', 0, 1),
(3, 'ranirupa47@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Rupa', 'Rani', 0, 1),
(4, 'raku@ninestars.in', '202cb962ac59075b964b07152d234b70', 'Rakesh', 'Singh', 0, 1),
(5, 'rituraj.r@ninestars.co.in', '202cb962ac59075b964b07152d234b70', 'GDPR', 'Team', 0, 1),
(6, 'sowmya.rv@ninestars.in', '9b04d152845ec0a378394003c96da594', 'Test1', '1', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
