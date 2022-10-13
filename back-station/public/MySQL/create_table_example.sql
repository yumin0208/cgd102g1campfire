
-- drop database tibamefe_cgd102g1;
-- CREATE DATABASE tibamefe_cgd102g1;
<<<<<<< HEAD
<<<<<<< HEAD
-- use tibamefe_cgd102g1;
=======
=======
--  CREATE DATABASE tibamefe_cgd102g1;
>>>>>>> 474a4023e615983e58404339d9933d1fc6d44409
=======
>>>>>>> yishan
--  use tibamefe_cgd102g1;

>>>>>>> bd0be4ca5f461ff522ec92b111c6f72cb9286eb4


-- CREATE TABLE 後面加TABLE名稱 (欄位名稱_欄位類型_欄位特性) _代表空白
CREATE TABLE member(
mem_no int NOT NULL PRIMARY KEY AUTO_INCREMENT,
mem_id  varchar(20) NOT NULL UNIQUE,
mem_psw varchar(20) NOT NULL,
mem_name varchar(100) NOT NULL,
mem_nick_name  varchar(20) NOT NULL,
mem_email varchar(100) NOT NULL,
mem_city varchar(10) NOT NULL,
mem_addr varchar(300) NOT NULL,
mem_phone varchar(30) NOT NULL,
mem_pic tinyint ,
mem_status tinyint NOT NULL,
register_date datetime NOT NULL
);

INSERT INTO member 
VALUES(1,'tktk','abcd1234','蔡誠如','踢虧','tktk@gmail.com','桃園市','中壢區復興路46號9樓','0987987987','2','1','2022-09-28 00:00:00'),
	  (2,'sunrain','abcd1234','温晴雨','小雨','rain@gmail.com','新竹市','子虛區烏有路87號','0987487487','1','1','2022-09-28 10:00:00'),
      (3,'1313','abcd1234','陳一三','13老師','1313@gmail.com','台北市','萬華區厚德路69號','0969696969','3','1','2022-09-30 10:00:00'),
      (4,'boling','abcd1234','呂伯零','小胖哥','boling@gmail.com','新北市','板橋區沒有路87號','0922334455','4','1','2022-09-30 12:00:00'),
      (5,'xh87','abcd1234','蕭花','超級奧客','xh87@gmail.com','台北市','士林區天母路87號','0919221922','5','1','2022-09-30 12:00:00'),
      (6,'maruchen','abcd1234','陳硬玉','這玉好硬','maruchen@gmail.com','高雄市','鹽埕區一心路87號','0987654321','6','1','2022-09-30 16:00:00');


create table employee(
employee_no int PRIMARY KEY AUTO_INCREMENT,
employee_id varchar(20) unique,
employee_psw varchar(20),
employee_name varchar(100) not null,
employee_auth tinyint not null,
employee_sex varchar(15) not null,
employee_email varchar(100) not null,
employee_phone varchar(20) not null,
employee_status tinyint not null
);

insert into employee
values
(1,"tktk","asdf1234","蔡踢虧",1,"男","tktk@gmail.com","0987987987",1),
(2,"bolin","asdf1234","陳柏霖",2,"男","boling@gmail.com","0934313520",1),
(3,"maru","asdf1234","陳媽魯",3,"女","maruchen@gmail.com","0987987987",1);


