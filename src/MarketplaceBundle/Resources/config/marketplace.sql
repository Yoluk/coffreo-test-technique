/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for marketplace
DROP DATABASE IF EXISTS `marketplace`;
CREATE DATABASE IF NOT EXISTS `marketplace` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `marketplace`;


-- Dumping structure for table marketplace.bid
DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto assigned ID',
  `loan_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'This is an id from the loan table',
  `amount` double unsigned DEFAULT '0' COMMENT 'The amount the user has placed',
  `rate` double unsigned DEFAULT '0' COMMENT 'The rate requested by the user',
  `accepted` tinyint(1) unsigned DEFAULT '0' COMMENT '1 or 0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'The time the bid was placed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='User bids placed on a loan';

-- Dumping data for table marketplace.bid: ~25 rows (approximately)
/*!40000 ALTER TABLE `bid` DISABLE KEYS */;
INSERT INTO `bid` (`id`, `loan_id`, `amount`, `rate`, `accepted`, `date`) VALUES
	(1, 1, 50, 8.5, 1, '2016-01-21 14:26:53'),
	(2, 1, 250, 14.5, 1, '2016-01-22 14:27:19'),
	(3, 1, 60, 12.5, 1, '2016-01-25 14:27:35'),
	(4, 1, 500, 16, 0, '2016-01-23 14:28:52'),
	(5, 1, 60, 9.5, 1, '2016-01-24 14:29:12'),
	(6, 2, 750, 10.5, 1, '2016-01-21 14:30:40'),
	(7, 2, 100, 8.5, 1, '2016-01-26 14:32:11'),
	(8, 2, 2500, 15, 0, '2016-01-25 14:32:27'),
	(9, 2, 70, 9.5, 1, '2016-01-25 14:32:44'),
	(10, 2, 150, 10.5, 1, '2016-02-01 14:33:18'),
	(11, 2, 200, 18, 0, '2016-02-21 14:33:30'),
	(12, 2, 80, 9.5, 1, '2016-01-15 14:33:43'),
	(13, 2, 150, 11.5, 1, '2016-01-29 14:33:56'),
	(14, 2, 750, 12.5, 1, '2016-01-28 14:36:05'),
	(15, 3, 50, 10, 1, '2016-01-28 14:36:18'),
	(16, 3, 90, 11.5, 1, '2016-01-24 14:36:39'),
	(17, 3, 2600, 15, 0, '2016-01-29 14:36:52'),
	(18, 3, 50, 10, 1, '2016-01-27 14:37:05'),
	(19, 4, 70, 12.5, 1, '2016-01-21 14:37:58'),
	(20, 4, 120, 13.5, 1, '2016-01-21 14:38:10'),
	(21, 4, 20, 15, 0, '2016-01-23 14:38:22'),
	(22, 4, 50, 12.5, 1, '2016-01-25 14:38:52'),
	(23, 4, 80, 11.5, 1, '2016-01-24 14:39:08'),
	(24, 4, 120, 13, 1, '2016-01-25 14:39:20'),
	(25, 4, 500, 13.5, 1, '2016-01-21 14:39:32');
/*!40000 ALTER TABLE `bid` ENABLE KEYS */;


-- Dumping structure for table marketplace.loan
DROP TABLE IF EXISTS `loan`;
CREATE TABLE IF NOT EXISTS `loan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto assigned ID',
  `name` varchar(255) DEFAULT NULL COMMENT 'The name given to this loan for internal Use',
  `display_name` varchar(255) DEFAULT NULL COMMENT 'The name a user would see on the frontend',
  `amount` double DEFAULT '0' COMMENT 'The amount the user is borrowing',
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'The date the record was created',
  `live` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 or 0 to indicate if the loan is live',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Stores all loan information for the marketplace';

-- Dumping data for table marketplace.loan: ~4 rows (approximately)
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` (`id`, `name`, `display_name`, `amount`, `creation_date`, `live`) VALUES
	(1, 'Kehoe\'s Dairy Farm', 'Invest in Kehoe\'s Dairy Farm in Co. Wexford', 20000, '2016-01-20 14:18:54', 1),
	(2, 'Speedway Couriers', 'Using your investment to purchase a new van', 35000, '2016-01-21 14:20:02', 1),
	(3, 'Nolans', 'Bringing you the best food for over 80 years', 25000, '2016-01-22 14:21:46', 0),
	(4, 'Grants Garage', 'Support your local garage', 15000, '2016-01-23 14:22:52', 1);
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
