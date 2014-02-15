DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `answer` text NOT NULL,
  `source` varchar(1024) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `answerscategories`;
CREATE TABLE `answerscategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `answerscategories` (`id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`) VALUES
(1,	0,	1,	10,	'Root',	'2014-02-11 12:07:21',	'2014-02-11 12:07:21'),
(2,	2,	2,	3,	'General',	'2014-02-11 12:07:50',	'2014-02-11 12:07:50'),
(3,	2,	4,	5,	'Cakephp',	'2014-02-11 12:08:19',	'2014-02-11 12:08:19'),
(4,	2,	6,	7,	'Javascript',	'2014-02-11 12:08:33',	'2014-02-11 12:08:33'),
(5,	2,	8,	9,	'Php',	'2014-02-11 12:08:52',	'2014-02-11 12:08:52');

DROP TABLE IF EXISTS `best_answers`;
CREATE TABLE `best_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `favorite_questions`;
CREATE TABLE `favorite_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `point_events`;
CREATE TABLE `point_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(256) NOT NULL,
  `model` varchar(256) NOT NULL,
  `points` int(10) unsigned NOT NULL,
  `code` varchar(16) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `point_events` (`id`, `description`, `model`, `points`, `code`, `created`, `modified`) VALUES
(1,	'Points for asking a new question.',	'Point',	5,	'askquestion',	'2012-07-21 19:50:38',	'2012-07-21 19:50:41'),
(2,	'Points for answering a question',	'Point',	2,	'answer',	'2012-07-21 20:02:43',	'2012-07-21 20:02:43'),
(3,	'Points for choosing the best answer',	'Point',	3,	'bestanswer',	'2012-07-23 15:23:20',	'2012-07-23 15:23:23'),
(4,	'Points for giving the best answer',	'Point',	10,	'youranswerbest',	'2012-07-23 15:23:49',	'2012-07-23 15:23:52'),
(5,	'Question reporteed as abuse',	'Point',	10,	'reported',	'2012-07-31 09:48:16',	'2012-07-31 09:48:16');

DROP TABLE IF EXISTS `points`;
CREATE TABLE `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `point_event_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `model_foreign_key` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `point_event_id` (`point_event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(256) NOT NULL,
  `message` text NOT NULL,
  `answer_count` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('open','resolved','deleted') NOT NULL DEFAULT 'open',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user_answer_profiles`;
CREATE TABLE `user_answer_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(256) NOT NULL,
  `avatar_option` tinyint(3) unsigned NOT NULL,
  `show_link_profile` tinyint(1) NOT NULL,
  `allow_contact` tinyint(1) NOT NULL,
  `allow_fans` tinyint(1) NOT NULL,
  `notify_question_answered` tinyint(1) NOT NULL,
  `notify_friend_asks` tinyint(1) NOT NULL,
  `notify_new_fan` tinyint(1) NOT NULL,
  `subscribe_newsletter` tinyint(1) NOT NULL,
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE `user_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `from_points` int(10) unsigned NOT NULL,
  `question_limit` tinyint(3) unsigned NOT NULL,
  `answer_limit` tinyint(3) unsigned NOT NULL,
  `favorite_question_limit` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user_statistics`;
CREATE TABLE `user_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_level_id` int(10) unsigned NOT NULL DEFAULT '1',
  `points` int(10) unsigned NOT NULL DEFAULT '100',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
