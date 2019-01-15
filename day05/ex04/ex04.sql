SELECT ft_table
WHERE creation_date AND 
LENGTH(id) > 5;



WHERE creation_date AND LENGTH(id) > 5
UPDATE ft_table.creation_date
SET creation_date += 20;

UPDATE ft_table.creation_date
SET creation_date += 20;

UPDATE ft_table.creation_date
SET creation_date = DATE_ADD(creation_date, INTERVAL, 20 YEAR) WHERE id > 5;

UPDATE ft_table
SET creation_date = DATE_ADD(creation_date, INTERVAL, 20 YEAR) WHERE id > 5;

UPDATE ft_table
SET `creation_date` = DATE_ADD(creation_date, INTERVAL, 20 YEAR) WHERE id > 5;

UPDATE ft_table
SET creation_date = DATE_ADD(creation_date, INTERVAL 20 YEAR) WHERE id > 5;