SELECT REVERSE(substring(distrib.phone_number, 2)) AS 'rebmunenohp' FROM distrib 
WHERE distrib.phone_number LIKE '05%';