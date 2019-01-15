SELECT `last_name` FROM `user_card` WHERE size < 9; 


SELECT `last_name` 
FROM `user_card`
WHERE last_name LIKE '@a@' AND LENGTH =< 9; 

SELECT `last_name` 
FROM `user_card`
WHERE last_name LIKE '@a@' AND LENGTH=< 9;


SELECT last_name
FROM user_card
WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
ORDER BY last_name ASC
LIMIT 10;

SELECT last_name, birthdate
FROM user_card
WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
ORDER BY last_name ASC
LIMIT 10;

INSERT INTO ft_table ('login', 'group', 'creation_date')
SELECT last_name, birthdate
FROM user_card
WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
ORDER BY last_name ASC
LIMIT 10;


INSERT INTO ft_table ('login', 'group', 'creation_date')
SELECT last_name, 'other' birthdate
FROM user_card
WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
ORDER BY last_name ASC
LIMIT 10;

INSERT INTO ft_table (login, `group`, creation_date)
SELECT last_name, 'other', birthdate
FROM user_card
WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9
ORDER BY last_name ASC
LIMIT 10;