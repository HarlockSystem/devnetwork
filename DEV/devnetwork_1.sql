-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 05, 2017 at 06:53 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `devnetwork_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteUserPost`
--

CREATE TABLE `FavoriteUserPost` (
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `LikeUserPost`
--

CREATE TABLE `LikeUserPost` (
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `contentType` tinyint(4) NOT NULL COMMENT 'snippet\ncomment\n',
  `content` varchar(1000) NOT NULL,
  `language` varchar(100) NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `statusPost` tinyint(4) NOT NULL COMMENT 'active\npending \ndelete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `PostTag`
--

CREATE TABLE `PostTag` (
  `PostId` int(11) NOT NULL,
  `TagId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

CREATE TABLE `Tag` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL COMMENT 'pseudo',
  `password` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(65) DEFAULT NULL,
  `lastname` varchar(65) DEFAULT NULL,
  `skill` varchar(1000) DEFAULT NULL COMMENT 'user skill',
  `bio` varchar(1000) DEFAULT NULL,
  `jobs` varchar(1000) DEFAULT NULL,
  `jobStatus` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `theme` varchar(60) DEFAULT 'monokai',
  `img` varchar(45) DEFAULT NULL,
  `role` tinyint(4) NOT NULL,
  `statusUser` tinyint(4) NOT NULL COMMENT 'active\ndelete\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `UserFavorite`
--

CREATE TABLE `UserFavorite` (
  `UserId` int(11) NOT NULL,
  `FavoriteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `UserTag`
--

CREATE TABLE `UserTag` (
  `UserId` int(11) NOT NULL,
  `TagId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`,`PostId`,`UserId`),
  ADD KEY `fk_Comment_Post1_idx` (`PostId`),
  ADD KEY `fk_Comment_User1_idx` (`UserId`);

--
-- Indexes for table `FavoriteUserPost`
--
ALTER TABLE `FavoriteUserPost`
  ADD PRIMARY KEY (`UserId`,`PostId`),
  ADD KEY `fk_User_has_Post_Post1_idx` (`PostId`),
  ADD KEY `fk_User_has_Post_User1_idx` (`UserId`);

--
-- Indexes for table `LikeUserPost`
--
ALTER TABLE `LikeUserPost`
  ADD PRIMARY KEY (`UserId`,`PostId`),
  ADD KEY `fk_User_has_Post_Post2_idx` (`PostId`),
  ADD KEY `fk_User_has_Post_User2_idx` (`UserId`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`,`UserId`),
  ADD KEY `fk_Post_User_idx` (`UserId`);

--
-- Indexes for table `PostTag`
--
ALTER TABLE `PostTag`
  ADD PRIMARY KEY (`PostId`,`TagId`),
  ADD KEY `fk_Post_has_Tag_Tag1_idx` (`TagId`),
  ADD KEY `fk_Post_has_Tag_Post1_idx` (`PostId`);

--
-- Indexes for table `Tag`
--
ALTER TABLE `Tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick_UNIQUE` (`name`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `UserFavorite`
--
ALTER TABLE `UserFavorite`
  ADD PRIMARY KEY (`UserId`,`FavoriteId`),
  ADD KEY `fk_User_has_User_User2_idx` (`FavoriteId`),
  ADD KEY `fk_User_has_User_User1_idx` (`UserId`);

--
-- Indexes for table `UserTag`
--
ALTER TABLE `UserTag`
  ADD PRIMARY KEY (`UserId`,`TagId`),
  ADD KEY `fk_User_has_Tag_Tag1_idx` (`TagId`),
  ADD KEY `fk_User_has_Tag_User1_idx` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tag`
--
ALTER TABLE `Tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `fk_Comment_Post1` FOREIGN KEY (`PostId`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Comment_User1` FOREIGN KEY (`UserId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `FavoriteUserPost`
--
ALTER TABLE `FavoriteUserPost`
  ADD CONSTRAINT `fk_User_has_Post_Post1` FOREIGN KEY (`PostId`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_User_has_Post_User1` FOREIGN KEY (`UserId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `LikeUserPost`
--
ALTER TABLE `LikeUserPost`
  ADD CONSTRAINT `fk_User_has_Post_Post2` FOREIGN KEY (`PostId`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_User_has_Post_User2` FOREIGN KEY (`UserId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `fk_Post_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `PostTag`
--
ALTER TABLE `PostTag`
  ADD CONSTRAINT `fk_Post_has_Tag_Post1` FOREIGN KEY (`PostId`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Post_has_Tag_Tag1` FOREIGN KEY (`TagId`) REFERENCES `Tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `UserFavorite`
--
ALTER TABLE `UserFavorite`
  ADD CONSTRAINT `fk_User_has_User_User1` FOREIGN KEY (`UserId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_User_User2` FOREIGN KEY (`FavoriteId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `UserTag`
--
ALTER TABLE `UserTag`
  ADD CONSTRAINT `fk_User_has_Tag_Tag1` FOREIGN KEY (`TagId`) REFERENCES `Tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Tag_User1` FOREIGN KEY (`UserId`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
