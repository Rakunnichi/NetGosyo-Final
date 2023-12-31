-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 07:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `size` varchar(250) NOT NULL,
  `weight` varchar(250) NOT NULL,
  `archipelago` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `convo`
--

CREATE TABLE `convo` (
  `convo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `convo_added` datetime NOT NULL DEFAULT current_timestamp(),
  `convo_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size` varchar(250) NOT NULL,
  `weight` varchar(250) NOT NULL,
  `archipelago` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `order_id`, `user_id`, `product_id`, `seller_id`, `qty`, `size`, `weight`, `archipelago`, `status`) VALUES
(120, 113, 45, 36, 8, 2, 'none', '400', 'Visayas', 0),
(121, 114, 45, 1, 8, 1, 'none', '211', 'Visayas', 0),
(122, 115, 45, 8, 7, 1, 'none', '99', 'Visayas', 1),
(123, 116, 45, 8, 7, 1, 'none', '99', 'Visayas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `convo_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `message_added` datetime NOT NULL DEFAULT current_timestamp(),
  `message_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `notification_added` datetime NOT NULL DEFAULT current_timestamp(),
  `notification_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `notification`, `notification_added`, `notification_updated`) VALUES
(202, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-07 12:19:33', '2023-12-07 12:19:33'),
(203, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-07 12:19:33', '2023-12-07 12:19:33'),
(204, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-07 12:25:28', '2023-12-07 12:25:28'),
(205, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-07 12:27:40', '2023-12-07 12:27:40'),
(206, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-07 13:12:58', '2023-12-07 13:12:58'),
(207, 39, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-07 13:12:58', '2023-12-07 13:12:58'),
(208, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-09 00:50:48', '2023-12-09 00:50:48'),
(209, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-09 00:53:26', '2023-12-09 00:53:26'),
(210, 3, 'A new user registered to NetGosyo. Congratulations!', '2023-12-09 21:31:28', '2023-12-09 21:31:28'),
(211, 61, 'Thank you for registering to NetGosyo. Have a happy shopping!', '2023-12-09 21:31:28', '2023-12-09 21:31:28'),
(212, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-09 21:39:04', '2023-12-09 21:39:04'),
(213, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-09 21:48:29', '2023-12-09 21:48:29'),
(214, 45, 'The seller accepted your order. Please refer to your purchases page for more Information!', '2023-12-09 22:00:56', '2023-12-09 22:00:56'),
(215, 45, 'The seller accepted your order. Please refer to your purchases page for more Information!', '2023-12-09 22:01:19', '2023-12-09 22:01:19'),
(216, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:10:00', '2023-12-10 12:10:00'),
(217, 48, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:10:00', '2023-12-10 12:10:00'),
(218, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:13:44', '2023-12-10 12:13:44'),
(219, 48, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:13:45', '2023-12-10 12:13:45'),
(220, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:18:24', '2023-12-10 12:18:24'),
(221, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:18:24', '2023-12-10 12:18:24'),
(222, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:39:57', '2023-12-10 12:39:57'),
(223, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:39:57', '2023-12-10 12:39:57'),
(224, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:42:10', '2023-12-10 12:42:10'),
(225, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 12:42:10', '2023-12-10 12:42:10'),
(226, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 17:19:06', '2023-12-10 17:19:06'),
(227, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-10 17:19:06', '2023-12-10 17:19:06'),
(228, 45, 'The seller accepted your order. Please refer to your purchases page for more Information!', '2023-12-10 17:48:40', '2023-12-10 17:48:40'),
(229, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-12 23:03:38', '2023-12-12 23:03:38'),
(230, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-12 23:49:55', '2023-12-12 23:49:55'),
(231, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-12 23:52:40', '2023-12-12 23:52:40'),
(232, 8, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-13 12:17:27', '2023-12-13 12:17:27'),
(233, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-13 12:17:27', '2023-12-13 12:17:27'),
(234, 7, 'A buyer placed an order. Go to the orders page for more information.', '2023-12-13 13:57:27', '2023-12-13 13:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `pmode` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `proof_img` varchar(250) NOT NULL,
  `order_added` datetime NOT NULL DEFAULT current_timestamp(),
  `order_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `seller_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `name`, `contact`, `address`, `city`, `province`, `zip`, `pmode`, `status`, `proof_img`, `order_added`, `order_updated`, `seller_id`) VALUES
(113, 45, 'ECNC17023963608', 'Earl Cartney N. Centino', '09682601128', 'San Jose, Rainbow Village', 'Tacloban City', 'Leyte', '6500', 'Cash on Delivery', 'Pending', '', '2023-12-12 23:52:40', NULL, 8),
(114, 45, 'ECNC17024410478', 'Earl Cartney N. Centino', '09682601128', 'San Jose, Rainbow Village', 'Tacloban City', 'Leyte', '6500', 'Cash on Delivery', 'Pending', '', '2023-12-13 12:17:27', NULL, 8),
(115, 45, 'ECNC17024410477', 'Earl Cartney N. Centino', '09682601128', 'San Jose, Rainbow Village', 'Tacloban City', 'Leyte', '6500', 'Cash on Delivery', 'Pending', '', '2023-12-13 12:17:27', NULL, 7),
(116, 45, 'ECNC17024470477', 'Earl Cartney N. Centino', '09682601128', 'San Jose, Rainbow Village', 'Tacloban City', 'Leyte', '6500', 'Cash on Delivery', 'Pending', '', '2023-12-13 13:57:27', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pmethod`
--

CREATE TABLE `pmethod` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `provider` varchar(250) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pmethod`
--

INSERT INTO `pmethod` (`id`, `name`, `provider`, `dateadded`) VALUES
(1, 'Cash on Delivery', 'NetGosyo-Sellers', '2023-09-27 10:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `item_brand` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `sales` int(100) NOT NULL,
  `prodweight` varchar(250) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `image`, `item_brand`, `quantity`, `description`, `sales`, `prodweight`, `date_added`) VALUES
(1, 8, 'Banig Bag - Rounded', '500', '1.png', 'Women-Bag', 19, 'Handwoven banig bags are one of the most popular fashion pieces from the Philippines and for a good reason. These native straw bags made from tikog, pandan, and straw leaves have transitioned from being just a Filipino fashion staple into a world-renowned style accent that gives that rich personality to any ensemble.                                                                                                                                                                                                        ', 9, '211', '2023-12-13 04:17:27'),
(2, 8, 'Banig Bag - Rectangular', '300', '2.png', 'Women-Bag', 90, 'Handwoven banig bags are one of the most popular fashion pieces from the Philippines and for a good reason. These native straw bags made from tikog, pandan, and straw leaves have transitioned from being just a Filipino fashion staple into a world-renowned style accent that gives that rich personality to any ensemble.', 0, '200', '2023-12-12 15:34:22'),
(3, 8, 'Banig Bag - ZigZag', '150', '3.png', 'Women-Bag', 18, 'Handwoven banig bags are one of the most popular fashion pieces from the Philippines and for a good reason. These native straw bags made from tikog, pandan, and straw leaves have transitioned from being just a Filipino fashion staple into a world-renowned style accent that gives that rich personality to any ensemble.', 0, '190', '2023-12-12 15:34:33'),
(4, 8, 'I Love Tacloban Shirt', '250', '4.png', 'Men-Apparel', 13, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, eaque. Atque, ad soluta corporis temporibus assumenda saepe laudantium quidem. Facilis veniam rerum ipsam totam sequi at autem omnis reprehenderit voluptatibus.', 16, '170', '2023-12-12 15:32:47'),
(5, 39, 'Baybayin Jacket', '200', '5.png', 'Men-Apparel', 57, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, eaque. Atque, ad soluta corporis temporibus assumenda saepe laudantium quidem. Facilis veniam rerum ipsam totam sequi at autem omnis reprehenderit voluptatibus.', 1, '175', '2023-12-12 15:32:58'),
(6, 39, 'Baybayin Tanktop', '134', '6.png', 'Men-Apparel', 60, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, eaque. Atque, ad soluta corporis temporibus assumenda saepe laudantium quidem. Facilis veniam rerum ipsam totam sequi at autem omnis reprehenderit voluptatibus.', 0, '150', '2023-12-12 15:33:09'),
(7, 7, 'Leyte`s Special Binagol', '150', '7.png', 'Foods', 197, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, eaque. Atque, ad soluta corporis temporibus assumenda saepe laudantium quidem. Facilis veniam rerum ipsam totam sequi at autem omnis reprehenderit voluptatibus.', 1, '260', '2023-12-12 15:57:46'),
(8, 7, 'Leyte`s Chocolate Moron', '45', '8.png', 'Foods', 203, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, eaque. Atque, ad soluta corporis temporibus assumenda saepe laudantium quidem. Facilis veniam rerum ipsam totam sequi at autem omnis reprehenderit voluptatibus.', 8, '99', '2023-12-13 05:57:27'),
(9, 8, 'I Love Tacloban(Cotton)', '200', 'Picture1.png', 'Men-Apparel', 16, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, eaque. Atque, ad soluta corporis temporibus assumenda saepe laudantium quidem. Facilis veniam rerum ipsam totam sequi at autem omnis reprehenderit voluptatibus.                                                                                                                        ', 3, '150', '2023-12-12 15:33:25'),
(25, 8, 'Handmade Mugs', '90', '1700633543-Picture10.png', 'Souvenirs', 40, 'Show your love for your hometown in Leyte with this handmade coffee mug.\r\n\r\nThis high quality 11oz ceramic white mug has a premium hard coat that provides crisp and vibrant color reproduction sure to last for years. Perfect for all hot & cold beverages.', 0, '235', '2023-12-12 15:36:07'),
(26, 8, 'Banig Purse', '250', '1700633644-Picture12.png', 'Women-Bag', 56, 'Handwoven banig bags are one of the most popular fashion pieces from the Philippines and for a good reason. These native straw bags made from tikog, pandan, and straw leaves have transitioned from being just a Filipino fashion staple into a world-renowned style accent that gives that rich personality to any ensemble.', 0, '100', '2023-12-12 15:36:23'),
(27, 8, 'Wooden Mugs', '150', '1700633845-Picture6.png', 'Souvenirs', 100, 'This wooden mug will give you a unique, close to nature drinking experience and a great souvenir item to take with you if you’re a tourist.', 0, '290', '2023-12-12 15:36:37'),
(28, 8, 'Minimalist Banig Bag', '300', '1700634466-Picture7.png', 'Women-Bag', 56, 'Handwoven banig bags are one of the most popular fashion pieces from the Philippines and for a good reason. These native straw bags made from tikog, pandan, and straw leaves have transitioned from being just a Filipino fashion staple into a world-renowned style accent that gives that rich personality to any ensemble.          ', 0, '110', '2023-12-12 15:36:47'),
(29, 7, 'RAB Bahalina', '150', '1700649299-Picture11.png', 'Foods', 211, 'Habang tumatagal Lalong Sumasarap', 0, '180', '2023-12-12 15:37:27'),
(30, 7, 'Shamrock Utap', '50', '1700649392-Picture15.png', 'Foods', 239, 'With more than 70 years of excellent baking experience, Shamrock has become one of Cebu’s living icons in homegrown goodness. And to this day, Shamrock continues to earn its place in the taste buds of both local and foreign visitors who all delight in shamrock’s famous “Otap” and other baked specialties.', 1, '50', '2023-12-12 15:37:38'),
(31, 7, 'Pastillas de leche ', '20', '1700649517-Picture16.png', 'Foods', 300, 'Looking for the perfect sweet treat? Try this Pastillas de Leche recipe! These Filipino candies made with sugar and milk are soft and creamy bites of heaven. Make a big batch for gift-giving or to keep on hand for anytime cravings.', 0, '50', '2023-12-12 15:37:48'),
(36, 8, 'Samsung Galaxy ', '300', '1701783567-Iphonethis.png', 'Gadget', 489, 'asdadasdasd', 11, '200', '2023-12-12 15:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `product_id`, `user_name`, `user_rating`, `user_review`) VALUES
(30, 1, 'Earl Cartney N. Centino', 1, 'adsada'),
(31, 1, 'Earl Cartney N. Centino', 4, 'asasdsa'),
(36, 8, 'Earl Cartney N. Centino', 4, 'tis great but bad'),
(37, 8, 'Earl Cartney N. Centino', 3, 'this great I think'),
(38, 8, 'Earl Cartney N. Centino', 5, 'I proclaim this as good');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `checkout_pass` varchar(250) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `archipelago` varchar(250) NOT NULL,
  `landmark` varchar(500) NOT NULL,
  `city` varchar(250) NOT NULL,
  `province` varchar(250) NOT NULL,
  `zip` varchar(250) NOT NULL,
  `dateofbirth` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `shopname` varchar(250) NOT NULL DEFAULT 'user',
  `shopdesc` varchar(5000) NOT NULL,
  `vkey` varchar(50) NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pic` varchar(255) DEFAULT NULL,
  `has_verified_badge` tinyint(1) DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `number_verified` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `fullname`, `email`, `username`, `password`, `checkout_pass`, `phonenumber`, `address`, `address2`, `archipelago`, `landmark`, `city`, `province`, `zip`, `dateofbirth`, `gender`, `image`, `shopname`, `shopdesc`, `vkey`, `verify_token`, `verified`, `register_date`, `id_pic`, `has_verified_badge`, `is_banned`, `number_verified`) VALUES
(1, 'Andrew Afable Agda', 'izukumidoriya032@gmail.com', 'Rakunnichi', '81dc9bdb52d04dc20036dbd8313ed055', '0', '09933081154', 'Caibaan', 'Jiabong, Samar', '', 'Near The Waiting Shed', 'Tacloban City', 'Leyte', '6500', '2000-07-02', 'Male', 'profile_902284549.jpg', 'user', '', '', 'd67f7200e52a9125acdca230e213925cNetGosyo', 1, '2023-12-04 16:08:17', '', 0, 0, 1),
(3, 'NetGosyo', 'netgosyo398@gmail.com', 'Netgosyo', '81dc9bdb52d04dc20036dbd8313ed055', '0', '09143567784', 'Tacloban City', '', '', '', '', '', '', '2023-09-12', 'Male', '', 'user', '', '', '', 0, '2023-11-17 15:29:24', '', 0, 0, 0),
(7, 'Coline Lorriene Aguipo', 'colineaguipo05@gmail.com', 'Coline51', '81dc9bdb52d04dc20036dbd8313ed055', '0', '09154715779', 'Rainbow Village Tacloban City', '', '', '', 'Tanauan', 'Leyte', '4027', '2000-02-09', 'Female', 'profile_1030987840.png', 'Pasalubong', 'Treat your taste buds to the flavors of Tacloban with our mouthwatering local foods, perfect for pasalubong or your next fiesta.\r\n\r\nMade with care using time-honored recipes and the freshest local ingredients\r\n\r\nWide selection including suman sa ibos, binagol, moron, and more\r\n\r\nSupport local farmers and food artisans\r\n\r\nOur top-quality local delicacies capture the rich culinary traditions of the Tacloban region. The suman sa ibos features sticky rice wrapped in fragrant coconut leaves, with an irresistibly sweet and nutty coconut jam filling.\r\n\r\nGive your family and friends a taste of authentic Tacloban culture with food gifts lovingly crafted to share and enjoy. These hand-made treats spotlight the care and skill of local food makers using long-held recipes and techniques.', '', '797b4f3f68b9118943e03241b7335940NetGosyo', 1, '2023-12-05 13:23:22', '', 1, 0, 0),
(8, 'Joey Raymund Macasusi', 'kuyaey30@gmail.com', 'KuyaEy', '202cb962ac59075b964b07152d234b70', '', '09154715772', '1st Street', '', '', '', 'Santa Fe', 'Leyte', '6513', '2015-02-10', 'Male', 'profile_1123099532.png', 'Local Treasures', 'Discover the clothes, gadgets, and accessories that will make you stand out from the crowd! Our selection of the latest fashion, technology, and gear has something for everyone.\r\n\r\nHuge selection of stylish clothes for men, women, and kids - from casual wear to formal attire\r\nCutting-edge phones and gadgets with all the latest features and capabilities\r\nQuality bags, backpacks, and accessories to carry your essentials in style\r\nStay on top of all the hottest trends and get compliments wherever you go. Our affordable prices make it easy to refresh your look as often as you like.\r\n\r\nMake a statement and express your personal style with confidence. Our products make looking and feeling your best effortless!', '', '', 1, '2023-12-05 13:27:17', 'id_pic_177193073.jpg', 1, 0, 0),
(39, 'John Rey Amith', 'centino.earlcartney.n@gmail.com', 'Seler101', '81dc9bdb52d04dc20036dbd8313ed055', '0', '09154715772', 'Cogon San Jose', '', '', '', 'Tacloban City', 'Leyte', '', '2023-09-12', 'Male', 'profile_1223238167.png', 'Ukay-Ukay', 'Stand out from the crowd with these one-of-a-kind vintage apparels! This stylish clothing takes you back to iconic eras with authentic retro designs.\r\n\r\nGenuine vintage pieces from the 50s, 60s, 70s, and beyond\r\nUnique fabrics and patterns you won\'t find anywhere else\r\nCarefully curated collection of dresses, tops, bottoms, and accessories\r\nWith these vintage apparels, you\'ll showcase your bold personality and love of retro style. The flattering fits and high-quality construction ensure you look as good as you feel in these conversation-starting classics.\r\n\r\nFor trendsetters and vintage devotees who want effortless chic style, these vintage apparels are your ticket to timeless cool. Wear them to stand out in any crowd while paying homage to iconic fashion history.\r\n\r\nVersion 2:\r\n\r\nTake your wardrobe back in time with these one-of-a-kind vintage apparels! Lovingly curated from iconic eras, these retro gems are your new secret weapons for showstopping style.\r\n\r\nAuthentic designs from the most stylish decades\r\nFabrics and patterns with true vintage charm\r\nDresses, tops, bottoms and accessories for head-to-toe retro looks\r\nImagine the compliments you\'ll get when you walk into the room looking like a glamorous star from the past. With impeccable fits tailored to flatter, these vintage apparels make you look as gorgeous as you feel.\r\n\r\nFor fashionistas and vintage devotees, these apparels are your ticket to era-hopping chic. Express your bold personality while paying homage to the past with the ultimate vintage classics.', 'bf5e7bece61ea61e580983f2ce115bfd', '', 1, '2023-12-05 13:29:59', '', 0, 1, 0),
(45, 'Earl Cartney N. Centino', 'rakunn777@gmail.com', 'Ran1020', '81dc9bdb52d04dc20036dbd8313ed055', '0ae84817365fa50ae008311381d052a0', '09682601128', 'San Jose, Rainbow Village', 'Jaro, Leyte', 'Visayas', 'Near Madisson Park', 'Tacloban City', 'Leyte', '6500', '2023-11-13', '', 'profile_2094043675.png', 'user', '', 'e92f29283cf4e4c42e7a14286efdb22e', '7dea3ba66d3dfe004c6aba00a4415f83NetGosyo', 1, '2023-12-10 09:15:53', NULL, NULL, 0, 1),
(48, 'Arvin Felicen', 'rakunn719@gmail.com', 'Arvin2020', '81dc9bdb52d04dc20036dbd8313ed055', '', '09682601128', 'Fatima Village', '', '', '', 'Abuyog', 'Leyte', '', '', 'Male', 'profile_1938960060.png', 'Arvin`s Gadgets', 'Whether you need to send emails on the go, stream movies, or video chat with friends, Gadgets\' laptops and phones have the specs to handle it all. From lightweight notebooks to tablets to smartphones, your new device is ready to tackle work and play with ease.\r\n\r\nSay goodbye to low storage, slow processing speeds, and short battery life. Gadgets offers stylish, innovative devices built for today\'s nonstop lifestyles. And with a range of prices, there\'s something for every budget.\r\n\r\nJoin the Gadgets revolution and upgrade your tech - and your life. Find the gadget that fits you best today.', 'c335cd45e5b7fcd2083203aab2879dca', '', 1, '2023-12-07 07:31:50', NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `convo`
--
ALTER TABLE `convo`
  ADD PRIMARY KEY (`convo_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pmethod`
--
ALTER TABLE `pmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `convo`
--
ALTER TABLE `convo`
  MODIFY `convo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `pmethod`
--
ALTER TABLE `pmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