create table discuss(
discuss_no int PRIMARY KEY AUTO_INCREMENT,
mem_no int not null,
discuss_title varchar(50),
discuss_content varchar(1000),
discuss_post_time DATETIME Not Null,
discuss_status TINYINT not null,
comment_count INT,
background_type TINYINT Not Null,
constraint fk_discuss_mem_no foreign key (mem_no) references member (mem_no)
);
INSERT INTO discuss 
VALUES(1,1,'我好像看到恐龍','阿看錯了，是你媽經過啦','2022-09-28 13:25:01',1,null,1),
      (2,2,'露營景色好美','整個露營我覺得是一次很棒的體驗，不管是風景還是氛圍都完全讓人放鬆，感覺像來到世外桃源一樣，也難怪越來越多人喜歡從事露營這個活動！早上的太陽搭配營區根本是拍照聖地吧～快攜手一起去體驗露營的美好吧！也能享受大自然的風光，短暫逃離都市的喧囂，完全是一個很特別很值得的旅程！','2022-09-28 15:04:20',1,null,1),
	  (3,3,'請教神人裝備','小弟今年想去冰雪奇緣做露營，第一次到雪地活動遊玩，該帶甚麼裝備比較好?','2022-09-29 14:32:29',1,null,2),
      (4,4,'傍晚的蚊子都怎麼解決？防蚊片有效嗎?','我一直都是在身上噴防蚊液，但沒噴到的地方都會被偷襲，像是屁股，隔著褲子也要咬我，4點生火的時候都相安無事，到5、6點的時候開始多很多，一直到10點要收拾的時候蚊子才會少一點。有人有推薦嗎?','2022-09-29 16:18:34',1,null,2),
      (5,6,'露營時的菜單有什麼，大家來說說吧','喜愛露營的朋友，想必每次露營都有一定要端出來的拿手好菜吧，歡迎大家分享自己的拿手菜，我個人一定會準備:奶油、櫛瓜、杏包菇、牛排、鮭魚，牛排和鮭魚基本上只要簡單煎一煎就很好吃了，奶油還可以拿來炒杏包菇，大家快來分享自己的露營菜單吧!','2022-09-29 20:11:37',1,null,3),
	  (6,5,'營火叢太爛了吧','想問一下路怎麼走，服務人員竟然過0.3秒才回我，服務態度太差了吧，詛咒你們全家都得香港腳。','2022-09-30 17:35:16',1,null,3);


create table comment(
comment_no int PRIMARY KEY AUTO_INCREMENT,
discuss_no int not null,
comment_content varchar(1000),
mem_no int not null,
comment_date DATETIME Not Null,
comment_status TINYINT Not Null,
constraint fk_comment_mem_no foreign key (mem_no) references member (mem_no),
constraint fk_comment_discuss_no foreign key (discuss_no) references discuss (discuss_no)
);

INSERT INTO comment 
VALUES(1,1,'或許是真的喔?',2,'2022-09-28 16:30:05',1),
	  (2,1,'是迅猛龍嗎?',4,'2022-09-30 22:40:16',1),
      (3,2,'真的露營會讓人輕鬆愉快!',3,'2022-09-30 10:13:24',1),
      (4,2,'你是去叢林歷險嗎? 今年我也想去!',4,'2022-09-30 11:20:14',1),
      (5,2,'營火叢的露營，感覺CP值很高耶!',5,'2022-09-30 21:40:30',1),
      (6,5,'海鮮大餐，螃蟹、蝦子、大干貝，吃到痛風最讚!',1,'2022-09-30 12:10:21',1),
      (7,4,'防蚊液用好好牌，我覺得是我用過最好的了',1,'2022-09-29 18:21:01',1),
      (8,3,'最重要的是要帶好防暖衣物，避免凍死',6,'2022-09-30 12:10:21',1);

create table report(
report_no int PRIMARY KEY AUTO_INCREMENT,
comment_no int ,
discuss_no int ,
mem_no int not null ,
report_content varchar(200),
report_time datetime not null,
report_result tinyint not null,
constraint fk_report_mem_no foreign key (mem_no) references member (mem_no),
constraint fk_report_discuss_no foreign key (discuss_no) references discuss (discuss_no),
constraint fk_report_comment_no foreign key (comment_no) references comment (comment_no)
);

INSERT INTO report 
VALUES (1,null,6,2,'亂詛咒人，沒禮貌','2022-09-30 21:21:39',0),
	   (2,2,1,6,'檢舉玩看看而已','2022-09-30 23:21:39',0);

