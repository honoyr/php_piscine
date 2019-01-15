SELECT last_name, first_name FROM user_card WHERE DATE(birthdate);


SELECT last_name, first_name, DATE(birthdate)
FROM user_card 
WHERE YEAR(birthdate) = 1989
ORDER BY last_name ASC;