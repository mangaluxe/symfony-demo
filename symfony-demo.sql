-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 18 sep. 2019 à 12:44
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony-demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image`, `created_at`, `category_id`) VALUES
(36, 'Titre corrigé', '<p>Facilis beatae quidem tenetur quidem et accusantium officia pariatur. Enim quasi et omnis molestiae maxime. Autem aspernatur voluptates rem nemo quod quos. Excepturi quia nisi at enim aut vel sint.</p><p>Odit sed voluptatem explicabo nulla natus est quaerat. Voluptatum at modi enim repellendus fugiat hic. Sunt perferendis ipsum impedit reprehenderit non.</p><p>Corrupti ea tempora sed quia aliquid. Cupiditate rerum eaque rerum possimus et sint optio. Libero ut amet mollitia officia quo animi quas deserunt. Fuga cumque tempore et et nihil eius odit.</p><p>Dolores voluptatem aut minima tempora officiis ex. Ad alias porro impedit rem rerum voluptas. Aut iste tempora nihil quidem. Iste fugit omnis voluptates ut sint.</p><p>Aliquid hic non eum non omnis odio. Deleniti explicabo tenetur quis minima enim minima voluptatem. Suscipit dolorem et sit eligendi.</p>', 'https://lorempixel.com/640/480/?40368', '2019-09-04 12:50:29', 3),
(37, 'Je suis un titre créé', '<p>Possimus ut sed sit ut. Consequatur explicabo autem provident. Rerum doloremque omnis dolorum repellat commodi consequuntur. Dicta ullam necessitatibus sint ullam architecto temporibus assumenda.</p><p>Ut vitae laudantium quasi doloremque eum. Error velit consequatur necessitatibus excepturi. Sit ipsa ab ducimus soluta. Maxime voluptatum eos occaecati repellendus minima magnam rem.</p><p>Asperiores qui tenetur autem vitae ducimus. Earum hic deleniti harum error. Magnam sed eos quibusdam ad consequatur illum quo. Aut facilis consequuntur voluptatem illum.</p><p>Fuga eos qui repudiandae tempore voluptatum incidunt. Veritatis quis eos voluptas alias earum accusamus. Voluptas omnis impedit sunt et impedit. Fuga minima aliquid iusto quo est.</p><p>Molestias quasi quae omnis sed. Nostrum ex sit amet fuga. Quia harum adipisci officiis dolorem. Eaque quas occaecati id repellendus eos laboriosam.</p>', 'https://lorempixel.com/640/480/?38005', '2019-04-27 00:43:00', 1),
(38, 'Je suis 1 article créé par moi-meme !', 'Je suis une description qui ne sert à rien !', 'https://lorempixel.com/400/200/sports/1/', '2019-09-17 16:24:07', 3),
(40, 'Super titre', 'Je suis une description pour tester !', 'https://lorempixel.com/400/200/sports/3/', '2019-09-17 16:24:56', 3),
(44, 'Poubelle article', 'Je suis un article de santé', 'https://lorempixel.com/400/200/sports/7/', '2019-09-18 10:01:06', 3);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(1, 'Nature', 'In laborum dolor voluptates dolor et dolorem. Iusto modi at dolorem similique molestiae corporis omnis nostrum. Labore quidem iste quod exercitationem modi minus. Libero eum iusto at iste tempora ducimus placeat.'),
(2, 'Culture', 'Voluptas eveniet qui voluptates ut iste impedit itaque. Ab magni est qui blanditiis impedit quo. Ea provident tenetur itaque ad. Eligendi quo impedit dolor omnis non accusamus fuga.'),
(3, 'Santé', 'Pariatur praesentium consequatur eos repellendus adipisci. Odit repudiandae nihil et nihil sit dignissimos repellendus. Odio est quod est. Fuga perferendis nisi alias officia doloremque ut. Placeat sit asperiores pariatur iste ratione.');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `author`, `content`, `created_at`) VALUES
(68, 36, 'Louis Fouquet', '<p>Sunt nulla laborum odio nesciunt aliquam. Sint tenetur autem aut hic qui. Error magnam autem rem deleniti qui consequuntur molestiae. Repellat autem quaerat rerum vel omnis quos.</p><p>Optio neque explicabo dolores est voluptas dolore dignissimos ducimus. Est earum libero deserunt rerum. Ut nihil voluptas fuga nulla sunt. Magnam quod quis temporibus sit ut culpa unde autem.</p>', '2019-09-06 07:59:20'),
(69, 36, 'David Bonneau', '<p>Architecto voluptas rerum natus itaque ut perferendis in. Optio aspernatur corrupti esse ducimus veniam reprehenderit. Eligendi eum animi eius vel.</p><p>Est ducimus iusto explicabo earum consequatur et. Rerum et corrupti nulla non iusto sunt. In odio repellendus officiis laborum.</p>', '2019-09-08 16:30:14'),
(70, 36, 'Sylvie Boucher', '<p>Accusantium odit et vero sit accusantium in earum. Nobis quas nesciunt voluptatem ad eveniet fugit et. Officia molestiae nostrum sint molestiae.</p><p>Cum quidem ea rem quae. Animi placeat ipsa labore. Quia dolorem beatae quia ipsam incidunt est quo culpa. Eaque corrupti ut quis aut magni dolores ea dolores.</p>', '2019-09-16 02:24:52'),
(71, 36, 'Philippe du Martineau', '<p>Reprehenderit temporibus cumque minima incidunt. At ullam nam distinctio aut animi dicta occaecati ut. Omnis nostrum earum dolores.</p><p>Ab voluptas et provident consequatur officiis qui necessitatibus eaque. Et magnam nam unde et veritatis tempore. Voluptatibus debitis eligendi quae qui voluptas. Pariatur tenetur ut totam est sit quia rem.</p>', '2019-09-12 21:18:52'),
(72, 36, 'Tristan Navarro', '<p>Et tenetur quia autem et quod esse vero. Laboriosam voluptas a impedit doloremque. Et consequatur ut neque. Beatae quo quis ea ut minus molestias sequi cupiditate. Qui aperiam distinctio ipsam rerum sunt ad.</p><p>Fugit fugit dolores temporibus eaque. Ipsa mollitia ut ipsa aut tempore. Quidem enim soluta omnis laudantium repudiandae et non.</p>', '2019-09-17 13:08:43'),
(73, 36, 'Jeanne Labbe-Boulay', '<p>Ratione eaque aliquam quis nulla. Reprehenderit consequatur recusandae doloremque libero. Optio similique et autem nulla ratione voluptas corrupti veritatis.</p><p>Fugit delectus corporis inventore cupiditate itaque laudantium. Voluptas ut repellendus accusamus. Optio sunt placeat assumenda atque dolor consectetur est voluptas. Dolore et praesentium ratione ex similique ab nam.</p>', '2019-09-08 22:03:50'),
(74, 36, 'Brigitte Bruneau-Caron', '<p>Quibusdam facilis consequuntur animi nisi quas modi itaque. Aut porro libero qui.</p><p>Omnis voluptatem quasi dolor. Possimus fuga voluptatum dolore enim similique. Iste officia possimus voluptas sunt.</p>', '2019-09-04 18:05:25'),
(75, 37, 'Andrée Valentin', '<p>Id officia animi ut magni mollitia. Qui error architecto recusandae nemo laborum nesciunt. Sint voluptatibus ipsum sequi temporibus. Earum quae ut quisquam ratione voluptatibus autem quis qui. Illum dolores consequuntur recusandae enim molestiae sed.</p><p>Dolor voluptatem quo sint. Omnis ipsum doloremque amet nulla deserunt reprehenderit.</p>', '2019-05-19 10:47:27'),
(76, 37, 'Éléonore-Suzanne Lesage', '<p>Molestias ipsum aliquid in libero aut repellendus earum. Quidem rerum beatae eum quam sit. Quos sunt et voluptate assumenda.</p><p>Vero et est dolorem recusandae dolores. Molestias ut voluptatem temporibus cupiditate. Fuga sapiente corrupti excepturi doloremque. Iste omnis aut hic cum.</p>', '2019-07-09 21:03:38'),
(77, 37, 'Agnès Guibert', '<p>Ut sit quam est enim eos dolore. Totam ex non saepe. Cumque asperiores dolorem consequatur ut quia eos. Adipisci ut ea et rerum enim voluptate.</p><p>Saepe quo maiores repellendus et. Voluptatem veniam cupiditate et ut amet exercitationem nihil ut. Ducimus voluptas animi aut. Eum a incidunt voluptate illo.</p>', '2019-08-02 22:13:50'),
(78, 37, 'Lucy Grenier', '<p>Pariatur velit cum sequi id. Molestiae illo nemo veniam amet. Eum iste reprehenderit fugiat vero error labore. Fugiat tempora in animi occaecati dolor nulla repudiandae dignissimos.</p><p>Totam eum aut in quae. Voluptas harum nesciunt voluptates tempore. Sit perspiciatis totam reprehenderit voluptas delectus magni blanditiis.</p>', '2019-06-01 07:28:15'),
(79, 37, 'Denise Vidal', '<p>Commodi impedit odio non magni unde. Occaecati velit similique aut non. Voluptas nobis impedit dolor aut.</p><p>Excepturi quis nihil repellat maxime eaque recusandae qui. Soluta ut similique id et consequatur. Velit eos illum quaerat est.</p>', '2019-04-29 16:52:30'),
(80, 37, 'Élodie de Gaudin', '<p>Voluptatibus quam pariatur aperiam sint est qui commodi. Eius quod iure et in est quo vel. Culpa hic qui et voluptas sit quibusdam qui. Quibusdam quia in natus aspernatur eligendi. Recusandae et excepturi nostrum dolorum quae exercitationem nam libero.</p><p>Culpa cumque illo ipsum omnis error ipsam consequatur. Mollitia atque sapiente quisquam voluptatem aut praesentium hic. Recusandae sed ad incidunt incidunt sunt corporis fugiat expedita. Porro doloremque vel quia vel. Qui at et reprehenderit minus pariatur.</p>', '2019-06-05 03:59:31'),
(81, 37, 'Nathalie Lemaitre', '<p>Quia et aliquam quo voluptatum. Cum non dolorum id provident quia a maiores velit. Quod sunt dolor eum quo et. Est nam voluptatibus nisi.</p><p>Necessitatibus doloribus quidem quibusdam aliquid modi nihil. Exercitationem et alias fugiat rerum. Voluptas amet aperiam similique sed eius.</p>', '2019-08-12 06:34:39'),
(82, 36, 'Moi', 'Je teste un commentaire', '2019-09-18 12:30:07');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190916125018', '2019-09-16 12:52:20'),
('20190917120014', '2019-09-17 12:03:46'),
('20190917121411', '2019-09-17 12:15:02'),
('20190917143700', '2019-09-17 14:37:44');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(1, '1234@1234.fr', '1234', '$2y$13$zR4Juuqs9FF4hwT/Q3hPs.ZRJD1qyA1Agh1bTnlOMHP3uQQDq86Vy'),
(3, '123456@123456.fr', '123456', '$2y$13$yp8q3qmacSI2GgIpuVALEeQcdwoNW2HddmrvkvCEd3DlNMSaRukay');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E6612469DE2` (`category_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C7294869C` (`article_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
