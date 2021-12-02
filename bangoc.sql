-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2021 at 03:22 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_cinema`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_create` (IN `name` VARCHAR(100), IN `img` VARCHAR(200), IN `tr` VARCHAR(100), IN `dsta` DATE, IN `dend` DATE, IN `det` VARCHAR(10000), IN `at` VARCHAR(1000), IN `dir` VARCHAR(50), IN `tmn` INT(11), IN `bn` VARCHAR(255), IN `name_vn` VARCHAR(255), IN `sta` INT(11), IN `coun` VARCHAR(50), IN `pro` VARCHAR(50), IN `rate` INT(50))  INSERT INTO `movie`(`name_mv`, `image_mv`, `traller`, `date_start`, `date_end`, `detail`, `actor`, `director`, `time_mv`, `banner`, `name_vn`, `status`, `country`, `production`, `rate`) VALUES (name,img,tr,dsta,dend,det,at,dir,tmn,bn,name_vn,sta,coun,pro,rate)$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_delete` (IN `id` INT)  DELETE FROM movie where id_movie=id$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_day` (IN `START` INT, IN `END` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.date_start LIMIT START,END$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_day_DESC` (IN `START` INT, IN `END` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.date_start DESC LIMIT START,END$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_id` ()  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.id_movie$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_id_DESC` (IN `START` INT, IN `END` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.id_movie DESC LIMIT START,END$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_name` (IN `START` INT, IN `END` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.name_mv  LIMIT START,END$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_name_DESC` (IN `START` INT, IN `END` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.name_mv DESC LIMIT START,END$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `movie_show_one` (IN `id` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category WHERE mv.id_movie = id  GROUP BY mv.id_movie order by mv.id_movie$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `review_one` (IN `id` INT)  SELECT user.full_name, movie.name_mv, review.content,review.start FROM `review` INNER JOIN user on review.id_user =user.id_user INNER JOIN movie ON movie.id_movie =review.id_movie WHERE user.id_user = id GROUP BY user.id_user ORDER BY user.id_user$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `review_read` ()  SELECT user.full_name, movie.name_mv, review.content,review.start FROM `review` INNER JOIN user on review.id_user =user.id_user INNER JOIN movie ON movie.id_movie =review.id_movie GROUP BY user.id_user ORDER BY user.id_user$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `show_one` (IN `id` INT)  SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate, sts.time_start,sts.time_end,se.day_start,se.day_end
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category INNER JOIN session se on mv.id_movie=se.id_movie  INNER JOIN showtimes sts on sts.id_showtimes =se.id_showtimes  WHERE mv.id_movie=id GROUP BY mv.id_movie$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `ticker_show` ()  SELECT user.full_name, tk.id_ticket,movie.name_mv,se.day_start,sts.time_start,combo.name as Combo,seat.id_seat,room.id_room,tk.ticket_information,tk.status,tk.Total_money FROM ticket tk INNER JOIN user on tk.id_user =user.id_user INNER JOIN promotion pr ON tk.id_promotion = pr.id_promotion INNER JOIN
session se ON tk.id_session = se.id_session INNER JOIN showtimes sts ON se.id_showtimes = sts.id_showtimes INNER JOIN room on se.id_room =room.id_room INNER JOIN seat ON seat.id_room = room.id_room INNER JOIN movie ON se.id_movie =movie.id_movie INNER JOIN combo ON combo.id_combo =tk.id_combo GROUP BY user.id_user ORDER BY user.id_user$$

CREATE DEFINER=`sql6454106`@`%` PROCEDURE `ticket_show_one` (IN `id_tk` INT)  SELECT user.full_name, tk.id_ticket,movie.name_mv,se.day_start,sts.time_start,combo.name as Combo,seat.id_seat,room.id_room,tk.ticket_information,tk.status,tk.Total_money FROM ticket tk INNER JOIN user on tk.id_user =user.id_user INNER JOIN promotion pr ON tk.id_promotion = pr.id_promotion INNER JOIN
session se ON tk.id_session = se.id_session INNER JOIN showtimes sts ON se.id_showtimes = sts.id_showtimes INNER JOIN room on se.id_room =room.id_room INNER JOIN seat ON seat.id_room = room.id_room INNER JOIN movie ON se.id_movie =movie.id_movie INNER JOIN combo ON combo.id_combo =tk.id_combo WHERE tk.id_ticket=id_tk GROUP BY user.id_user ORDER BY user.id_user$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `image`) VALUES
(1, 'banner1.jpg'),
(2, 'banner2.jpg'),
(3, 'banner3.jpg'),
(4, 'banner4.jpg'),
(5, 'banner5.jpg'),
(6, 'banner6.jpg'),
(7, 'banner7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'Xã hội'),
(2, 'Kinh dị'),
(3, 'Tình cảm'),
(4, 'Khoa học - Viễn tưởng'),
(5, 'Hoạt hình'),
(6, 'Tâm lý'),
(7, 'Gia đình'),
(8, 'Phiêu lưu-Mạo hiểm'),
(9, 'Hài hước'),
(10, 'Hành động'),
(11, 'Ly kì'),
(12, 'Chính kịch');

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

CREATE TABLE `combo` (
  `id_combo` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `combo`
--

INSERT INTO `combo` (`id_combo`, `name`, `price`) VALUES
(1, 'combo bắp nước ', 200000),
(2, 'combo bắp nước kẹo', 230000),
(3, 'combo bắp nước gà', 300000),
(4, 'combo 1 bắp 2  nước ', 220000);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `id` int(11) NOT NULL,
  `header_color` varchar(45) DEFAULT NULL,
  `header_background_color` varchar(45) DEFAULT NULL,
  `footer_color` varchar(45) DEFAULT NULL,
  `footer_background_color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id_movie` int(11) NOT NULL,
  `name_mv` varchar(100) NOT NULL,
  `image_lage` varchar(500) NOT NULL,
  `traller` varchar(100) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `detail` varchar(10000) NOT NULL,
  `actor` varchar(1000) NOT NULL,
  `director` varchar(50) NOT NULL,
  `time_mv` int(11) NOT NULL,
  `image_banner` varchar(500) NOT NULL,
  `name_vn` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `production` varchar(20) NOT NULL,
  `rate` int(11) NOT NULL,
  `image_medium` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id_movie`, `name_mv`, `image_lage`, `traller`, `date_start`, `date_end`, `detail`, `actor`, `director`, `time_mv`, `image_banner`, `name_vn`, `status`, `country`, `production`, `rate`, `image_medium`) VALUES
(1, 'Bố già', 'https://ss-images.saostar.vn/wp700/pc/1606897461583/BoGia_Teaser1.jpg', 'https://www.youtube.com/embed/jluSu8Rw6YE', '2021-01-30', '2021-03-17', 'Phim sẽ xoay quanh lối sống thường nhật của một xóm lao động nghèo, ở đó có bộ tứ anh em Giàu – Sang – Phú – Quý với Ba Sang sẽ là nhân vật chính, hay lo chuyện bao đồng nhưng vô cùng thương con cái. Câu chuyện phim tập trung về hai cha con Ba Sang (Trấn Thành) và Quắn (Tuấn Trần). Dù yêu thương nhau nhưng khoảng cách thế hệ đã đem đến những bất đồng lớn giữa hai cha con. Liệu cả hai có thể cho nhau cơ hội thấu hiểu đối phương, thu hẹp khoảng cách và tạo nên hạnh phúc từ sự khác biệt?', 'Trấn Thành, Ngọc Giàu,Tuấn Trần,Ngân Chi,Lê Giang,Hoàng Mèo,Lan Phương,La Thành,A Quay,Lê Trang,...', 'Trấn Thành', 128, 'https://koicine.com/wp-content/uploads/2020/12/a4cea40b4548ac16f559.jpg', '', 5, 'VIệt Nam', 'Trấn Thành Town', 5, 'https://media.vov.vn/sites/default/files/styles/large/public/2021-03/1_114.jpg'),
(2, 'VENOM: LET THERE BE CARNAGE', 'https://static1.dienanh.net/upload/202110/6d1c1d64-9d41-4e7b-b928-5ceb345251cc.jpg', 'https://www.youtube.com/embed/-FmWuCgJmxo', '2022-01-01', '2022-03-01', 'Venom: Let There Be Carnage tiếp tục câu chuyện vừa hài hước vừa máu me về chàng phóng viên Eddie Brock và bạn đồng hành Venom. Cả hai sẽ học cách sống chung thế nào khi nhân loại và quái vật ngoài hành tinh khác nhau quá đỗi? Thêm vào đó, sự xuất hiện của tên sát nhân hàng loạt Cletus / Carnage càng khiến cuộc sống yên bình quá xa với hai gã “loser”. Tom Hardy tiếp tục hóa thân vào Eddie Brock / Venom – một trong những nhân vật phức tạp nhất nhà Marvel.', 'Cletus Kasady (Woody Harrelson),Anne Weying (Michelle Williams),Michelle Williamsy,Amber Sienna,Woody Harrelson\r\nCletus', 'Andy Serkis', 180, 'https://www.galaxycine.vn/media/2021/11/24/2048x68e2_1637756862375.jpg', '', 4, 'Mỹ', 'Marvel Studios ', 5, 'https://www.galaxycine.vn/media/2021/11/24/1350x9ee00_1637756719481.jpg'),
(4, 'BLACK WIDOW', 'https://www.galaxycine.vn/media/2021/11/19/1200x1800_1637308282912.jpg', 'https://www.youtube.com/embed/8zyi9DrUb2Q', '2021-11-19', '0000-00-00', 'Cùng với cái chết của Iron Man, sự ra đi của Black Widow Natasha Romanoff là mất mát không thể thay thế của team Avengers. Người phụ nữ vừa mạnh mẽ vừa dịu dàng, coi Biệt Đội Siêu Anh Hùng như “gia đình” đã ra đi mãi mãi để đổi lấy viên đá linh hồn. Sự hy sinh của cô để lại trong lòng các fan vũ trụ điện ảnh Marvel niềm đau khó tả. May mắn thay, Marvel thấu hiểu tình yêu người hâm mộ dành cho Góa Phụ Đen. Dù khó thể trở lại trong tương lai MCU, Natasha và fan được “tặng” một bộ phim riêng mặc sức tung hoành. Cuộc hành trình độc lập của nữ chiến binh xuất sắc nhất Avengers sẽ đưa cô đụng độ một trong những kẻ thù “sừng sỏ” nhất – chuyên gia copy Taskmaster. Chuyến phiêu lưu sẽ đưa lên màn ảnh rộng quá khứ của Black Widow trước khi gia nhập S.H.I.E.L.D. Natasha sẽ gặp lại “gia đình” cũ gồm các đặc vụ  Yelena Belova (Florence Pugh), Melina Vostokoff (Rachel Weisz), Alexei Shostakov hay còn gọi là Red Guardian (David Harbour). Đặc biệt, theo nhiều tin đồn, “Iron Man” Tony Stark dù đã tạm biệt MCU vẫn xuất hiện trong phim. Sau một năm thành công với hai đề cử Oscar Nữ chính xuất sắc nhất (Marriage Story) và Nữ phụ xuất sắc nhất (Jojo Rabbit), Black Widow chắc chắn sẽ tiếp tục đưa danh tiếng quả bom gợi cảm của Hollywood – Scarlett Johansson lan rộng toàn cầu. Phim mới Black Widow: Góa Phụ Đen, ra mắt tại các rạp chiếu phim từ 05.11.2021. Xem thêm tại: https://www.galaxycine.vn/dat-ve/black-widow', '  Scarlett Johansson, Florence Pugh, Rachel Weisz', '  Cate Shortland', 133, 'https://writedrunkeditdrunk.files.wordpress.com/2021/07/bw_ytkcwef.jpg', 'Goá Phụ Đen', 4, 'Mỹ', 'Marvel Studios ', 0, 'https://www.galaxycine.vn/media/2021/11/19/1350x900-2_1637308287425.jpg'),
(5, 'THE SUICIDE SQUAD', 'https://www.galaxycine.vn/media/2021/11/5/900wx1350h_1636101337537.jpg', 'https://www.youtube.com/embed/TcajBCE7zfE', '0000-00-00', '0000-00-00', 'Những siêu ác nhân như Harley Quinn, Bloodsport, Peacemaker và nhiều kẻ tàn bạo khác tại nhà tù Belle Reve được chiêu mộ gia nhập lực lượng bí mật. Họ bị thả xuống hòn đảo thuộc Corto Maltese, thực hiện một nhiệm vụ ngàn cân treo sợi tóc. Phim mới Suicide Squad: Điệp Vụ Cảm Tử dự kiến ra mắt tại các rạp chiếu phim 19.11.2021. Xem thêm tại: https://www.galaxycine.vn/dat-ve/the-suicide-squat', '  Idris Elba, Margot Robbie, John Cena, Viola Davis', 'James Gunn', 132, '', 'SUICIDE SQUAD: ĐIỆP VỤ CẢM TỬ  ', 4, 'Mỹ', 'Warner Bros', 4, 'https://www.galaxycine.vn/media/2021/11/5/1350wx900h_1636101437844.jpg'),
(6, 'THE MEDIUM', 'https://www.galaxycine.vn/media/2021/11/2/300_1635857414897.jpg', 'https://www.youtube.com/embed/zLFhGUmg3I8', '2021-11-19', '0000-00-00', 'Câu chuyện về gia đình một bà đồng, có khả năng kết nối với những âm hồn của thế giới bên kia luôn là đề tài gây nhiều hứng thú. Liệu sẽ ra sao nếu có sự xuất hiện của một linh hồn quỷ dữ đe dọa tính mạng của cả gia tộc? Phim mới The Medium: Âm Hồn Nhập Xác, ra mắt tại các rạp chiếu phim từ 11.2021', '  Sawanee Utoomma, Narilya Gulmongkolpech', 'Banjong Pisanthanakun', 120, 'the_medium_banner.jpg', 'ÂM HỒN NHẬP XÁC', 3, 'Thái Lan', 'NORTHERN CROSS', 4, 'https://www.galaxycine.vn/media/2021/11/2/450_1635857325778.jpg'),
(7, 'SPIDER-MAN: NO WAY HOME', 'https://www.galaxycine.vn/media/2021/11/17/snwh-poster-posed-fb4x5_1637167936199.jpg', 'https://www.youtube.com/embed/twOE43vLRAM', '2021-12-17', '0000-00-00', 'Bị lộ mặt và trở thành kẻ thù quốc dân, Peter Parker tìm đến Dr Strange để nhờ thực hiện câu thần chú, khiến mọi người quên đi việc cậu là Spider-Man. Thế nhưng, quá trình thực hiện xảy ra sự cố. Đa vũ trụ hình thành. Những kẻ thù ở các vũ trụ trước đây của Người Nhện lần lượt xuất hiện. Phải chống lại Green Goblin, Doc Ock, Electro, Sandman và Lizard…, làm thế nào Nhện nhí có thể bảo vệ được người thân và bạn bè? Spider-Man: No Way Home qui tụ dàn diễn viên khủng: Tom Holland, Benedict Cumberbatch, Willem Dafoe, Zendaya, J.K.Simmons, Jamie Foxx… ', '    Tom Holland, Zendaya, Willem Dafoe, Jamie Foxx, Benedict Cumberbatch', 'Jon Watts', 0, 'https://ichi.pro/assets/images/max/724/1*17t4GylSBhXwdDNAdZURKQ.jpeg', 'NGƯỜI NHỆN: KHÔNG CÒN NHÀ\n', 5, 'Mỹ', 'Sony Pictures', 5, 'https://media.songdep.com.vn/files/phuonghoa/2021/08/26/spider-man-no-way-home-3-082531.jpg'),
(8, 'THIÊN THẦN HỘ MỆNH', 'https://www.galaxycine.vn/media/2021/11/17/400x633_1637134250845.jpg', 'https://www.youtube.com/embed/FzoWWAJeFgM', '2021-11-19', '0000-00-00', 'Cái chết bí ẩn của một ngôi sao trong giới giải trí, được đồn đoán rằng có liên quan đến loại búp bê ma thuật có tính chất bùa ngải hắc ám. Liệu bí ẩn khủng khiếp nào đang bị che giấu? Hội tụ dàn hot girl tài năng như Trúc Anh, Salim, Amee, Samuel An và Chi Pu. Đạo diễn Victor Vũ lại cho ra mắt một bộ phim nói về cuộc sống trong giới showbiz, sự hào nhoáng và những góc khuất ẩn sau vẻ ngoài rực rỡ của thế giới nghệ thuật. Mai Ly là một ngôi sao đang lên trong làng giải trí, đột nhiên người ta phát hiện cô đã chết sau khi rơi từ tầng thượng của một tòa nhà. Hàng loạt tin đồn được dấy lên, nhiều người cho rằng sự ra đi của Mai Ly có liên quan đến một loại ma thuật bùa ngải, hiện đang trú ngụ trong hình hài con búp bê hắc ám.', '    Trúc anh,Amee, Salim, Samuel an', 'Victor Vũ', 124, 'https://i.ytimg.com/vi/Jj_KRtlezPE/maxresdefault.jpg', '', 4, 'Việt Nam', 'lotte Entertainment', 5, 'https://i.vietgiaitri.com/2021/5/4/thien-than-ho-menh-cua-victor-vu-dan-dau-dip-le-a4b-5744398.jpg'),
(9, 'RESIDENT EVIL: WELCOME TO RACCOON CITY', 'https://www.galaxycine.vn/media/2021/10/14/re-poster-eye-fb4x5_1634213194313.jpg', 'https://www.youtube.com/embed/jr6YqjVtdKs', '2021-11-26', '0000-00-00', 'Resident Evil là một trong những tựa game sinh tồn xác sống ăn khách nhất mọi thời đại. Sau 25 năm và 8 phần game gốc cùng hàng loạt ngoại truyện, tác phẩm ngày càng có đông đảo người hâm mộ. Loạt phim Resident Evil do Paul W.S. Anderson đạo diễn là một thành công về mặt thương mại nhưng bị nhiều fan chỉ trích vì rời quá xa nguyên tác. Do đó mà Sony quyết định tái khởi động thương hiệu với Resident Evil: Welcome to Raccoon City (Resident Evil: Quỷ dữ trỗi dậy) có nội dung lấy từ hai phần game đầu tiên. Xem thêm tại: https://www.galaxycine.vn/dat-ve/resident-evil-welcome-to-raccoon-city', '    Kaya Scodelario, Robbie Amell', 'Johannes Roberts', 0, 'https://images5.alphacoders.com/117/thumb-1920-1173827.jpg', 'RESIDENT EVIL: QUỶ DỮ TRỖI DẬY', 4, 'Mỹ', 'Sony Pictures', 4, 'https://i.ytimg.com/vi/e3KzJWcmE7g/mqdefault.jpg'),
(10, 'MINIONS: SỰ TRỖI DẬY CỦA GRU', 'https://www.galaxycine.vn/media/2021/2/2/minons-090721_1612233432649.jpg', 'https://www.youtube.com/embed/hiUoV4i-diU', '2021-06-01', '0000-00-00', 'MINIONS : SỰ TRỖI DẬY CỦA GRU - Nội dung bộ phim nói về năm 1970, khi Gru vẫn còn là một cậu bé 12 tuổi, nhưng cậu đã là 1 fanboy chính hiệu của nhóm siêu ác nhân được biết đến với cái tên Vicious 6, Gru đã ấp ủ một kế hoạch để tham gia cùng họ và diễn nhiên đồng hành cùng cậu nhóc Gru là các Minion trung thành Kevin, Stuart, Bob và Otto... Để gây ấn tượng với nhóm siêu ác nhân Gru đã cướp &quot;viên đá&quot; của họ và trên đường chạy trốn Otto đã vô tình xao lãng đánh tráo viên đá mà Gru cướp được... liệu Gru có thực hiện được ước mơ trở thành siêu ác nhân khét tiếng nhất thế giới ? Phim dự kiến sẽ ra mắt vào 01.06.2022', 'Animation USA  ', 'Animation USA  ', 0, 'https://i.rada.vn/data/image/2020/02/07/minions-su-troi-day-cua-gru-1.jpg', 'MINIONS: SỰ TRỖI DẬY CỦA GRU', 3, 'USA', 'Animation USA  ', 5, 'https://i3.wp.com/img.phimchill.tv/images/info/minions-the-rise-of-gru.jpg'),
(11, 'NHÓC TRÙM: NỐI NGHIỆP GIA ĐÌNH', 'http://res.cloudinary.com/myapp12091999/image/upload/v1637258214/s8o1mqxr/iwa5g8osrrq2udbmf75x.jpg', 'https://www.youtube.com/embed/8OeSvp2_4NM', '2021-12-01', '0000-00-00', 'NHÓC TRÙM 2: NỐI NGHIỆP GIA ĐÌNH - Nối tiếp câu chuyện của phần đầu tiên, sau khi Nhóc Trùm Ted và anh trai Tim đều trưởng thành, tuy nhiên hai anh em họ đã không còn thân thiết như xưa nữa, khi hai anh em họ đang tranh cãi nhau, một điều bất ngờ xảy ra - Tina (con gái nhỏ của Tim) bất ngờ nói chuyện, Tina tự nhận mình là đặc vụ của tổ chức bí mật Baby Corp, nơi mà những đứa trẻ sơ sinh với tâm trí như người lớn và cô bé đang thực hiện nhiệm vụ bảo vệ thế giới. Để ngăn chặn kế hoạch biến mọi đứa trẻ trở nên quậy phá và không nghe lời của Tiến sĩ Armstrong, Tina cần đến sự giúp đỡ của bố và chú Ted. Nhờ một loại thuốc đặc biệt do Baby Corp sản xuất, cả Tim và Ted trở lại phiên bản trẻ con , &quot;Nhóc Trùm &quot; chính thức trở lại....', 'Animation USA', 'Animation USA', 107, 'tthm.jpg', 'NHÓC TRÙM: NỐI NGHIỆP GIA ĐÌNH', 5, 'USA', 'Animation USA', 5, 'https://minhvy.net/wp-content/uploads/2021/03/the-boss-baby-family-business.jpg'),
(12, 'MALIGNANT', 'https://www.galaxycine.vn/media/2021/10/22/malignant-james-wan-3_1634895379147.jpg', 'https://www.youtube.com/embed/OnKLbYPQ5Vg', '2021-11-12', '0000-00-00', 'Malignant - Hiện Thân Tà Ác nội dung chính xoay quanh Madison (Annabelle Wallis đóng), một nữ điều dưỡng đang mang thai đứa con đầu lòng. Sau một tai nạn kinh hoàng, Madison cùng lúc mất đi cả chồng và con, còn cô thì rơi vào tình trạng hoảng loạn với tâm lý bất ổn. Cũng từ đó, Madison bắt đầu nhìn thấy những ảo ảnh ghê rợn, liên tục tấn công những người xa lạ. Những cơn ác mộng ngày một “thật hơn”, tình trạng của Madison cũng ngày càng tồi tệ. Người duy nhất tin tưởng Madison và đồng hành cùng cô là em gái Sydney (Maddie Hasson), người sau đó đã cùng Madison lật mở những bí mật không ai có thể ngờ tới.', 'Annabelle Wallis, Maddie Hasson', 'James Wan', 111, 'tthm.jpg', 'HIỆN THÂN TÀ ÁC', 3, 'USA', 'Warner Bros', 5, ''),
(13, 'DARK SPELL', 'https://www.galaxycine.vn/media/2021/11/12/1200x1800_1636697924958.jpg', 'https://www.youtube.com/embed/AjnRu1Mb7KA', '2021-11-19', '0000-00-00', 'Điên cuồng vì bị bạn trai phản bội, Zhenya sử dụng cấm thuật để thực hiện hôn lễ. Mối tình ám ảnh được sinh ra bởi sự tác hợp của quỷ dữ, Zhenya liệu có thoát khỏi được một tình yêu ngay cả cái chết cũng không thể chia lìa họ? Xem thêm tại: https://www.galaxycine.vn/dat-ve/dark-spell', 'Konstantin Beloshapka, Yana Yenzhayeva', 'Svyatoslav Podgaevskiy', 92, '', 'CẤM THUẬT', 4, 'Nga', 'Central Partnership ', 4, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBUVFBgVFRQZGBgaGBodGhgaGhoYGxgaIxsbIRoaGhsbIS0kGx0qHxoZJTclKy4xNDQ0GyM6PzozPi0zNDEBCwsLEA8QHxISHTMhJCozMzMzMzMzMzMzMzMzMTUzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzM//AABEIAKgBLAMBIgACEQEDEQH/xAAcAAABBQEBAQAAAAAAAAAAAAAAAQIDBAUGBwj/xABCEAABAwIDBAcEBggHAQEAAAABAAIRAyEEEjEFQVFhBhMicYGRoQcy0fAUFUJSscEjU2JygqLh8SQzNHOSssKzJf/EABoBAAMBAQEBAAAAAAAAAAAAAAABAgMEBQb/xAAsEQACAgAFAwIGAgMAAAAAAAAAAQIRAxIhMUEEUWEioQUTMnHB0YHwI4KS/9oADAMBAAIRAxEAP'),
(14, 'SHANG-CHI AND THE LEGEND OF THE TEN RINGS', 'https://www.galaxycine.vn/media/2021/11/23/1200x1800_1637635582546.jpg', 'https://www.youtube.com/embed/ccQjdsbZJ0U', '2021-11-26', '0000-00-00', 'Bộ phim tiếp theo của vũ trụ điện ảnh Marvel với nhân vật chính là \'Bậc Thầy Kung-Fu\' Shang-Chi. Shang-Chi là bậc thầy Kung Fu, tinh thông võ thuật. Sức mạnh của Shang-Chi đến từ hàng ngàn giờ luyện tập miệt mài và sự kỷ luật cao độ với bản thân. Siêu anh hùng võ thuật này được chính bố của mình tôi luyện, dạy dỗ để trở thành một sát thủ chuyên nghiệp và kế thừa tập đoàn tội ác của ông. Shang-Chi có lẽ không còn xa lạ với người hâm mộ truyện tranh Marvel, tuy nhiên, đây sẽ là lần đầu tiên nhân vật này được bước lên màn ảnh. Đặc biệt hơn, Shang-Chi cũng chính là nhân vật siêu anh hùng gốc Á đầu tiên của MCU được chuyển thể thành phim. Teaser trailer đầu tiên cũng hé lộ những hình ảnh thời niên thiếu của Shang-Chi, từ một cậu bé nhỏ tuổi được cha mình khổ luyện, đào tạo trong môi trường vô cùng khắc nghiệt cho tới khi trở thành một người đàn ông trưởng thành. Xuyên suốt trailer dài 2 phút là những pha phô diễn võ thuật, công phu choáng ngợp, đậm chất Á Đông, đúng như cội nguồn của nhân vật này. Xem thêm tại: https://www.galaxycine.vn/dat-ve/shang-chi-and-the-legend-of-the-ten-rings', ' Simi Liu, Lương Triều Vỹ, Awkwafina', 'Destin Daniel Cretton', 132, '', 'SHANG-CHI VÀ HUYỀN THOẠI THẬP LUÂN', 4, 'Nga', '  Walt Disney Pictur', 5, 'https://www.galaxycine.vn/media/2021/11/23/1350x900_1637635576821.jpg'),
(15, 'TURNING RED', 'https://www.galaxycine.vn/media/2021/10/13/turning-red-3_1634124839497.jpg', 'https://www.youtube.com/embed/eXeEM2rVIZk', '2023-03-22', '0000-00-00', 'Chuyện gì sẽ xảy ra khi một cô bé 13 tuổi biến thành gấu trúc đỏ mỗi khi phấn khích? Cuộc sống của nhóc chắc chắn chẳng thể yên bình rồi! Turning Red là tác phẩm sắp ra mắt của xưởng phim hoạt hình lừng danh Pixar. Xem thêm tại: https://www.galaxycine.vn/dat-ve/turning-red', '   Sandra Oh, Rosalie Chiang', 'Domee Shi', 0, '', '', 5, 'mỹ', 'Pixar', 5, ''),
(28, 'SING 2', 'https://www.galaxycine.vn/media/2021/11/30/sing-2-24-12_1638243732567.jpg', 'https://www.youtube.com/embed/s7shIOOV5iQ', '2023-12-24', '0000-00-00', '“Bầu sô” Buster Moon và các bạn phải tìm cách thuyết phục ngôi sao Clay Calloway đã về hưu nhiều năm trở lại và tham gia buổi diễn của họ. ', 'Matthew McConaughey, Scarlett Johansson, Reese Witherspoon, Taron Egerton', '  Garth Jennings', 0, '', 'ĐẤU TRƯỜNG ÂM NHẠC ', 4, 'Mỹ', 'Illumination Enterta', 4, 'https://www.galaxycine.vn/media/2021/11/27/450_1637986933942.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie_category`
--

CREATE TABLE `movie_category` (
  `id_category` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_category`
--

INSERT INTO `movie_category` (`id_category`, `id_movie`) VALUES
(2, 6),
(2, 9),
(2, 13),
(3, 11),
(4, 4),
(5, 2),
(5, 10),
(5, 11),
(5, 12),
(5, 15),
(6, 11),
(7, 1),
(7, 2),
(7, 11),
(7, 12),
(8, 4),
(8, 12),
(9, 1),
(9, 2),
(9, 10),
(10, 4),
(10, 5),
(10, 7),
(10, 9),
(10, 14),
(11, 8),
(12, 1),
(2, 28);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `detal` int(11) NOT NULL,
  `banner` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id_promotion` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `sale` double NOT NULL,
  `detail` varchar(500) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `code`, `sale`, `detail`, `date_start`, `date_end`, `quantity`) VALUES
(1, 'cinemasale1', 40, '', '2021-12-01 00:00:00', '2021-12-28 00:00:00', 0),
(2, 'cinemasale2', 50, '', '2021-11-02 07:48:56', '2021-11-10 07:48:59', 0),
(3, 'cinemasale3', 60, '', '2021-08-17 07:49:23', '2021-09-14 07:49:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `start` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_user`, `id_movie`, `content`, `start`) VALUES
(1, 1, 'bộ phim rất hay và ấn tượng', 5),
(1, 2, 'cũng rất hay', 3),
(2, 2, 'các tình tiết trong phim thật là hấp dẫn, hay quá đi mất', 5);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `name`) VALUES
(1, 'phòng 1'),
(2, 'phòng 2'),
(3, 'phòng 3'),
(4, 'phòng 4'),
(5, 'phòng 5'),
(6, 'phòng 6'),
(7, 'phòng 7');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` varchar(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `location` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `type_seat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id_seat`, `id_room`, `location`, `price`, `type_seat`) VALUES
('3', 1, ' ', 80000, 'đơn'),
('4', 2, '[value-3]', 160000, 'đôi'),
('5', 1, '[value-3]', 200000, 'đặc biệt'),
('6', 3, '[value-3]', 80000, 'đơn'),
('7', 4, '[value-3]', 80000, 'đơn'),
('8', 2, '[value-3]', 160000, 'đôi');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id_session` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `day` date NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '2D',
  `id_showtimes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id_session`, `id_movie`, `id_room`, `day`, `type`, `id_showtimes`) VALUES
(1, 1, 1, '2021-11-30', '2D', 1),
(2, 2, 2, '2021-11-30', '2D', 2),
(3, 3, 1, '2021-11-28', '3D', 2),
(4, 2, 3, '2021-12-03', '2D', 1),
(5, 3, 2, '2021-12-05', '3D', 3),
(6, 4, 2, '2021-12-05', '3D', 3),
(7, 8, 1, '2021-12-01', '3D', 4),
(8, 4, 2, '2021-12-01', '3D', 2),
(9, 5, 2, '2021-12-19', '2D', 1),
(10, 8, 3, '2021-12-06', '2D', 2),
(11, 7, 2, '2021-12-07', '2D', 3),
(12, 12, 3, '2021-12-08', '2D', 1),
(13, 9, 3, '2021-12-08', '2D', 2),
(14, 10, 1, '2021-12-07', '2D', 3),
(15, 13, 4, '2021-12-10', '3D', 4),
(16, 13, 2, '2021-12-12', '2D', 2),
(17, 13, 2, '2021-12-16', '2D', 3),
(18, 15, 4, '2021-12-11', '3D', 2);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id_showtimes` int(11) NOT NULL,
  `time_start` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time_end` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id_showtimes`, `time_start`, `time_end`) VALUES
(1, '9h', '11h30'),
(2, '13h30', '15h'),
(3, '17h', '19h30'),
(4, '20h30', '23h');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `Total_money` double NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `ticket_information` varchar(255) NOT NULL,
  `ticket_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_session`, `Total_money`, `id_user`, `id_promotion`, `time_create`, `status`, `ticket_information`, `ticket_code`) VALUES
(1, 2, 195000, 3, 2, '2021-11-24 02:39:38', 1, '160k', 'TK125'),
(2, 1, 180000, 1, 3, '2021-11-24 07:35:54', 1, '(2*80k)', 'TK285'),
(58, 3, 120000, 2, 1, '2021-12-02 20:59:40', 1, 'vé thường(2)', '321638453580'),
(59, 4, 140000, 2, 1, '2021-12-02 21:00:38', 1, 'vé thường(1) vé đặt biệt(1)', '421638453638'),
(60, 5, 120000, 4, 1, '2021-12-02 21:01:19', 1, 'vé thường(1) vé đặt biệt(1)', '541638453679'),
(61, 6, 110000, 3, 1, '2021-12-02 21:01:48', 1, 'vé thường(1) vé đặt biệt(2)', '631638453708'),
(62, 7, 180000, 4, 1, '2021-12-02 21:02:40', 1, 'vé đặt biệt (1)', '741638453760'),
(63, 2, 160000, 4, 2, '2021-12-02 21:03:18', 1, 'vé đặt biệt (1)', '241638453798'),
(64, 1, 300000, 5, 2, '2021-12-02 21:04:20', 1, 'vé đặt biệt (3)', '151638453860'),
(65, 8, 200000, 6, 3, '2021-12-02 21:05:12', 1, 'vé đặt biệt (2), vé thường(1)', '861638453912'),
(67, 11, 200000, 6, 2, '2021-12-02 21:06:47', 1, 'vé đặt biệt (2), vé thường(3)', '1161638454007'),
(68, 3, 100000, 1, 1, '2021-12-02 21:07:26', 1, 'vé đặt biệt (2), vé thường(3)', '311638454046'),
(69, 3, 100000, 4, 1, '2021-12-02 21:07:46', 1, 'vé đặt biệt (1), vé thường(2)', '341638454066');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_combo`
--

CREATE TABLE `ticket_combo` (
  `id_ticket` int(11) NOT NULL,
  `id_combo` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_combo`
--

INSERT INTO `ticket_combo` (`id_ticket`, `id_combo`, `quantity`, `unit_price`) VALUES
(1, 2, 0, 0),
(1, 3, 0, 0),
(2, 2, 0, 0),
(2, 3, 0, 0),
(58, 1, 1, 16000),
(59, 1, 2, 10000),
(59, 2, 0, 0),
(60, 1, 2, 15000),
(60, 2, 0, 0),
(61, 1, 3, 18000),
(61, 2, 0, 0),
(62, 1, 1, 12000),
(62, 2, 0, 0),
(63, 1, 1, 12000),
(64, 1, 1, 300000),
(64, 2, 0, 0),
(64, 3, 0, 0),
(65, 1, 2, 200000),
(67, 1, 2, 200000),
(68, 1, 2, 100000),
(69, 1, 2, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_seat`
--

CREATE TABLE `ticket_seat` (
  `id_ticket` int(11) NOT NULL,
  `id_seat` varchar(11) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_seat`
--

INSERT INTO `ticket_seat` (`id_ticket`, `id_seat`) VALUES
(1, 'A1'),
(1, 'A2'),
(2, 'B1'),
(2, 'B2'),
(58, 'A6'),
(64, 'B3'),
(58, 'A9'),
(58, 'A10'),
(58, 'A6'),
(59, 'A2'),
(59, 'A1'),
(60, 'C10'),
(60, 'H3'),
(61, 'C1'),
(61, 'C2'),
(64, 'C10'),
(63, 'C9'),
(62, 'A9'),
(64, 'D3'),
(64, 'D4'),
(65, 'A1'),
(65, 'A2'),
(67, 'A1'),
(67, 'A2'),
(67, 'B3'),
(67, 'B4'),
(67, 'A5'),
(68, 'A1'),
(68, 'A2'),
(68, 'D3'),
(68, 'D4'),
(67, 'A7'),
(69, 'C1'),
(69, 'C2'),
(67, 'C5');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` bit(1) NOT NULL,
  `administration` int(11) NOT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `img_user` varchar(100) NOT NULL,
  `create_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `full_name`, `email`, `phone`, `password`, `status`, `administration`, `google_id`, `facebook_id`, `img_user`, `create_at`) VALUES
(1, 'Liu Tấn Phát ú', 'phatl@gmail.com', '123456', '123456aA', b'1', 1, '', NULL, '1', '2021-12-12'),
(2, 'Lê thiện thông', 'thong1@gmail.com', '0972136650', 'thongntp1', b'1', 0, '', NULL, '', '2021-12-27'),
(3, 'Nguyễn tấn Tường', 'tuong121@gmail.com', '0912883715', 'tuong1121', b'1', 0, '', NULL, '', '2021-11-08'),
(4, 'Trần Thanh Sang', 'sanglp@gmail.com', '0952136871', '123123a', b'1', 1, '', NULL, '', '2021-10-11'),
(5, 'Mai Tuấn Hùng', 'hungmt@gmail.com', '0975841264', '15897123bv', b'1', 0, '', NULL, '', '2021-11-01'),
(6, 'Lan Thần Bắc', 'ltb@gmail.com', '0923436650', 'thongntp1', b'1', 0, '', NULL, '', '2021-10-17'),
(12, 'nauto123', 'nautogame2@gmail.com', '0972136489', '73278a4a86960eeb576a', b'1', 0, NULL, NULL, '1', '2021-12-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`id_combo`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id_movie`);

--
-- Indexes for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD KEY `movie_category_ibfk_2` (`id_category`),
  ADD KEY `movie_category_ibfk_1` (`id_movie`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promotion`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `review_ibfk_2` (`id_movie`),
  ADD KEY `review_ibfk_1` (`id_user`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id_seat`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id_showtimes`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_promotion` (`id_promotion`),
  ADD KEY `id_session` (`id_session`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ticket_combo`
--
ALTER TABLE `ticket_combo`
  ADD KEY `id_combo` (`id_combo`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indexes for table `ticket_seat`
--
ALTER TABLE `ticket_seat`
  ADD KEY `id_ticket` (`id_ticket`),
  ADD KEY `id_seat` (`id_seat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `image` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id_showtimes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Constraints for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD CONSTRAINT `movie_category_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_category_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `ticket_combo`
--
ALTER TABLE `ticket_combo`
  ADD CONSTRAINT `ticket_combo_ibfk_1` FOREIGN KEY (`id_combo`) REFERENCES `combo` (`id_combo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_combo_ibfk_2` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
