-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2020 pada 09.17
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icoffee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kota_kabupaten` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `addresses`
--

INSERT INTO `addresses` (`id`, `id_pelanggan`, `nama`, `provinsi`, `kecamatan`, `kode_pos`, `address`, `no_hp`, `created_at`, `updated_at`, `kota_kabupaten`) VALUES
(1, 9, 'Fauzi', 'Lampung', 'Tanjung Karang Pusat', 35116, 'Jl. Durian II', 819283165, '2020-01-14 17:00:00', '2020-01-14 17:00:00', 'BANDAR LAMPUNG'),
(2, 6, 'Riski', 'TANGERANG', 'TANGERANG SELATAN', 15315, 'Jl Tangerang', 8192831, '2020-01-16 07:18:00', '2020-01-16 07:18:00', 'TANGERANG SELATAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Robusta', NULL, NULL),
(2, 'Arabica', NULL, NULL),
(3, 'Honey', NULL, NULL),
(4, 'Natural', NULL, NULL),
(5, 'Flores', NULL, NULL),
(6, 'Hijau', NULL, NULL),
(7, 'Balsamiq', '2020-01-16 03:06:25', '2020-01-16 03:06:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengiriman` bigint(20) UNSIGNED NOT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkos_kirim` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `deliveries`
--

INSERT INTO `deliveries` (`id`, `id_pengiriman`, `asal`, `tujuan`, `ongkos_kirim`, `created_at`, `updated_at`) VALUES
(1, 1, 'BANDAR LAMPUNG', 'JAKARTA PUSAT', 20000, '2020-01-16 06:56:25', '2020-01-16 06:56:25'),
(2, 1, 'BANDAR LAMPUNG', 'TANGERANG SELATAN', 20000, '2020-01-16 06:58:41', '2020-01-16 06:58:41'),
(3, 2, 'BANDAR LAMPUNG', 'JAKARTA PUSAT', 24000, '2020-01-16 07:59:52', '2020-01-16 07:59:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_categories`
--

CREATE TABLE `delivery_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pengiriman` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `delivery_categories`
--

