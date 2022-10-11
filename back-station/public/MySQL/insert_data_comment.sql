insert into comment 
values(1,1,'或許是真的喔?',2,'2022-09-28 16:30:05',1),
	  (2,1,'是迅猛龍嗎?',4,'2022-09-30 22:40:16',1),
      (3,2,'真的露營會讓人輕鬆愉快!',3,'2022-09-30 10:13:24',1),
      (4,2,'你是去叢林歷險嗎? 今年我也想去!',4,'2022-09-30 11:20:14',1),
      (5,2,'營火叢的露營，感覺CP值很高耶!',5,'2022-09-30 21:40:30',1),
      (6,5,'海鮮大餐，螃蟹、蝦子、大干貝，吃到痛風最讚!',1,'2022-09-30 12:10:21',1),
      (7,4,'防蚊液用好好牌，我覺得是我用過最好的了',1,'2022-09-29 18:21:01',1),
      (8,3,'最重要的是要帶好防暖衣物，避免凍死',6,'2022-09-30 12:10:21',1);
      
-- 指令      
select c.discuss_no,
	   c.comment_no, c.comment_content, c.comment_date,
	   m.mem_no, m.mem_name, m.mem_pic
from comment c join member m on c.mem_no = m.mem_no
where discuss_no=1;
-- group by c.discuss_no;

select m.mem_no, m.mem_name, m.mem_pic, 
d.discuss_no, d.discuss_title, d.discuss_content, date_format(d.discuss_post_time, '%Y-%m-%d') discuss_post_time, d.discuss_status, d.background_type, count(c.discuss_no) comment_count
from member m join discuss d on m.mem_no = d.mem_no
			  left join comment c on d.discuss_no = c.discuss_no
where d.discuss_no=1              
 group by c.discuss_no;
 
select m.mem_no, m.mem_name, m.mem_pic, 
d.discuss_no, d.discuss_title, d.discuss_content, date_format(d.discuss_post_time, '%Y-%m-%d') discuss_post_time, d.discuss_status, d.background_type, count(c.discuss_no) comment_count
from member m join discuss d on m.mem_no = d.mem_no
			  left join comment c on d.discuss_no = c.discuss_no
where d.discuss_no=1
 group by c.discuss_no;
 
 -- 只抓取留言數
 select c.discuss_no, c.comment_no, c.comment_content, date_format(c.comment_date, '%Y-%m-%d') comment_date,
	   m.mem_no, m.mem_name, m.mem_pic
from comment c join member m on c.mem_no = m.mem_no
where discuss_no=1;
 
 