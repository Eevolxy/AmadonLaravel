-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 juin 2026 à 11:20
-- Version du serveur : 8.4.7
-- Version de PHP : 8.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `description`, `note`, `prix`, `categorie`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'facilis eligendi', 'Dignissimos architecto laboriosam nam facere consequatur occaecati. Eum quo enim enim praesentium nemo amet.\n\nCupiditate aut sequi non porro. Enim adipisci qui facilis sit et. Neque neque unde dicta harum. Sed qui quis aliquid.\n\nNecessitatibus reprehenderit accusantium ut quia labore. Nam et voluptatem distinctio enim. Non qui vel incidunt atque. Aut et voluptatibus quam nisi vel omnis deserunt laborum.', 1, 206.98, 'maison', 'https://picsum.photos/seed/11691/400/400', 11, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(2, 'ut aut veniam illo voluptas', 'Mollitia qui accusamus necessitatibus quia consequatur qui velit. Ut est delectus nihil dolorem totam. Voluptatem repellat aliquam totam et ut consequuntur ut.', 1, 463.13, 'électronique', 'https://picsum.photos/seed/55091/400/400', 10, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(3, 'itaque debitis non ab', 'Sit occaecati tempore expedita. Sunt eum odio magni tempora et minima. Itaque nulla sint quis doloribus facilis cum.', 4, 244.48, 'sport', 'https://picsum.photos/seed/21720/400/400', 9, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(4, 'vitae excepturi optio maxime', 'Eum et officiis at et consequuntur ab. Adipisci facilis ut facilis quaerat excepturi et. Libero eos culpa neque sed sed dolorem explicabo. Minus voluptatem modi dolor dignissimos minus. Quis totam enim quia praesentium itaque est.', 2, 383.42, 'livres', 'https://picsum.photos/seed/50568/400/400', 11, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(5, 'et autem alias', 'Cum nulla aliquam quidem odit ad. Porro ipsa laudantium ducimus et id eos nemo. Quibusdam molestias veritatis quidem consequuntur ut.\n\nEt modi occaecati impedit veritatis nisi. Occaecati excepturi velit quidem et. Et voluptas repellat ut dicta nihil. Fugit officiis libero delectus odio doloribus reiciendis.\n\nMolestiae aut est rerum in occaecati dolores. Et qui ea commodi occaecati. Laudantium corporis natus eum culpa. Repudiandae dolores consequatur est magnam rerum quia eum consequatur. Eveniet nobis odio ut repellat aliquid dolorem quia.', 5, 101.69, 'jouets', 'https://picsum.photos/seed/37635/400/400', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(6, 'molestiae labore est', 'Sint voluptatem delectus quia rerum dolore. In dolore reprehenderit neque dolore. Natus perferendis cupiditate culpa nemo voluptas qui. Impedit quibusdam ipsam officiis deserunt ab optio est.', 1, 85.37, 'maison', 'https://picsum.photos/seed/51889/400/400', 4, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(7, 'voluptas sapiente voluptatem', 'Laudantium facilis qui ab enim quidem provident dicta. Dolor facilis sequi inventore qui corporis autem. Architecto quidem fugit veniam dolor. Ad vel eius et eos.\n\nCommodi eum numquam quas non velit placeat nostrum. Velit aspernatur mollitia quia vel fuga inventore omnis. In harum omnis tempore enim. Aliquam eos voluptatem qui inventore praesentium placeat rerum.\n\nIste nesciunt dicta earum nostrum esse. Aliquam suscipit ut voluptatibus qui blanditiis. Qui minima harum quod qui.', 4, 284.53, 'jouets', 'https://picsum.photos/seed/75488/400/400', 3, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(8, 'beatae voluptas', 'Ipsam nesciunt ullam voluptas veritatis necessitatibus dicta. Ut ut quo quos. Quas ipsa officia culpa perferendis. Id omnis molestiae et quaerat sit illum.\n\nExercitationem in odio ut quaerat quibusdam sequi. Saepe sed ex et quasi. Aut earum nesciunt similique at ut. Maiores fuga asperiores consectetur.', 3, 427.16, 'alimentation', 'https://picsum.photos/seed/96909/400/400', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(9, 'aperiam eaque vitae mollitia repudiandae', 'Perspiciatis sed dignissimos at dolor reprehenderit aut. Repellendus tempora tenetur rem voluptatum repellendus quidem. Quia facilis perspiciatis quia perspiciatis architecto. Laborum cumque fuga sint autem culpa tempore. Id distinctio quisquam eveniet quo.\n\nDolorem quod iste distinctio et praesentium qui eos totam. Praesentium consectetur distinctio delectus minima itaque laudantium. Harum id voluptas unde.', 1, 161.65, 'alimentation', 'https://picsum.photos/seed/91495/400/400', 10, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(10, 'expedita mollitia', 'Blanditiis est aspernatur magni iure et commodi. Vel et ut possimus corporis quo quam. Officia non aut harum fugiat praesentium molestiae ipsa. Rem ab sed sunt iure incidunt aut atque aut.', 5, 460.58, 'sport', 'https://picsum.photos/seed/65521/400/400', 8, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(11, 'et quia fugiat et et', 'Fugiat veniam dolorum quia expedita atque. Asperiores doloribus et molestiae tempore qui sit quae. Ut ea voluptas explicabo quia et cumque qui. Debitis voluptatem unde velit omnis et pariatur.\n\nMolestiae vel autem veritatis aut iusto expedita. Ut quos quibusdam minima necessitatibus dolorum sed in. Sed doloremque necessitatibus voluptas repellat omnis sed et.', 5, 396.40, 'électronique', 'https://picsum.photos/seed/72269/400/400', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(12, 'dolorem aut', 'Perspiciatis veritatis voluptatem adipisci a nam ratione. Voluptates laboriosam fugiat voluptatem est veniam reprehenderit voluptates. Asperiores eius eos eius itaque corrupti cum. Qui illum recusandae tempore quam ipsum.\n\nUt assumenda autem amet repellat velit aut. Assumenda voluptas est ipsum voluptas assumenda eos.', 3, 316.38, 'vêtements', 'https://picsum.photos/seed/63417/400/400', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(13, 'iusto quisquam', 'Architecto voluptatibus laboriosam sit nisi minima assumenda rerum. Non odit nisi eius totam. Id et maiores ut. Sed suscipit eum aut quo officiis asperiores excepturi sint.\n\nQui quibusdam iusto consequatur. Itaque rerum corporis exercitationem totam voluptas praesentium eum. Ut est fugiat est dolores voluptas totam. Provident amet quo assumenda quo. Iusto cupiditate sed esse quia.\n\nEt velit quia eaque occaecati expedita ea tempora. Aliquid necessitatibus est qui. Asperiores sequi est omnis.', 4, 28.61, 'livres', 'https://picsum.photos/seed/32432/400/400', 11, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(14, 'sequi deleniti a', 'Et fugit facere id. Cumque et culpa ducimus soluta.\n\nEos voluptas quisquam quae dolore. Ipsa aut ipsam officiis. Ullam nesciunt facilis eveniet voluptatum temporibus qui. Rem enim ea magnam non impedit voluptas aut.\n\nCumque ab recusandae cupiditate. Occaecati qui eum consectetur inventore. Rerum sint dignissimos nihil quaerat dolorem.', 4, 278.29, 'électronique', 'https://picsum.photos/seed/34676/400/400', 10, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(15, 'repellat ullam inventore', 'Repellendus quos quis et quas et sunt dolore. Similique optio alias facere ea doloribus commodi. Provident quas pariatur ad laborum quia voluptatem. Debitis suscipit beatae ipsam vero commodi.\n\nEaque deleniti molestias minima in ipsa. Veniam ex dolore nihil et repellendus aut reiciendis.\n\nDolor suscipit non necessitatibus aperiam. Omnis voluptas provident omnis ut eos. Fugiat vero consequuntur id id aperiam est. Recusandae voluptatibus facere in aliquam maiores alias officia.', 4, 435.79, 'livres', 'https://picsum.photos/seed/56976/400/400', 10, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(16, 'non quibusdam', 'Velit cum ratione ratione delectus. Ullam ea libero sed. Rem ut dolor reprehenderit ipsam sit nihil.\n\nAt et quisquam quo. Dolorem deserunt sunt fuga earum. Ullam unde ut possimus facere expedita quis sequi. Quaerat maiores odio magnam aperiam est laborum quasi.', 1, 276.73, 'sport', 'https://picsum.photos/seed/83836/400/400', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(17, 'ex totam optio est temporibus', 'Aut dolor recusandae unde voluptatem corrupti dicta nostrum. Consectetur exercitationem quis eaque quisquam ipsum. Ipsa magni alias optio provident fugiat nobis. Suscipit excepturi omnis harum cum labore et nihil.', 4, 264.97, 'sport', 'https://picsum.photos/seed/97453/400/400', 7, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(18, 'minus nulla', 'Iusto hic tempora asperiores et est. Officia nam omnis aperiam vero quae magni quaerat. Sit officiis in quidem aut ea similique corporis fugiat.\n\nEt deleniti ratione nihil sed esse deleniti voluptatem. Dolor aliquid est praesentium autem. At et rerum quod.', 2, 297.37, 'beauté', 'https://picsum.photos/seed/87849/400/400', 11, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(19, 'optio et', 'Dolor blanditiis aut facilis perspiciatis neque natus quidem. Sed exercitationem sunt qui aspernatur quia occaecati in. Id aut qui aspernatur vero qui dolor iure.\n\nFacere autem unde et eveniet fuga deleniti voluptas. Magni consectetur iusto est quasi. Tempore qui aperiam voluptas aut.', 4, 7.61, 'sport', 'https://picsum.photos/seed/48484/400/400', 8, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(20, 'porro quaerat hic quisquam illo', 'Dolores alias laudantium quo perferendis amet. Est sit architecto impedit. Ut sapiente consequuntur assumenda repellendus.\n\nNulla quia et dolores veniam saepe quas. Eaque voluptas at magnam inventore. Iure corporis unde velit autem sint suscipit quos aut. Ullam iste aliquid mollitia facilis itaque consequatur dolor.\n\nAut ut ut qui delectus temporibus. Quos repellendus sunt rerum similique omnis. Enim sint non nemo totam deleniti dolor consequatur.', 5, 79.81, 'vêtements', 'https://picsum.photos/seed/135/400/400', 6, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(21, 'sed error et magnam', 'A aperiam quod aut accusantium molestiae odio asperiores consequuntur. Est doloremque dignissimos ut qui. Neque rerum autem aut praesentium aut iure. Exercitationem voluptates possimus voluptates recusandae quidem molestiae id. At rerum fugiat mollitia quas officia voluptas.', 5, 295.16, 'alimentation', 'https://picsum.photos/seed/50462/400/400', 8, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(22, 'accusantium voluptas tempora cum', 'Est dolores ut quisquam hic labore accusamus laudantium. Aut neque magni qui. Sunt corrupti nihil rerum totam. Dolorem maiores corrupti ea deserunt.\n\nDignissimos neque temporibus et dolorem ea. Culpa voluptatem culpa veritatis est sed.', 3, 163.25, 'jouets', 'https://picsum.photos/seed/19426/400/400', 3, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(23, 'et ratione laudantium', 'Sit nostrum quia debitis. Fugit beatae est et doloribus quisquam minus illo voluptatum. Hic unde nam quam. Velit sapiente numquam sed ut.\n\nIllum odio et reiciendis modi ut eveniet aspernatur et. Omnis quia eos voluptatibus illum est minima. Maiores dolorum illum a ea aut laudantium molestiae. Ipsam et quisquam enim enim.\n\nProvident et quod magni id voluptatem. Quisquam expedita voluptatibus delectus sed illum voluptas. Qui expedita vitae voluptatem. Laborum deleniti facere officia cupiditate deserunt. Illum velit sit et ratione aut.', 2, 333.89, 'maison', 'https://picsum.photos/seed/19413/400/400', 3, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(24, 'nulla eos quibusdam sint', 'Nihil minima ut reiciendis autem qui distinctio. Aut consequatur ducimus nesciunt qui. Asperiores qui rerum quidem nulla et saepe. Dolorem labore neque id et consectetur quo nisi.\n\nUnde est explicabo voluptatem ipsam aspernatur in quaerat et. Amet dolorum voluptatem in nostrum qui. Porro est beatae voluptatibus corporis et labore. Nisi deserunt earum dicta voluptate alias culpa. Sunt quasi numquam consequuntur repellat repellendus.', 4, 89.02, 'vêtements', 'https://picsum.photos/seed/44353/400/400', 9, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(25, 'ad atque', 'Nostrum et consequatur iusto corporis consequatur rerum. Itaque itaque et velit adipisci. Dolor vero fuga dolorum. Sed ea consectetur eius perspiciatis rerum quidem aliquam quis.', 5, 437.84, 'électronique', 'https://picsum.photos/seed/10101/400/400', 5, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(26, 'soluta in', 'Animi reiciendis eaque deleniti ea est. Qui vel facere ducimus earum sed qui. Sapiente rerum magnam dolores.', 1, 367.53, 'sport', 'https://picsum.photos/seed/86106/400/400', 3, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(27, 'dolores dolor voluptate a', 'Dolorem consequatur et nihil cupiditate et aut. Sed est nisi est et aut animi nesciunt. Odit eius ipsam accusantium dolore. Quasi aut recusandae laborum non debitis iste sed hic.', 5, 198.15, 'jouets', 'https://picsum.photos/seed/16504/400/400', 10, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(28, 'id qui', 'Voluptatibus facilis quibusdam corporis quam. Et fugit laboriosam illum laboriosam repudiandae nulla rerum. Facilis qui quos et ullam sit iure.', 1, 92.36, 'vêtements', 'https://picsum.photos/seed/87640/400/400', 8, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(29, 'accusamus vero harum ipsam', 'Perspiciatis aliquam qui tempore incidunt. Et incidunt sunt dicta ratione quia.\n\nIllum error quos corporis exercitationem. Rerum eligendi velit dolorum similique. Enim nisi possimus ratione quam et. Vel enim et sed voluptatem sapiente eius.\n\nAut ut non ut voluptatibus consectetur. Rerum non dolore voluptatem quo minima. Fuga quis repudiandae qui officiis. Eius reprehenderit libero voluptatem voluptatem iure corrupti.', 2, 180.61, 'sport', 'https://picsum.photos/seed/7869/400/400', 10, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(30, 'et distinctio aut', 'Quae accusamus facere tempore odio qui ut. Qui dolorum quia rerum accusantium nihil.\n\nNihil dolor rerum necessitatibus atque et quia. Qui quos provident deleniti et. Nesciunt fugiat deserunt qui eum molestiae et. Enim iste quis eum nisi fugiat.', 3, 214.80, 'livres', 'https://picsum.photos/seed/17619/400/400', 6, '2026-06-02 09:07:08', '2026-06-02 09:07:08');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_session_id_index` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_article_id_foreign` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `usage_limit` int UNSIGNED DEFAULT NULL,
  `used_count` int UNSIGNED NOT NULL DEFAULT '0',
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_order_amount`, `usage_limit`, `used_count`, `expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PROMO10', 'percentage', 10.00, 20.00, 100, 0, '2026-09-02 09:07:08', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(2, 'WELCOME5', 'fixed', 5.00, 15.00, 50, 0, '2026-12-02 10:07:08', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(3, 'SUMMER25', 'percentage', 25.00, 50.00, 30, 0, '2026-08-02 09:07:08', 1, '2026-06-02 09:07:08', '2026-06-02 09:07:08');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_26_150939_create_article_table', 1),
(5, '2026_05_26_100001_add_is_admin_to_users_table', 1),
(6, '2026_05_26_100002_create_carts_table', 1),
(7, '2026_05_26_100003_create_cart_items_table', 1),
(8, '2026_05_26_100004_create_coupons_table', 1),
(9, '2026_05_26_100005_create_orders_table', 1),
(10, '2026_05_26_100006_create_order_items_table', 1),
(11, '2026_05_26_100007_create_contacts_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `coupon_id` bigint UNSIGNED DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_coupon_id_foreign` (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_article_id_foreign` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RKfMqoyz1MfstssIWYRojRFKDIm8tN6xfJ0FxVLT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3lDME82Sk1iNW1xcGcyWVJNZGpyb2JEdGNpbkVibEhMRXpNODc0ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780399025);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@amadon.fr', '2026-06-02 09:07:07', '$2y$12$UXJEsJAqdaV0OgFhqCGwxOdmAvtIfb.DqEoFtFaFmJ72SiPckDK0e', 1, 'v6cum3bdGO', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(2, 'Prof. Kameron Moen', 'wilber65@example.net', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'DRV8Wkac17', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(3, 'Melyna Weimann DDS', 'angeline.corwin@example.com', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'DzVe6S9fZ0', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(4, 'Miss Name Champlin Jr.', 'otto69@example.com', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'ndgxnu5KkA', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(5, 'Prof. Terry Hansen', 'klocko.zoie@example.org', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'NbqNbCc0TF', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(6, 'Agustina Gorczany', 'corkery.dana@example.org', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'F2M3uw6wmD', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(7, 'Gwen O\'Kon DVM', 'graham.caitlyn@example.com', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'gQEYZ8W56g', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(8, 'Jacinthe Schmidt', 'mertie10@example.org', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'NxzTzW38sV', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(9, 'Mrs. Natasha Goldner DVM', 'ablick@example.org', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, '8LETPUQUD9', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(10, 'Bonita Reynolds', 'valerie.champlin@example.org', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'TpMmBvffzU', '2026-06-02 09:07:08', '2026-06-02 09:07:08'),
(11, 'Kassandra Wilkinson', 'freida48@example.org', '2026-06-02 09:07:08', '$2y$12$vo09As6K8Xk6P8Ysr9Hmb.XiRE3RLHSZt5UEUVCAY.WdTDgy4ADWm', 0, 'cRHF1O5Gkx', '2026-06-02 09:07:08', '2026-06-02 09:07:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
