SELECT distrib.phone_number FROM distrib;

SELECT distrib.phone_number FROM distrib 
WHERE distrib.phone_number LIKE '05%';

SELECT REVERSE(substring(distrib.phone_number, 2)) AS 'rebmunenohp' FROM distrib 
WHERE distrib.phone_number LIKE '05%';