INSERT INTO `delivery_categories` (`id`, `nama_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 'JNE', '2020-01-16 06:55:46', '2020-01-16 06:55:46'),
(2, 'J&T', '2020-01-16 07:58:57', '2020-01-16 07:58:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `nama_gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `images`
--

INSERT INTO `images` (`id`, `id_pelanggan`, `id_produk`, `nama_gambar`, `created_at`, `updated_at`, `kode_produk`) VALUES
(1, 8, 2, 'IMG20200111094231.jpg', '2020-01-10 20:08:35', '2020-01-10 20:08:35', '202001110308358'),
(2, 8, 4, 'IMG20200111094236.jpg', '2020-01-10 20:10:46', '2020-01-10 20:10:46', '202001110310468');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jbcarts`
--

CREATE TABLE `jbcarts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jbcarts`
--

INSERT INTO `jbcarts` (`id`, `id_pelanggan`, `id_produk`, `nama_produk`, `jumlah`, `harga`, `total`, `created_at`, `updated_at`, `kode_produk`, `image`) VALUES
(2, 9, 15, 'asasa', 1, 45000, 45000, '2020-01-13 07:30:03', '2020-01-13 07:30:03', '202001110532358', 'product-1.jpg'),
(13, 9, 14, 'a', 2, 10000, 20000, '2020-01-16 02:49:49', '2020-01-16 02:49:49', '202001110531558', 'IMG20200111120358.jpg'),
(14, 9, 12, 'sasasa', 2, 10000, 20000, '2020-01-16 02:52:40', '2020-01-16 02:52:40', '202001110529168', 'IMG20200111120358.jpg'),
(15, 7, 15, 'asasa', 1, 45000, 45000, '2020-01-16 03:21:40', '2020-01-16 03:21:40', '202001110532358', 'product-1.jpg'),
(16, 7, 5, 'robusta', 3, 40000, 120000, '2020-01-16 03:25:52', '2020-01-16 03:25:52', '202001110458138', 'IMG20200111094239.jpg'),
(17, 7, 13, 'sa', 1, 45000, 45000, '2020-01-16 03:48:28', '2020-01-16 03:48:28', '202001110530478', 'product-1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_01_08_130134_create_permission_tables', 1),
(9, '2020_01_09_034159_create_shop_products_table', 2),
(10, '2020_01_09_075758_add_kode_produk_to_shop_products', 3),
(11, '2020_01_09_080647_add_kode_produk_to_images', 4),
(13, '2020_01_09_083449_delete_id_produk_to_images', 5),
(14, '2020_01_10_024051_move_kode_produk_postion_from_images', 6),
(15, '2020_01_13_102422_create_keranjang_table', 6),
(16, '2020_01_13_104059_change_carts_to_jbcarts_table', 7),
(17, '2020_01_13_140755_add_kode_produk_to_jbcarts_table', 8),
(18, '2020_01_13_142648_add_image_to_jbcarts_table', 9),
(19, '2020_01_13_152100_create_order_table', 10),
(20, '2020_01_13_160135_change_nama_from_addresses', 11),
(21, '2020_01_15_153232_change_kota_from_addresses', 12),
(22, '2020_01_15_154836_add_kota_from_addresses', 13),
(23, '2020_01_16_113133_create_deliveries_table', 14),
(24, '2020_01_16_134542_add_pesan_to_orders', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 8),
(2, 'App\\User', 7),
(3, 'App\\User', 6),
(3, 'App\\User', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_penjual` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_alamat` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pesan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2020-01-08 06:36:52', '2020-01-08 06:36:52'),
(2, 'admin', 'web', '2020-01-08 06:36:52', '2020-01-08 06:36:52'),
(3, 'user', 'web', '2020-01-08 06:36:52', '2020-01-08 06:36:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shop_products`
--

CREATE TABLE `shop_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shop_products`
--

INSERT INTO `shop_products` (`id`, `id_pelanggan`, `id_kategori`, `nama_produk`, `detail_produk`, `gambar`, `harga`, `stok`, `created_at`, `updated_at`, `kode_produk`) VALUES
(1, 8, 1, 'Kopi Robusta Mantab', 'Dijual cepat kopi enak', 'IMG20200111094239.jpg', 40000, 20, '2020-01-10 20:06:24', '2020-01-10 20:06:24', '202001110306248'),
(2, 8, 2, 'Kopi Arabica', 'Dijual cepat kopi rabica enak', 'IMG20200111094242.jpg', 50000, 30, '2020-01-10 20:08:35', '2020-01-10 20:08:35', '202001110308358'),
(3, 8, 3, 'Kopi Proses Honey', 'Dijual cepat kopi honey enak', 'IMG20200111094236.jpg', 60000, 40, '2020-01-10 20:09:58', '2020-01-10 20:09:58', '202001110309588'),
(4, 8, 4, 'Kopi Natural', 'Dijual cepat kopi natural enak', 'IMG20200111094231.jpg', 70000, 50, '2020-01-10 20:10:46', '2020-01-10 20:10:46', '202001110310468'),
(5, 8, 1, 'robusta', 'Dijual cepat kopi enak', 'IMG20200111094239.jpg', 40000, 20, '2020-01-10 21:58:15', '2020-01-10 21:58:15', '202001110458138'),
(6, 8, 1, 'robusta', 'sasasa', 'IMG20200111120358.jpg', 10000, 45, '2020-01-10 22:06:48', '2020-01-10 22:06:48', '202001110506468'),
(7, 8, 1, 'robusta', 'sasasa', 'IMG20200111120358.jpg', 10000, 45, '2020-01-10 22:08:25', '2020-01-10 22:08:25', '202001110508238'),
(8, 8, 1, 'robusta', 'aaaaaaaaaaa', 'IMG20200111094231.jpg', 45000, 45, '2020-01-10 22:21:18', '2020-01-10 22:21:18', '202001110521168'),
(9, 8, 1, 'sa', 'sasa', 'IMG20200111094231.jpg', 10000, 45, '2020-01-10 22:23:56', '2020-01-10 22:23:56', '202001110523558'),
(10, 8, 2, 'sasasa', 'sasasa', 'IMG20200111094239.jpg', 10000, 45, '2020-01-10 22:25:54', '2020-01-10 22:25:54', '202001110525538'),
(11, 8, 2, 'sasasa', 'saas', 'IMG20200111120358.jpg', 10000, 45, '2020-01-10 22:27:02', '2020-01-10 22:27:02', '202001110527018'),
(12, 8, 2, 'sasasa', 'saass', 'IMG20200111120358.jpg', 10000, 21, '2020-01-10 22:29:17', '2020-01-10 22:29:17', '202001110529168'),
(13, 8, 2, 'sa', 'sasa', 'product-1.jpg', 45000, 21, '2020-01-10 22:30:48', '2020-01-10 22:30:48', '202001110530478'),
(14, 8, 2, 'a', 'sasa', 'IMG20200111120358.jpg', 10000, 45, '2020-01-10 22:31:57', '2020-01-10 22:31:57', '202001110531558'),
(15, 8, 2, 'asasa', 'saa', 'product-1.jpg', 45000, 45, '2020-01-10 22:32:35', '2020-01-10 22:32:35', '202001110532358');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0819-2831-6552', 'intip.kartu@gmail.com', '$2y$10$g.9Gi/5UvR3xunB3YAt4hO63avvBgZRnmZmNYQ06ORgC7n0j9//2e', NULL, '2020-01-08 06:37:47', '2020-01-08 06:37:47'),
(2, 'fauzi', 'intip.kartu11@gmail.com', '$2y$10$niUNJkW7q0YniZSYx.aPNO3fQ7FSEUyYI9sK9AoY8NFZY9yWOBjVS', NULL, '2020-01-08 06:41:30', '2020-01-08 06:41:30'),
(3, '0819-2831-6552', 'intip.kart2121u@gmail.com', '$2y$10$6DmScZkOd9wqcKxrff0d.O7F1qYwdQer3KGzQALm9MT5oJh/cDAeO', NULL, '2020-01-08 06:44:43', '2020-01-08 06:44:43'),
(4, '0819-2831-6552', 'intip.kartu1@gmail.com', '$2y$10$Rap.0qii3ymNIzlcGW..aewE8cs0A9ZJMX14ayTjGZj6.kVdKux2a', NULL, '2020-01-08 06:50:16', '2020-01-08 06:50:16'),
(5, '0819-2831-6552', 'intip.kartu212121@gmail.com', '$2y$10$f6FNwg8C.mJ9vDbTgmn.SOVFs1RiNWqj7WsVNgQwqrvOu.PCxv9tS', NULL, '2020-01-08 06:54:23', '2020-01-08 06:54:23'),
(6, 'sa', 'sasa@sa.com', '$2y$10$MkIYEdsjon3yJQmjKErgIerdfk1EWNmcOVoXD6oR8bT.LrWRGZOqm', NULL, '2020-01-08 06:58:39', '2020-01-08 06:58:39'),
(7, 'Admin Icoffee', 'AdminIcoffee@icoffee.co.id', '$2y$10$vFYIj98TwEKuKz9qRB2y6eDr82HEy9743iSHExpfSpuOQgp5MzR3W', NULL, '2020-01-08 07:20:11', '2020-01-08 07:20:11'),
(8, 'Super Admin Icoffee', 'SuperAdminIcoffee@icoffee.co.id', '$2y$10$US4i2Le0mO1/odNmlCCKI.INaNK.qYd03Z4gPi8lyr.cv7ajZY26K', NULL, '2020-01-08 07:20:22', '2020-01-08 07:20:22'),
(9, '0819-2831-6552', 'intip.ka2112rtu@gmail.com', '$2y$10$z5Em9ha.edKEuf0zNuKp3O1oJbmvOFb76u.n.hMN.Xf8qphzP6SKO', NULL, '2020-01-08 18:58:07', '2020-01-08 18:58:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_id_pengiriman_foreign` (`id_pengiriman`);

--
-- Indeks untuk tabel `delivery_categories`
--
ALTER TABLE `delivery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `images_id_produk_foreign` (`id_produk`);

--
-- Indeks untuk tabel `jbcarts`
--
ALTER TABLE `jbcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `carts_id_produk_foreign` (`id_produk`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `orderdetails_id_penjual_foreign` (`id_penjual`),
  ADD KEY `orderdetails_id_order_foreign` (`id_order`),
  ADD KEY `orderdetails_id_produk_foreign` (`id_produk`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `orders_id_alamat_foreign` (`id_alamat`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_products_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `shop_products_id_kategori_foreign` (`id_kategori`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `delivery_categories`
--
ALTER TABLE `delivery_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jbcarts`
--
ALTER TABLE `jbcarts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `shop_products`
--
ALTER TABLE `shop_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_id_pengiriman_foreign` FOREIGN KEY (`id_pengiriman`) REFERENCES `delivery_categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `images_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jbcarts`
--
ALTER TABLE `jbcarts`
  ADD CONSTRAINT `carts_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_id_penjual_foreign` FOREIGN KEY (`id_penjual`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_alamat_foreign` FOREIGN KEY (`id_alamat`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shop_products`
--
ALTER TABLE `shop_products`
  ADD CONSTRAINT `shop_products_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_products_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
