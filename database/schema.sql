-- Generation Time: Oct 25, 2025 at 02:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `datafrasa`(Phrase data)
--

CREATE TABLE `datafrasa` (
  `id_frasa` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `terjemahan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `datakosakata`(Vocabulary data)
--

CREATE TABLE `datakosakata` (
  `id_kosakata` int(11) NOT NULL,
  `kosakata` varchar(100) NOT NULL,
  `spelling` varchar(100) NOT NULL,
  `terjemahan` varchar(255) NOT NULL,
  `suara` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id_leaderboard` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_stage` int(11) NOT NULL,
  `skor` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `password` varchar(255) NOT NULL COMMENT 'hashed password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `jenis_soal` enum('Frasa','Kosakata') NOT NULL,
  `pertanyaan` varchar(50) NOT NULL,
  `jawaban` varchar(50) NOT NULL,
  `pengelabuan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `level` enum('mudah','sedang','sulit') NOT NULL,
  `id_stage` int(11) NOT NULL,
  `tema` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datafrasa`
--
ALTER TABLE `datafrasa`
  ADD PRIMARY KEY (`id_frasa`);

--
-- Indexes for table `datakosakata`
--
ALTER TABLE `datakosakata`
  ADD PRIMARY KEY (`id_kosakata`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id_leaderboard`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datafrasa`
--
ALTER TABLE `datafrasa`
  MODIFY `id_frasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `datakosakata`
--
ALTER TABLE `datakosakata`
  MODIFY `id_kosakata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id_leaderboard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
