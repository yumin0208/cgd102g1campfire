insert into orders
values
(1,1,1,1,1,1,1,1,1,"2022-10-4 00:00:00","12345",1,20000,"2022-10-3 00:00:00","2022-10-25","2022-10-26"),
(2,131,2,27,6,3,3,3,1,"2022-10-4 00:00:00","54321",1,40000,"2022-10-3 00:00:00","2022-11-3","2022-11-4");

select * from orders;

insert into orders(
	mem_no, 
    tent_style_no,
    activity_no,
    food_no,
    equip_no,
    area_no,
    payment_methods,
    payment_status,
    orders_total,
    orders_time,
    checkin_date,
    checkout_date
    )
values();
