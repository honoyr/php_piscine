SELECT last_name AS 'NAME', first_name FROM user_card;



SELECT last_name AS 'NAME', first_name FROM user_card
INNER JOIN mem ON subscription.price = mem.price
INNER JOIN member ON user_card.last_name = member.last_name;


SELECT last_name AS 'NAME', first_name FROM user_card
INNER JOIN member ON member.id_user_card = user_card.id_user
INNER JOIN subscription ON subscription.id_sub = member.id_sub;

SELECT user_card.last_name AS 'NAME', user_card.first_name, subscription.price FROM user_card
INNER JOIN member ON member.id_user_card = user_card.id_user
INNER JOIN subscription ON subscription.id_sub = member.id_sub;

SELECT user_card.last_name AS 'NAME', user_card.first_name, subscription.price FROM user_card
INNER JOIN member ON member.id_user_card = user_card.id_user
INNER JOIN subscription ON subscription.id_sub = member.id_sub;

SELECT user_card.last_name AS 'NAME', user_card.first_name, subscription.price FROM user_card
INNER JOIN member ON member.id_user_card = user_card.id_user
INNER JOIN subscription ON subscription.id_sub = member.id_sub
WHERE subscription.price > 42;