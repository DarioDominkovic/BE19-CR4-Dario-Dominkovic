-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Jul 2023 um 19:18
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr_biglibrary`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `mediaID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `isbn_code` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `author_name` varchar(100) DEFAULT NULL,
  `publisher_name` varchar(200) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `status` enum('available','reserved') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`mediaID`, `title`, `image`, `isbn_code`, `description`, `author_name`, `publisher_name`, `publish_date`, `status`) VALUES
(1, '1984', '1984.webp', '1234567890', 'A dystopian novel set in a totalitarian society where the government controls every aspect of its citizens\' lives and suppresses individuality. The protagonist, Winston Smith, rebels against the oppressive regime, leading to a gripping and thought-provoking narrative.', 'George Orwell', 'Secker & Warburg', '1949-06-08', 'reserved'),
(2, 'To Kill a Mockingbird', 'to-kill-a-mockingbird.webp', '0987654321', 'This classic coming-of-age novel explores themes of racial injustice, moral growth, and compassion through the eyes of young Scout Finch. Her father, Atticus Finch, a lawyer, defends an innocent black man accused of assaulting a white woman, highlighting the prejudice and discrimination present in the Southern United States during the 1930s.', 'Harper Lee', 'J. B. Lippincott & Co.', '1960-06-11', 'available'),
(3, 'The Lord of the Rings', 'the-lord-of-the-rings.webp', '5678901234', 'A high-fantasy epic that follows the quest to destroy the powerful One Ring, which could bring darkness and control to the world. This timeless tale by J.R.R. Tolkien takes readers on a captivating journey through Middle-earth, filled with diverse characters and extraordinary adventures.', 'J.R.R. Tolkien', ' George Allen & Unwin', '1954-07-29', 'available'),
(4, 'Pride and Prejudice', 'pride-and-prejudice.jpeg', '7890123456', 'Jane Austen\'s classic romance novel explores the complexities of societal expectations, love, and self-discovery. The story revolves around Elizabeth Bennet and Mr. Darcy as they navigate their own pride and prejudices on the path to true understanding and affection.', 'Jane Austen', 'T. Egerton, Whitehall', '1813-01-28', 'reserved'),
(5, 'The Great Gatsby', 'the-great-gatsby.webp', '2345678901', 'F. Scott Fitzgerald\'s masterpiece delves into the decadence and disillusionment of the Roaring Twenties. Jay Gatsby, a mysterious millionaire, tries to recapture his lost love, Daisy Buchanan, leading to a tragic exploration of the American Dream and its pitfalls.', 'F. Scott Fitzgerald', ' Charles Scribner\'s Sons', '1925-04-10', 'available'),
(6, 'Harry Potter and the Philosopher\'s Stone', 'harry-potter-and-the-philosopher-s-stone.webp', '6789012345', 'The first book in the beloved fantasy series introduces readers to the magical world of Hogwarts School of Witchcraft and Wizardry. Follow Harry Potter as he discovers his true heritage and battles the dark forces of Lord Voldemort.', 'J.K. Rowling', ' Bloomsbury (UK) / Scholastic (US)', '1997-06-26', 'available'),
(7, 'Brave New World', 'brave-new-world.webp', '3456789012', ' Aldous Huxley\'s futuristic novel presents a society where people are conditioned from birth for a life of superficial happiness and stability, but at the cost of individuality and free will. The story raises profound questions about the price of progress and the role of technology in shaping humanity.', 'Aldous Huxley', 'Chatto & Windus', '1932-07-17', 'available'),
(8, 'The Catcher in the Rye', 'the-catcher-in-the-rye.jpeg', '9012345678', ' J.D. Salinger\'s influential coming-of-age novel centers around Holden Caulfield, a disenchanted teenager navigating the challenges of adolescence, alienation, and identity. Through Holden\'s poignant and cynical voice, the book captures the struggles and discontents of youth.', ' J.D. Salinger', 'Little, Brown and Company', '1951-07-16', 'reserved'),
(9, 'The Chronicles of Narnia: The Lion, the Witch, and the Wardrobe', 'the-chronicles-of-narnia-the-lion-the-witch-and-the-wardrobe.jpeg', '4567890123', 'The first book in C.S. Lewis\'s magical series introduces the enchanting land of Narnia, where four siblings discover a world of talking animals, mythical creatures, and a battle between good and evil. Aslan, the great lion, plays a pivotal role in the children\'s adventures.', 'C.S. Lewis', 'Geoffrey Bles', '1950-10-16', 'available'),
(10, 'The Handmaid\'s Tale 20', 'the-handmaid-s-tale.jpeg', '1234567890', 'Margaret Atwood\'s chilling dystopian novel is set in the Republic of Gilead, a theocratic society where fertile women, known as Handmaids, are subjugated and forced into reproductive servitude. The story follows Offred as she struggles to survive and resist in this oppressive world.', 'Margaret Atwood', 'McClelland and Stewart', '1985-01-01', 'available'),
(16, 'Lord of the Flies', 'https://images.thalia.media/00/-/74ccd0f248a54167b4969bcf225e05b0/lord-of-the-flies-taschenbuch-william-golding-englisch.jpeg', '978-0571191475', '', 'William Golding', 'Secker & Warburg', '1954-09-17', 'available'),
(17, 'The Picture of Dorian Gray', 'https://images.thalia.media/00/-/28392bbe25d44118b69558075d53dac3/the-picture-of-dorian-gray-collector-s-edition-epub-oscar-wilde.jpeg', '9789875503229', '\"The Picture of Dorian Gray\" is a Gothic novel by Oscar Wilde, first published as a complete book in 1890. The story revolves around Dorian Gray, a young and exceptionally handsome man living in Victorian London. Dorian sits for a portrait painted by the artist Basil Hallward, and during their acquaintance, he meets Lord Henry Wotton, a hedonistic and influential figure. Under Lord Henrys influence, Dorian becomes captivated by the pursuit of pleasure and youth. A series of moral and ethical dilemmas arise as Dorian wishes for his portrait to bear the marks of time and sin while he remains forever young and beautiful. The portrait begins to reflect his moral decay and evil deeds, while he retains his youthful appearance. Dorians life spirals into a life of vice and corruption, and he becomes increasingly obsessed with concealing the hidden portrait. The novel explores themes of beauty, hedonism, the duality of human nature, and the consequences of living a life devoid of morality.', 'Oscar Wilde', 'J. B. Lippincott & Co.', '1890-07-01', 'reserved');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `mediaID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
