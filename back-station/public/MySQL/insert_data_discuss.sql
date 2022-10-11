insert into discuss 
values(1,1,'我好像看到恐龍','阿看錯了，是你媽經過啦','2022-09-28 13:25:01',1,null,1),
      (2,2,'露營景色好美','整個露營我覺得是一次很棒的體驗，不管是風景還是氛圍都完全讓人放鬆，感覺像來到世外桃源一樣，也難怪越來越多人喜歡從事露營這個活動！早上的太陽搭配營區根本是拍照聖地吧～快攜手一起去體驗露營的美好吧！也能享受大自然的風光，短暫逃離都市的喧囂，完全是一個很特別很值得的旅程！','2022-09-28 15:04:20',1,null,1),
	  (3,3,'請教神人裝備','小弟今年想去冰雪奇緣做露營，第一次到雪地活動遊玩，該帶甚麼裝備比較好?','2022-09-29 14:32:29',1,null,2),
      (4,4,'傍晚的蚊子都怎麼解決？防蚊片有效嗎?','我一直都是在身上噴防蚊液，但沒噴到的地方都會被偷襲，像是屁股，隔著褲子也要咬我，4點生火的時候都相安無事，到5、6點的時候開始多很多，一直到10點要收拾的時候蚊子才會少一點。有人有推薦嗎?','2022-09-29 16:18:34',1,null,2),
      (5,6,'露營時的菜單有什麼，大家來說說吧','喜愛露營的朋友，想必每次露營都有一定要端出來的拿手好菜吧，歡迎大家分享自己的拿手菜，我個人一定會準備:奶油、櫛瓜、杏包菇、牛排、鮭魚，牛排和鮭魚基本上只要簡單煎一煎就很好吃了，奶油還可以拿來炒杏包菇，大家快來分享自己的露營菜單吧!','2022-09-29 20:11:37',1,null,3),
	  (6,5,'營火叢太爛了吧','想問一下路怎麼走，服務人員竟然過0.3秒才回我，服務態度太差了吧，詛咒你們全家都得香港腳。','2022-09-30 17:35:16',1,null,3);
      
update  discuss
set discuss_post_time = '2022-09-28 13:25:01'
where discuss_no = 1;


-- comment_count
update  discuss
set comment_count = (select count(discuss_no) from comment where discuss_no=6)
where discuss_no = 6;

select d.discuss_no , count(c.discuss_no) FROM discuss d join comment c on d.discuss_no = c.discuss_no 
where d.discuss_no=6 group by d.discuss_no;

select m.mem_no, m.mem_name, m.mem_pic, 
d.discuss_no, d.discuss_title, d.discuss_content, date_format(d.discuss_post_time, '%Y-%m-%d') discuss_post_time, d.discuss_status, d.background_type, count(c.discuss_no) comment_count
from member m join discuss d on m.mem_no = d.mem_no
			  left join comment c on d.discuss_no = c.discuss_no
 group by c.discuss_no;
