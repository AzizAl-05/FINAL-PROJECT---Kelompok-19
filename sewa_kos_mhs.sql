-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 01:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa_kos_mhs`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `detail_kamar_kos` (IN `p_no_kamar` INT)   BEGIN

    select
	k.no_kamar,
	t.Tipe,
	t.harga,
	group_concat(
	f.nama_fasilitas
	SEPARATOR ', '
    ) AS fasilitas,
	case
		when k.status = 0 then 'tersedia'
		else 'ditempati'
		end as status
	from kamar k

join tipe_kamar t
on k.tipe = t.id_tipe

join fasilitas_kamar fk
on k.id_kamar = fk.kamar_id_kamar

join fasilitas f
on f.id_fasilitas = fk.fasilitas_id_fasilitas

where k.no_kamar = p_no_kamar

GROUP BY 
    k.no_kamar,
    t.Tipe,
    t.harga,
    k.status;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_kamar_kosong` ()   BEGIN
	select
		k.no_kamar,
		t.Tipe,
		case
		when k.status = 0 then 'tersedia'
		end as status_kamar
    from kamar k
    
    join tipe_kamar t
    on k.tipe = t.id_tipe
    where k.status = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_transaksi` (IN `p_tanggal` DATE, IN `p_penghuni` INT, IN `p_kamar` INT, IN `p_periode` VARCHAR(50))   BEGIN
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Gagal Tambah Transaksi: Data Penghuni atau Kamar tidak valid!';
    END;

    INSERT INTO transaksi_sewa(
        tanggal_transaksi,
        penghuni_id_penghuni,
        kamar_id_kamar,
        periode_sewa,
        jumlah_bayar
    )
    VALUES(
        p_tanggal,
        p_penghuni,
        p_kamar,
        p_periode,
        0
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1782290734),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1782290734;', 1782290734),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', 1782287174),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1782287174;', 1782287174),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:89:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"ViewAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"View:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Create:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Update:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"Delete:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"DeleteAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"Restore:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"ForceDelete:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:19:\"ForceDeleteAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"RestoreAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:14:\"Replicate:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"Reorder:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:17:\"ViewAny:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"View:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"Create:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:16:\"Update:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"Delete:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:19:\"DeleteAny:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:17:\"Restore:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:21:\"ForceDelete:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:24:\"ForceDeleteAny:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:20:\"RestoreAny:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:19:\"Replicate:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:17:\"Reorder:Fasilitas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:13:\"ViewAny:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:10:\"View:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"Create:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"Update:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"Delete:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:15:\"DeleteAny:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"Restore:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:17:\"ForceDelete:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:20:\"ForceDeleteAny:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"RestoreAny:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:15:\"Replicate:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:13:\"Reorder:Kamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:16:\"ViewAny:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:13:\"View:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:15:\"Create:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:15:\"Update:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:15:\"Delete:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:18:\"DeleteAny:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:16:\"Restore:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:20:\"ForceDelete:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:23:\"ForceDeleteAny:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:19:\"RestoreAny:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:18:\"Replicate:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:16:\"Reorder:Penghuni\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:17:\"ViewAny:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:14:\"View:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:16:\"Create:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:16:\"Update:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:16:\"Delete:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:19:\"DeleteAny:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:17:\"Restore:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:21:\"ForceDelete:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:24:\"ForceDeleteAny:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:20:\"RestoreAny:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:19:\"Replicate:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:17:\"Reorder:TipeKamar\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:21:\"ViewAny:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:18:\"View:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:20:\"Create:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:20:\"Update:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:20:\"Delete:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:23:\"DeleteAny:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:21:\"Restore:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:25:\"ForceDelete:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:28:\"ForceDeleteAny:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:24:\"RestoreAny:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:23:\"Replicate:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:21:\"Reorder:TransaksiSewa\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:12:\"ViewAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:9:\"View:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:11:\"Create:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:11:\"Update:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:11:\"Delete:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:14:\"DeleteAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:12:\"Restore:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:16:\"ForceDelete:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:19:\"ForceDeleteAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:15:\"RestoreAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:14:\"Replicate:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:12:\"Reorder:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:14:\"View:Dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:33:\"View:DashboardDonutOkupansiWidget\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:32:\"View:DashboardRevenueChartWidget\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:29:\"View:DashboardStatCardsWidget\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:36:\"View:DashboardTransaksiTerbaruWidget\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"petugas\";s:1:\"c\";s:3:\"web\";}}}', 1782314069);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(65) NOT NULL,
  `icon` varchar(255) DEFAULT 'check'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`, `icon`) VALUES