create table news(
news_no int PRIMARY KEY AUTO_INCREMENT,
news_title varchar(30) not null,
news_content varchar(1000) not null,
news_pic varchar(50) not null,
news_post_time datetime not null,
news_status tinyint not null
);
insert into news
values(1,"慟！暴風雪來臨，冰雪奇緣區域關閉一週",'氣象局預警，下周冰雪奇緣地區將有暴風雪來臨，該區將暫時關閉一週，以防發生危險，此次關閉期間為2022年9月13日至2022年9月19日，造成不便敬請見諒。','news_1.jpg','2022/09/10 12:39:56',1),
	  (2,"熱浪來襲，小心中暑",'氣象局發布高溫警報，請峽谷地區的遊客特別注意防曬及補水，儘可能待在陰涼處，並多補充水分，以免中暑造成身體不適。','news_2.jpg','2022/09/10 12:39:56',1),
	  (3,'神秘力量壟罩，叢林探險區域暫時關閉','近期有未知神秘力量壟罩著叢林探險區域，暫停叢林探險區域暫停開放，以防發生危險，待力量散去時將再度開放叢林探險區域，造成不便敬請見諒。','news_3.jpg','2022/09/10 12:39:56',1),
      (4,'薩滿發威！叢林探險區域重新開放','經過薩滿的作法後，神秘力量已經驅除，叢林探險區域重新開放！','news_4.jpg','2022/09/12 20:00:00',1),
      (5,'馬雅趴來了！眾多知名樂團金字塔前開唱！','一年一度的馬雅趴將於11月23日至11月25日在叢林探險區的金字塔前開唱！本集團重金邀請蘇打紅、醜秀集團、、2266、告四人、熟女時代及防飛彈少年團，喜歡音樂的朋友不要錯過喔！','news_5.jpg','2022/10/13 15:40:30',1);
     

create table area(
area_no tinyint not null PRIMARY KEY,
area_name varchar(20) not null,
area_subtitle varchar(30) not null,
area_info varchar(1000) not null
);

insert into area
values (1,'叢林歷險','擁有茂密森林，生物多樣性和植物的自然美','叢林探險地區擁有大面積原生植物，還有許多叢林動物的蹤跡，讓您不用飛到熱帶國家也可以享受到同樣的景致，尤其特別喜歡享受大自然的遊客，千萬不要錯過叢林探險地區。然而，在叢林探險地區冒險，無須擔心安全的問題，並不會受到動物的攻擊，但要小心蚊蟲襲擊，若遇到突發狀況，也可隨時聯繫到工作人員！'),
       (2,'冰雪奇緣','美麗的雪景，使人的心靈變得一樣美麗純潔','冰雪奇緣地區為一年四季都為雪季，讓您無需等待到冬天也可以滑雪，並欣賞雪山美景，除了一般雪地活動之外，也可來場雪地健行，享受近距離仔細觀察大自然的樂趣，有膨鬆柔軟的粉雪綿延不絕，且能在導遊允許的範圍內自由玩耍，在飄落新雪的雪地上蹦蹦跳跳、或跟同伴打打雪仗、或用雪橇從小小的雪丘上飛速俯衝而下等，能享受多彩多姿的玩雪樂趣。'),
       (3,'荒野峽谷','崖壁陡直、氣勢磅礡，欣賞自然的壯麗之美','荒野峽谷地區是由河流向下切蝕形成河谷，但由於河谷兩旁的谷壁易因侵蝕或崩塌，不斷擴大而形成V形橫剖面，不需飛到美國也可以就近體驗峽谷的壯觀景色，如果想在天上目睹峽谷全貌的話，可以乘坐熱氣球，由專人為您導覽解說，讓您可以一邊享受壯麗景觀的同時，也可以更了解峽谷地形的形成演變史。');

create table tent_style(
tent_style_no int PRIMARY KEY AUTO_INCREMENT, 
tent_style_people tinyint not null,
area_no tinyint not null, 
tent_style_type tinyint not null,
tent_style_name varchar(20) not null,
tent_style_pic varchar(50) not null,
tent_style_info varchar(1000) not null,
tent_style_price int not null,
tent_qty int not null,
tent_status tinyint not null,
constraint fk_tent_style_area_no foreign key (area_no) references area (area_no)
);

