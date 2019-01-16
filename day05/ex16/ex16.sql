SELECT film.title, member_history.id_member
INNER JOIN member_history ON member_history.id_member=user_card.id_user
GROUP BY film.title;


SELECT member.id_user_card
INNER JOIN member_history ON member_history.id_member=member.id_member;

SELECT COUNT(*) AS 'movie'
INNER JOIN member_history ON member_history.id_member=member.id_member
INNER JOIN member ON member.id_user_card = user_card.id_user;

SELECT COUNT(*) AS 'movie' FROM member_history
INNER JOIN member_history ON member_history.id_member=member.id_member
INNER JOIN member ON member.id_user_card = user_card.id_user;

SELECT COUNT(*) AS 'movie' FROM member_history
;

SELECT COUNT(*) AS 'movie' FROM member_history
WHERE DATE('date') BETWEEN '2006-10-30' AND '2007-07-27';

SELECT COUNT(*) AS 'movie' FROM member_history
WHERE DATE('date') BETWEEN '2006-10-30' AND '2007-07-27' OR DATE('date') LIKE '%-12-24';

SELECT count(date) 'movies' 
FROM member_history 
WHERE DATE(date) >= '2006-10-30' AND DATE(date) <= '2007-07-27' OR MONTH(date) = 12 AND DAY(date) = 24;

SELECT count(date) 'movies' 
FROM member_history 
WHERE DATE(date) >= '2006-10-30' AND DATE(date) <= '2007-07-27' OR MONTH(date) = 12 AND DAY(date) = 24;