(1, 'AC', 'ac_unit'),
(2, 'wifi', 'Wifi'),
(3, 'kamar mandi', 'Bathroom'),
(4, 'kipas angin', 'wind_power'),
(5, 'dispenser', 'touch_app'),
(6, 'TV', 'Tv'),
(7, 'kasur', 'Bed'),
(8, 'lemari', 'Dresser'),
(9, 'meja belajar', 'Table'),
(10, 'kursi', 'Chair'),
(11, 'dapur bersama', 'chef_hat'),
(12, 'free cleaning room', 'cleaning_services'),
(13, 'rak buku', 'library_books'),
(16, 'dapur pribadi', 'chef_hat');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `kamar_id_kamar` int(11) NOT NULL,
  `fasilitas_id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`kamar_id_kamar`, `fasilitas_id_fasilitas`) VALUES
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(14, 6),
(15, 6),
(16, 6),
(17, 6),
(18, 6),
(19, 6),
(20, 6),
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(5, 7),
(6, 7),
(7, 7),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 7),
(13, 7),
(14, 7),
(15, 7),
(16, 7),
(17, 7),
(18, 7),
(19, 7),
(20, 7),
(21, 7),
(22, 7),
(23, 7),
(24, 7),
(25, 7),
(7, 8),
(8, 8),
(9, 8),
(10, 8),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 8),
(16, 8),
(17, 8),
(18, 8),
(19, 8),
(20, 8),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(9, 9),
(10, 9),
(11, 9),
(12, 9),
(13, 9),
(21, 9),
(22, 9),
(23, 9),
(24, 9),
(25, 9),
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(5, 10),
(6, 10),
(7, 10),
(8, 10),
(9, 10),
(10, 10),
(11, 10),
(12, 10),
(13, 10),
(21, 10),
(22, 10),
(23, 10),
(24, 10),
(25, 10),
(14, 12),
(15, 12),
(16, 12),
(17, 12),
(18, 12),
(19, 12),
(20, 12),
(14, 13),
(15, 13),
(16, 13),
(17, 13),
(18, 13),
(19, 13),
(20, 13),
(14, 16),
(15, 16),
(16, 16),
(17, 16),
(18, 16),
(19, 16),
(20, 16),
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `tipe` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `tipe`, `foto`, `status`) VALUES
(1, 101, 3, NULL, 0),
(2, 102, 3, NULL, 0),
(3, 103, 3, NULL, 0),
(4, 104, 3, NULL, 0),
(5, 105, 3, NULL, 0),
(6, 106, 3, NULL, 0),
(7, 201, 2, NULL, 0),
(8, 202, 2, NULL, 0),
(9, 203, 2, NULL, 0),
(10, 204, 2, NULL, 0),
(11, 205, 2, NULL, 0),
(12, 206, 2, NULL, 1),
(13, 207, 2, NULL, 0),
(14, 301, 1, 'kamar/01KVWCH8ENSZ621B55RPQK32YA.jpg', 0),
(15, 302, 1, 'kamar/01KVWCM83DTY74C2C2VHJE91W2.jpg', 0),
(16, 303, 1, 'kamar/01KVWCNNMP34A6FT7VVAFQE0PP.jpg', 0),
(17, 304, 1, 'kamar/01KVWCPQQBC3ZH60PZ22TH33YT.jpg', 0),
(18, 305, 1, 'kamar/01KVWCRM00RVQC1QXNM7PN2WGP.jpg', 0),
(19, 306, 1, 'kamar/01KVWCSHP9RDMX2P6AGGDNT284.jpg', 0),
(20, 307, 1, 'kamar/01KVWCV12XMSY6EBB1PT43X499.jpg', 1),
(21, 107, 3, NULL, 0),
(22, 108, 3, NULL, 0),
(23, 109, 3, NULL, 0),
(24, 110, 3, NULL, 0),
(25, 111, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_19_155538_add_new_columns_to_tables', 2),
(5, '2026_06_20_100734_add_icon_to_fasilitas_table', 3),
(6, '2026_06_23_070739_create_permission_tables', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penghuni`
--

