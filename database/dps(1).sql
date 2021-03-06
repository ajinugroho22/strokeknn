-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2020 pada 14.39
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akurasi`
--

CREATE TABLE `akurasi` (
  `no` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  `akurasiknn` float NOT NULL,
  `akurasiF` float NOT NULL,
  `akurasiW` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `k_awal` int(11) NOT NULL,
  `k_akhir` int(11) NOT NULL,
  `eks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id`, `k_awal`, `k_akhir`, `eks`) VALUES
(1, 3, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_latih`
--

CREATE TABLE `data_latih` (
  `id` int(11) NOT NULL,
  `j_kelamin` int(11) NOT NULL,
  `umur` float NOT NULL,
  `hipertensi` int(11) NOT NULL,
  `jantung` int(11) NOT NULL,
  `nikah` int(11) NOT NULL,
  `kerja` int(11) NOT NULL,
  `tinggal` int(11) NOT NULL,
  `gula` float NOT NULL,
  `bmi` float NOT NULL,
  `merokok` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `jarak` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_latih`
--

INSERT INTO `data_latih` (`id`, `j_kelamin`, `umur`, `hipertensi`, `jantung`, `nikah`, `kerja`, `tinggal`, `gula`, `bmi`, `merokok`, `class`, `jarak`) VALUES
(16779, 1, 28, 0, 0, 1, 1, 2, 94.36, 25.1, 3, 0, 0.923338),
(16780, 0, 17, 0, 0, 0, 1, 2, 114, 22.6, 1, 0, 0.919304),
(16781, 0, 24, 0, 0, 0, 1, 1, 100.24, 20.8, 1, 0, 0.919342),
(16782, 0, 51, 0, 0, 1, 1, 1, 74.36, 33.4, 2, 0, 0.891345),
(16783, 0, 60, 0, 0, 1, 4, 1, 86.34, 22.1, 1, 0, 0.9742),
(16784, 0, 51, 0, 0, 1, 1, 1, 91.46, 39.6, 2, 0, 0.875619),
(16785, 0, 57, 0, 0, 0, 1, 1, 94.99, 20.5, 1, 0, 0.979805),
(16786, 0, 48, 0, 0, 1, 4, 2, 84.68, 29.9, 3, 0, 0.912455),
(16787, 0, 24, 0, 0, 0, 4, 1, 88.61, 20.9, 1, 0, 0.896368),
(16788, 0, 22, 0, 0, 0, 1, 1, 94.09, 21.4, 1, 0, 0.913154),
(16789, 0, 79, 0, 0, 1, 2, 1, 118.88, 20.4, 1, 0, 0.915145),
(16790, 0, 45, 0, 0, 1, 1, 1, 74.85, 27.1, 1, 0, 0.924211),
(16791, 0, 30, 0, 0, 1, 2, 2, 82.25, 35.3, 1, 0, 0.8591),
(16792, 1, 80, 0, 0, 1, 1, 1, 246.31, 31.5, 1, 0, 0.821027),
(16793, 1, 17, 0, 0, 0, 1, 2, 94.92, 23.5, 1, 0, 0.928498),
(16794, 0, 61, 1, 0, 1, 1, 2, 249.64, 37.7, 2, 0, 0.832467),
(16795, 0, 36, 0, 0, 1, 2, 1, 115.16, 40.2, 2, 0, 0.790184),
(16796, 1, 26, 0, 0, 1, 1, 2, 95.57, 30.7, 3, 0, 0.898754),
(16797, 0, 81, 0, 0, 1, 1, 2, 81.55, 32.8, 1, 0, 0.902204),
(16798, 0, 16, 0, 0, 0, 1, 1, 122.26, 34.2, 1, 0, 0.858242),
(16799, 1, 48, 0, 0, 1, 4, 2, 83.41, 28.9, 1, 0, 0.940374),
(16800, 1, 38, 0, 0, 1, 1, 2, 77.09, 31, 2, 0, 0.90782),
(16801, 0, 11, 0, 0, 0, 4, 2, 87.97, 26.5, 1, 0, 0.879532),
(16802, 1, 34, 0, 0, 1, 1, 2, 99.61, 22.7, 3, 0, 0.946016),
(16803, 1, 57, 0, 0, 1, 1, 1, 106.24, 32.3, 1, 0, 0.95867),
(16804, 0, 52, 0, 0, 1, 1, 2, 124.27, 22.2, 3, 0, 0.96282),
(16805, 0, 41, 0, 0, 1, 1, 1, 101.85, 29.6, 1, 0, 0.926919),
(16806, 0, 59, 0, 0, 1, 4, 1, 75.61, 25.9, 1, 0, 0.955177),
(16807, 0, 37, 0, 0, 1, 1, 2, 82.91, 31.2, 1, 0, 0.909348),
(16808, 0, 63, 0, 0, 1, 1, 1, 210.4, 45.4, 2, 0, 0.758904),
(16809, 0, 32, 0, 0, 0, 1, 1, 74.56, 20.9, 1, 0, 0.916712),
(16810, 0, 60, 0, 0, 1, 1, 2, 103.72, 30.4, 1, 0, 0.969392),
(16811, 1, 22, 0, 0, 0, 1, 2, 106.59, 23.3, 1, 0, 0.940524),
(16812, 1, 49, 0, 0, 1, 1, 2, 93.08, 26.4, 1, 0, 0.964187),
(16813, 1, 55, 0, 0, 1, 1, 2, 192.28, 31, 1, 0, 0.909363),
(16814, 0, 37, 0, 0, 1, 4, 2, 129.19, 37.5, 1, 0, 0.862496),
(16815, 0, 48, 0, 0, 1, 1, 2, 80.17, 25.1, 1, 0, 0.952584),
(16816, 0, 58, 0, 0, 1, 2, 1, 109.02, 32.4, 1, 0, 0.941516),
(16817, 0, 14, 0, 0, 0, 4, 1, 104.29, 32.2, 1, 0, 0.854366),
(16818, 0, 27, 0, 0, 0, 1, 2, 86.72, 27.6, 1, 0, 0.917867),
(16819, 0, 44, 0, 0, 1, 1, 1, 79.13, 23.8, 1, 0, 0.940354),
(16820, 0, 20, 0, 0, 0, 1, 1, 80.02, 29, 3, 0, 0.862265),
(16821, 0, 42, 1, 0, 1, 1, 1, 208.03, 51.1, 1, 0, 0.781848),
(16822, 1, 29, 0, 0, 1, 1, 2, 108.69, 29.6, 1, 0, 0.922721),
(16823, 0, 51, 0, 0, 0, 4, 2, 116.14, 20.9, 1, 0, 0.967134),
(16824, 1, 51, 0, 0, 1, 2, 1, 95.75, 25.9, 1, 0, 0.96141),
(16825, 1, 62, 1, 0, 1, 1, 2, 86.38, 29.3, 2, 0, 0.962283),
(16826, 1, 78, 0, 0, 1, 4, 2, 84.29, 23.9, 2, 0, 0.935074),
(16827, 1, 38, 0, 0, 0, 2, 1, 91.31, 27.5, 2, 0, 0.920339),
(16828, 0, 58, 1, 0, 1, 1, 1, 250.67, 50.9, 1, 0, 0.783002),
(16829, 0, 34, 0, 0, 1, 2, 2, 86.47, 23.2, 1, 0, 0.926192),
(16830, 0, 68, 0, 0, 1, 1, 2, 111.98, 26.8, 2, 0, 0.955294),
(16831, 0, 40, 0, 0, 1, 1, 1, 200.35, 57.6, 2, 0, 0.661994),
(16832, 0, 20, 0, 0, 0, 4, 2, 65.39, 37.2, 1, 0, 0.839691),
(16833, 1, 13, 0, 0, 0, 4, 2, 97.97, 24.5, 1, 0, 0.911218),
(16834, 0, 50, 0, 0, 1, 1, 2, 82.75, 32.6, 3, 0, 0.917922),
(16835, 0, 72, 0, 0, 1, 2, 2, 103.25, 26.9, 2, 0, 0.942149),
(16836, 1, 10, 0, 0, 0, 4, 2, 93.04, 21.7, 2, 0, 0.889725),
(16837, 1, 71, 0, 0, 1, 4, 1, 80.66, 36.9, 2, 0, 0.867903),
(16838, 0, 42, 0, 0, 1, 4, 1, 232.85, 41.7, 2, 0, 0.649462),
(16839, 1, 68, 0, 0, 1, 2, 2, 101.09, 27.6, 1, 0, 0.962337),
(16840, 0, 63, 0, 0, 1, 1, 1, 116.66, 34.6, 1, 0, 0.927907),
(16841, 0, 25, 0, 0, 0, 1, 2, 99.26, 29.2, 3, 0, 0.905244),
(16842, 1, 35, 1, 0, 1, 2, 1, 113.88, 34.6, 3, 0, 0.883996),
(16843, 0, 52, 0, 0, 1, 1, 2, 90.18, 22.1, 2, 0, 0.967906),
(16844, 0, 74, 0, 0, 1, 1, 2, 86.25, 27.9, 1, 0, 0.938366),
(16845, 1, 64, 0, 0, 1, 1, 1, 130.68, 34, 2, 0, 0.91625),
(16846, 0, 47, 0, 0, 1, 1, 1, 77.83, 36, 2, 0, 0.869828),
(16847, 1, 39, 0, 0, 1, 1, 1, 74.03, 29.2, 3, 0, 0.90021),
(16848, 0, 22, 0, 0, 0, 1, 2, 81.44, 24.9, 1, 0, 0.914861),
(16849, 1, 58, 0, 0, 1, 2, 1, 76.68, 34.7, 2, 1, 0.906189),
(16850, 0, 77, 0, 0, 1, 2, 1, 199.71, 36.2, 2, 1, 0.725605),
(16851, 0, 81, 1, 0, 1, 1, 2, 67.92, 26.2, 1, 1, 0.927834),
(16852, 0, 81, 1, 0, 1, 2, 1, 82.77, 25.1, 2, 1, 0.905739),
(16853, 0, 82, 1, 0, 1, 1, 2, 84.67, 20.7, 1, 1, 0.939901),
(16854, 1, 79, 0, 1, 1, 1, 2, 246.58, 28.5, 2, 1, 0.806722),
(16855, 0, 77, 1, 0, 1, 2, 1, 199.84, 28, 2, 1, 0.824436),
(16856, 0, 72, 0, 0, 1, 1, 2, 97.92, 26.9, 3, 1, 0.947217),
(16857, 0, 80, 0, 0, 1, 1, 1, 106.72, 27.8, 1, 1, 0.92755),
(16858, 1, 73, 0, 1, 1, 1, 1, 82.94, 33.8, 2, 1, 0.881362),
(16859, 0, 81, 1, 0, 1, 1, 1, 85.55, 25.6, 1, 1, 0.932795),
(16860, 0, 66, 1, 0, 1, 2, 2, 84.91, 44.4, 2, 1, 0.871538),
(16861, 0, 82, 0, 1, 0, 1, 1, 111.3, 22.3, 1, 1, 0.937359),
(16862, 0, 55, 1, 0, 1, 4, 1, 207.29, 31.6, 3, 1, 0.836299),
(16863, 1, 59, 0, 0, 1, 1, 2, 91.59, 31.9, 3, 1, 0.956695),
(16864, 1, 78, 1, 0, 1, 2, 2, 93.68, 22.6, 2, 1, 0.953175),
(16865, 0, 77, 0, 1, 1, 1, 2, 231.56, 36.9, 1, 1, 0.786605),
(16866, 1, 82, 0, 0, 1, 1, 1, 85.19, 26.7, 1, 1, 0.926322),
(16867, 0, 80, 0, 0, 1, 1, 1, 79.86, 26.6, 2, 1, 0.897456),
(16868, 0, 65, 0, 0, 1, 1, 1, 205.77, 46, 2, 1, 0.75489),
(16869, 1, 81, 0, 0, 0, 1, 2, 195.48, 37.9, 2, 1, 0.852868),
(16870, 1, 68, 0, 0, 1, 2, 1, 77.82, 27.5, 3, 1, 0.92385),
(16871, 0, 39, 0, 0, 1, 1, 2, 215.08, 43.8, 3, 1, 0.765202),
(16872, 0, 63, 0, 0, 1, 4, 2, 205.35, 42.2, 2, 1, 0.781308),
(16873, 0, 79, 0, 0, 1, 1, 1, 97.73, 21.5, 3, 1, 0.929924),
(16874, 1, 75, 1, 0, 1, 4, 2, 233.88, 28.5, 1, 1, 0.870159),
(16875, 0, 79, 1, 1, 1, 1, 2, 74.95, 29.8, 1, 1, 0.912838),
(16876, 1, 80, 0, 0, 1, 1, 2, 259.63, 31.7, 3, 1, 0.810462),
(16877, 0, 52, 1, 0, 1, 2, 1, 233.29, 48.9, 1, 1, 0.75682),
(16878, 0, 62, 1, 0, 1, 1, 2, 101.76, 22.5, 3, 1, 0.99048);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_uji`
--

CREATE TABLE `data_uji` (
  `no` int(11) NOT NULL,
  `j_kelamin` int(11) NOT NULL,
  `umur` float NOT NULL,
  `hipertensi` int(11) NOT NULL,
  `jantung` int(11) NOT NULL,
  `nikah` int(11) NOT NULL,
  `kerja` int(11) NOT NULL,
  `tinggal` int(11) NOT NULL,
  `gula` float NOT NULL,
  `bmi` float NOT NULL,
  `merokok` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_uji`
--

INSERT INTO `data_uji` (`no`, `j_kelamin`, `umur`, `hipertensi`, `jantung`, `nikah`, `kerja`, `tinggal`, `gula`, `bmi`, `merokok`, `class`, `date`) VALUES
(8657, 1, 28, 0, 0, 1, 1, 2, 94.36, 25.1, 3, 0, '2020-02-14 09:21:22'),
(8658, 0, 17, 0, 0, 0, 1, 2, 114, 22.6, 1, 0, '2020-02-14 09:21:22'),
(8659, 0, 24, 0, 0, 0, 1, 1, 100.24, 20.8, 1, 0, '2020-02-14 09:21:22'),
(8660, 0, 51, 0, 0, 1, 1, 1, 74.36, 33.4, 2, 0, '2020-02-14 09:21:22'),
(8661, 0, 60, 0, 0, 1, 4, 1, 86.34, 22.1, 1, 0, '2020-02-14 09:21:22'),
(8662, 0, 51, 0, 0, 1, 1, 1, 91.46, 39.6, 2, 0, '2020-02-14 09:21:22'),
(8663, 0, 57, 0, 0, 0, 1, 1, 94.99, 20.5, 1, 0, '2020-02-14 09:21:22'),
(8664, 0, 48, 0, 0, 1, 4, 2, 84.68, 29.9, 3, 0, '2020-02-14 09:21:22'),
(8665, 0, 24, 0, 0, 0, 4, 1, 88.61, 20.9, 1, 0, '2020-02-14 09:21:22'),
(8666, 0, 22, 0, 0, 0, 1, 1, 94.09, 21.4, 1, 0, '2020-02-14 09:21:23'),
(8667, 0, 79, 0, 0, 1, 2, 1, 118.88, 20.4, 1, 0, '2020-02-14 09:21:23'),
(8668, 0, 45, 0, 0, 1, 1, 1, 74.85, 27.1, 1, 0, '2020-02-14 09:21:23'),
(8669, 0, 30, 0, 0, 1, 2, 2, 82.25, 35.3, 1, 0, '2020-02-14 09:21:23'),
(8670, 1, 80, 0, 0, 1, 1, 1, 246.31, 31.5, 1, 0, '2020-02-14 09:21:23'),
(8671, 1, 17, 0, 0, 0, 1, 2, 94.92, 23.5, 1, 0, '2020-02-14 09:21:23'),
(8672, 0, 61, 1, 0, 1, 1, 2, 249.64, 37.7, 2, 0, '2020-02-14 09:21:23'),
(8673, 0, 36, 0, 0, 1, 2, 1, 115.16, 40.2, 2, 0, '2020-02-14 09:21:23'),
(8674, 1, 26, 0, 0, 1, 1, 2, 95.57, 30.7, 3, 0, '2020-02-14 09:21:23'),
(8675, 0, 81, 0, 0, 1, 1, 2, 81.55, 32.8, 1, 0, '2020-02-14 09:21:23'),
(8676, 0, 16, 0, 0, 0, 1, 1, 122.26, 34.2, 1, 0, '2020-02-14 09:21:23'),
(8677, 1, 48, 0, 0, 1, 4, 2, 83.41, 28.9, 1, 0, '2020-02-14 09:21:23'),
(8678, 1, 38, 0, 0, 1, 1, 2, 77.09, 31, 2, 0, '2020-02-14 09:21:23'),
(8679, 0, 11, 0, 0, 0, 4, 2, 87.97, 26.5, 1, 0, '2020-02-14 09:21:23'),
(8680, 1, 34, 0, 0, 1, 1, 2, 99.61, 22.7, 3, 0, '2020-02-14 09:21:23'),
(8681, 1, 57, 0, 0, 1, 1, 1, 106.24, 32.3, 1, 0, '2020-02-14 09:21:23'),
(8682, 0, 52, 0, 0, 1, 1, 2, 124.27, 22.2, 3, 0, '2020-02-14 09:21:23'),
(8683, 0, 41, 0, 0, 1, 1, 1, 101.85, 29.6, 1, 0, '2020-02-14 09:21:23'),
(8684, 0, 59, 0, 0, 1, 4, 1, 75.61, 25.9, 1, 0, '2020-02-14 09:21:23'),
(8685, 0, 37, 0, 0, 1, 1, 2, 82.91, 31.2, 1, 0, '2020-02-14 09:21:23'),
(8686, 0, 63, 0, 0, 1, 1, 1, 210.4, 45.4, 2, 0, '2020-02-14 09:21:23'),
(8687, 0, 32, 0, 0, 0, 1, 1, 74.56, 20.9, 1, 0, '2020-02-14 09:21:24'),
(8688, 0, 60, 0, 0, 1, 1, 2, 103.72, 30.4, 1, 0, '2020-02-14 09:21:24'),
(8689, 1, 22, 0, 0, 0, 1, 2, 106.59, 23.3, 1, 0, '2020-02-14 09:21:24'),
(8690, 1, 49, 0, 0, 1, 1, 2, 93.08, 26.4, 1, 0, '2020-02-14 09:21:24'),
(8691, 1, 55, 0, 0, 1, 1, 2, 192.28, 31, 1, 0, '2020-02-14 09:21:24'),
(8692, 0, 37, 0, 0, 1, 4, 2, 129.19, 37.5, 1, 0, '2020-02-14 09:21:24'),
(8693, 0, 48, 0, 0, 1, 1, 2, 80.17, 25.1, 1, 0, '2020-02-14 09:21:24'),
(8694, 0, 58, 0, 0, 1, 2, 1, 109.02, 32.4, 1, 0, '2020-02-14 09:21:24'),
(8695, 0, 14, 0, 0, 0, 4, 1, 104.29, 32.2, 1, 0, '2020-02-14 09:21:24'),
(8696, 0, 27, 0, 0, 0, 1, 2, 86.72, 27.6, 1, 0, '2020-02-14 09:21:24'),
(8697, 0, 44, 0, 0, 1, 1, 1, 79.13, 23.8, 1, 0, '2020-02-14 09:21:24'),
(8698, 0, 20, 0, 0, 0, 1, 1, 80.02, 29, 3, 0, '2020-02-14 09:21:24'),
(8699, 0, 42, 1, 0, 1, 1, 1, 208.03, 51.1, 1, 0, '2020-02-14 09:21:24'),
(8700, 1, 29, 0, 0, 1, 1, 2, 108.69, 29.6, 1, 0, '2020-02-14 09:21:24'),
(8701, 0, 51, 0, 0, 0, 4, 2, 116.14, 20.9, 1, 0, '2020-02-14 09:21:24'),
(8702, 1, 51, 0, 0, 1, 2, 1, 95.75, 25.9, 1, 0, '2020-02-14 09:21:24'),
(8703, 1, 62, 1, 0, 1, 1, 2, 86.38, 29.3, 2, 0, '2020-02-14 09:21:24'),
(8704, 1, 78, 0, 0, 1, 4, 2, 84.29, 23.9, 2, 0, '2020-02-14 09:21:24'),
(8705, 1, 38, 0, 0, 0, 2, 1, 91.31, 27.5, 2, 0, '2020-02-14 09:21:24'),
(8706, 0, 58, 1, 0, 1, 1, 1, 250.67, 50.9, 1, 0, '2020-02-14 09:21:24'),
(8707, 0, 34, 0, 0, 1, 2, 2, 86.47, 23.2, 1, 0, '2020-02-14 09:21:24'),
(8708, 0, 68, 0, 0, 1, 1, 2, 111.98, 26.8, 2, 0, '2020-02-14 09:21:24'),
(8709, 0, 40, 0, 0, 1, 1, 1, 200.35, 57.6, 2, 0, '2020-02-14 09:21:25'),
(8710, 0, 20, 0, 0, 0, 4, 2, 65.39, 37.2, 1, 0, '2020-02-14 09:21:25'),
(8711, 1, 13, 0, 0, 0, 4, 2, 97.97, 24.5, 1, 0, '2020-02-14 09:21:25'),
(8712, 0, 50, 0, 0, 1, 1, 2, 82.75, 32.6, 3, 0, '2020-02-14 09:21:25'),
(8713, 0, 72, 0, 0, 1, 2, 2, 103.25, 26.9, 2, 0, '2020-02-14 09:21:25'),
(8714, 1, 10, 0, 0, 0, 4, 2, 93.04, 21.7, 2, 0, '2020-02-14 09:21:25'),
(8715, 1, 71, 0, 0, 1, 4, 1, 80.66, 36.9, 2, 0, '2020-02-14 09:21:25'),
(8716, 0, 42, 0, 0, 1, 4, 1, 232.85, 41.7, 2, 0, '2020-02-14 09:21:25'),
(8717, 1, 68, 0, 0, 1, 2, 2, 101.09, 27.6, 1, 0, '2020-02-14 09:21:25'),
(8718, 0, 63, 0, 0, 1, 1, 1, 116.66, 34.6, 1, 0, '2020-02-14 09:21:25'),
(8719, 0, 25, 0, 0, 0, 1, 2, 99.26, 29.2, 3, 0, '2020-02-14 09:21:25'),
(8720, 1, 35, 1, 0, 1, 2, 1, 113.88, 34.6, 3, 0, '2020-02-14 09:21:25'),
(8721, 0, 52, 0, 0, 1, 1, 2, 90.18, 22.1, 2, 0, '2020-02-14 09:21:25'),
(8722, 0, 74, 0, 0, 1, 1, 2, 86.25, 27.9, 1, 0, '2020-02-14 09:21:25'),
(8723, 1, 64, 0, 0, 1, 1, 1, 130.68, 34, 2, 0, '2020-02-14 09:21:25'),
(8724, 0, 47, 0, 0, 1, 1, 1, 77.83, 36, 2, 0, '2020-02-14 09:21:25'),
(8725, 1, 39, 0, 0, 1, 1, 1, 74.03, 29.2, 3, 0, '2020-02-14 09:21:25'),
(8726, 0, 22, 0, 0, 0, 1, 2, 81.44, 24.9, 1, 0, '2020-02-14 09:21:25'),
(8727, 1, 58, 0, 0, 1, 2, 1, 76.68, 34.7, 2, 1, '2020-02-14 09:21:25'),
(8728, 0, 77, 0, 0, 1, 2, 1, 199.71, 36.2, 2, 1, '2020-02-14 09:21:25'),
(8729, 0, 81, 1, 0, 1, 1, 2, 67.92, 26.2, 1, 1, '2020-02-14 09:21:25'),
(8730, 0, 81, 1, 0, 1, 2, 1, 82.77, 25.1, 2, 1, '2020-02-14 09:21:25'),
(8731, 0, 82, 1, 0, 1, 1, 2, 84.67, 20.7, 1, 1, '2020-02-14 09:21:25'),
(8732, 1, 79, 0, 1, 1, 1, 2, 246.58, 28.5, 2, 1, '2020-02-14 09:21:25'),
(8733, 0, 77, 1, 0, 1, 2, 1, 199.84, 28, 2, 1, '2020-02-14 09:21:25'),
(8734, 0, 72, 0, 0, 1, 1, 2, 97.92, 26.9, 3, 1, '2020-02-14 09:21:26'),
(8735, 0, 80, 0, 0, 1, 1, 1, 106.72, 27.8, 1, 1, '2020-02-14 09:21:26'),
(8736, 1, 73, 0, 1, 1, 1, 1, 82.94, 33.8, 2, 1, '2020-02-14 09:21:26'),
(8737, 0, 81, 1, 0, 1, 1, 1, 85.55, 25.6, 1, 1, '2020-02-14 09:21:26'),
(8738, 0, 66, 1, 0, 1, 2, 2, 84.91, 44.4, 2, 1, '2020-02-14 09:21:26'),
(8739, 0, 82, 0, 1, 0, 1, 1, 111.3, 22.3, 1, 1, '2020-02-14 09:21:26'),
(8740, 0, 55, 1, 0, 1, 4, 1, 207.29, 31.6, 3, 1, '2020-02-14 09:21:26'),
(8741, 1, 59, 0, 0, 1, 1, 2, 91.59, 31.9, 3, 1, '2020-02-14 09:21:26'),
(8742, 1, 78, 1, 0, 1, 2, 2, 93.68, 22.6, 2, 1, '2020-02-14 09:21:26'),
(8743, 0, 77, 0, 1, 1, 1, 2, 231.56, 36.9, 1, 1, '2020-02-14 09:21:26'),
(8744, 1, 82, 0, 0, 1, 1, 1, 85.19, 26.7, 1, 1, '2020-02-14 09:21:26'),
(8745, 0, 80, 0, 0, 1, 1, 1, 79.86, 26.6, 2, 1, '2020-02-14 09:21:26'),
(8746, 0, 65, 0, 0, 1, 1, 1, 205.77, 46, 2, 1, '2020-02-14 09:21:26'),
(8747, 1, 81, 0, 0, 0, 1, 2, 195.48, 37.9, 2, 1, '2020-02-14 09:21:26'),
(8748, 1, 68, 0, 0, 1, 2, 1, 77.82, 27.5, 3, 1, '2020-02-14 09:21:26'),
(8749, 0, 39, 0, 0, 1, 1, 2, 215.08, 43.8, 3, 1, '2020-02-14 09:21:26'),
(8750, 0, 63, 0, 0, 1, 4, 2, 205.35, 42.2, 2, 1, '2020-02-14 09:21:26'),
(8751, 0, 79, 0, 0, 1, 1, 1, 97.73, 21.5, 3, 1, '2020-02-14 09:21:26'),
(8752, 1, 75, 1, 0, 1, 4, 2, 233.88, 28.5, 1, 1, '2020-02-14 09:21:26'),
(8753, 0, 79, 1, 1, 1, 1, 2, 74.95, 29.8, 1, 1, '2020-02-14 09:21:26'),
(8754, 1, 80, 0, 0, 1, 1, 2, 259.63, 31.7, 3, 1, '2020-02-14 09:21:26'),
(8755, 0, 52, 1, 0, 1, 2, 1, 233.29, 48.9, 1, 1, '2020-02-14 09:21:27'),
(8756, 0, 62, 1, 0, 1, 1, 2, 101.76, 22.5, 3, 1, '2020-02-14 09:21:27'),
(8757, 1, 32, 0, 0, 1, 2, 2, 104, 23, 1, 0, '2020-02-14 09:37:11'),
(8758, 1, 32, 0, 0, 1, 2, 2, 104, 23, 1, 1, '2020-02-14 09:40:04'),
(8759, 1, 59, 1, 0, 0, 1, 2, 104, 23, 1, 1, '2020-02-16 03:34:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`username`, `password`) VALUES
('aku', '89ccfac87d8d06db06bf3211cb2d69ed'),
('ghina', '5053c14c7e08af19347e82f606b51297');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prediksi`
--

CREATE TABLE `prediksi` (
  `id` int(11) NOT NULL,
  `id_datauji` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `knn` int(11) NOT NULL,
  `fuzzy` int(11) NOT NULL,
  `weigted` int(11) NOT NULL,
  `k` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sorting`
--

CREATE TABLE `sorting` (
  `no` int(11) NOT NULL,
  `no_data_latih` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `jarak` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sorting`
--

INSERT INTO `sorting` (`no`, `no_data_latih`, `class`, `jarak`) VALUES
(955058, 16878, 1, 0.99048),
(955059, 16785, 0, 0.979805),
(955060, 16783, 0, 0.9742),
(955061, 16810, 0, 0.969392),
(955062, 16843, 0, 0.967906),
(955063, 16823, 0, 0.967134),
(955064, 16812, 0, 0.964187),
(955065, 16804, 0, 0.96282),
(955066, 16839, 0, 0.962337),
(955067, 16825, 0, 0.962283),
(955068, 16824, 0, 0.96141),
(955069, 16803, 0, 0.95867),
(955070, 16863, 1, 0.956695),
(955071, 16830, 0, 0.955294),
(955072, 16806, 0, 0.955177),
(955073, 16864, 1, 0.953175),
(955074, 16815, 0, 0.952584),
(955075, 16856, 1, 0.947217),
(955076, 16802, 0, 0.946016),
(955077, 16835, 0, 0.942149),
(955078, 16816, 0, 0.941516),
(955079, 16811, 0, 0.940524),
(955080, 16799, 0, 0.940374),
(955081, 16819, 0, 0.940354),
(955082, 16853, 1, 0.939901),
(955083, 16844, 0, 0.938366),
(955084, 16861, 1, 0.937359),
(955085, 16826, 0, 0.935074),
(955086, 16859, 1, 0.932795),
(955087, 16873, 1, 0.929924),
(955088, 16793, 0, 0.928498),
(955089, 16840, 0, 0.927907),
(955090, 16851, 1, 0.927834),
(955091, 16857, 1, 0.92755),
(955092, 16805, 0, 0.926919),
(955093, 16866, 1, 0.926322),
(955094, 16829, 0, 0.926192),
(955095, 16790, 0, 0.924211),
(955096, 16870, 1, 0.92385),
(955097, 16779, 0, 0.923338),
(955098, 16822, 0, 0.922721),
(955099, 16827, 0, 0.920339),
(955100, 16781, 0, 0.919342),
(955101, 16780, 0, 0.919304),
(955102, 16834, 0, 0.917922),
(955103, 16818, 0, 0.917867),
(955104, 16809, 0, 0.916712),
(955105, 16845, 0, 0.91625),
(955106, 16789, 0, 0.915145),
(955107, 16848, 0, 0.914861),
(955108, 16788, 0, 0.913154),
(955109, 16875, 1, 0.912838),
(955110, 16786, 0, 0.912455),
(955111, 16833, 0, 0.911218),
(955112, 16813, 0, 0.909363),
(955113, 16807, 0, 0.909348),
(955114, 16800, 0, 0.90782),
(955115, 16849, 1, 0.906189),
(955116, 16852, 1, 0.905739),
(955117, 16841, 0, 0.905244),
(955118, 16797, 0, 0.902204),
(955119, 16847, 0, 0.90021),
(955120, 16796, 0, 0.898754),
(955121, 16867, 1, 0.897456),
(955122, 16787, 0, 0.896368),
(955123, 16782, 0, 0.891345),
(955124, 16836, 0, 0.889725),
(955125, 16842, 0, 0.883996),
(955126, 16858, 1, 0.881362),
(955127, 16801, 0, 0.879532),
(955128, 16784, 0, 0.875619),
(955129, 16860, 1, 0.871538),
(955130, 16874, 1, 0.870159),
(955131, 16846, 0, 0.869828),
(955132, 16837, 0, 0.867903),
(955133, 16814, 0, 0.862496),
(955134, 16820, 0, 0.862265),
(955135, 16791, 0, 0.8591),
(955136, 16798, 0, 0.858242),
(955137, 16817, 0, 0.854366),
(955138, 16869, 1, 0.852868),
(955139, 16832, 0, 0.839691),
(955140, 16862, 1, 0.836299),
(955141, 16794, 0, 0.832467),
(955142, 16855, 1, 0.824436),
(955143, 16792, 0, 0.821027),
(955144, 16876, 1, 0.810462),
(955145, 16854, 1, 0.806722),
(955146, 16795, 0, 0.790184),
(955147, 16865, 1, 0.786605),
(955148, 16828, 0, 0.783002),
(955149, 16821, 0, 0.781848),
(955150, 16872, 1, 0.781308),
(955151, 16871, 1, 0.765202),
(955152, 16808, 0, 0.758904),
(955153, 16877, 1, 0.75682),
(955154, 16868, 1, 0.75489),
(955155, 16850, 1, 0.725605),
(955156, 16831, 0, 0.661994),
(955157, 16838, 0, 0.649462);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akurasi`
--
ALTER TABLE `akurasi`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_latih`
--
ALTER TABLE `data_latih`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_uji`
--
ALTER TABLE `data_uji`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `prediksi`
--
ALTER TABLE `prediksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre` (`id_datauji`);

--
-- Indeks untuk tabel `sorting`
--
ALTER TABLE `sorting`
  ADD PRIMARY KEY (`no`),
  ADD KEY `sor` (`no_data_latih`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akurasi`
--
ALTER TABLE `akurasi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111580;

--
-- AUTO_INCREMENT untuk tabel `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_latih`
--
ALTER TABLE `data_latih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16879;

--
-- AUTO_INCREMENT untuk tabel `data_uji`
--
ALTER TABLE `data_uji`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8760;

--
-- AUTO_INCREMENT untuk tabel `prediksi`
--
ALTER TABLE `prediksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112749;

--
-- AUTO_INCREMENT untuk tabel `sorting`
--
ALTER TABLE `sorting`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=955158;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `prediksi`
--
ALTER TABLE `prediksi`
  ADD CONSTRAINT `pre` FOREIGN KEY (`id_datauji`) REFERENCES `data_uji` (`no`);

--
-- Ketidakleluasaan untuk tabel `sorting`
--
ALTER TABLE `sorting`
  ADD CONSTRAINT `sor` FOREIGN KEY (`no_data_latih`) REFERENCES `data_latih` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