INSERT INTO tent_style
VALUES (1,2,1,1,'叢林經濟二人帳','service_ordinary_1.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',5200,5,0),
	   (2,4,1,1,'叢林經濟四人帳','service_ordinary_1.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',9200,5,0),
       (3,6,1,1,'叢林經濟六人帳','service_ordinary_1.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',13200,5,0),
       (4,2,1,2,'叢林豪華二人帳','service_luxury_1.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',8300,5,0),
	   (5,4,1,2,'叢林豪華四人帳','service_luxury_1.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',12300,5,0),
       (6,6,1,2,'叢林豪華六人帳','service_luxury_1.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',19300,5,0),
       (7,2,1,3,'叢林主題二人帳','service_feature_1.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',9100,5,0),
	   (8,4,1,3,'叢林主題四人帳','service_feature_1.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',13700,5,0),
       (9,6,1,3,'叢林主題六人帳','service_feature_1.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',21300,5,0),
       (10,2,2,1,'冰雪經濟二人帳','service_ordinary_3.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',5200,5,0),
	   (11,4,2,1,'冰雪經濟四人帳','service_ordinary_3.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',9200,5,0),
       (12,6,2,1,'冰雪經濟六人帳','service_ordinary_3.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',13200,5,0),
       (13,2,2,2,'冰雪豪華二人帳','service_luxury_3.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',8300,5,0),
	   (14,4,2,2,'冰雪豪華四人帳','service_luxury_3.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',12300,5,0),
       (15,6,2,2,'冰雪豪華六人帳','service_luxury_3.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',19300,5,0),
       (16,2,2,3,'冰雪主題二人帳','service_feature_3.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',9100,5,0),
	   (17,4,2,3,'冰雪主題四人帳','service_feature_3.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',13700,5,0),
       (18,6,2,3,'冰雪主題六人帳','service_feature_3.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',21300,5,0),
       (19,2,3,1,'峽谷經濟二人帳','service_ordinary_5.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',5200,5,0),
	   (20,4,3,1,'峽谷經濟四人帳','service_ordinary_5.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',9200,5,0),
       (21,6,3,1,'峽谷經濟六人帳','service_ordinary_5.jpg','充氣床墊、枕被、營燈、電蚊拍、冷暖氣、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',13200,5,0),
       (22,2,3,2,'峽谷豪華二人帳','service_luxury_5.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',8300,5,0),
	   (23,4,3,2,'峽谷豪華四人帳','service_luxury_5.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',12300,5,0),
       (24,6,3,2,'峽谷豪華六人帳','service_luxury_5.jpg','TPU床墊、枕被、營燈、電蚊拍、循環扇、冷暖氣、桌椅、 熱水壺、炊事工具、防疫保健工具、沐浴用品、插座、獨立衛浴',19300,5,0),
       (25,2,3,3,'峽谷主題二人帳','service_feature_5.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',9100,5,0),
	   (26,4,3,3,'峽谷主題四人帳','service_feature_5.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',13700,5,0),
       (27,6,3,3,'峽谷主題六人帳','service_feature_5.jpg','TPU床墊、枕被、營燈、電蚊拍、冷暖氣、桌椅、 熱水壺炊事工具、防疫保健工具、沐浴用品、插座、共用衛浴',21300,5,0);
       

create table tent(
tent_no int PRIMARY KEY,
tent_style_no int not null,
area_no tinyint not null,
tent_status tinyint not null,
mem_no int,
tent_date datetime not null,
tent_year datetime not null,
constraint fk_tent_tent_style_no foreign key (tent_style_no) references tent_style (tent_style_no),
constraint fk_tent_area_no foreign key (area_no) references area (area_no),
constraint fk_tent_mem_no foreign key (mem_no) references member (mem_no)
);