CREATE TABLE `penghuni` (
  `id_penghuni` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jurusan` varchar(45) DEFAULT NULL,
  `kampus` varchar(64) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penghuni`
--

INSERT INTO `penghuni` (`id_penghuni`, `nama`, `no_telp`, `email`, `jurusan`, `kampus`, `password`, `foto_profil`, `remember_token`, `created_at`, `updated_at`) VALUES
(31, 'Aziz ITP', '089511111111', 'azizalpalembani@gmail.com', 'Perhutanan', 'Institut Teknologi Palembang', '$2y$12$DA9pZ1clDtamSr3.VUfID.GusW4G7abi/AYb/Zidhm7twCm7TlDKG', 'foto_profil/t1AhP3WsUvJHgWDhtj6bCelp5cyVi7RiQZPqFoqb.jpg', 'EFuVrUoernFqhJQ8l8EQh1z3fWERzt9npkgoNXWcRS3vdSeIPYfF1zAivNfu', '2026-06-23 07:41:20', '2026-06-23 23:52:19'),
(35, 'Wahyu TS', '12345678', 'wahyu@gmail.com', 'Rekayasa Sistem Negara', 'STT-NF', '$2y$12$F6JfD.fr8lo9yBp95fHlYuwHjLYIlwr6EoQgclXQWtpVwMKc0cUAC', 'foto_profil/emC3acOh2BKIOvj0tJIju5t3MAbm63w9St4doxgB.jpg', 'rZceXmSSG5mbKjiosMV1G9K8LER1axNTvpF5wUjJksihdJjNOAR9LgddkoVj', '2026-06-24 00:43:02', '2026-06-24 00:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ViewAny:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(2, 'View:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(3, 'Create:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(4, 'Update:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(5, 'Delete:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(6, 'DeleteAny:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(7, 'Restore:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(8, 'ForceDelete:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(9, 'ForceDeleteAny:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(10, 'RestoreAny:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(11, 'Replicate:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(12, 'Reorder:Role', 'web', '2026-06-23 02:54:45', '2026-06-23 02:54:45'),
(13, 'ViewAny:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(14, 'View:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(15, 'Create:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(16, 'Update:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(17, 'Delete:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(18, 'DeleteAny:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(19, 'Restore:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(20, 'ForceDelete:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(21, 'ForceDeleteAny:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(22, 'RestoreAny:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(23, 'Replicate:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(24, 'Reorder:Fasilitas', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(25, 'ViewAny:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(26, 'View:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(27, 'Create:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(28, 'Update:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(29, 'Delete:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(30, 'DeleteAny:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(31, 'Restore:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(32, 'ForceDelete:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(33, 'ForceDeleteAny:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(34, 'RestoreAny:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(35, 'Replicate:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(36, 'Reorder:Kamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(37, 'ViewAny:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(38, 'View:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(39, 'Create:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(40, 'Update:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(41, 'Delete:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(42, 'DeleteAny:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(43, 'Restore:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(44, 'ForceDelete:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(45, 'ForceDeleteAny:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(46, 'RestoreAny:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(47, 'Replicate:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(48, 'Reorder:Penghuni', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(49, 'ViewAny:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(50, 'View:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(51, 'Create:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(52, 'Update:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(53, 'Delete:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(54, 'DeleteAny:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(55, 'Restore:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(56, 'ForceDelete:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(57, 'ForceDeleteAny:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(58, 'RestoreAny:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(59, 'Replicate:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(60, 'Reorder:TipeKamar', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(61, 'ViewAny:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(62, 'View:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(63, 'Create:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(64, 'Update:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(65, 'Delete:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(66, 'DeleteAny:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(67, 'Restore:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(68, 'ForceDelete:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(69, 'ForceDeleteAny:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(70, 'RestoreAny:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(71, 'Replicate:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(72, 'Reorder:TransaksiSewa', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(73, 'ViewAny:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(74, 'View:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(75, 'Create:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(76, 'Update:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(77, 'Delete:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(78, 'DeleteAny:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(79, 'Restore:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(80, 'ForceDelete:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(81, 'ForceDeleteAny:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(82, 'RestoreAny:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(83, 'Replicate:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(84, 'Reorder:User', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(85, 'View:Dashboard', 'web', '2026-06-23 02:56:46', '2026-06-23 02:56:46'),
(86, 'View:DashboardDonutOkupansiWidget', 'web', '2026-06-23 02:56:47', '2026-06-23 02:56:47'),
(87, 'View:DashboardRevenueChartWidget', 'web', '2026-06-23 02:56:47', '2026-06-23 02:56:47'),
(88, 'View:DashboardStatCardsWidget', 'web', '2026-06-23 02:56:47', '2026-06-23 02:56:47'),
(89, 'View:DashboardTransaksiTerbaruWidget', 'web', '2026-06-23 02:56:47', '2026-06-23 02:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2026-06-23 00:33:36', '2026-06-23 00:33:36'),
(2, 'petugas', 'web', '2026-06-23 00:33:36', '2026-06-23 00:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(24, 1),
(25, 1),
(25, 2),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(45, 2),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(55, 2),
(56, 1),
(57, 1),
(57, 2),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(66, 1),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1),
(72, 2),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(85, 2),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(89, 1),
(89, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Q7FS7nHcflfXerPQW918XeZY3fciof1RrkrZpdFG', 35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiRmxSU2paZWxJeXFZR2dWSUdreU1FNlRIUHpwUE4zb2RaNktyalJIMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWwiO3M6NToicm91dGUiO3M6NjoicHJvZmlsIjt9czo1NToibG9naW5fcGVuZ2h1bmlfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozNTtzOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiOGZkNTJhMzFlOTA5MjM2NzNiMjhkODg2MGU1MGE4ZWM3YzZkODUyYmNjMTQ3MTMyMGFjZmZmYzg0YjlkNTMyNCI7czo4OiJmaWxhbWVudCI7YTowOnt9czo2OiJ0YWJsZXMiO2E6Njp7czo0MDoiMGVhNmE3NzFkMjA1MDQxNWY0MzI3MzkwMGEwNjJjODJfY29sdW1ucyI7YTo2OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTI6ImlkX3RyYW5zYWtzaSI7czo1OiJsYWJlbCI7czoxMjoiSWQgdHJhbnNha3NpIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMzoicGVuZ2h1bmkubmFtYSI7czo1OiJsYWJlbCI7czo4OiJQZW5naHVuaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTQ6ImthbWFyLm5vX2thbWFyIjtzOjU6ImxhYmVsIjtzOjU6IkthbWFyIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMzoidGFuZ2dhbF9tdWxhaSI7czo1OiJsYWJlbCI7czoxMzoiVGFuZ2dhbCBtdWxhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTI6Imp1bWxhaF9iYXlhciI7czo1OiJsYWJlbCI7czoxMjoiSnVtbGFoIGJheWFyIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJzdGF0dXMiO3M6NToibGFiZWwiO3M6NjoiU3RhdHVzIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiI3OTBkNmIxMGJjZjRmMjA4YjJhOWQ4ZGNiYzNjZWJjY19jb2x1bW5zIjthOjU6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo4OiJub19rYW1hciI7czo1OiJsYWJlbCI7czoxMToiTm9tb3IgS2FtYXIiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjE0OiJ0aXBlS2FtYXIuVGlwZSI7czo1OiJsYWJlbCI7czoxMDoiVGlwZSBLYW1hciI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjQ6ImZhc2lsaXRhcy5uYW1hX2Zhc2lsaXRhcyI7czo1OiJsYWJlbCI7czo5OiJGYXNpbGl0YXMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czo2OiJTdGF0dXMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjQ6ImZvdG8iO3M6NToibGFiZWwiO3M6NDoiRm90byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319czo0MDoiODY4MTg0NTc0MTVkMzU1MTBhMzkxMjc1ZDFhZmFlODVfY29sdW1ucyI7YTo1OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTc6InRhbmdnYWxfdHJhbnNha3NpIjtzOjU6ImxhYmVsIjtzOjc6IlRhbmdnYWwiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEzOiJwZW5naHVuaS5uYW1hIjtzOjU6ImxhYmVsIjtzOjg6IlBlbmdodW5pIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNDoia2FtYXIubm9fa2FtYXIiO3M6NToibGFiZWwiO3M6NToiS2FtYXIiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEyOiJqdW1sYWhfYmF5YXIiO3M6NToibGFiZWwiO3M6MTI6Ikp1bWxhaCBCYXlhciI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Njoic3RhdHVzIjtzOjU6ImxhYmVsIjtzOjY6IlN0YXR1cyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319czo0MDoiOGE0NmVlMmZlZmMzNjliNmM2MTE3NDVkYmZlMDdhYjZfY29sdW1ucyI7YToxOntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTQ6Im5hbWFfZmFzaWxpdGFzIjtzOjU6ImxhYmVsIjtzOjE0OiJOYW1hIGZhc2lsaXRhcyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319czo0MDoiNzFjOWU4MWIyMzZkNTdlMzVjYmIyMWFiMWU5YTRjNDNfY29sdW1ucyI7YTo1OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoibmFtZSI7czo1OiJsYWJlbCI7czo0OiJOYW1lIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiZ3VhcmRfbmFtZSI7czo1OiJsYWJlbCI7czoxMDoiR3VhcmQgTmFtZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6OToidGVhbS5uYW1lIjtzOjU6ImxhYmVsIjtzOjQ6IlRlYW0iO3M6ODoiaXNIaWRkZW4iO2I6MTtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjE3OiJwZXJtaXNzaW9uc19jb3VudCI7czo1OiJsYWJlbCI7czoxMToiUGVybWlzc2lvbnMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJVcGRhdGVkIEF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiJjNTk5ZDI1NmYxOWMyOTI3ODRmNmJkOTVjNGI2MDZhY19jb2x1bW5zIjthOjc6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMToiaWRfcGVuZ2h1bmkiO3M6NToibGFiZWwiO3M6MjoiSUQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjExOiJmb3RvX3Byb2ZpbCI7czo1OiJsYWJlbCI7czo0OiJGb3RvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJuYW1hIjtzOjU6ImxhYmVsIjtzOjQ6Ik5hbWEiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjc6Im5vX3RlbHAiO3M6NToibGFiZWwiO3M6NzoiTm8gVGVscCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToiZW1haWwiO3M6NToibGFiZWwiO3M6MTM6IkVtYWlsIGFkZHJlc3MiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjc6Imp1cnVzYW4iO3M6NToibGFiZWwiO3M6NzoiSnVydXNhbiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjY7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Njoia2FtcHVzIjtzOjU6ImxhYmVsIjtzOjY6IkthbXB1cyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319fX0=', 1782300876);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe` int(11) NOT NULL,
  `Tipe` char(1) DEFAULT NULL,
  `Harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe`, `Tipe`, `Harga`) VALUES
(1, 'A', 1500000.00),
(2, 'B', 800000.00),
(3, 'C', 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sewa`
--

CREATE TABLE `transaksi_sewa` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `penghuni_id_penghuni` int(11) NOT NULL,
  `kamar_id_kamar` int(11) NOT NULL,
  `periode_sewa` varchar(45) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `jumlah_bayar` decimal(10,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_sewa`
--

INSERT INTO `transaksi_sewa` (`id_transaksi`, `tanggal_transaksi`, `penghuni_id_penghuni`, `kamar_id_kamar`, `periode_sewa`, `tanggal_mulai`, `jumlah_bayar`, `status`) VALUES
(6, '2026-06-24', 31, 20, '12 Bulan', '2026-09-01', 18000000.00, 1),
(11, '2026-06-24', 35, 12, '3 Bulan', '2026-06-24', 2400000.00, 1);

--
-- Triggers `transaksi_sewa`
--
DELIMITER $$
CREATE TRIGGER `hitung_total_bayar` BEFORE INSERT ON `transaksi_sewa` FOR EACH ROW BEGIN

    DECLARE harga_kamar INT;
    DECLARE tipe_kamar CHAR(1);
    DECLARE lama_sewa INT;

    -- Ambil tipe kamar
    SELECT t.tipe
    INTO tipe_kamar
    FROM kamar k
    JOIN tipe_kamar t
        ON k.tipe = t.id_tipe
    WHERE k.id_kamar = NEW.kamar_id_kamar;

    -- Tentukan harga berdasarkan tipe
    IF tipe_kamar = 'A' THEN
        SET harga_kamar = 1500000;

    ELSEIF tipe_kamar = 'B' THEN
        SET harga_kamar = 800000;

    ELSE
        SET harga_kamar = 500000;
    END IF;

    -- Ambil angka dari periode sewa
    SET lama_sewa =
        CAST(SUBSTRING_INDEX(NEW.periode_sewa,' ',1) AS UNSIGNED);

    -- Hitung total bayar
    SET NEW.jumlah_bayar = harga_kamar * lama_sewa;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kamar_kosong` AFTER DELETE ON `transaksi_sewa` FOR EACH ROW BEGIN

    UPDATE kamar
    SET status = 0
    WHERE id_kamar = OLD.kamar_id_kamar;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kamar_terisi` AFTER INSERT ON `transaksi_sewa` FOR EACH ROW BEGIN

    UPDATE kamar
    SET status = 1
    WHERE id_kamar = NEW.kamar_id_kamar;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$uiqUpRj8WSV2e2QCYokbmOrKGtmjMKzod55B0PnLxWVLBN7Q4Z2aS', NULL, '2026-06-22 23:32:14', '2026-06-22 23:32:14'),
(3, 'petugas', 'petugas@gmail.com', NULL, '$2y$12$jdZNc4BBy8gcirJEzxnNV.D5gbeTtBWyN3hwgisCnPC8Xt4p1UoaS', NULL, '2026-06-22 23:32:29', '2026-06-23 00:54:53');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kamar_terisi`
-- (See below for the actual view)
--
CREATE TABLE `view_kamar_terisi` (
`id_kamar` int(11)
,`no_kamar` int(11)
,`tipe` char(1)
,`status_kamar` varchar(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kamar_tipe`
-- (See below for the actual view)
--
CREATE TABLE `view_kamar_tipe` (
`no_kamar` int(11)
,`Tipe` char(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi_sewa`
-- (See below for the actual view)
--
CREATE TABLE `view_transaksi_sewa` (
`id_transaksi` int(11)
,`tanggal_transaksi` date
,`nama` varchar(255)
,`no_kamar` int(11)
,`periode_sewa` varchar(45)
,`jumlah_bayar` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Structure for view `view_kamar_terisi`
--
DROP TABLE IF EXISTS `view_kamar_terisi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kamar_terisi`  AS SELECT `kamar`.`id_kamar` AS `id_kamar`, `kamar`.`no_kamar` AS `no_kamar`, `tipe_kamar`.`Tipe` AS `tipe`, CASE WHEN `kamar`.`status` = 1 THEN 'Terisi' END AS `status_kamar` FROM (`kamar` join `tipe_kamar` on(`tipe_kamar`.`id_tipe` = `kamar`.`tipe`)) WHERE `kamar`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_kamar_tipe`
--
DROP TABLE IF EXISTS `view_kamar_tipe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kamar_tipe`  AS SELECT `k`.`no_kamar` AS `no_kamar`, `t`.`Tipe` AS `Tipe` FROM (`kamar` `k` join `tipe_kamar` `t` on(`k`.`tipe` = `t`.`id_tipe`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi_sewa`
--
DROP TABLE IF EXISTS `view_transaksi_sewa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi_sewa`  AS SELECT `ts`.`id_transaksi` AS `id_transaksi`, `ts`.`tanggal_transaksi` AS `tanggal_transaksi`, `p`.`nama` AS `nama`, `k`.`no_kamar` AS `no_kamar`, `ts`.`periode_sewa` AS `periode_sewa`, `ts`.`jumlah_bayar` AS `jumlah_bayar` FROM ((`transaksi_sewa` `ts` join `penghuni` `p` on(`ts`.`penghuni_id_penghuni` = `p`.`id_penghuni`)) join `kamar` `k` on(`ts`.`kamar_id_kamar` = `k`.`id_kamar`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD KEY `fk_fasilitas_kamar_kamar1_idx` (`kamar_id_kamar`),
  ADD KEY `fk_fasilitas_kamar_fasilitas1_idx` (`fasilitas_id_fasilitas`),
  ADD KEY `idx_fasilitas_kamar` (`fasilitas_id_fasilitas`,`kamar_id_kamar`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id_penghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
