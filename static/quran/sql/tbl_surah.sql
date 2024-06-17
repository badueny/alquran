-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2024 at 05:32 PM
-- Server version: 10.4.31-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddweb_mtq`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surah`
--

CREATE TABLE `tbl_surah` (
  `id_surah` int(11) NOT NULL,
  `arabic_surah` mediumtext NOT NULL,
  `latin_surah` char(200) NOT NULL,
  `transliteration_surah` char(200) NOT NULL,
  `translation_surah` char(200) NOT NULL,
  `num_ayah_surah` int(11) NOT NULL,
  `page_surah` int(11) NOT NULL,
  `location_surah` char(200) NOT NULL,
  `idinc_surah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_surah`
--

INSERT INTO `tbl_surah` (`id_surah`, `arabic_surah`, `latin_surah`, `transliteration_surah`, `translation_surah`, `num_ayah_surah`, `page_surah`, `location_surah`, `idinc_surah`) VALUES
(1, ' الفاتحة', 'Al-Fātiḥah', 'Al-Fatihah', 'Pembuka', 7, 1, 'Makkiyah', 2),
(2, ' البقرة', 'Al-Baqarah', 'Al-Baqarah', 'Sapi', 286, 2, 'Madaniyah', 3),
(3, ' اٰل عمرٰن', 'Āli ‘Imrān', 'Ali ‘Imran', 'Keluarga Imran', 200, 50, 'Madaniyah', 4),
(4, 'النّساۤء', 'An-Nisā\'', 'An-Nisa\'', 'Perempuan', 176, 77, 'Madaniyah', 5),
(5, ' الماۤئدة', 'Al-Mā\'idah', 'Al-Ma\'idah', 'Hidangan', 120, 106, 'Madaniyah', 6),
(6, ' الانعام', 'Al-An‘ām', 'Al-An‘am', 'Binatang Ternak', 165, 128, 'Makkiyah', 7),
(7, ' الاعراف', 'Al-A‘rāf', 'Al-A‘raf', 'Tempat Tertinggi', 206, 151, 'Makkiyah', 8),
(8, ' الانفال', 'Al-Anfāl', 'Al-Anfal', 'Rampasan Perang', 75, 177, 'Madaniyah', 9),
(9, 'التّوبة', 'At-Taubah', 'At-Taubah', 'Pengampunan', 129, 187, 'Madaniyah', 10),
(10, ' يونس', 'Yūnus', 'Yunus', 'Yunus', 109, 208, 'Makkiyah', 11),
(11, ' هود', 'Hūd', 'Hud', 'Hud', 123, 221, 'Makkiyah', 12),
(12, ' يوسف', 'Yūsuf', 'Yusuf', 'Yusuf', 111, 235, 'Makkiyah', 13),
(13, ' الرّعد', 'Ar-Ra‘d', 'Ar-Ra‘d', 'Guruh', 43, 249, 'Makkiyah', 14),
(14, ' ابرٰهيم', 'Ibrāhīm', 'Ibrahim', 'Ibrahim', 52, 255, 'Makkiyah', 15),
(15, ' الحجر', 'Al-Ḥijr', 'Al-Hijr', 'Hijr', 99, 262, 'Makkiyah', 16),
(16, 'النّحل', 'An-Naḥl', 'An-Nahl', 'Lebah', 128, 267, 'Makkiyah', 17),
(17, ' الاسراۤء', 'Al-Isrā\'', 'Al-Isra\'', 'Memperjalankan di Malam Hari', 111, 282, 'Makkiyah', 18),
(18, ' الكهف', 'Al-Kahf', 'Al-Kahf', 'Gua', 110, 293, 'Makkiyah', 19),
(19, ' مريم', 'Maryam', 'Maryam', 'Maryam', 98, 305, 'Makkiyah', 20),
(20, ' طٰهٰ', 'Ṭāhā', 'Taha', 'Taha', 135, 312, 'Makkiyah', 21),
(21, ' الانبياۤء', 'Al-Anbiyā\'', 'Al-Anbiya\'', 'Para Nabi', 112, 322, 'Makkiyah', 22),
(22, 'الحجّ', 'Al-Ḥajj', 'Al-Hajj', 'Haji', 78, 332, 'Madaniyah', 23),
(23, ' المؤمنون', 'Al-Mu\'minūn', 'Al-Mu\'minun', 'Orang-Orang Mukmin', 118, 342, 'Makkiyah', 24),
(24, ' النّور', 'An-Nūr', 'An-Nur', 'Cahaya', 64, 350, 'Madaniyah', 25),
(25, ' الفرقان', 'Al-Furqān', 'Al-Furqan', 'Pembeda', 77, 359, 'Makkiyah', 26),
(26, 'الشّعراۤء', 'Asy-Syu‘arā\'', 'Asy-Syu‘ara\'', 'Para Penyair', 227, 367, 'Makkiyah', 27),
(27, 'النّمل', 'An-Naml', 'An-Naml', 'Semut', 93, 377, 'Makkiyah', 28),
(28, ' القصص', 'Al-Qaṣaṣ', 'Al-Qasas', 'Kisah-Kisah', 88, 385, 'Makkiyah', 29),
(29, ' العنكبوت', 'Al-‘Ankabūt', 'Al-‘Ankabut', 'Laba-Laba', 69, 396, 'Makkiyah', 30),
(30, ' الرّوم', 'Ar-Rūm', 'Ar-Rum', 'Romawi', 60, 404, 'Makkiyah', 31),
(31, ' لقمٰن', 'Luqmān', 'Luqman', 'Luqman', 34, 411, 'Makkiyah', 32),
(32, ' السّجدة', 'As-Sajdah', 'As-Sajdah', 'Sajdah', 30, 415, 'Makkiyah', 33),
(33, ' الاحزاب', 'Al-Aḥzāb', 'Al-Ahzab', 'Golongan Yang Bersekutu', 73, 418, 'Madaniyah', 34),
(34, ' سبأ', 'Saba\'', 'Saba\'', 'Saba\'', 54, 428, 'Makkiyah', 35),
(35, ' فاطر', 'Fāṭir', 'Fatir', 'Pencipta', 45, 434, 'Makkiyah', 36),
(36, ' يٰسۤ', 'Yāsīn', 'Yasin', 'Yasin', 83, 440, 'Makkiyah', 37),
(37, ' الصّٰۤفّٰت', 'Aṣ-Ṣāffāt', 'As-Saffat', 'Barisan-Barisan', 182, 446, 'Makkiyah', 38),
(38, 'صۤ', 'Ṣād', 'Sad', 'Ṣād', 88, 453, 'Makkiyah', 39),
(39, 'الزّمر', 'Az-Zumar', 'Az-Zumar', 'Rombongan', 75, 458, 'Makkiyah', 40),
(40, ' غافر', 'Gāfir', 'Gafir', 'Maha Pengampun', 85, 467, 'Makkiyah', 41),
(41, ' فصّلت', 'Fuṣṣilat', 'Fussilat', 'Dijelaskan', 54, 477, 'Makkiyah', 42),
(42, 'الشّورٰى', 'Asy-Syūrā', 'Asy-Syura', 'Musyawarah', 53, 483, 'Makkiyah', 43),
(43, 'الزّخرف', 'Az-Zukhruf', 'Az-Zukhruf', 'Perhiasan dari Emas', 89, 489, 'Makkiyah', 44),
(44, 'الدّخان', 'Ad-Dukhān', 'Ad-Dukhan', 'Kabut Asap', 59, 496, 'Makkiyah', 45),
(45, ' الجاثية', 'Al-Jāṡiyah', 'Al-Jasiyah', 'Berlutut', 37, 499, 'Makkiyah', 46),
(46, ' الاحقاف', 'Al-Aḥqāf', 'Al-Ahqaf', 'Ahqaf', 35, 502, 'Makkiyah', 47),
(47, ' محمّد', 'Muḥammad', 'Muhammad', 'Nabi Muhammad', 38, 507, 'Madaniyah', 48),
(48, ' الفتح', 'Al-Fatḥ', 'Al-Fath', 'Kemenangan', 29, 511, 'Madaniyah', 49),
(49, ' الحجرٰت', 'Al-Ḥujurāt', 'Al-Hujurat', 'Kamar-Kamar', 18, 515, 'Madaniyah', 50),
(50, 'قۤ', 'Qāf', 'Qaf', 'Qaf', 45, 518, 'Makkiyah', 51),
(51, ' الذّٰريٰت', 'Aż-Żāriyāt', 'Az-Zariyat', 'Yang Menerbangkan', 60, 520, 'Makkiyah', 52),
(52, 'الطّور', 'Aṭ-Ṭūr', 'At-Tur', 'Gunung', 49, 523, 'Makkiyah', 53),
(53, 'النّجم', 'An-Najm', 'An-Najm', 'Bintang', 62, 526, 'Makkiyah', 54),
(54, ' القمر', 'Al-Qamar', 'Al-Qamar', 'Bulan', 55, 528, 'Makkiyah', 55),
(55, 'الرّحمٰن', 'Ar-Raḥmān', 'Ar-Rahman', 'Yang Maha Pengasih', 78, 531, 'Makkiyah', 56),
(56, ' الواقعة', 'Al-Wāqi‘ah', 'Al-Waqi‘ah', 'Hari Kiamat Yang Pasti Terjadi', 96, 534, 'Makkiyah', 57),
(57, ' الحديد', 'Al-Ḥadīd', 'Al-Hadid', 'Besi', 29, 537, 'Madaniyah', 58),
(58, ' المجادلة', 'Al-Mujādalah', 'Al-Mujadalah', 'Gugatan', 22, 542, 'Madaniyah', 59),
(59, ' الحشر', 'Al-Ḥasyr', 'Al-Hasyr', 'Pengusiran', 24, 545, 'Madaniyah', 60),
(60, ' الممتحنة', 'Al-Mumtaḥanah', 'Al-Mumtahanah', 'Wanita Yang Diuji', 13, 549, 'Madaniyah', 61),
(61, ' الصّفّ', 'Aṣ-Ṣaff', 'As-Saff', 'Barisan', 14, 551, 'Madaniyah', 62),
(62, ' الجمعة', 'Al-Jumu‘ah', 'Al-Jumu‘ah', 'Jumat', 11, 553, 'Madaniyah', 63),
(63, ' المنٰفقون', 'Al-Munāfiqūn', 'Al-Munafiqun', 'Orang-Orang Munafik', 11, 554, 'Madaniyah', 64),
(64, 'التّغابن', 'At-Tagābun', 'At-Tagabun', 'Pengungkapan Kesalahan', 18, 556, 'Madaniyah', 65),
(65, 'الطّلاق', 'Aṭ-Ṭalāq', 'At-Talaq', 'Talak', 12, 558, 'Madaniyah', 66),
(66, 'التّحريم', 'At-taḥrīm', 'At-tahrim', 'Pengharaman', 12, 560, 'Madaniyah', 67),
(67, 'المُلك', 'Al-Mulk', 'Al-Mulk', 'Kerajaan', 30, 562, 'Makkiyah', 68),
(68, ' القلم', 'Al-Qalam', 'Al-Qalam', 'Pena', 52, 564, 'Makkiyah', 69),
(69, ' الحاۤقّة', 'Al-Ḥāqqah', 'Al-Haqqah', 'Hari Kiamat Yang Pasti Terjadi', 52, 566, 'Makkiyah', 70),
(70, ' المعارج', 'Al-Ma‘ārij', 'Al-Ma‘arij', 'Tempat-Tempat Naik', 44, 568, 'Makkiyah', 71),
(71, ' نوح', 'Nūḥ', 'Nuh', 'Nuh', 28, 570, 'Makkiyah', 72),
(72, 'الجنّ', 'Al-Jinn', 'Al-Jinn', 'Jin', 28, 572, 'Makkiyah', 73),
(73, ' المزّمّل', 'Al-Muzzammil', 'Al-Muzzammil', 'Orang Berkelumun', 20, 574, 'Makkiyah', 74),
(74, ' المدّثّر', 'Al-Muddaṡṡir', 'Al-Muddassir', 'Orang Berselimut', 56, 575, 'Makkiyah', 75),
(75, ' القيٰمة', 'Al-Qiyāmah', 'Al-Qiyamah', 'Hari Kiamat', 40, 577, 'Makkiyah', 76),
(76, ' الانسان', 'Al-Insān', 'Al-Insan', 'Manusia', 31, 578, 'Madaniyah', 77),
(77, ' المرسلٰت', 'Al-Mursalāt', 'Al-Mursalat', 'Malaikat Yang Diutus', 50, 580, 'Makkiyah', 78),
(78, 'النّبأ', 'An-Naba\'', 'An-Naba\'', 'Berita', 40, 582, 'Makkiyah', 79),
(79, ' النّٰزعٰت', 'An-Nāzi‘āt', 'An-Nazi‘at', 'Yang Mencabut Dengan Keras', 46, 583, 'Makkiyah', 80),
(80, ' عبس', '‘Abasa', '‘Abasa', 'Berwajah Masam', 42, 585, 'Makkiyah', 81),
(81, 'التّكوير', 'At-Takwīr', 'At-Takwir', 'Penggulungan', 29, 586, 'Makkiyah', 82),
(82, ' الانفطار', 'Al-Infiṭār', 'Al-Infitar', 'Terbelah', 19, 587, 'Makkiyah', 83),
(83, ' المطفّفين', 'Al-Muṭaffifīn', 'Al-Mutaffifin', 'Orang-Orang Yang Curang', 36, 587, 'Makkiyah', 84),
(84, ' الانشقاق', 'Al-Insyiqāq', 'Al-Insyiqaq', 'Terbelah', 25, 589, 'Makkiyah', 85),
(85, ' البروج', 'Al-Burūj', 'Al-Buruj', 'Gugusan Bintang', 22, 590, 'Makkiyah', 86),
(86, 'الطّارق', 'Aṭ-Ṭāriq', 'At-Tariq', 'Yang Datang Pada Malam Hari', 17, 591, 'Makkiyah', 87),
(87, ' الاعلى', 'Al-A‘lā', 'Al-A‘la', 'Yang Maha Tinggi', 19, 591, 'Makkiyah', 88),
(88, ' الغاشية', 'Al-Gāsyiyah', 'Al-Gasyiyah', 'Hari Kiamat Yang Menghilangkan Kesadaran', 26, 592, 'Makkiyah', 89),
(89, ' الفجر', 'Al-Fajr', 'Al-Fajr', 'Fajar', 30, 593, 'Makkiyah', 90),
(90, ' البلد', 'Al-Balad', 'Al-Balad', 'Negeri', 20, 594, 'Makkiyah', 91),
(91, 'الشّمس', 'Asy-Syams', 'Asy-Syams', 'Matahari', 15, 595, 'Makkiyah', 92),
(92, ' الّيل', 'Al-Lail', 'Al-Lail', 'Malam', 21, 595, 'Makkiyah', 93),
(93, 'الضّحى', 'Aḍ-Ḍuḥā', 'Ad-Duha', 'Duha', 11, 596, 'Makkiyah', 94),
(94, 'الشّرح', 'Asy-Syarḥ', 'Asy-Syarh', 'Pelapangan', 8, 596, 'Makkiyah', 95),
(95, 'التّين', 'At-Tīn', 'At-Tin', 'Buah Tin', 8, 597, 'Makkiyah', 96),
(96, ' العلق', 'Al-‘Alaq', 'Al-‘Alaq', 'Segumpal Darah', 19, 597, 'Makkiyah', 97),
(97, ' القدر', 'Al-Qadr', 'Al-Qadr', 'Al-Qadar', 5, 598, 'Makkiyah', 98),
(98, ' البيّنة', 'Al-Bayyinah', 'Al-Bayyinah', 'Bukti Nyata', 8, 598, 'Madaniyah', 99),
(99, 'الزّلزلة', 'Az-Zalzalah', 'Az-Zalzalah', 'Guncangan', 8, 599, 'Madaniyah', 100),
(100, ' العٰديٰت', 'Al-‘Ādiyāt', 'Al-‘Adiyat', 'Kuda Perang Yang Berlari Kencang', 11, 599, 'Makkiyah', 101),
(101, ' القارعة', 'Al-Qāri‘ah', 'Al-Qari‘ah', 'Al-Qāri‘ah', 11, 600, 'Makkiyah', 102),
(102, 'التّكاثر', 'At-Takāṡur', 'At-Takasur', 'Berbangga-Bangga Dalam Memperbanyak Dunia', 8, 600, 'Makkiyah', 103),
(103, ' العصر', 'Al-‘Aṣr', 'Al-‘Asr', 'Masa', 3, 601, 'Makkiyah', 104),
(104, ' الهمزة', 'Al-Humazah', 'Al-Humazah', 'Pengumpat', 9, 601, 'Makkiyah', 105),
(105, ' الفيل', 'Al-Fīl', 'Al-Fil', 'Gajah', 5, 601, 'Makkiyah', 106),
(106, ' قريش', 'Quraisy', 'Quraisy', 'Orang Quraisy', 4, 602, 'Makkiyah', 107),
(107, ' الماعون', 'Al-Mā‘ūn', 'Al-Ma‘un', 'Bantuan', 7, 602, 'Makkiyah', 108),
(108, ' الكوثر', 'Al-Kauṡar', 'Al-Kausar', 'Nikmat Yang Banyak', 3, 602, 'Makkiyah', 109),
(109, ' الكٰفرون', 'Al-Kāfirūn', 'Al-Kafirun', 'Orang-Orang kafir', 6, 603, 'Makkiyah', 110),
(110, 'النّصر', 'An-Naṣr', 'An-Nasr', 'Pertolongan', 3, 603, 'Madaniyah', 111),
(111, 'اللّهب', 'Al-Lahab', 'Al-Lahab', 'Gejolak Api', 5, 603, 'Makkiyah', 112),
(112, ' الاخلاص', 'Al-Ikhlāṣ', 'Al-Ikhlas', 'Ikhlas', 4, 604, 'Makkiyah', 113),
(113, ' الفلق', 'Al-Falaq', 'Al-Falaq', 'Fajar', 5, 604, 'Madaniyah', 114),
(114, 'النّاس', 'An-Nās', 'An-Nas', 'Manusia', 6, 604, 'Madaniyah', 115);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_surah`
--
ALTER TABLE `tbl_surah`
  ADD PRIMARY KEY (`idinc_surah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_surah`
--
ALTER TABLE `tbl_surah`
  MODIFY `idinc_surah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
