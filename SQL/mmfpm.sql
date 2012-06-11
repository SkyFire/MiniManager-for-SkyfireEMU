-- Database: mmfs

--
-- Table structure for table `mmfs_forum_posts`
--

DROP TABLE IF EXISTS `mmfs_forum_posts`;

CREATE TABLE `mmfs_forum_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `authorid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `authorname` varchar(16) NOT NULL DEFAULT '',
  `forum` bigint(20) unsigned NOT NULL DEFAULT '0',
  `topic` bigint(20) unsigned NOT NULL DEFAULT '0',
  `lastpost` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `text` longtext,
  `time` varchar(255) NOT NULL,
  `annouced` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sticked` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `closed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mmfs_forum_posts`
--

LOCK TABLES `mmfs_forum_posts` WRITE;
/*!40000 ALTER TABLE `mmfs_forum_posts` DISABLE KEYS */;
INSERT INTO `mmfs_forum_posts`(`id`,`authorid`,`authorname`,`forum`,`topic`,`lastpost`,`name`,`text`,`time`,`annouced`,`sticked`) values
(1,0,'miniManagerTeam',1,1,1,'Hello Admin!','[b]Hi[/b] !!:D<br /><br />If you are reading this, that means that you have [i]correctly[/i] installed this forum, XD<br /><br /><br /><br />So what\' s next?<br /><br />Edit [color=red]forum.conf.php[/color]<br /><br /><br /><br />And enjoy!<br /><br /><br /><br />Report bugs at [url=http://www.trintiyscripts.xe.cx]miniManager forums[/url]<br /><br /><br /><br />Bye!<br /><br />miniManagerTeam','00/00/00 00:00:00',1,0);
/*!40000 ALTER TABLE `mmfs_forum_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mmfs_motd`
--

DROP TABLE IF EXISTS `mmfs_motd`;

CREATE TABLE `mmfs_motd` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `realmid` int(11) NOT NULL,
  `type` longtext NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='MOTD System';

--
-- Dumping data for table `mmfs_motd`
--

LOCK TABLES `mmfs_motd` WRITE;
/*!40000 ALTER TABLE `mmfs_motd` DISABLE KEYS */;
INSERT INTO `mmfs_motd` VALUES (1, 1, '02/05/10 14:29:07 Posted by: MiniManager Team', 'Hello Admin\r\n\r\nhelp supporting Minimanager\r\n\r\nhttp://www.trinityscripts.xe.cx\r\n\r\nif you found a bug or improved it, please contribute\r\n\r\nor it will eventually stop development from lack of interrest from community ');
/*!40000 ALTER TABLE `mmfs_motd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mmfs_point_system_invites`
--

DROP TABLE IF EXISTS `mmfs_point_system_invites`;
CREATE TABLE `mmfs_point_system_invites` (
  `entry` int(11) NOT NULL auto_increment,
  `PlayersAccount` char(50) default NULL,
  `InvitedBy` char(50) default NULL,
  `InviterAccount` char(50) default NULL,
  `Treated` int(1) NOT NULL default '0',
  `Rewarded` int(1) NOT NULL default '0',
  UNIQUE KEY `entry` (`entry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `mmfs_account`
--

DROP TABLE IF EXISTS `mmfs_account`;

CREATE TABLE `mmfs_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `username` varchar(32) NOT NULL DEFAULT '',
  `sha_pass_hash` varchar(40) NOT NULL DEFAULT '',
  `sessionkey` longtext,
  `v` longtext,
  `s` longtext,
  `email` text,
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_ip` varchar(30) NOT NULL DEFAULT '127.0.0.1',
  `failed_logins` int(11) unsigned NOT NULL DEFAULT '0',
  `locked` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `expansion` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mutetime` bigint(40) unsigned NOT NULL DEFAULT '0',
  `locale` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `authkey` varchar(40) DEFAULT '',
    PRIMARY KEY (`id`),
  UNIQUE KEY `idx_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Account System';