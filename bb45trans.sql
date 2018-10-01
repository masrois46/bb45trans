-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Sep 2018 pada 13.59
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bb45trans`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`email`, `password`, `name`, `telp`) VALUES
('masrois46@gmail.com', '$2y$10$itjQWFdeNEPpA9Bu6YaH1.fzvZdl.CjA4vRxPlCRqp46BlRA1Kq8i', 'Kang Rois', '08785722111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_account`
--

CREATE TABLE `bank_account` (
  `id_bank` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `account_holder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bank_account`
--

INSERT INTO `bank_account` (`id_bank`, `bank_name`, `account`, `account_holder`) VALUES
(1, 'Paypal', 'bb45trans@gmail.com', 'Imam R Prayogi'),
(2, 'Bank Mandiri', '123456789', 'Imam R Prayogi'),
(3, 'Bank BNI', '123456789', 'Imam R Prayogi'),
(4, 'Bank BRI', '123456789', 'Imam R Prayogi'),
(5, 'Cash On Delivery', 'Just pay on our driver', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE `config` (
  `config` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`config`, `value`) VALUES
('footer-copyright', 'Copyright © BB 45Trans 2018.'),
('footer-email', 'admin[at]bb45trans.com'),
('footer-link1', '<ul>\r\n                        <li><a href=\"#\">About us</a></li>\r\n                        <li><a href=\"#\">FAQ</a></li>\r\n                        <li><a href=\"#\">Login</a></li>\r\n                        <li><a href=\"#\">Register</a></li>\r\n                         <li><a href=\"#\">Terms and condition</a></li>\r\n                    </ul>'),
('footer-link2', '<ul>\r\n                        <li><a href=\"#\">Community blog</a></li>\r\n                        <li><a href=\"#\">Tour guide</a></li>\r\n                        <li><a href=\"#\">Wishlist</a></li>\r\n                         <li><a href=\"#\">Gallery</a></li>\r\n                    </ul>'),
('footer-link3', '<div id=\"google_translate_element\"></div><script type=\"text/javascript\">\r\nfunction googleTranslateElementInit() {\r\n  new google.translate.TranslateElement({pageLanguage: \'id\', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, \'google_translate_element\');\r\n}\r\n</script><script type=\"text/javascript\" src=\"https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"></script>\r\n        '),
('footer-number', '+62333-123456'),
('footer-text-link1', 'Tentang'),
('footer-text-link2', 'Pengalaman'),
('footer-text-link3', 'Language'),
('icon-facebook', 'https://facebook.com/bb45trans'),
('icon-google', '##'),
('icon-instagram', '##'),
('icon-twitter', '##'),
('icon-youtube', '##'),
('phone-number', '+6287857449111'),
('title-universal', 'BB 45Trans Tour And Travel'),
('youtube_home_link', 'https://www.youtube.com/watch?v=bR3eAJcnrZM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `confirm_transfer`
--

CREATE TABLE `confirm_transfer` (
  `id_confirm_transfer` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `date_transfer` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `confirm_transfer`
--

INSERT INTO `confirm_transfer` (`id_confirm_transfer`, `email`, `id_invoice`, `date_transfer`, `image`, `status`) VALUES
(19, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 1),
(20, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(21, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(22, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(23, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(24, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(25, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(26, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(27, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(28, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(29, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(30, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(31, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(32, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 0),
(33, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 1),
(34, 'masrois46@gmail.com', 809182, 1538154000, '/assets/buktiTransfer/44c17428b27475008ca0a4f87c990b23.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `order_date` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `date_tour` int(11) NOT NULL,
  `email_confirm` tinyint(1) NOT NULL,
  `status_paid` tinyint(1) NOT NULL,
  `status_invoice` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `user_email`, `order_date`, `payment_method`, `date_tour`, `email_confirm`, `status_paid`, `status_invoice`) VALUES
(809180, 'masrois46@gmail.com', 1536426904, '5', 1540940400, 1, 0, 1),
(809181, 'masrois46@gmail.com', 1536427076, '2', 1537826400, 1, 0, 2),
(809182, 'masrois46@gmail.com', 1536427140, '4', 1537394400, 1, 0, 0),
(809183, 'masrois46@gmail.com', 1536427436, '5', 1537394400, 1, 0, 2),
(809184, 'masrois46@gmail.com', 1536428337, '4', 1536703200, 1, 0, 2),
(909185, 'masrois46@gmail.com', 1536472101, '5', 1538258400, 1, 1, 127),
(1309186, 'masrois46@gmail.com', 1536808522, '3', 1537999200, 1, 0, 127);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_services`
--

CREATE TABLE `invoice_services` (
  `id_invoice_services` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_services`
--

INSERT INTO `invoice_services` (`id_invoice_services`, `id_invoice`, `name`, `price`) VALUES
(1, 809180, 'Dedicated Tour guide', 34),
(2, 809180, 'Welcome bottle', 24),
(3, 809180, 'Dinner', 26),
(4, 809180, 'Pick up service', 34),
(5, 909185, 'Insurance', 24),
(6, 909185, 'Dinner', 26),
(7, 1309186, 'Coffe break', 12),
(8, 1309186, 'Pick up service', 34);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_tour`
--

CREATE TABLE `invoice_tour` (
  `id_invoice_tour` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_tour` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_tour`
--

INSERT INTO `invoice_tour` (`id_invoice_tour`, `id_invoice`, `id_tour`, `name`, `qty`, `price`, `subtotal`) VALUES
(1, 809180, 'ubud-bali1', 'Ubud Bali', 5, 45, 225),
(2, 809180, 'kuta-beach-bali1', 'Kuta Beach Bali', 5, 60, 300),
(3, 809180, 'pandawa-beach-bali', 'Pandawa Beach Bali', 5, 65, 325),
(4, 809180, 'glilitrawang-lombok', 'Gilitrawang Lombok', 5, 74, 370),
(5, 809181, 'ubud-bali', '7', 1, 45, 45),
(6, 809182, 'kuta-beach-bali', '3', 1, 60, 60),
(7, 809183, 'kuta-beach-bali11123', 'Kuta Beach Bali', 1, 60, 60),
(8, 809184, 'red-islan1123', '2', 1, 74, 74),
(9, 909185, 'ubud-bali1', 'Ubud Bali', 2, 45, 90),
(10, 1309186, '1', 'Gilitrawang Lombok', 2, 74, 148),
(11, 1309186, '3', 'Kuta Beach Bali', 2, 60, 120);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_children`
--

CREATE TABLE `menu_children` (
  `children_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_children`
--

INSERT INTO `menu_children` (`children_id`, `parent_id`, `text`, `link`) VALUES
(1, 1, 'Contact Us', '/contact-us'),
(2, 1, 'Our Team', '/our-team');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_parents`
--

CREATE TABLE `menu_parents` (
  `parent_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_parents`
--

INSERT INTO `menu_parents` (`parent_id`, `text`, `link`) VALUES
(1, 'Service', '/service'),
(3, 'contact', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `information` varchar(255) NOT NULL,
  `link_button1` varchar(255) NOT NULL,
  `text_button1` varchar(50) NOT NULL,
  `link_button2` varchar(255) NOT NULL,
  `text_button2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `image`, `caption`, `information`, `link_button1`, `text_button1`, `link_button2`, `text_button2`) VALUES
(1, '/assets/img/tours/full/kuta-bali.jpg', 'Affordable Bali Tours', 'City Tours / Tour Tickets / Tour Guides', '#', 'View Tour', '#', 'Selengkapnya'),
(2, 'http://www.ansonika.com/citytours/rev-slider-files/assets/notgeneric_bg2.jpg', 'Affordable Bromo Tours', 'City Tours / Tour Tickets / Tour Guides', '#', 'View Tour', '#', 'Read More');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tour`
--

CREATE TABLE `tour` (
  `id_tour` int(255) NOT NULL,
  `id_categories` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_thumbnail` varchar(255) NOT NULL,
  `image_full` varchar(255) NOT NULL,
  `badge` enum('popular','top_rated','empty') NOT NULL,
  `normal_price` int(11) NOT NULL,
  `discount_price` int(11) NOT NULL,
  `date_post` int(11) NOT NULL,
  `date_update` int(11) NOT NULL,
  `short_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tour`
--

INSERT INTO `tour` (`id_tour`, `id_categories`, `name`, `image_thumbnail`, `image_full`, `badge`, `normal_price`, `discount_price`, `date_post`, `date_update`, `short_description`) VALUES
(1, 'bali', 'Gilitrawang Lombok', '/assets/img/tours/thumbnail/red-island-banyuwangi-thumbnail.jpg', '/assets/img/tours/full/bromo-tour.jpg', 'popular', 41, 74, 0, 0, ''),
(2, 'bali', '3', '/assets/img/tours/thumbnail/kuta-beach-bali-thumbnail.jpg', '/assets/img/tours/full/borobudur-tours.jpg', 'popular', 35, 60, 0, 0, ''),
(3, 'bali', 'Kuta Beach Bali', '/assets/img/tours/thumbnail/kuta-beach-bali-thumbnail.jpg', '/assets/img/tours/full/ijen-crater.jpg', 'popular', 35, 60, 0, 0, ''),
(4, 'bali', 'Kuta Beach Bali', '/assets/img/tours/thumbnail/kuta-beach-bali-thumbnail.jpg', '/assets/img/tours/full/bromo-tour.jpg', 'popular', 35, 60, 0, 0, ''),
(5, 'bali', 'Kuta Beach Bali', '/assets/img/tours/thumbnail/kuta-beach-bali-thumbnail.jpg', '/assets/img/tours/full/kuta-bali.jpg', 'popular', 35, 60, 0, 0, ''),
(6, 'bali', 'Pandawa Beach Bali', '/assets/img/tours/thumbnail/pandawa-beach-bali-thumbnail.jpg', '/assets/img/tours/full/ijen-crater.jpg', 'top_rated', 43, 65, 0, 0, ''),
(7, 'bali', '4', '/assets/img/tours/thumbnail/pandawa-beach-bali-thumbnail.jpg', '/assets/img/tours/full/borobudur-tours.jpg', 'top_rated', 43, 65, 0, 0, ''),
(8, 'bali', '6', '/assets/img/tours/thumbnail/pandawa-beach-bali-thumbnail.jpg', '/assets/img/tours/full/bromo-tour.jpg', 'top_rated', 43, 65, 0, 0, ''),
(9, 'bali', '5', '/assets/img/tours/thumbnail/pandawa-beach-bali-thumbnail.jpg', '/assets/img/tours/full/kuta-bali.jpg', 'top_rated', 43, 65, 0, 0, ''),
(10, 'bali', '2', '/assets/img/tours/thumbnail/red-island-banyuwangi-thumbnail.jpg', '/assets/img/tours/full/bromo-tour.jpg', 'popular', 41, 74, 0, 0, ''),
(11, 'bali', '1', '/assets/img/tours/thumbnail/red-island-banyuwangi-thumbnail.jpg', '/assets/img/tours/full/kuta-bali.jpg', 'popular', 41, 74, 0, 0, 'tes deskripsi, tes deskripsi, tes deskrtes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, ipsi, tes deskripsi, tes deskripsi, tes deskripsites deskripsi, tes deskripsi, tes deskrtes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, ipsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, , tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, tes deskripsi, '),
(12, 'bali', '7', '/assets/img/tours/thumbnail/ubud-bali-thumbnail.jpg', '/assets/img/tours/full/kuta-bali2.jpg', 'empty', 34, 45, 0, 0, ''),
(13, 'bali', 'Ubud Bali', '/assets/img/tours/thumbnail/ubud-bali-thumbnail.jpg', '/assets/img/tours/full/borobudur-tours.jpg', 'empty', 34, 45, 0, 0, ''),
(14, 'bali', 'Ubud Bali', '/assets/img/tours/thumbnail/ubud-bali-thumbnail.jpg', '/assets/img/tours/full/kuta-bali2.jpg', 'empty', 34, 45, 0, 0, ''),
(15, 'bali', '8', '/assets/img/tours/thumbnail/ubud-bali-thumbnail.jpg', '/assets/img/tours/full/kuta-bali2.jpg', 'empty', 34, 45, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tour_carousel`
--

CREATE TABLE `tour_carousel` (
  `id` int(11) NOT NULL,
  `id_tour` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tour_carousel`
--

INSERT INTO `tour_carousel` (`id`, `id_tour`, `image`) VALUES
(1, 'red-islan123', '/assets/img/tours/full/kuta-bali2.jpg'),
(2, 'red-islan123', '/assets/img/slider_single_tour/9_medium.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tour_categories`
--

CREATE TABLE `tour_categories` (
  `id_categories` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon_tags` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tour_categories`
--

INSERT INTO `tour_categories` (`id_categories`, `name`, `icon_tags`) VALUES
('bali', 'Bali', ' icon_set_3_restaurant-10'),
('jawa', 'Jawa', 'icon_set_3_restaurant-6'),
('lombok', 'Lombok', 'icon_set_2_icon-111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tour_features`
--

CREATE TABLE `tour_features` (
  `id_features` int(11) NOT NULL,
  `id_tour_features` varchar(255) NOT NULL,
  `icon_tour_features` varchar(255) NOT NULL,
  `heading_features` varchar(255) NOT NULL,
  `content_features` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tour_features`
--

INSERT INTO `tour_features` (`id_features`, `id_tour_features`, `icon_tour_features`, `heading_features`, `content_features`) VALUES
(1, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(2, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(3, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(4, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(5, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(6, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(7, 'ubud-bali', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah'),
(9, 'red-islan123', 'icon_set_1_icon-4', 'Tes Heading', 'oke==========coba==========hayah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tour_services`
--

CREATE TABLE `tour_services` (
  `id_services` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tour_services`
--

INSERT INTO `tour_services` (`id_services`, `name`, `icon`, `price`) VALUES
(1, 'Dedicated Tour guide', 'icon_set_1_icon-16', 34),
(2, 'Pick up service', 'icon_set_1_icon-26', 34),
(3, 'Insurance', 'icon_set_1_icon-71', 24),
(4, 'Welcome bottle', 'icon_set_1_icon-15', 24),
(5, 'Coffe break', 'icon_set_1_icon-59', 12),
(6, 'Dinner', 'icon_set_1_icon-58', 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tour_timeline`
--

CREATE TABLE `tour_timeline` (
  `id_timeline` int(11) NOT NULL,
  `id_tour` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tour_timeline`
--

INSERT INTO `tour_timeline` (`id_timeline`, `id_tour`, `icon`, `heading`, `content`) VALUES
(1, 'red-islan123', 'icon_set_1_icon-4', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(2, 'red-islan123', 'icon_set_1_icon-4', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(3, 'red-islan123', 'icon_set_1_icon-4', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(4, 'red-islan123', 'icon_set_1_icon-4', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(5, 'ubud-bali', 'icon_set_2_icon-103', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(6, 'ubud-bali', 'icon_set_3_restaurant-1', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(7, 'ubud-bali', 'icon_set_1_icon-4', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.'),
(8, 'ubud-bali', 'icon_set_1_icon-4', 'Meet', 'Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Pea sprouts wattle seed rutabaga okra yarrow cress avocado grape radish bush tomato ricebean black-eyed pea maize eggplant.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `confirmation_code` varchar(255) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `last_access` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`email`, `password`, `picture`, `first_name`, `last_name`, `phone_number`, `date_of_birth`, `street_address`, `city`, `zip_code`, `country`, `confirmation_code`, `confirmed`, `create_at`, `update_at`, `last_access`) VALUES
('masrois46@gmail.com', '$2y$10$8NOGRxnqACRd0K.13plM2OULHbYaeOm5mRFHlgs35uJvyNsKyKt46', '/assets/profile/dd09f264067800aaae1f2a440cca4f1b.jpg', 'Muhammad', 'Rois', '87857449253', '2018-09-26', 'Dsun Parastembok Rt2 Rw3 Desa Jambewangi Kecamatan Sempu', 'Banyuwangi', 68468, 'Indonesia', '$2y$10$9Cd/45KflTXOVp7XCQOrgOFUy.cBMGfvzojkzlw.KnhEs/KM1fK5u', 0, 1536808489, 1537991225, 1537989492);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config`);

--
-- Indeks untuk tabel `confirm_transfer`
--
ALTER TABLE `confirm_transfer`
  ADD PRIMARY KEY (`id_confirm_transfer`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `invoice_services`
--
ALTER TABLE `invoice_services`
  ADD PRIMARY KEY (`id_invoice_services`);

--
-- Indeks untuk tabel `invoice_tour`
--
ALTER TABLE `invoice_tour`
  ADD PRIMARY KEY (`id_invoice_tour`);

--
-- Indeks untuk tabel `menu_children`
--
ALTER TABLE `menu_children`
  ADD PRIMARY KEY (`children_id`);

--
-- Indeks untuk tabel `menu_parents`
--
ALTER TABLE `menu_parents`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id_tour`);

--
-- Indeks untuk tabel `tour_carousel`
--
ALTER TABLE `tour_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tour_categories`
--
ALTER TABLE `tour_categories`
  ADD PRIMARY KEY (`id_categories`);

--
-- Indeks untuk tabel `tour_features`
--
ALTER TABLE `tour_features`
  ADD PRIMARY KEY (`id_features`);

--
-- Indeks untuk tabel `tour_services`
--
ALTER TABLE `tour_services`
  ADD PRIMARY KEY (`id_services`);

--
-- Indeks untuk tabel `tour_timeline`
--
ALTER TABLE `tour_timeline`
  ADD PRIMARY KEY (`id_timeline`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `confirm_transfer`
--
ALTER TABLE `confirm_transfer`
  MODIFY `id_confirm_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `invoice_services`
--
ALTER TABLE `invoice_services`
  MODIFY `id_invoice_services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `invoice_tour`
--
ALTER TABLE `invoice_tour`
  MODIFY `id_invoice_tour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `menu_children`
--
ALTER TABLE `menu_children`
  MODIFY `children_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `menu_parents`
--
ALTER TABLE `menu_parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tour_carousel`
--
ALTER TABLE `tour_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tour_features`
--
ALTER TABLE `tour_features`
  MODIFY `id_features` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tour_services`
--
ALTER TABLE `tour_services`
  MODIFY `id_services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tour_timeline`
--
ALTER TABLE `tour_timeline`
  MODIFY `id_timeline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
