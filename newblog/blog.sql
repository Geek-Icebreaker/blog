-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: 118.123.16.19
-- 生成日期: 2016 年 10 月 05 日 19:07
-- 服务器版本: 5.1.69
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jijiale`
--
CREATE DATABASE `jijiale` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jijiale`;

-- --------------------------------------------------------

--
-- 表的结构 `blog_admin`
--

CREATE TABLE IF NOT EXISTS `blog_admin` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` char(32) CHARACTER SET utf8 NOT NULL,
  `login_time` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_admin_nav`
--

CREATE TABLE IF NOT EXISTS `blog_admin_nav` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(20) CHARACTER SET utf8 NOT NULL,
  `state` varchar(10) CHARACTER SET utf8 DEFAULT NULL COMMENT '菜单默认初始状态',
  `iconCls` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '显示的图片',
  `children` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '菜单子元素',
  `nid` int(8) DEFAULT NULL,
  `url` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '前台加载的控制器地址',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_article`
--

CREATE TABLE IF NOT EXISTS `blog_article` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_title` varchar(255) DEFAULT NULL,
  `a_intro` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `a_content` text,
  `a_views` varchar(11) CHARACTER SET utf8 DEFAULT '1',
  `a_comments` int(11) DEFAULT '0',
  `a_type` int(1) DEFAULT NULL,
  `a_author` varchar(25) DEFAULT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `a_commend` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_article_cate`
--

CREATE TABLE IF NOT EXISTS `blog_article_cate` (
  `cate_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_comment`
--

CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `aid` int(11) DEFAULT NULL COMMENT '评论的文章id',
  `comment` text CHARACTER SET utf8,
  `comment_time` varchar(11) CHARACTER SET utf8 DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=103 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_links`
--

CREATE TABLE IF NOT EXISTS `blog_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_members`
--

CREATE TABLE IF NOT EXISTS `blog_members` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '用户登录名',
  `password` char(32) CHARACTER SET utf8 NOT NULL COMMENT '用户登录密码',
  `email` varchar(30) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `reg_time` int(30) NOT NULL DEFAULT '0',
  `login_time` int(30) NOT NULL DEFAULT '0',
  `login_ip` int(10) NOT NULL DEFAULT '0',
  `faceSrc` text COMMENT '管理员头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=97 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
