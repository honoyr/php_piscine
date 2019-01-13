-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: folkmade.mysql.ukraine.com.ua
-- Generation Time: May 20, 2012 at 11:06 PM
-- Server version: 5.1.56-log
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `folkmade_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `_blog`
--

CREATE TABLE IF NOT EXISTS `_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brief_wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `brief_html` text COLLATE utf8_unicode_ci NOT NULL,
  `content_wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `content_html` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `comments` mediumint(5) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `disabled` (`disabled`),
  KEY `timestamp` (`timestamp`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `_fails`
--

CREATE TABLE IF NOT EXISTS `_fails` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_menu`
--

CREATE TABLE IF NOT EXISTS `_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` smallint(3) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `disabled` (`disabled`),
  KEY `parent_id` (`parent_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `_menu`
--

INSERT INTO `_menu` (`id`, `parent_id`, `title`, `link`, `position`, `disabled`) VALUES
(5, 0, 'Каталог', './', 6, 0),
(9, 0, 'О нас', 'about', 5, 0),
(7, 0, 'Контакты', 'contact', 1, 0),
(10, 0, 'Отзывы', 'testimonials', 2, 0),
(13, 0, 'Новости', 'blog', 4, 0),
(14, 0, 'Доставка и оплата', 'dostavka-i-oplata', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_orders`
--

CREATE TABLE IF NOT EXISTS `_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `cart` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `paymethod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `step` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `_pages`
--

CREATE TABLE IF NOT EXISTS `_pages` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_pages`
--

INSERT INTO `_pages` (`id`, `key`, `value`) VALUES
(1, 'name', 'index'),
(1, 'title', 'Интернет-магазин {SITE_NAME}'),
(3, 'name', 'about'),
(3, 'title', 'О нас'),
(3, 'content_wiki', ''),
(20, 'dynamic', '0'),
(3, 'content_html', ''),
(3, 'dynamic', '0'),
(1, 'content_wiki', ''),
(1, 'content_html', ''),
(1, 'keywords', ''),
(1, 'description', ''),
(3, 'keywords', ''),
(3, 'description', ''),
(17, 'dynamic', 'on'),
(17, 'name', 'order'),
(17, 'email', 'sales@site.com.ua'),
(18, 'email', 'Sasha20043@mail.ru'),
(18, 'name', 'testimonial'),
(18, 'dynamic', 'on'),
(24, 'dynamic', '1'),
(24, 'description', ''),
(24, 'content_html', ''),
(24, 'keywords', ''),
(24, 'title', 'Новости'),
(24, 'content_wiki', ''),
(24, 'name', 'blog'),
(20, 'name', 'contact'),
(20, 'title', 'Контакты'),
(20, 'content_wiki', '++ Контакты\n\n\nСвязаться с нами вы можете любым удобным для вас способом:\n\nТел.:\n\n+++ {PHONE}   \n\n+++{PHONE2}\n\n\nE-mail : {MAILTO}\n\n\n\n\n\n'),
(20, 'content_html', '<h2 id="toc0"> Контакты</h2><p>Связаться с нами вы можете любым удобным для вас способом:</p><p>Тел.:</p><h3 id="toc1"> {PHONE}</h3><h3 id="toc2">{PHONE2}</h3><p>E-mail : {MAILTO}</p>'),
(20, 'keywords', ''),
(20, 'description', ''),
(13, 'name', 'admin/howto/wiki'),
(13, 'title', 'Wiki-разметка'),
(13, 'content_wiki', '+ HowTo: Wiki-разметка\n\n[[toc]]\n\n++ Что это такое\nЭто искусственный язык разметки гиппертекста. Он на порядок легче HTML, имеет низкий порог вхождения, удобночитаем и легок в поддержке.\n\n++ Зачем она нам\nWiki-разметка используется главным образом для поддержания единообразие страниц сайта. Также она упрощает оформление текста, так как она гораздо проще HTML, имеет удобночитаемый вид. После изучения всех возможностей этой разметки и работы с ней некоторое время, вы станете удивляться, как же вы обходились без нее раньше.\n\n++ Описание основных элементов разметки\nНиже приведены примеры использования разметки и результаты их выполнения.\n\n+++ Заголовки\n<code>\n+++ Уровень 3. Заголовок\n++++ Уровень 4. Заголовок\n+++++ Уровень 5. Заголовок\n++++++ Уровень 6. Заголовок\n</code>\n+++ Уровень 3. Заголовок\n++++ Уровень 4. Заголовок\n+++++ Уровень 5. Заголовок\n++++++ Уровень 6. Заголовок\n\n+++ Абзацы\n<code>\nПервый абзац.\n \nА это уже второй абзац.\n</code>\n\nПервый абзац.\n\nА это уже второй абзац.\n\n+++ Списки\n++++ Маркированные\n<code>\n* элемент списка\n* элемент списка\n * вложенный элемент списка\n * вложенный элемент списка\n* элемент списка\n</code>\n* элемент списка\n* элемент списка\n * вложенный элемент списка\n * вложенный элемент списка\n* элемент списка\n\n++++ Нумерованные\n<code>\n# элемент списка\n# элемент списка\n # вложенный элемент списка\n # вложенный элемент списка\n# элемент списка\n</code>\n# элемент списка\n# элемент списка\n # вложенный элемент списка\n # вложенный элемент списка\n# элемент списка\n\n++++ Смешанные\n<code>\n# элемент списка\n# элемент списка\n * вложенный элемент списка\n * вложенный элемент списка\n# элемент списка\n</code>\n# элемент списка\n# элемент списка\n * вложенный элемент списка\n * вложенный элемент списка\n# элемент списка\n\n+++ Ссылки\n<code>\nhttp://www.site.com\n[http://www.site.com Внешняя ссылка]\n[./admin Внутренняя ссылка]\n</code>\nhttp://www.site.com\n[http://www.site.com Внешняя ссылка]\n[./admin Внутренняя ссылка]\n\n+++ Изображения\n<code>\nhttp://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg\n[http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg Эйнштейн]\n</code>\nhttp://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg\n[http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg Эйнштейн]\n\n+++ Таблицы\n<code>\n|| Cell 1 || Cell 2 ||\n|| Cell 3 || Cell 4 ||\n</code>\n|| Cell 1 || Cell 2 ||\n|| Cell 3 || Cell 4 ||\n\n<code>\n||< left ||= center ||> right ||\n|| The quick brown || fox jumps over || the lazy dog. ||\n</code>\n||< left ||= center ||> right ||\n|| The quick brown || fox jumps over || the lazy dog. ||\n\n<code>\n|| lines must start and end || with double vertical bars || nothing ||\n|| cells are separated by || double vertical bars || nothing ||\n|||| you can span multiple columns by || starting each cell ||\n|| with extra cell |||| separators ||\n|||||| but perhaps an example is the easiest way to see ||\n</code>\n|| lines must start and end || with double vertical bars || nothing ||\n|| cells are separated by || double vertical bars || nothing ||\n|||| you can span multiple columns by || starting each cell ||\n|| with extra cell |||| separators ||\n|||||| but perhaps an example is the easiest way to see ||\n\n+++ Горизонтальная линия\n<code>\n----\n</code>\n----\n\n+++ Содержание\nГенерирует содержание данной статьи на основе заголовков. Содержание содержит ссылки для быстрого перехода к каждому заголовку.\n<code>\n[[toc]]\n</code>\n\nПример содержания можно увидеть в начале данной статьи.\n\n+++ Центрирование текста\nЛюбая строка, начинающаяся со знака "равно".\n<code>\n= Строка по центру\n</code>\n= Строка по центру\n\n+++ Выделения\n<code>\n**Bold** ''''italic'''' {{teletype text}} //emphasis// __underline__\n</code>\n**Bold** ''''italic'''' {{teletype text}} //emphasis// __underline__\n\n+++ Цвет текста\n<code>\n##ffca00|Оранжевый текст##\n</code>\n##ffca00|Оранжевый текст##\n\n+++ Разрыв строки\nСостоит из пробела и знака подчеркивания. Ставится в конце строки. Используется когда часть текста нужно перенести на новую строку, не создавая новый абзац и не разрушая разметочный блок.\n<code>\n* элемент списка #1\n* элемент списка #1\n* элемент списка #1, следующий текст которого должен распологаться _\nна новой строке\n* элемент списка #1\n</code>\n* элемент списка #1\n* элемент списка #1\n* элемент списка #1, следующий текст которого должен распологаться _\nна новой строке\n* элемент списка #1\n\nИначе список разобьется на два:\n<code>\n* элемент списка #2\n* элемент списка #2\n* элемент списка #2, следующий текст которого должен распологаться\nна новой строке\n* это уже элемент списка #3\n* элемент списка #3\n</code>\n* элемент списка #2\n* элемент списка #2\n* элемент списка #2, следующий текст которого должен распологаться\nна новой строке\n* это уже элемент списка #3\n* элемент списка #3\n\n+++ Текст, который не нужно размечать\nТекст, заключенный с обеих сторон двумя обратными кавычками, не будет рассматриваться на наличие в нем разметочных тегов. Используется чтобы экранировать сочитания символов, совпадающие с элементами разметки.\n<code>\n`` ++ = текст выведется как есть: [[toc]] **bold** ... etc. ``\n</code>\n`` ++ = текст выведется как есть: [[toc]] **bold** ... etc. ``\n\n++ Примечание\nДанная разметка может иметь отличия от других Wiki-разметок, в частности от MediaWiki, которая используется в Википедии. Также в разметку погут быть внесены корректировки по усмотрению администратора.'),
(13, 'content_html', '<h1 id="toc0"> HowTo: Wiki-разметка</h1><table\nborder="0" cellspacing="0" cellpadding="0"><tr><td><div\nid="toc"><strong>Содержание</strong><div\nstyle="margin-left: -1em;"><a\nhref="{URL_THIS}#toc0"> HowTo: Wiki-разметка</a></div><div\nstyle="margin-left: 0em;"><a\nhref="{URL_THIS}#toc1"> Что это такое</a></div><div\nstyle="margin-left: 0em;"><a\nhref="{URL_THIS}#toc2"> Зачем она нам</a></div><div\nstyle="margin-left: 0em;"><a\nhref="{URL_THIS}#toc3"> Описание основных элементов разметки</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc4"> Заголовки</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc5"> Уровень 3. Заголовок</a></div><div\nstyle="margin-left: 2em;"><a\nhref="{URL_THIS}#toc6">Уровень 4. Заголовок</a></div><div\nstyle="margin-left: 3em;"><a\nhref="{URL_THIS}#toc7"> Уровень 5. Заголовок</a></div><div\nstyle="margin-left: 4em;"><a\nhref="{URL_THIS}#toc8">Уровень 6. Заголовок</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc9"> Абзацы</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc10"> Списки</a></div><div\nstyle="margin-left: 2em;"><a\nhref="{URL_THIS}#toc11">Маркированные</a></div><div\nstyle="margin-left: 2em;"><a\nhref="{URL_THIS}#toc12"> Нумерованные</a></div><div\nstyle="margin-left: 2em;"><a\nhref="{URL_THIS}#toc13"> Смешанные</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc14"> Ссылки</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc15"> Изображения</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc16"> Таблицы</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc17"> Горизонтальная линия</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc18"> Содержание</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc19"> Центрирование текста</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc20"> Выделения</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc21"> Цвет текста</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc22"> Разрыв строки</a></div><div\nstyle="margin-left: 1em;"><a\nhref="{URL_THIS}#toc23"> Текст, который не нужно размечать</a></div><div\nstyle="margin-left: 0em;"><a\nhref="{URL_THIS}#toc24"> Примечание</a></div></div></td></tr></table><h2 id="toc1"> Что это такое</h2><p>Это искусственный язык разметки гиппертекста. Он на порядок легче HTML, имеет низкий порог вхождения, удобночитаем и легок в поддержке.</p><h2 id="toc2"> Зачем она нам</h2><p>Wiki-разметка используется главным образом для поддержания единообразие страниц сайта. Также она упрощает оформление текста, так как она гораздо проще HTML, имеет удобночитаемый вид. После изучения всех возможностей этой разметки и работы с ней некоторое время, вы станете удивляться, как же вы обходились без нее раньше.</p><h2 id="toc3"> Описание основных элементов разметки</h2><p>Ниже приведены примеры использования разметки и результаты их выполнения.</p><h3 id="toc4"> Заголовки</h3><pre><code>+++  Уровень 3. Заголовок\n\n++++ Уровень 4. Заголовок\n\n+++++  Уровень 5. Заголовок\n\n++++++ Уровень 6. Заголовок</code></pre><h3 id="toc5"> Уровень 3. Заголовок</h3><h4 id="toc6">Уровень 4. Заголовок</h4><h5 id="toc7"> Уровень 5. Заголовок</h5><h6 id="toc8">Уровень 6. Заголовок</h6><h3 id="toc9"> Абзацы</h3><pre><code>Первый абзац.\n \nА это уже второй абзац.</code></pre><p>Первый абзац.</p><p>А это уже второй абзац.</p><h3 id="toc10"> Списки</h3><h4 id="toc11">Маркированные</h4><pre><code>* элемент списка\n* элемент списка\n * вложенный элемент списка\n * вложенный элемент списка\n* элемент списка</code></pre><ul><li>элемент списка</li><li>элемент списка<ul><li>вложенный элемент списка</li><li>вложенный элемент списка</li></ul></li><li>элемент списка</li></ul><h4 id="toc12"> Нумерованные</h4><pre><code># элемент списка\n# элемент списка\n # вложенный элемент списка\n # вложенный элемент списка\n# элемент списка</code></pre><ol><li>элемент списка</li><li>элемент списка<ol><li>вложенный элемент списка</li><li>вложенный элемент списка</li></ol></li><li>элемент списка</li></ol><h4 id="toc13"> Смешанные</h4><pre><code># элемент списка\n# элемент списка\n * вложенный элемент списка\n * вложенный элемент списка\n# элемент списка</code></pre><ol><li>элемент списка</li><li>элемент списка<ul><li>вложенный элемент списка</li><li>вложенный элемент списка</li></ul></li><li>элемент списка</li></ol><h3 id="toc14"> Ссылки</h3><pre><code>http://www.site.com\n[http://www.site.com Внешняя ссылка]\n[./admin Внутренняя ссылка]</code></pre><br\n/> <a\nhref="http://www.site.com">http://www.site.com</a><br\n/> <a\nhref="http://www.site.com">Внешняя ссылка</a><br\n/> <a\nhref="./admin">Внутренняя ссылка</a><h3 id="toc15"> Изображения</h3><pre><code>http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg\n[http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg Эйнштейн]</code></pre><br\n/> <img\nsrc="http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg" alt="http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg" title="http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg" /><!-- http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg --><br\n/> <img\nsrc="http://upload.wikimedia.org/wikipedia/ru/6/65/EinsteinA.jpg" alt="Эйнштейн" title="Эйнштейн" /><!-- Эйнштейн --><h3 id="toc16"> Таблицы</h3><pre><code>|| Cell 1 || Cell 2 ||\n|| Cell 3 || Cell 4 ||</code></pre><br\n/><table\nclass="wikitable"><tr><td>Cell 1</td><td>Cell 2</td></tr><tr><td>Cell 3</td><td>Cell 4</td></tr></table><pre><code>||&lt; left ||= center ||&gt; right ||\n|| The quick brown || fox jumps over || the lazy dog. ||</code></pre><br\n/><table\nclass="wikitable"><tr><td\nstyle="text-align: left;">left</td><td\nstyle="text-align: center;">center</td><td\nstyle="text-align: right;">right</td></tr><tr><td>The quick brown</td><td>fox jumps over</td><td>the lazy dog.</td></tr></table><pre><code>|| lines must start and end || with double vertical bars || nothing ||\n|| cells are separated by || double vertical bars || nothing ||\n|||| you can span multiple columns by || starting each cell ||\n|| with extra cell |||| separators ||\n|||||| but perhaps an example is the easiest way to see ||</code></pre><br\n/><table\nclass="wikitable"><tr><td>lines must start and end</td><td>with double vertical bars</td><td>nothing</td></tr><tr><td>cells are separated by</td><td>double vertical bars</td><td>nothing</td></tr><tr><td\ncolspan="2">you can span multiple columns by</td><td>starting each cell</td></tr><tr><td>with extra cell</td><td\ncolspan="2">separators</td></tr><tr><td\ncolspan="3">but perhaps an example is the easiest way to see</td></tr></table><h3 id="toc17"> Горизонтальная линия</h3><pre><code>----</code></pre><hr\n/><h3 id="toc18"> Содержание</h3><p>Генерирует содержание данной статьи на основе заголовков. Содержание содержит ссылки для быстрого перехода к каждому заголовку.<br\n/><pre><code>[[toc]]</code></pre></p><p>Пример содержания можно увидеть в начале данной статьи.</p><h3 id="toc19"> Центрирование текста</h3><p>Любая строка, начинающаяся со знака &quot;равно&quot;.<br\n/><pre><code>= Строка по центру</code></pre><br\n/><div\nstyle="text-align: center;">Строка по центру</div></p><h3 id="toc20"> Выделения</h3><pre><code>**Bold** ''''italic'''' {{teletype text}} //emphasis// __underline__</code></pre><br\n/> <strong>Bold</strong> <i>italic</i> <tt>teletype text</tt> <em>emphasis</em> <u>underline</u><h3 id="toc21"> Цвет текста</h3><pre><code>##ffca00|Оранжевый текст##</code></pre><br\n/> <span\nstyle="color: #ffca00;">Оранжевый текст</span><h3 id="toc22"> Разрыв строки</h3><p>Состоит из пробела и знака подчеркивания. Ставится в конце строки. Используется когда часть текста нужно перенести на новую строку, не создавая новый абзац и не разрушая разметочный блок.<br\n/><pre><code>* элемент списка #1\n* элемент списка #1\n* элемент списка #1, следующий текст которого должен распологаться _\nна новой строке\n* элемент списка #1</code></pre></p><ul><li>элемент списка #1</li><li>элемент списка #1</li><li>элемент списка #1, следующий текст которого должен распологаться<br\n/> на новой строке</li><li>элемент списка #1</li></ul><p>Иначе список разобьется на два:<br\n/><pre><code>* элемент списка #2\n* элемент списка #2\n* элемент списка #2, следующий текст которого должен распологаться\nна новой строке\n* это уже элемент списка #3\n* элемент списка #3</code></pre></p><ul><li>элемент списка #2</li><li>элемент списка #2</li><li>элемент списка #2, следующий текст которого должен распологаться</li></ul><p>на новой строке</p><ul><li>это уже элемент списка #3</li><li>элемент списка #3</li></ul><h3 id="toc23"> Текст, который не нужно размечать</h3><p>Текст, заключенный с обеих сторон двумя обратными кавычками, не будет рассматриваться на наличие в нем разметочных тегов. Используется чтобы экранировать сочитания символов, совпадающие с элементами разметки.<br\n/><pre><code>`` ++ = текст выведется как есть: [[toc]] **bold** ... etc. ``</code></pre><br\n/> ++ = текст выведется как есть: [[toc]] **bold** ... etc.</p><h2 id="toc24"> Примечание</h2><p>Данная разметка может иметь отличия от других Wiki-разметок, в частности от MediaWiki, которая используется в Википедии. Также в разметку погут быть внесены корректировки по усмотрению администратора.</p>'),
(13, 'keywords', ''),
(13, 'description', ''),
(16, 'email', 'chernysh.vadim@gmail.com'),
(16, 'name', 'contact/send'),
(16, 'dynamic', 'on'),
(21, 'name', 'catalog/item'),
(21, 'title', '{PRODUCT_NAME} &laquo; Каталог'),
(21, 'content_wiki', ''),
(21, 'content_html', ''),
(21, 'keywords', ''),
(21, 'description', ''),
(22, 'name', 'catalog'),
(22, 'title', '{CATEGORY_NAME} &laquo; Каталог'),
(22, 'content_wiki', ''),
(22, 'content_html', ''),
(22, 'keywords', ''),
(22, 'description', ''),
(21, 'dynamic', '1'),
(22, 'dynamic', '1'),
(23, 'name', 'testimonials'),
(23, 'title', 'Отзывы'),
(23, 'content_wiki', ''),
(23, 'content_html', ''),
(23, 'keywords', ''),
(23, 'description', ''),
(23, 'dynamic', '1'),
(1, 'dynamic', '0'),
(26, 'name', 'blog/note'),
(25, 'email', 'sales@site.com.ua'),
(25, 'name', 'cart/order'),
(25, 'dynamic', 'on'),
(26, 'title', '{NOTE_MANE} «  Новости'),
(26, 'content_wiki', ''),
(26, 'content_html', ''),
(26, 'keywords', ''),
(26, 'description', ''),
(26, 'dynamic', '1'),
(27, 'name', 'dostavka-i-oplata'),
(27, 'title', 'Доставка и оплата'),
(27, 'content_wiki', ''),
(27, 'content_html', ''),
(27, 'keywords', ''),
(27, 'description', ''),
(27, 'dynamic', '0');

-- --------------------------------------------------------

--
-- Table structure for table `_pano`
--

CREATE TABLE IF NOT EXISTS `_pano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `position` smallint(3) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position`),
  KEY `disabled` (`disabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_products`
--

CREATE TABLE IF NOT EXISTS `_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_old` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brief` text COLLATE utf8_unicode_ci NOT NULL,
  `description_wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `description_html` text COLLATE utf8_unicode_ci NOT NULL,
  `seotext_wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `seotext_html` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `album` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `also` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` smallint(3) NOT NULL,
  `position_main` smallint(3) NOT NULL,
  `main` tinyint(1) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `disabled` (`disabled`),
  KEY `timestamp` (`timestamp`),
  KEY `position` (`position`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=186 ;

--
-- Dumping data for table `_products`
--

INSERT INTO `_products` (`id`, `category_id`, `name`, `price`, `price_old`, `brief`, `description_wiki`, `description_html`, `seotext_wiki`, `seotext_html`, `title`, `keywords`, `description`, `timestamp`, `picture`, `album`, `label`, `also`, `position`, `position_main`, `main`, `disabled`) VALUES
(185, 0, 'Плюшка', '990', '', 'Плюшка — скрученная бантиком или «улиткой» булочка.', 'Плюшка — скрученная бантиком или «улиткой» булочка.', '<p>Плюшка &mdash; скрученная бантиком или &laquo;улиткой&raquo; булочка.</p>', '', '', '', '', '', 0, '18560239.png', '', 'hit', '', 999, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_product_categories`
--

CREATE TABLE IF NOT EXISTS `_product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `description_html` text COLLATE utf8_unicode_ci NOT NULL,
  `block` text COLLATE utf8_unicode_ci NOT NULL,
  `seotext_wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `seotext_html` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `position` smallint(3) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `timestamp` (`timestamp`),
  KEY `disabled` (`disabled`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `_product_structure`
--

CREATE TABLE IF NOT EXISTS `_product_structure` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_product_structure`
--

INSERT INTO `_product_structure` (`product_id`, `category_id`) VALUES
(12, 8),
(12, 6),
(12, 4),
(17, 7),
(18, 12),
(18, 5),
(19, 12),
(20, 11),
(19, 6),
(20, 6),
(21, 12),
(21, 6),
(22, 12),
(22, 6),
(23, 12),
(23, 6),
(24, 12),
(24, 6),
(25, 12),
(25, 6),
(26, 12),
(26, 6),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(31, 5),
(32, 5),
(33, 5),
(34, 5),
(35, 6),
(36, 6),
(37, 6),
(38, 5),
(39, 6),
(40, 6),
(41, 6),
(42, 6),
(43, 6),
(44, 6),
(45, 6),
(46, 6),
(47, 6),
(48, 12),
(48, 10),
(48, 6),
(49, 12),
(49, 10),
(49, 6),
(50, 12),
(50, 10),
(50, 6),
(51, 12),
(51, 10),
(51, 5),
(52, 12),
(52, 10),
(52, 5),
(53, 12),
(53, 10),
(53, 5),
(54, 9),
(55, 9),
(56, 9),
(57, 9),
(58, 9),
(59, 6),
(59, 9),
(60, 6),
(60, 9),
(61, 6),
(61, 9),
(62, 7),
(62, 9),
(63, 7),
(63, 9),
(64, 7),
(64, 9),
(65, 6),
(65, 12),
(66, 14),
(67, 6),
(67, 14),
(68, 6),
(68, 14),
(69, 6),
(69, 14),
(70, 6),
(70, 14),
(71, 14),
(71, 6),
(72, 12),
(72, 14),
(72, 6),
(73, 5),
(73, 14),
(74, 6),
(74, 14),
(75, 7),
(75, 14),
(76, 6),
(76, 14),
(77, 6),
(77, 14),
(78, 6),
(79, 12),
(79, 6),
(80, 12),
(80, 6),
(81, 6),
(82, 6),
(83, 12),
(83, 6),
(84, 6),
(85, 6),
(86, 6),
(86, 10),
(87, 6),
(88, 12),
(88, 5),
(89, 12),
(89, 5),
(90, 12),
(90, 5),
(91, 5),
(91, 12),
(92, 5),
(92, 12),
(93, 5),
(94, 5),
(95, 5),
(96, 5),
(97, 5),
(98, 5),
(98, 10),
(95, 10),
(94, 10),
(93, 10),
(97, 10),
(99, 5),
(99, 10),
(100, 6),
(100, 10),
(101, 6),
(101, 10),
(102, 5),
(102, 10),
(103, 6),
(104, 6),
(105, 6),
(106, 12),
(106, 6),
(107, 6),
(107, 12),
(107, 11),
(108, 6),
(108, 12),
(109, 6),
(110, 6),
(111, 6),
(112, 6),
(113, 6),
(114, 6),
(114, 12),
(115, 6),
(116, 6),
(116, 10),
(116, 12),
(117, 6),
(118, 5),
(119, 5),
(120, 6),
(121, 6),
(121, 12),
(122, 12),
(122, 6),
(123, 12),
(124, 12),
(125, 6),
(125, 12),
(126, 6),
(126, 12),
(127, 5),
(127, 12),
(128, 6),
(128, 12),
(129, 5),
(129, 12),
(130, 6),
(130, 12),
(131, 6),
(132, 6),
(133, 7),
(134, 6),
(134, 12),
(135, 6),
(135, 12),
(136, 5),
(136, 10),
(137, 10),
(137, 6),
(138, 10),
(138, 6),
(139, 6),
(139, 10),
(140, 6),
(140, 10),
(141, 6),
(141, 10),
(142, 6),
(142, 10),
(143, 6),
(143, 10),
(144, 6),
(144, 10),
(145, 6),
(145, 10),
(146, 6),
(146, 10),
(147, 6),
(147, 10),
(148, 6),
(148, 7),
(148, 10),
(149, 5),
(150, 7),
(151, 6),
(152, 6),
(153, 6),
(153, 10),
(154, 6),
(155, 6),
(156, 6),
(157, 7),
(158, 5),
(159, 6),
(160, 6),
(161, 6),
(162, 6),
(163, 6),
(164, 6),
(165, 6),
(166, 5),
(167, 5),
(168, 5),
(169, 12),
(169, 5),
(170, 6),
(171, 5),
(172, 5),
(173, 6),
(174, 6),
(175, 6),
(176, 5),
(177, 6),
(178, 6),
(179, 6),
(180, 0),
(181, 6),
(182, 6),
(182, 12),
(183, 6),
(183, 12),
(184, 5);

-- --------------------------------------------------------

--
-- Table structure for table `_stuff`
--

CREATE TABLE IF NOT EXISTS `_stuff` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_stuff`
--

INSERT INTO `_stuff` (`id`, `key`, `value`) VALUES
(1, 'email', 'sales@site.com.ua'),
(1, 'phone', '044-222-33'),
(1, 'address', ''),
(1, 'site_name', 'SITE'),
(1, 'year', '2012'),
(1, 'title_postfix', ' &laquo;'),
(1, 'ogrn', ''),
(1, 'work_hours', 'Есть вопросы? Звоните! Работаем с 8:00 до 21:00 Без выходных '),
(1, 'guarantee_header', 'Гарантия качества'),
(1, 'guarantee_body', 'Если Вам не понравилось качество нашей продукции, мы вернем деньги, либо сделаем все возможное, чтобы удовлетворить ваши нужды.'),
(1, 'body_pattern_fixed', '1'),
(1, 'guarantee_on', 'on'),
(1, 'promo_header', 'Акции и спецпредложения'),
(1, 'promo_body', 'Сделайте заказ на сумму от  1000грн и получите что-то в ПОДАРОК!'),
(1, 'promo_link', './'),
(1, 'promo_on', 'on'),
(1, 'promo_timer', 'on'),
(1, 'promo_interval', '24'),
(1, 'promo_timestamp', '1337257401'),
(1, 'discount_header', 'Доставка'),
(1, 'discount_body', 'Сделайте заказ СЕГОДНЯ и получите БЕСПЛАТНУЮ доставку!!!'),
(1, 'discount_link', './blog/note/dostavka-po-kieva'),
(1, 'discount_on', 'on'),
(1, 'google_analytics', ''),
(1, 'pay_alfabank', ''),
(1, 'pay_sberbank', ''),
(1, 'pay_contact', ''),
(1, 'icq', ''),
(1, 'yandex_metrika', ''),
(1, 'justbuy_header', 'Только что купили'),
(1, 'justbuy_products', '19|24|26|27|54|58|62|67'),
(1, 'justbuy_on', 'on'),
(1, 'google_verification', ''),
(1, 'yandex_verification', ''),
(1, 'skype', ''),
(1, 'phone2', '050-555-50-50'),
(1, 'color_bg', '#ffffff'),
(1, 'color_font', ' '),
(1, 'color2', '#ccdaff'),
(1, 'guarantee_link', ''),
(1, 'phone3', ''),
(1, 'body_bg_color', '#d8d6cb'),
(1, 'menu_link_color', '#222222'),
(1, 'phone_color', '#000000'),
(1, 'link_color', '#222222'),
(1, 'foot_bg_color', '#ffffff'),
(1, 'foot_font_color', '#222222'),
(1, 'foot_link_color', '#222222'),
(1, 'button2_bg_color', '#CECECE'),
(1, 'button_bg_color', '#B01A33'),
(1, 'button_font_color', '#ffffff'),
(1, 'button2_font_color', '#000000'),
(1, 'menu_bg_color', '0'),
(1, 'menu_bg_opacity', '0.8'),
(1, 'body_bg_image', ''),
(1, 'body_bg_pattern', '4ead34.png'),
(1, 'body_bg_fixed', '0'),
(1, 'text_color', '#575757'),
(1, 'header_color', '#000000'),
(1, 'price_color', '#222222'),
(1, 'block_bg_color', '#ffffff'),
(1, 'descript', ''),
(1, 'counter', ''),
(1, 'vk_app_id', '2809069'),
(1, 'vk_group_id', '35218122');

-- --------------------------------------------------------

--
-- Table structure for table `_testimonials`
--

CREATE TABLE IF NOT EXISTS `_testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duties` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` smallint(3) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position`),
  KEY `disabled` (`disabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `_testimonials`
--

INSERT INTO `_testimonials` (`id`, `name`, `phone`, `city`, `duties`, `website`, `message`, `timestamp`, `picture`, `position`, `disabled`) VALUES
(25, 'Ринов Александр', '', 'Киев', 'Маркетолог', '', 'Отличный сайт! Приятные цены, хорошее качество, доставка радует!', 1329488232, '2595eb3.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_themes`
--

CREATE TABLE IF NOT EXISTS `_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `_themes`
--

INSERT INTO `_themes` (`id`, `name`, `description`, `settings`, `author`, `picture`) VALUES
(4, 'Стандартная', 'Тема оформления по умолчанию', '{"body_bg_color":"#E7DECD","body_bg_image":"","body_bg_pattern":"4ead34.png","body_pattern_fixed":null,"body_bg_fixed":"0","menu_link_color":"#222222","menu_bg_color":"0","menu_bg_opacity":"0.3","text_color":"#575757","header_color":"#000000","price_color":"#222222","block_bg_color":"#ffffff","phone_color":"#000000","link_color":"#222222","foot_bg_color":"#ffffff","foot_font_color":"#222222","foot_link_color":"#222222","button_bg_color":"#B01A33","button2_bg_color":"#CECECE","button_font_color":"#ffffff","button2_font_color":"#222222"}', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `_users`
--

CREATE TABLE IF NOT EXISTS `_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwd_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `_users`
--

INSERT INTO `_users` (`id`, `email`, `passwd_hash`, `role`, `name`) VALUES
(1, 'admin', 'dfcaff1c5b80ca30cd15a4e5cd28be9dd2cc74bb', 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
