-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2020 at 11:49 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u155055925_ebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$vq0vl8AaljfCdeUHcCWo2eHD8ZLNYHqQ4Z1ViT3d4gQ/Q5RvKBoky');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `name`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_keyword`, `status`) VALUES
(1, 4, 'Rama\'s Ring', 250, 10, '9430514255_rama_s-ring.jpg', 'Over the centuries, the two greatest Indian epics, Ramayana and Mahabharata, have been written in different Indian languages to enable them to reach a wider audience. Poets like Tulsidas, Kamban and Krittibas Ojha have all penned down their own versions of these stories in the common language of their regions. The tribal communities also had their own versions in the form of songs and plays that their people could connect to.', 'Over the centuries, the two greatest Indian epics, Ramayana and Mahabharata, have been written in different Indian languages to enable them to reach a wider audience. Poets like Tulsidas, Kamban and Krittibas Ojha have all penned down their own versions of these stories in the common language of their regions. The tribal communities also had their own versions in the form of songs and plays that their people could connect to. These versions of Indian epics are a part of our rich Indian heritage which should to be preserved and promoted. In this special collection entitled Rama\'s Ring, Amar Chitra Katha brings together nine lesser-known stories from alternate tellings of the two great Indian epics. This is the first time we bring Ramayana stories and Mahabharata stories together in a book. While some tellings in this book are poetic masterpieces in their own right, others are simple folk versions passed down from one generation to the next. The iconic illustrations and in-depth research of the credible team of Amar Chitra Katha make this book a must-read for all genders and all age groups.\r\n\r\nSo what are some of the stories inside?\r\n\r\nRead about the time when Ramaâ€™s ring falls down a crack in the floor, and Hanuman takes a journey to the centre of the earth to retrieve it.\r\n\r\nFind out how an alternate telling of the Mahabharata talked about not Krishna but a different set of saviours who came to Draupadi\'s rescue when she was humiliated by Dushasana in the Kaurava court.\r\n\r\nDid you know that Ravana was capable of replacing his physical body with a fiercer, almost demonic form which made him nearly impervious to Rama\'s attacks?\r\n\r\nCheck out the special \'crossover\' episode when the Pandava prince Bhima comes to Rama\'s help when Lakshmana is kidnapped by a celestial princess.\r\n\r\nLearn why Duryodhana, inspite of recieving five powerful golden arrows guaranteed to kill the Pandavas from Bhishmacharya, still lost the war because of a debt he owed Arjuna.', 'mythology,rama', 1),
(2, 1, 'Before we were yours', 450, 10, '9353455118_before-we-were-yours.jpg', 'Memphis, 1939. Twelve-year-old Rill Foss and her four younger siblings live a magical life aboard their familyâ€™s Mississippi River shantyboat. But when their father must rush their mother to the hospital one stormy night, Rill is left in chargeâ€”until strangers arrive in force.', 'Memphis, 1939. Twelve-year-old Rill Foss and her four younger siblings live a magical life aboard their familyâ€™s Mississippi River shantyboat. But when their father must rush their mother to the hospital one stormy night, Rill is left in chargeâ€”until strangers arrive in force. Wrenched from all that is familiar and thrown into a Tennessee Childrenâ€™s Home Society orphanage, the Foss children are assured that they will soon be returned to their parentsâ€”but they quickly realize the dark truth. At the mercy of the facilityâ€™s cruel director, Rill fights to keep her sisters and brother together in a world of danger and uncertainty.', 'Drama', 1),
(3, 1, 'Then She Was Gone', 300, 10, '1305465814_then-she-was-gone.jpg', 'Ellie Mack was the perfect daughter. She was fifteen, the youngest of three. She was beloved by her parents, friends, and teachers.', 'Ellie Mack was the perfect daughter. She was fifteen, the youngest of three. She was beloved by her parents, friends, and teachers. She and her boyfriend made a teenaged golden couple. She was days away from an idyllic post-exams summer vacation, with her whole life ahead of her.', 'drama', 1),
(4, 3, 'Superhero Comics', 1000, 10, '1977944535_superhero-comics.jpg', 'Superhero comics are one of the most common genres of American comic books. The genre rose to prominence in the 1930s and became extremely popular in the 1940s and has remained the dominant form of comic book in North America since the 1960s. Superhero comics feature stories about superheroes and the universes these characters inhabit.', 'Superhero comics are one of the most common genres of American comic books. The genre rose to prominence in the 1930s and became extremely popular in the 1940s and has remained the dominant form of comic book in North America since the 1960s. Superhero comics feature stories about superheroes and the universes these characters inhabit.\r\n\r\nBeginning with the introduction of Superman in 1938 in Action Comics #1 â€” an anthology of adventure features â€” comic books devoted to superheroes (heroic people with extraordinary or superhuman abilities and skills, or god-like powers and attributes) ballooned into a widespread genre, coincident with the beginnings of World War II and the end of the Great Depression.', 'comics,super hero', 1),
(5, 3, 'DABUNG GIRL and the Space Journey', 345, 20, '8546157541_dabung-girl.png', 'This comic book is a must-read for every child. A new Indian superhero is here, and this time, it is a female superhero, Dabung Girl. She is a fearless hero, who has an elastic body as her superpower. However, unlike other superheroes, who come and save the day, she helps children find solutions on their own.', 'This comic book is a must-read for every child. A new Indian superhero is here, and this time, it is a female superhero, Dabung Girl. She is a fearless hero, who has an elastic body as her superpower. However, unlike other superheroes, who come and save the day, she helps children find solutions on their own. The imagination, creativity, and fun continues throughout the comic. This comic book inspires children to find their inner superhero. In this issue, she uses her power to protect children while imparting the importance of saving the environment and a lesson on gender equality! This book content has been created by Harvard University and IIT Alumni. The content is designed in alignment with the United Nations Sustainable Development Goals (UN SDG and the 2030 Agenda).', 'comic,dabung girl', 1),
(6, 1, 'Finding Utopia', 1000, 6, '3987785979_finding-utopia.jpg', 'Enjoy a deep and profound conversation as together Jiya and Arjun delve into the mysteries of life, the world and the universe. Discover for yourself answers that might just make you feel like you\'ve found utopia.', 'Enjoy a deep and profound conversation as together Jiya and Arjun delve into the mysteries of life, the world and the universe. Discover for yourself answers that might just make you feel like you\'ve found utopia.', 'utopia,drama', 1),
(7, 6, 'As Darkness Breaks', 500, 1, '2987901936_horror.jpg', 'Jonny Newell\'s latest anthology series - DARKNESS AWAKES with horror themed tales for the MATURE reader. Containing a balance of new, revised, sequel stories, and poetry for true lovers of unsettling horror and suspense based themes. With a believable blend of characters explored from the despised devils to the loved heroes, the gruesome to the ghostly. From the ridiculous looking to the cutest of angels. BUT BE WARNED! Some stories are very DARK .', 'Jonny Newell\'s latest anthology series - DARKNESS AWAKES with horror themed tales for the MATURE reader. Containing a balance of new, revised, sequel stories, and poetry for true lovers of unsettling horror and suspense based themes. With a believable blend of characters explored from the despised devils to the loved heroes, the gruesome to the ghostly. From the ridiculous looking to the cutest of angels. BUT BE WARNED! Some stories are very DARK .\r\n\r\nBook 1 - As DARKNESS BREAKS contains more \'Classic\' horror themes with 2 NEW bonus tales added that are only available by this free downloadable book.\r\n\r\nStories:\r\n\r\n1 - The Dead Inside / 2 - Dark Lust - Into the Night / 3 - Cruise of a Deathtime / 4 - Alleandro /5 - Dark Lust 2 - Towards the Moon', 'horror', 1),
(8, 6, 'And Next, Darkness', 500, 3, '8795587370_darkness.jpg', 'A supernatural thriller revolving around a series of mysterious voices accidentally recorded on an old reel-to-reel tape recorder. Seemingly they are the voices of the dead, lost in limbo, reaching out through the darkness for someone to hear them, to help them find peace.', 'A supernatural thriller revolving around a series of mysterious voices accidentally recorded on an old reel-to-reel tape recorder. Seemingly they are the voices of the dead, lost in limbo, reaching out through the darkness for someone to hear them, to help them find peace.\r\n\r\nThe story follows the descent of two women into the dark world of a reluctant serial killer as they endeavour to unlock the whereabouts of his victims through in-depth and potentially sanity-shredding analysis of the tapes. And with that discovery they hope to finally lay the tormented dead and their own dwindling sanity to rest.', 'horror', 1),
(9, 6, 'Tales from the Island', 250.5, 0, '8239337483_tales.jpg', 'A collection of six short stories that fit between the Amaranthine novels Heart of the Raven and Children of Shadows.\r\n\r\nThey\'re meant as a supplement to the novels may or may not make sense if you haven\'t read the series. They may also contain spoilers.\r\n\r\nAfter five novels of bloodshed and terror, Katelina gets her island vacation, but itâ€™s not what she expected. How can it be when her companions are vampires?', 'A collection of six short stories that fit between the Amaranthine novels Heart of the Raven and Children of Shadows.\r\n\r\nThey\'re meant as a supplement to the novels may or may not make sense if you haven\'t read the series. They may also contain spoilers.\r\n\r\nAfter five novels of bloodshed and terror, Katelina gets her island vacation, but itâ€™s not what she expected. How can it be when her companions are vampires?\r\n\r\nWhat happens on a vampire vacation, stays on a vampire vacation.\r\n\r\nIncludes:\r\n\r\nMicah: Micah is ready for some fun in the sand, but he\'s not so excited about the ocean. The dark waters stir memories from his past that he\'d rather forget.\r\n\r\nTorina: Torina is ready for a vacation in the sand. But can she find peace on the tropical island, or will worries catch up to her under the swaying palms?\r\n\r\nOren: Haunted by ghosts of the past, Oren\'s vacation is more torture than pleasure. But perhaps it\'s time he let some of his old agonies go and tried to shape the life he has left.', 'horror', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(25) NOT NULL,
  `book_id` int(25) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_id` int(25) NOT NULL,
  `qty` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `book_id`, `ip_address`, `user_id`, `qty`) VALUES
(3, 5, '157.49.178.131', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`) VALUES
(1, 'Drama', 1),
(2, 'Humor', 1),
(3, 'Comics', 1),
(4, 'Mythology', 1),
(6, 'Horror', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `book_id`, `qty`, `price`, `order_status`) VALUES
(1, 1, 9, 1, 250.5, '2'),
(2, 1, 8, 2, 500, '2');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `txnid` varchar(25) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `payment_status`, `txnid`, `added_on`) VALUES
(1, 12, 'Mangalore', 'karnataka', 574214, 'COD', 'pending', '', '2020-06-30 05:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(12, 'shwetha', '202cb962ac59075b964b07152d234b70', 'cheetu31@gmail.com', '6788990000', '2020-06-29 11:29:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
