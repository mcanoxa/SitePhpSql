-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 30 2022 г., 17:15
-- Версия сервера: 5.5.50
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `suvyrina_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `card_id` int(11) NOT NULL,
  `card_id_product` int(11) NOT NULL,
  `card_price` int(11) NOT NULL,
  `card_count` int(11) NOT NULL DEFAULT '1',
  `card_datetime` datetime NOT NULL,
  `card_ip` varchar(100) NOT NULL,
  `login` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `card`
--

INSERT INTO `card` (`card_id`, `card_id_product`, `card_price`, `card_count`, `card_datetime`, `card_ip`, `login`) VALUES
(7, 1, 370, 1, '2022-01-30 16:41:50', '127.0.0.1', ''),
(8, 2, 550, 1, '2022-01-30 16:41:51', '127.0.0.1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login`
--

INSERT INTO `login` (`id`, `login`, `password`) VALUES
(3, 'suvyrina', '9nm2rv8qcfc85120da82ab3dcbc88ca316f0a3702yo6z'),
(6, 'admin', '9nm2rv8q3cf108a4e0a498347a5a75a792f232122yo6z'),
(7, 'user', '9nm2rv8qee32c060ac0caa70b04e25091bbc11ee2yo6z');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `category` enum('Бургеры','Картофель') NOT NULL,
  `name` varchar(50) NOT NULL,
  `property` varchar(255) NOT NULL,
  `img` longtext NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category`, `name`, `property`, `img`, `description`, `price`) VALUES
(1, 'Бургеры', 'АНГУС Терияки Гриль', 'Премиальная новинка со 100% говядиной Абердин Ангус! ', 'АНГУСТериякиГриль.png', 'Невероятно нежный 150-граммовый мраморный бифштекс на французской булочке бриошь под соусом барбекю и натуральные ингредиенты со всего мира: салат Романо, сыр Гауда, бекон, лук фри и свежие овощи. Стопроцентная мраморная вкуснятина — пробуй срочно!', 370),
(2, 'Бургеры', 'АНГУС Терияки Гриль XL', 'Создавая эту премиальную новинку, мы задумали сломать рамки привычного.', 'АНГУС Терияки Гриль XL.png', 'Приготовили на огне большой и невероятно сочный бифштекс из 100% мраморной говядины Абердин Ангус. Уложили на булочку бриошь под соусом терияки. Добавили удивительные ингредиенты: нежный кремчиз, салат Романо и сочные перцы гриль. Получилась Магия. Пробуй!', 550),
(3, 'Бургеры', 'АНГУС Шеф', 'Премиальная новинка со 100% говядиной Абердин Ангус! ', 'АНГУС Шеф.png', 'Невероятно нежный 150-граммовый мраморный бифштекс на французской булочке бриошь под соусом барбекю и натуральные ингредиенты со всего мира: салат Романо, сыр Гауда, бекон, лук фри и свежие овощи. Стопроцентная мраморная вкуснятина — пробуй срочно!', 340),
(23, 'Бургеры', 'АНГУС Шеф XL', 'Ангус Шеф XL — это pro-сочность!', 'АнгусШеф.png', 'В этом красавце целых 300 граммов невероятно нежной 100% мраморной говядины Абердин Ангус, приготовленной на живом огне. Французская булочка бриошь со свежими овощами, луком фри, беконом и сыром Гауда.', 500),
(24, 'Бургеры', 'Моцарелла Кинг XL', 'Это более сытная версия бургера Моцарелла Кинг.', 'Моцарелла Кинг XL.png', ' Двойной бифштекс под соусом Сальса, помидоры, маринованные огурчики, салат Айсберг на сырной булочке и по-итальянски тянущийся сыр Моцарелла в хрустящей панировке. Тутто э пэрфэтто!', 400),
(25, 'Бургеры', 'Моцарелла Кинг', 'Флагман новой итальянской линейки Моцарелла!', 'Моцарелла Кинг.png', 'На сырной булочке — свежие овощи, маринованные огурчики, 100%-я говядина на огне под соусом Сальса. И самое главное — нежная расплавленная Моцарелла в золотистой корочке. Тебе понравится!', 300),
(26, 'Бургеры', 'Воппер', 'ВОППЕР — это вкуснейшая приготовленная на огне 100% говядина с сочными помидорами, свежим нарезанным листовым салатом, густым майонезом, хрустящими маринованными огурчиками и свежим луком на нежной булочке с кунжутом.', 'Воппер.png', 'ВОППЕР — это вкуснейшая приготовленная на огне 100% говядина с сочными помидорами, свежим нарезанным листовым салатом, густым майонезом, хрустящими маринованными огурчиками и свежим луком на нежной булочке с кунжутом.', 200),
(27, 'Бургеры', 'Двойной воппер с сыром', 'Двойной ВОППЕР®с сыром - это два аппетитных, приготовленных на огне бифштекса из 100% говядины, два нежных ломтика сыра, сочные помидоры, свежий нарезанный листовой салат, густой майонез, хрустящие маринованные огурчики и свежий лук на нежной булочке с ку', 'Двойной воппер с сыром.png', 'Двойной ВОППЕР®с сыром - это два аппетитных, приготовленных на огне бифштекса из 100% говядины, два нежных ломтика сыра, сочные помидоры, свежий нарезанный листовой салат, густой майонез, хрустящие маринованные огурчики и свежий лук на нежной булочке с кунжутом.', 309),
(28, 'Бургеры', 'Воппер Джуниор', 'Приготовленный на огне бифштекс из 100% говядины, сочный помидор, свежий нарезанный салат, густой майонез, хрустящие огурчики и свежий лук на мягкой булочке, посыпанной кунжутом.', 'Воппер Джуниор.png', 'Приготовленный на огне бифштекс из 100% говядины, сочный помидор, свежий нарезанный салат, густой майонез, хрустящие огурчики и свежий лук на мягкой булочке, посыпанной кунжутом.', 300),
(29, 'Бургеры', 'Лонг Чизбургер', 'Лонг Чизбургер – эталон в коллекции чизбургеров! Два приготовленных на огне бифштекса с двумя ломтиками слегка расплавленного сыра, хрустящими огурчиками, рубленым луком, горчицей и кетчупом на длинной подрумяненной булочке с кунжутом.', 'Лонг Чизбургер.png', 'Лонг Чизбургер – эталон в коллекции чизбургеров! Два приготовленных на огне бифштекса с двумя ломтиками слегка расплавленного сыра, хрустящими огурчиками, рубленым луком, горчицей и кетчупом на длинной подрумяненной булочке с кунжутом.', 200),
(30, 'Картофель', 'Луковые колечки ', 'Золотистые луковые колечки попадают на стол горячими и хрустящими. Рекомендуем с любым из наших соусов.', 'Луковые колечки.png', 'Золотистые луковые колечки попадают на стол горячими и хрустящими. Рекомендуем с любым из наших соусов.', 130),
(31, 'Картофель', 'Кинг Фри бол', 'Горячий и свежий картофель Кинг Фри® - золотистые и хрустящие ломтики отлично дополнят любой обед', 'Кинг Фри бол.png', 'Горячий и свежий картофель Кинг Фри® - золотистые и хрустящие ломтики отлично дополнят любой обед', 110),
(32, 'Картофель', 'Картофель деревенский', 'Известный всем вкус деревенской картошки в золотистых горячих ломтиках.', 'Картофель деревенский.png', 'Известный всем вкус деревенской картошки в золотистых горячих ломтиках.', 110),
(33, 'Картофель', 'Роял Фри', 'Горячие ломтики картофеля фри с топпингом из сырного соуса, хрустящего лука, бекона и соуса барбекю! Что может быть вкуснее!', 'Роял Фри.png', 'Горячие ломтики картофеля фри с топпингом из сырного соуса, хрустящего лука, бекона и соуса барбекю! Что может быть вкуснее!', 170),
(34, 'Картофель', 'Чипсы Lay’s сметана и зелень', 'Откройте пачку хрустящих чипсов Lay’s со вкусом сметаны и зелени и наслаждайтесь!', 'Чипсы Lay’s сметана и зелень.png', 'Откройте пачку хрустящих чипсов Lay’s со вкусом сметаны и зелени и наслаждайтесь!', 60),
(35, 'Картофель', 'Кинг Наггетс ', 'Наши наггетсы сделаны из нежного белого куриного мяса в легкой хрустящей панировке. Рекомендуем к ним восемь разных, но одинаково вкусных соусов на выбор: сырный, кетчуп, барбекю, кисло-сладкий, карри, чесночный, горчичный, сладкий чили.', 'Кинг Наггетс.png', 'Наши наггетсы сделаны из нежного белого куриного мяса в легкой хрустящей панировке. Рекомендуем к ним восемь разных, но одинаково вкусных соусов на выбор: сырный, кетчуп, барбекю, кисло-сладкий, карри, чесночный, горчичный, сладкий чили.', 100),
(36, 'Картофель', 'Крылышки Кинг', 'Огромная порция крылышек по фирменному рецепту отлично подойдет как закуска к обеду или пиву.', 'Крылышки Кинг.png', 'Огромная порция крылышек по фирменному рецепту отлично подойдет как закуска к обеду или пиву.', 200),
(37, 'Картофель', 'Кинг креветки', 'Нежные королевские креветки в легкой хрустящей панировке. Легкая закуска для большой компании с морским настроением. Внимание! Блюдо содержит аллергены – морепродукты.', 'Кинг креветки.png', 'Нежные королевские креветки в легкой хрустящей панировке. Легкая закуска для большой компании с морским настроением. Внимание! Блюдо содержит аллергены – морепродукты.', 550),
(38, 'Картофель', 'Сыр.Медальоны', 'Горячие дольки нежного сыра с хрустящей корочкой. Идеально с любимым соусом!', 'Сыр.Медальоны.png', 'Горячие дольки нежного сыра с хрустящей корочкой. Идеально с любимым соусом!', 100),
(39, 'Картофель', 'Кинг Букет "Снек-микс"', 'Большая порция наггетсов, луковых колечек и золотистой Кинг Фри.', 'Кинг БукетСнек-мик.png', 'Большая порция наггетсов, луковых колечек и золотистой Кинг Фри.', 430);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;