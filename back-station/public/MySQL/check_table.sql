SELECT * FROM tibamefe_cgd102g1.discuss;

SELECT * FROM tibamefe_cgd102g1.comment;

SELECT * FROM tibamefe_cgd102g1.member;

SELECT * FROM tibamefe_cgd102g1.report;

SELECT * FROM tibamefe_cgd102g1.product;

SELECT * FROM tibamefe_cgd102g1.product_type;

SELECT * FROM tibamefe_cgd102g1.area;

SELECT * FROM tibamefe_cgd102g1.tent_style;

SELECT * FROM tibamefe_cgd102g1.tent;

SELECT * FROM tibamefe_cgd102g1.food;

SELECT * FROM tibamefe_cgd102g1.news;

SELECT * FROM tibamefe_cgd102g1.orders;

select m.mem_no, m.mem_nick_name, m.mem_pic, 
            d.discuss_no, d.discuss_title, d.discuss_content, date_format(d.discuss_post_time, '%Y-%m-%d') discuss_post_time, d.discuss_status, d.background_type, count(c.discuss_no)comment_count
from member m join discuss d on m.mem_no = d.mem_no
                    left join comment c on d.discuss_no = c.discuss_no
            group by d.discuss_no;
            
select m.mem_no, m.mem_nick_name, m.mem_pic, 
            d.discuss_no, d.discuss_title, d.discuss_content, date_format(d.discuss_post_time, '%Y-%m-%d') discuss_post_time, d.discuss_status, d.background_type
from member m join discuss d on m.mem_no = d.mem_no;





