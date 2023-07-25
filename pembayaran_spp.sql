-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2023 at 01:22 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaran_spp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPengguna` (`in_username` VARCHAR(25), `in_password` VARCHAR(128), `in_role` VARCHAR(7))   BEGIN
INSERT INTO `pengguna`(`username`, `password`, `role`) VALUES(in_username, in_password, in_role);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPetugas` (`in_nama` VARCHAR(50), `in_pengguna_id` INT)   BEGIN
        INSERT INTO petugas(nama, pengguna_id) VALUES(in_nama, in_pengguna_id);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertSiswa` (IN `in_nis` VARCHAR(10), IN `in_nisn` VARCHAR(15), IN `in_nama` VARCHAR(50), IN `in_alamat` TEXT, IN `in_telepon` VARCHAR(14), IN `in_kelas_id` INT, IN `in_pengguna_id` INT, IN `in_pembayaran_id` INT)   BEGIN
INSERT INTO siswa (nis, nisn, nama, alamat, telepon, kelas_id, pengguna_id, pembayaran_id) VALUES(in_nis, in_nisn, in_nama, in_alamat, in_telepon, in_kelas_id, in_pengguna_id, in_pembayaran_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTransaksi` (`in_tanggal_dibayar` DATETIME, `in_bulan_dibayar` INT(2), `in_tahun_dibayar` YEAR, `in_siswa_id` INT, `in_petugas_id` INT, `in_pembayaran_id` INT)   BEGIN
INSERT INTO `transaksi` (`id`, `tanggal_dibayar`, `bulan_dibayar`, `tahun_dibayar`, `siswa_id`, `petugas_id`, `pembayaran_id`) VALUES (NULL, in_tanggal_dibayar, in_bulan_dibayar, in_tahun_dibayar, in_siswa_id, in_petugas_id, in_pembayaran_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateSiswa` (`in_id` INT, `in_pengguna_id` INT, `in_nis` VARCHAR(5), `in_nisn` VARCHAR(10), `in_nama` VARCHAR(50), `in_alamat` TEXT, `in_telepon` VARCHAR(14), `in_kelas_id` INT, `in_pembayaran_id` INT)   BEGIN
		UPDATE siswa SET nis = in_nis, nisn = in_nisn, nama = in_nama, alamat = in_alamat, telepon = in_telepon, kelas_id = in_kelas_id, pembayaran_id = in_pembayaran_id WHERE id = in_id;
        UPDATE pengguna SET username = in_nis, password = in_nisn WHERE id = in_pengguna_id;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `history`
-- (See below for the actual view)
--
CREATE TABLE `history` (
`id` int(11)
,`tanggal_dibayar` datetime
,`bulan_dibayar` int(2)
,`tahun_dibayar` year(4)
,`siswa_id` int(11)
,`petugas_id` int(11)
,`pembayaran_id` int(11)
,`nama` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` enum('admin','petugas','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$kAZ3sP/QSHhTOJstOfsJ8OozQygi2tE7mBsctJrljxuFPu4jHkCwq', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna_petugas`
-- (See below for the actual view)
--
CREATE TABLE `pengguna_petugas` (
`id` int(11)
,`nama` varchar(50)
,`pengguna_id` int(11)
,`username` varchar(25)
,`password` varchar(128)
,`role` enum('admin','petugas','siswa')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna_siswa`
-- (See below for the actual view)
--
CREATE TABLE `pengguna_siswa` (
`id` int(11)
,`nisn` varchar(10)
,`nis` varchar(5)
,`nama` varchar(50)
,`alamat` text
,`telepon` varchar(14)
,`kelas_id` int(11)
,`pengguna_id` int(11)
,`pembayaran_id` int(11)
,`kelas` varchar(10)
,`kompetensi_keahlian` varchar(50)
,`username` varchar(25)
,`password` varchar(128)
,`role` enum('admin','petugas','siswa')
,`tahun_ajaran` varchar(9)
,`nominal` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `pengguna_id`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nis` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `pengguna_id` int(11) DEFAULT NULL,
  `pembayaran_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal_dibayar` datetime NOT NULL,
  `bulan_dibayar` int(2) NOT NULL,
  `tahun_dibayar` year(4) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_view`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_view` (
`id` int(11)
,`tanggal_dibayar` datetime
,`bulan_dibayar` int(2)
,`tahun_dibayar` year(4)
,`siswa_id` int(11)
,`petugas_id` int(11)
,`pembayaran_id` int(11)
,`nama_siswa` varchar(50)
,`nama_petugas` varchar(50)
,`tahun_ajaran` varchar(9)
,`nominal` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `history`
--
DROP TABLE IF EXISTS `history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history`  AS SELECT `transaksi`.`id` AS `id`, `transaksi`.`tanggal_dibayar` AS `tanggal_dibayar`, `transaksi`.`bulan_dibayar` AS `bulan_dibayar`, `transaksi`.`tahun_dibayar` AS `tahun_dibayar`, `transaksi`.`siswa_id` AS `siswa_id`, `transaksi`.`petugas_id` AS `petugas_id`, `transaksi`.`pembayaran_id` AS `pembayaran_id`, `siswa`.`nama` AS `nama` FROM (`transaksi` join `siswa` on((`transaksi`.`siswa_id` = `siswa`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `pengguna_petugas`
--
DROP TABLE IF EXISTS `pengguna_petugas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna_petugas`  AS SELECT `petugas`.`id` AS `id`, `petugas`.`nama` AS `nama`, `petugas`.`pengguna_id` AS `pengguna_id`, `pengguna`.`username` AS `username`, `pengguna`.`password` AS `password`, `pengguna`.`role` AS `role` FROM (`petugas` join `pengguna` on((`petugas`.`pengguna_id` = `pengguna`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `pengguna_siswa`
--
DROP TABLE IF EXISTS `pengguna_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna_siswa`  AS SELECT `siswa`.`id` AS `id`, `siswa`.`nisn` AS `nisn`, `siswa`.`nis` AS `nis`, `siswa`.`nama` AS `nama`, `siswa`.`alamat` AS `alamat`, `siswa`.`telepon` AS `telepon`, `siswa`.`kelas_id` AS `kelas_id`, `siswa`.`pengguna_id` AS `pengguna_id`, `siswa`.`pembayaran_id` AS `pembayaran_id`, `kelas`.`nama` AS `kelas`, `kelas`.`kompetensi_keahlian` AS `kompetensi_keahlian`, `pengguna`.`username` AS `username`, `pengguna`.`password` AS `password`, `pengguna`.`role` AS `role`, `pembayaran`.`tahun_ajaran` AS `tahun_ajaran`, `pembayaran`.`nominal` AS `nominal` FROM (((`siswa` join `kelas` on((`siswa`.`kelas_id` = `kelas`.`id`))) join `pengguna` on((`siswa`.`pengguna_id` = `pengguna`.`id`))) join `pembayaran` on((`siswa`.`pembayaran_id` = `pembayaran`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi_view`
--
DROP TABLE IF EXISTS `transaksi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_view`  AS SELECT `transaksi`.`id` AS `id`, `transaksi`.`tanggal_dibayar` AS `tanggal_dibayar`, `transaksi`.`bulan_dibayar` AS `bulan_dibayar`, `transaksi`.`tahun_dibayar` AS `tahun_dibayar`, `transaksi`.`siswa_id` AS `siswa_id`, `transaksi`.`petugas_id` AS `petugas_id`, `transaksi`.`pembayaran_id` AS `pembayaran_id`, `siswa`.`nama` AS `nama_siswa`, `petugas`.`nama` AS `nama_petugas`, `pembayaran`.`tahun_ajaran` AS `tahun_ajaran`, `pembayaran`.`nominal` AS `nominal` FROM (((`transaksi` join `siswa` on((`transaksi`.`siswa_id` = `siswa`.`id`))) join `petugas` on((`transaksi`.`petugas_id` = `petugas`.`id`))) join `pembayaran` on((`transaksi`.`pembayaran_id` = `pembayaran`.`id`))) ORDER BY `transaksi`.`id` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_petugas_pengguna_id` (`pengguna_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `fk_siswa_pengguna_id` (`pengguna_id`),
  ADD KEY `fk_siswa_pembayaran_id` (`pembayaran_id`),
  ADD KEY `fk_siswa_kelas_id` (`kelas_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_siswa_id` (`siswa_id`),
  ADD KEY `fk_transaksi_petugas_id` (`petugas_id`),
  ADD KEY `fk_transaksi_pembayaran_id` (`pembayaran_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `fk_petugas_pengguna_id` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_kelas_id` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_siswa_pembayaran_id` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_siswa_pengguna_id` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pembayaran_id` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_petugas_id` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_siswa_id` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
