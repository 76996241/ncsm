-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-02-02 09:29:47
-- 服务器版本： 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncsm`
--

-- --------------------------------------------------------

--
-- 表的结构 `authoritys`
--

CREATE TABLE `authoritys` (
  `id` int(10) UNSIGNED NOT NULL,
  `cateid` int(5) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `authoritys`
--

INSERT INTO `authoritys` (`id`, `cateid`, `display_name`, `description`, `created_at`, `updated_at`, `uid`) VALUES
(1, 17, '系统管理员', '[[\"9\",\"7\"],[\"27\",\"10\",\"11\",\"28\",\"13\",\"14\",\"33\"],[\"15\",\"23\",\"24\",\"12\",\"16\",\"48\",\"49\",\"50\"],[\"\"]]', '2018-01-15 01:04:59', '2018-01-31 01:29:11', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gages`
--

CREATE TABLE `gages` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduce` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(5) NOT NULL COMMENT '类型分类',
  `hrand` int(5) NOT NULL COMMENT '品牌分类',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览数量',
  `page_tpl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'page类型时模板名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'open',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `gages`
--

INSERT INTO `gages` (`id`, `uid`, `title`, `introduce`, `images`, `type`, `hrand`, `content`, `comment`, `view`, `page_tpl`, `created_at`, `updated_at`, `comment_status`, `status`) VALUES
(40, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(42, 1, '122122122122122122s', '121', 'gage/180131/15173755748709.png', 41, 45, NULL, 0, 0, NULL, '2018-01-30 21:12:54', '2018-01-30 21:29:38', 'open', 1),
(43, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(44, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(45, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(46, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(47, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(48, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(49, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1),
(50, 1, '32323阿尔瓦飞娃儿喂喂喂12222', '121333334444444444444444433呃呃呃', 'news/180130/15172967638099.png', 40, 45, '<p>22222222222222<br/></p>', 0, 0, NULL, '2018-01-29 23:19:23', '2018-01-30 21:34:37', 'open', 1);

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_01_09_022035_create_posts_table', 1),
(2, '2017_01_09_022107_create_post_cates_table', 1),
(3, '2017_01_09_022137_create_post_relationships_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ncnews`
--

CREATE TABLE `ncnews` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduce` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(5) NOT NULL COMMENT '文章类型（post/page/link等）',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览数量',
  `page_tpl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'page类型时模板名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'open',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ncnews`
--

INSERT INTO `ncnews` (`id`, `uid`, `title`, `introduce`, `images`, `type`, `content`, `comment`, `view`, `page_tpl`, `created_at`, `updated_at`, `comment_status`, `status`) VALUES
(42, 1, '212121212121', '12121', 'news/180131/15173880529556.png', 37, '<p>212121</p>', 0, 0, NULL, '2018-01-31 00:40:52', '2018-01-31 00:40:52', 'open', 1);

-- --------------------------------------------------------

--
-- 表的结构 `post_cates`
--

CREATE TABLE `post_cates` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '分类缩略名',
  `sequence` int(2) NOT NULL,
  `taxonomy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '分类方法(category/tags)',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '分类描述',
  `count` int(11) DEFAULT '0' COMMENT '文章数量',
  `uid` int(10) NOT NULL COMMENT '编辑管理员ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `post_cates`
--

INSERT INTO `post_cates` (`id`, `pid`, `name`, `slug`, `sequence`, `taxonomy`, `description`, `count`, `uid`) VALUES
(1, 0, '试题库分类', '试题库分类', 1, NULL, NULL, 0, 1),
(2, 0, '用户组分类', '用户组分类', 1, NULL, NULL, 0, 1),
(3, 0, '权限分类 | 导航', '权限分类', 1, NULL, NULL, 0, 1),
(4, 0, '知识点分类', '知识点分类', 1, NULL, NULL, 0, 1),
(5, 0, '教学资料类型', '教学资料类型', 1, NULL, NULL, 0, 1),
(6, 3, '个人模块', '个人模块', 4, NULL, '/game', 0, 1),
(7, 3, '教学模块', '教学模块', 2, NULL, '/personal', 0, 1),
(8, 3, '大赛模块', '大赛模块', 3, NULL, '/teaching', 0, 1),
(9, 3, '服务管理端', '服务管理端', 1, NULL, '/admin', 0, 1),
(10, 9, '系统管理', 'am-icon-cogs', 2, NULL, '/systems', 0, 1),
(11, 9, '用户管理', 'am-icon-users', 3, NULL, NULL, 0, 1),
(12, 10, '权限管理', 'am-icon-desktop', 4, NULL, '/authority', 0, 1),
(13, 9, '量具教学资源管理', 'am-icon-bar-chart-o', 6, NULL, '/gage', 0, 1),
(14, 9, '题库管理', 'am-icon-tasks', 7, NULL, '/questions', 0, 1),
(15, 10, '平台基础信息设置', '平台基础信息设置', 1, NULL, '/systems', 0, 1),
(16, 10, '分类管理', '分类管理', 5, NULL, '/cate', 0, 1),
(17, 2, '系统管理员', '系统管理员', 1, NULL, '系统管理员', 0, 1),
(18, 2, '普通学员', '普通学员', 1, NULL, NULL, 0, 1),
(19, 2, '比赛选手', '比赛选手', 1, NULL, NULL, 0, 1),
(20, 2, '普通教师', '普通教师', 1, NULL, NULL, 0, 1),
(21, 2, '大赛裁判员', '大赛裁判员', 1, NULL, NULL, 0, 1),
(22, 2, '内容管理员', '内容管理员', 1, NULL, NULL, 0, 1),
(23, 10, '邮件接口设置', '邮件接口设置', 2, NULL, NULL, 0, 1),
(24, 10, '短信接口设置', '短信接口设置', 3, NULL, NULL, 0, 1),
(27, 9, '使用说明书', 'am-icon-file-text-o', 1, NULL, NULL, 0, 1),
(28, 9, '资讯类信息管理', 'am-icon-calendar', 5, NULL, '/news', 0, 1),
(33, 7, 'aaaa', 'aaaa', 1, NULL, NULL, 0, 1),
(34, 8, 'aaaa', 'aaaa', 1, NULL, NULL, 0, 1),
(35, 6, 'aaaa', 'aaaa', 1, NULL, NULL, 0, 1),
(36, 0, '资讯分类', '资讯分类', 1, NULL, NULL, 0, 1),
(37, 36, '系统公告', '系统公告', 1, NULL, NULL, 0, 1),
(38, 36, '行业新闻', '行业新闻', 1, NULL, NULL, 0, 1),
(39, 0, '量具类型分类', '量具类型分类', 1, NULL, NULL, 0, 1),
(40, 39, '标准器具', '标准器具', 1, NULL, NULL, 0, 1),
(41, 39, '通用器具', '通用器具', 1, NULL, NULL, 0, 1),
(42, 39, '专用器具', '专用器具', 1, NULL, NULL, 0, 1),
(43, 0, '量具品牌分类', '量具品牌分类', 1, NULL, NULL, 0, 1),
(44, 43, '青量', '青量', 1, NULL, NULL, 0, 1),
(45, 43, '成量', '成量', 1, NULL, NULL, 0, 1),
(46, 51, '铣削加工', 'CncMilling', 1, NULL, '铣削加工', 0, 1),
(47, 51, '车削加工', 'CncCar', 1, NULL, '车削加工', 0, 1),
(48, 14, '铣削加工试题', '铣削加工试题', 1, NULL, '/CncMilling', 0, 1),
(49, 14, '车削加工试题', '车削加工试题', 1, NULL, '/vehicle?typeone=47', 0, 1),
(50, 14, '大赛试题', '大赛试题', 1, NULL, NULL, 0, 1),
(51, 1, '试题项目分类', 'project', 1, NULL, NULL, 0, 1),
(52, 1, '试题用途分类', 'use', 1, NULL, NULL, 0, 1),
(53, 52, '普通大赛试题', '普通大赛试题', 1, NULL, NULL, 0, 1),
(54, 52, '国赛试题', '国赛试题', 1, NULL, NULL, 0, 1),
(55, 52, '世赛试题', '世赛试题', 1, NULL, NULL, 0, 1),
(56, 52, '普通训练试题', '普通训练试题', 1, NULL, NULL, 0, 1),
(57, 52, '阶段考试试题', '阶段考试试题', 1, NULL, NULL, 0, 1),
(58, 52, '期中考试试题', '期中考试试题', 1, NULL, NULL, 0, 1),
(59, 52, '期末考试试题', '期末考试试题', 1, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `post_relationships`
--

CREATE TABLE `post_relationships` (
  `object_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应文章ID/链接ID',
  `post_cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应分类方法ID',
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `systems`
--

CREATE TABLE `systems` (
  `id` int(1) UNSIGNED NOT NULL,
  `systems_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_smtp` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_smtppass` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_sms` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_smspass` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_keyword` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_copyright` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_slogo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `systems_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `systems`
--

INSERT INTO `systems` (`id`, `systems_name`, `systems_smtp`, `systems_smtppass`, `systems_sms`, `systems_smspass`, `systems_keyword`, `systems_description`, `systems_copyright`, `systems_slogo`, `systems_logo`, `updated_at`) VALUES
(1, 'NCSM - 数控智能测量系统', '', '', '', '', 'NCSM - 数控智能测量系统', 'NCSM - 数控智能测量系统', '<p>北京市斐克百纳教育科技有限责任公司 版权所有</p>', 'logo/systems_slogo.png', 'logo/systems_logo.png', '2017-12-22 02:45:30');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_group` int(5) NOT NULL DEFAULT '1' COMMENT '用户组',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `user_group`, `created_at`, `updated_at`) VALUES
(1, '76996241', '76996241@qq.com', '$2y$10$VqYGxvhAyof.TL6AhdOHBedDJlb16R9byfzOw7yBY6hS/9j9a3.TK', 'QiO0uewQSmShh3xb2EZpH56EPINM5bqiuN0cp4qJjgeq78RhF3fdc445Xwes', 17, '2017-12-10 23:25:05', '2017-12-10 23:25:05'),
(2, '769962415', '769962415@qq.com', '$2y$10$gv3f1lY7H9UOTqeQl9zhw.z0scgm10ABRN0AHlcB417BDkkKrUwCS', 'z4FPQY4VH0b30iAcUWZsYLpnjkEUNFMD6QFia2WWZdlvcweKGetAnokJT4kD', 2, '2017-12-13 19:16:28', '2017-12-13 19:16:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authoritys`
--
ALTER TABLE `authoritys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`cateid`);

--
-- Indexes for table `gages`
--
ALTER TABLE `gages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ncnews`
--
ALTER TABLE `ncnews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_cates`
--
ALTER TABLE `post_cates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `authoritys`
--
ALTER TABLE `authoritys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `gages`
--
ALTER TABLE `gages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `ncnews`
--
ALTER TABLE `ncnews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- 使用表AUTO_INCREMENT `post_cates`
--
ALTER TABLE `post_cates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- 使用表AUTO_INCREMENT `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
