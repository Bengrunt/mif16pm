--
-- Serveur: sql2.power-heberg.net
-- Base de données: `adriangaudebert3`
-- Script d'insertion dans les tables
--

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created`) VALUES
(1, 'Fête de la saucisse', 'Projet d''organisation de la fête de la saucisse de Strasbourg à Muflin', '2009-09-01 15:32:52'),
(2, 'MIF12 : Compilateur CELL', 'Projet de développement d''un compilateur pour processeur CELL', '2009-10-15 22:18:00'),
(3, 'Championnats intercommunaux de course en sac','Organisation des championnats intercommunaux de course en sac', '2009-06-22 15:51:28'),
(4, 'Projet Historia', 'Mise en place de cérémonie pour l''anniversaire du débarquement','2009-08-25 10:20:00'),
(5, 'Projet MIF16 : PROUT', 'Amélioration du projet PROUT', '2009-11-20 06:45:23');

-- --------------------------------------------------------

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'site_user'),
(2, 'site_admin'),
(3, 'team_admin'),
(4, 'team_user'),
(5, 'project_admin'),
(6, 'project_user');


-- --------------------------------------------------------

--
-- Contenu de la table `tasks`
--

-- --------------------------------------------------------

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `project_id`, `created`, `modified`) VALUES
(1, 'Equipe Sauvigny', 'Gestion des stands', 1, '2009-09-11 19:51:19', '2009-10-11 12:51:19'),
(2, 'Equipe Tangerine', 'Gestion des entrées', 1, '2009-09-23 22:15:23', '2009-10-09 22:22:16'),
(3, 'Equipe Damoclès', 'Gestion de la sécurité', 1, '2009-09-16 13:48:03', '2009-09-16 13:48:03'),
(4, 'MIF12 : CELL', 'Les developpeurs du projet MIF12 : CELL', 2, '2009-10-15 23:12:36', '2009-11-20 19:50:10'),
(5, 'Equipe Logistique', 'Gestion de la logistique de l''évenement', 3, '2009-06-23 19:51:19', '2009-10-11 19:52:50'),
(6, 'Equipe Communication', 'Gestion de la communication autour de l''évenement', 3, '2009-06-22 16:32:02', '2009-11-02 23:12:53'),
(7, 'Equipe Sanitaire','Gestion de l''aspect sanitaire de l''évenement', 3, '2009-06-22 16:32:02', '2009-07-08 09:02:42'),
(8, 'Historia : vétérans', 'Sauvegarde des mémoires des vétérans', 4, '2009-08-28 18:28:41', '2009-08-28 18:28:41'),
(9, 'Historia : comité historique', 'Expertise historique', 4, '2009-08-28 18:32:17', '2009-09-22 17:45:12'),
(10, 'Historia : équipe technique', 'Gestion des aspects techniques du projet', '2009-08-30 16:52:14', '2009-10-12 19:56:42'),
(11, 'PROUT : l''équipe', 'Developpement de PROUT', 5, '2009-11-20 6:52:01', '2009-11-20 07:23:56');

-- --------------------------------------------------------

--
-- Contenu de la table `tasks_teams`
--

-- --------------------------------------------------------

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `lastname`, `password`, `role_id`) 
VALUES
(1, 'root', 'PROUT', 'Admin', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 2),
(2, 'mAn', 'Emmanuel', 'GAUDE', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(3, 'bengrunt', 'Benjamin', 'GUILLON', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(4, 'mafy', 'Mamy', 'RAMINOSOA', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(5, 'hbmanu', 'Emmanuel', 'HALTER', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(6, 'lajoie', 'Adrian', 'GAUDEBERT', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1), 
(7, 'rbardoux', 'Robert', 'BARDOUX', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(8, 'jc', 'Jean-Claude', 'Chigne', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(9, 'guyguy', 'Guy', 'GEORGES', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(10, 'mickey', 'Mickaël', 'Delport', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(11, 'jeff', 'Jeff', 'Barbarosa', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(12, 'annie_c', 'Annie', 'Colbert', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(13, 'jess', 'Jessica', 'Alba', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(14, 'Bob_lol', 'Bobby', 'Starkson', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(15, 'JonDoe', 'Jon', 'Doe', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(16, 'RStallman', 'Richard', 'Stallman', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(17, 'theHand', 'La', 'Cho Se', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(18, 'Raymond', 'Raymond', 'HENRY', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(19, 'omaha1944', 'Alphonse', 'BROWN', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(20, 'Jamy', 'James', 'McCornick', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(21, 'dédé_du_90', 'Denis', 'Von Lübeck', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(22, 'wally', 'W.', 'Sheridan', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(23, 'Mock', 'Perry', 'RHODANE', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(24, 'super_c', 'Rémi', 'AUDUON', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),;

-- --------------------------------------------------------

--
-- Contenu de la table `teams_users`
--
INSERT INTO `teams_users` (`team_id`, `user_id`, `role_id`) VALUES
(1, 7, 3), (1, 9, 4), (1, 10, 4),
(2, 9, 3), (2, 6, 4), (2, 8, 4), (2, 10, 4),
(3, 10, 3), (3, 6, 4), (2, 7, 4),
(4, 15, 3), (4, 16, 4), (4, 17, 4),
(5, 11, 3), (5, 14, 4),
(6, 12, 3), (6, 14, 4), (6, 13, 4),
(7, 11, 3), (7, 12, 4), (7, 13, 4),
(8, 5, 3), (8, 20, 4), (8, 18, 4),
(9, 20, 3), (9, 21, 4), (9, 22, 4), (9, 23, 4),
(10, 23, 3), (10, 19, 4),
(11, 3, 3), (11, 2, 4), (11, 4, 4), (11, 5, 4), (11, 6, 4), (11, 24, 4)
;

--
-- Contenu de la table `projects_users`
--
INSERT INTO `projects_users` (`project_id`, `user_id`, `role_id`) VALUES
(1, 7, 5), (1, 8, 6), (1, 9, 6), (1, 10, 6),(1, 6, 6),
(2, 15, 5), (2, 16, 6), (2, 17, 6),
(3, 11, 5), (3, 12, 6), (3, 13, 6), (3, 14, 6),
(4, 5, 5), (4, 18, 6), (4, 19, 6), (4, 20, 6), (4, 21, 6), (4, 22, 6), (4, 23, 6),
(5, 3, 5), (5, 2, 6), (5, 4, 6), (5, 5, 6), (5, 6, 6), (5, 24, 6),
;

--
-- Contenu de la table `tasks_users`
--

--INSERT INTO `tasks_users` (`task_id`, `user_id`) VALUES
--(1,1), (1,3), (1,4), (1,5);