insert into tent values
(1,1,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(2,1,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(3,1,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(4,1,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(5,1,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(6,2,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(7,2,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(8,2,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(9,2,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(10,2,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(11,3,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(12,3,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(13,3,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(14,3,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(15,3,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(16,4,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(17,4,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(18,4,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(19,4,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(20,4,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(21,5,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(22,5,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(23,5,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(24,5,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(25,5,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(26,6,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(27,6,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(28,6,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(29,6,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(30,6,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(31,7,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(32,7,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(33,7,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(34,7,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(35,7,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(36,8,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(37,8,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(38,8,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(39,8,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(40,8,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(41,9,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(42,9,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(43,9,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(44,9,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(45,9,1,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(46,10,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(47,10,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(48,10,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(49,10,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(50,10,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(51,11,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(52,11,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(53,11,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(54,11,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(55,11,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(56,12,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(57,12,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(58,12,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(59,12,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(60,12,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(61,13,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(62,13,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(63,13,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(64,13,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(65,13,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(66,14,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(67,14,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(68,14,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(69,14,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(70,14,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(71,15,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(72,15,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(73,15,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(74,15,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(75,15,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(76,16,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(77,16,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(78,16,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(79,16,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(80,16,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(81,17,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(82,17,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(83,17,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(84,17,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(85,17,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(86,18,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(87,18,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(88,18,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(89,18,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(90,18,2,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(91,19,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(92,19,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(93,19,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(94,19,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(95,19,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(96,20,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(97,20,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(98,20,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(99,20,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(100,20,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(101,21,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(102,21,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(103,21,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(104,21,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(105,21,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(106,22,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(107,22,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(108,22,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(109,22,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(110,22,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(111,23,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(112,23,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(113,23,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(114,23,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(115,23,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(116,24,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(117,24,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(118,24,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(119,24,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(120,24,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(121,25,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(122,25,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(123,25,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(124,25,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(125,25,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(126,26,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(127,26,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(128,26,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(129,26,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(130,26,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(131,27,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(132,27,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(133,27,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(134,27,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00"),
(135,27,3,0,null,"2020-10-10 12:00:00","2025-10-10 12:00:00");

create table food(
food_no int PRIMARY KEY,
food_name varchar(40) not null,
food_price int not null,
food_info varchar(200) not null,
food_pic varchar(50) not null,
food_status tinyint not null
);

INSERT INTO food
VALUES (1,'肉多多吃到飽',4280,'日本A5極品雪花和牛、美國安格斯極上牛小排、美國安格斯霜降牛、澳洲和牛極上牛舌、西班牙伊比利雪花豬梅花、西班牙伊比利松阪豚、無骨雞腿肉、醃漬雞翅','service_food_1.jpg',1),
       (2,'素食養身蔬菜',1690,'養身山藥、香甜大玉米、青椒、甜椒、洋蔥、玉米筍、杏包菇、奶油香菇、胡椒金針菇、花椰菜、筊白筍、茄子、百頁豆腐、豆干、醬油豆皮、烤年糕','service_food_2.jpg',1),
       (3,'奢侈海鮮大餐',3680,'焗烤海大蝦、龍膽石斑、海大蝦、北極圓鱈、嚴選黑潮軟絲、日本大扇貝、北海道干貝、特選焗烤大草蝦、挪威鹽漬鯖魚、北海道嚴選巨干貝、特選大草蝦','service_food_3.jpg',1),
       (4,'海陸雙重享受',3460,'美國安格斯牛小排、澳洲牛舌、西班牙伊比利松阪豚、無骨雞腿肉、醃漬雞翅、大草蝦、北極圓鱈、嚴選黑潮軟絲、日本大扇貝、北海道干貝、挪威鹽漬鯖魚','service_food_4.jpg',1);
       
       
create table equip(
equip_no int PRIMARY KEY,
equip_name varchar(40) not null,
equip_price int not null,
equip_pic varchar(50) not null,
equip_info varchar(200) not null
);

INSERT INTO equip
VALUES (1,'懷舊露營燈具','2780','service_equipment_1.jpg','金屬質感懷舊風，防風防雪防水，最高亮度可持續時間4小時。'),
	   (2,'野外廚房套鍋組','1320','service_equipment_2.jpg','無毒優質生活，一次滿足所有烹飪需求，增加容量卻又不增加體積。'),
       (3,'生存多功能工具','2780','service_equipment_3.jpg','內含16種工具節省裝備空間，操作輕鬆，工具主刀皆有安全鎖固定。'),
       (4,'安全通電延長線','1080','service_equipment_4.jpg','電源線雙層絕緣，通過安全保證，搭載超過電量負荷立刻斷電。');

create table activity(
activity_no int PRIMARY KEY,
area_no tinyint not null,
activity_name varchar(40) not null,
activity_subtitle varchar(30) not null,
activity_synopsis varchar(500) not null,
activity_info varchar(1000) not null,
activity_pic varchar(50) not null,
activity_price INT not null,
activity_suitable_guest varchar(20),
activity_note varchar(500),
constraint fk_activity_area_no foreign key (area_no) references area (area_no)
);

INSERT INTO activity
VALUES(1,1,'遊覽動物','在叢林中遊覽各種動物的英姿','當您在叢林歷險露營時，遊覽動物活動是您最佳的選擇之一，可以遠離城市的喧囂，沉浸在美麗的自然風光中，還有各種不同的動物治癒人心，但請勿隨意觸摸動物。','叢林探險是全程在森林中探險的一個過程，可以欣賞茂密的樹林、眺望大山與河谷平原的景色，有可能看見猴子、松鼠與老鷹，我們跟猴子一樣在樹上飛躍與闖關，享受與大自然融為一體的樂趣。 森林裡的索道路線錯綜複雜分不清方向，所以必須由指導員來指引。我們採用最高標準的 “saferoller” 連續式安全確保系統 照顧您的每一步，這意味著一旦進入我們的第一個關卡，就不能後悔必須走完，幸好指導員安定人心的行前說明及適時的出現，協助完成探險經歷，現在就來安排您的假期吧!','activity_tour.jpg',3500,'喜愛大自然及動物的人','心臟病、高血壓、脊椎/頸首部問題、骨質疏鬆症者、孕婦、身心不舒服者，請斟酌自己能力要不要參加，小心不要跌倒，謝謝。'),
	  (2,1,'寶藏探險','快來叢林尋找消失已久的大秘寶','寶藏探險是考驗玩家取捨的策略遊戲，會先給玩家每人一份島上的尋寶地圖，在叢林尋覓寶藏，其中會有小遊戲關卡供玩家破關，每破一個關卡就可以得到一個提示！','西班牙探險家在1519年率領船隊首次環航地球，因金主西班牙政府財力不濟，航海計劃唯有靠Moncada家族出資成行，而環航主要目的是尋找價值不斐的黃金寶藏。 1521年後麥哲倫死於與菲律賓當地部族的衝突中，船長與船員找到了寶物後卻秘而不宣，傳說這批黃金被藏在西班牙某處。幾百年來探險家冒險犯難，黃金仍未被尋獲，最後主角憑藉失散多年親兄遺下的綫索，和尋寶獵人合作，接下來就由各位玩家們來試著解出謎團抽絲剝繭，尋找隱藏在叢林的大祕寶吧。','activity_adv.jpg',2500,'全年齡喜歡刺激的人','心臟病、高血壓、脊椎/頸首部問題、骨質疏鬆症者、孕婦、身心不舒服者，請斟酌自己能力要不要參加，小心不要跌倒，謝謝。'),
      (3,2,'滑雪體驗','超大的滑雪場等您來體驗','一年四季都可以享受到滑雪活動，場內設備非常安全，滑雪體驗一定會伴隨教練，所以教練的互動也是很重要的一環，進階課程將會藉著人工冰攀場來練習基礎的冰攀技巧，以因應實際演練中許多複雜混合的地形。','一年四季都可以享受到滑雪活動，場內設備非常安全，滑雪體驗一定會伴隨教練，所以教練的互動也是很重要的一環，進階課程將會藉著人工冰攀場來練習基礎的冰攀技巧，以因應實際演練中許多複雜混合的地形。滑雪是人生必去的旅行體驗之一，在白色的滑雪場上，看著一望無際的雪景，從雪地的一端滑到另一端，感受速度帶來的刺激和震撼。設有不同難度的滑雪道，更有特別為初學者而設的新手專用學習道，無論你是初學者還是專業級高手，必定能在這片冰天雪地找到滑雪的樂趣！','activity_ski.jpg',5000,'全年齡喜歡刺激的人及喜愛滑雪的人','心臟病、高血壓、脊椎/頸首部問題、骨質疏鬆症者、孕婦、身心不舒服者，請斟酌自己能力要不要參加，謝謝。'),
      (4,2,'冰上釣魚','享受冰上釣魚的樂趣','冰上釣魚活動，露營期間您可在厚達40公分以上的冰層找個好位置，將釣竿放進冰釣窟窿，享受冰上垂釣的樂趣！當山川魚上鉤後，您還可以在現場的燒烤區、活動區品嚐雪地魚鮮美的滋味，除了冰上釣魚體驗，現場也能玩雪盆、雪橇！','冰層厚度約有40公分足以在上方行走，鑿洞釣魚也很受歡迎。在冰層上鑿洞，可要利用特殊道具，加上電鑽設備才能快快鑿洞，若是手無縛雞之力，鑽洞也做不來呢！露營期間您可在厚達40公分以上的冰層找個好位置，將釣竿放進冰釣窟窿，享受冰上垂釣的樂趣！就算是初次體驗現場也會有冰釣達人指導您，就算是釣魚新手也不用怕！之後當魚上鉤後，您還可以在現場的燒烤區、活動區品嚐雪地魚鮮美的滋味，除了冰上釣魚體驗，現場也能玩雪盆、雪橇！','activity_fish.jpg',2500,'全年齡喜歡釣魚的人','心臟病、高血壓、身心不舒服者，請斟酌自己能力要不要參加，謝謝。'),
      (5,3,'熱氣球遊覽大峽谷','在空中自由遨遊並欣賞峽谷美景','看著來自各國的專業飛行員駕駛碩大的夢幻熱氣球，滿載觀眾們的興奮期盼漫天飄遠，徜徉在縱谷間的大峽谷之中，是這裡不可錯過的一大美景。熱氣球自由飛空中遊覽，除了現場體驗升空的感動，還有視覺及聽覺浪漫激盪的精采饗宴。','熱氣球點火，準備就緒，緩緩地迎著朝陽飛向天空，緩慢飛升的過程，從高處鳥瞰，壯麗的大峽谷景觀盡收眼底，這樣的美只有現場親身經歷才可以體會，其中會有自各國的專業飛行員駕駛碩大的夢幻熱氣球，絕對保證玩家們的安全，現場也會配有導覽解說人員，讓您除了欣賞美景之外，還可以補充峽谷地理知識，身心徜徉在縱谷間的大峽谷之中，是治癒心靈的好選擇。熱氣球自由飛空中遊覽，除了現場體驗升空的感動，還有視覺及聽覺浪漫激盪的精采饗宴。','activity_balloon.jpg',5600,'不怕高的人','心臟病、高血壓、骨質疏鬆症者、孕婦、身心不舒服者，請斟酌自己能力要不要參加，謝謝。'),
      (6,3,'攀岩體驗','挑戰在壯麗的大峽谷中攀岩','峽谷運動攀登將先鋒攀登保護支點都已經事先用錨栓打好的路線，該些錨栓在路線上的距離配置均勻，不會讓攀登者的墜落距離過長。錨栓通常都是路線開發者從路線上方垂降下來時打進岩壁的。天然岩場用錨栓架設的路線，以及人工岩場中可供先鋒的路線，都是屬於運動攀登路線。','荒野峽谷地區世界上最大且最為集中的自然沙岩拱門群之一，長年風雨作用在紅褐色岩石上，雕塑出超過2,000座天然拱門，擁有眾多特別的地理特徵，如尖頂、頂峰、平衡岩與軸承座，在視覺上成為明顯的前景，透過對比顏色，地形和地質成為了完美的背景。亦可靜坐在岩群之間觀賞夕陽或日出！若您是充滿活力的運動健將，可以挑戰峽谷攀岩的驚險樂趣，峽谷運動攀登將先鋒攀登保護支點都已經事先用錨栓打好的路線，該些錨栓在路線上的距離配置均勻，不會讓攀登者的墜落距離過長。錨栓通常都是路線開發者從路線上方垂降下來時打進岩壁；而恬靜的自然愛好者，則能眺望壯麗的景色與植被，享受悠閒的時光。','activity_rock.jpg',6600,'全年齡喜歡刺激的人及喜愛攀岩的人','心臟病、高血壓、脊椎/頸首部問題、孕婦，請斟酌自己能力要不要參加，謝謝。');
      

create table orders(
orders_no int PRIMARY KEY AUTO_INCREMENT,
tent_no int,
mem_no int not null,
tent_style_no int not null,
activity_no int,
food_no int,
equip_no int,
area_no tinyint not null,
payment_methods tinyint not null,
payment_time datetime ,
account_no varchar(5) ,
payment_status tinyint not null,
orders_total int not null,
orders_time datetime not null,
checkin_date date not null,
checkout_date date not null,
constraint fk_orders_mem_no foreign key (mem_no) references member (mem_no),
constraint fk_orders_tent_no foreign key (tent_no) references tent (tent_no),
constraint fk_orders_tent_style_no foreign key (tent_style_no) references tent_style (tent_style_no),
constraint fk_orders_activity_no foreign key (activity_no) references activity (activity_no),
constraint fk_orders_food_no foreign key (food_no) references food (food_no),
constraint fk_orders_equip_no foreign key (equip_no) references equip (equip_no),
constraint fk_orders_area_no foreign key (area_no) references area (area_no)
);

insert into orders
values
(1,1,1,1,1,1,1,1,1,"2022-10-4 00:00:00","12345",1,20000,"2022-10-3 00:00:00","2022-10-25","2022-10-26"),
(2,131,2,27,6,3,3,3,1,"2022-10-4 00:00:00","54321",1,40000,"2022-10-3 00:00:00","2022-11-3","2022-11-4"),
(3,1,1,1,1,1,1,1,1,"2022-10-5 00:00:00","12345",2,20000,"2022-10-4 00:00:00","2022-10-28","2022-10-30");


create table reserve(
reserve_no int PRIMARY KEY AUTO_INCREMENT,
tent_style_no int not null,
reserve_date datetime not null,
tent_left int not null,
tent_stock int not null,
reserve_status tinyint not null,
constraint fk_reserve_tent_style_no foreign key (tent_style_no) references tent_style (tent_style_no)
);

create table product_order(
product_order_no int PRIMARY KEY AUTO_INCREMENT,
mem_no int not null,
product_order_status tinyint not null,
product_order_time datetime not null,
product_order_pickup_time datetime ,
product_order_pickup_place varchar(50) not null,
product_order_total int not null,
constraint fk_product_order_mem_no foreign key (mem_no) references member (mem_no)
);



create table product_type(
product_type_no int primary key,
product_type_name varchar(20) not null
);

insert into product_type
values (1,'杯子'),
	   (2,'上著'),
       (3,'帽子');

create table product(
product_no int PRIMARY KEY,
product_type_no int ,
product_name VARCHAR(20) not null,
product_price int not null,
product_pic varchar(50) not null,
product_status tinyint not null,
product_update date not null,
product_qty int not null,
constraint fk_product_product_type_no foreign key (product_type_no) references product_type (product_type_no)
);

insert into product
values(1, 1, '營火叢多喝水瓶',2680,'1.jpg',0,'2022-09-28',1),
	  (2, 3, '營火叢不怕風吹帽',2680,'2.jpg',0,'2022-09-28',1),
      (3, 3, '營火叢漁夫帽',2680,'3.jpg',0,'2022-09-28',1),
      (4, 2,'營火叢帽T',2680,'4.jpg',0,'2022-09-28',1),
      (5, 1,'營火叢金勾杯',2680,'5.jpg',0,'2022-09-28',1),
	  (6, 2,'營火叢T-SHIRT',2680,'6.jpg',0,'2022-09-28',1);

create table product_order_list(
product_order_no int not null,
product_no int not null,
product_order_list_qty int not null,
product_order_list_price int not null,
constraint fk_product_order_list_product_order_no foreign key (product_order_no) references product_order (product_order_no),
constraint fk_product_order_list_product_no foreign key (product_no) references product (product_no),
constraint pk_product_order_list_product_order_no_product_no primary key(product_order_no,product_no)
);

