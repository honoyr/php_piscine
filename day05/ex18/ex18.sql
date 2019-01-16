SELECT distrib.name FROM distrib;

SELECT distrib.name FROM distrib
WHERE distrib.name LIKE '%y%' OR distrib.name LIKE '%Y%';

SELECT distrib.name FROM distrib
WHERE (distrib.name LIKE '%y%' OR distrib.name LIKE '%Y%') AND distrib.id_distrib = (42);


SELECT distrib.name FROM distrib
WHERE (distrib.name LIKE '%y%' OR distrib.name LIKE '%Y%') 
AND (distrib.id_distrib = 42 OR distrib.id_distrib = 71
     OR  distrib.id_distrib >= 62 AND <= 69 
     OR	distrib.id_distrib >= 88 AND <= 90);


SELECT distrib.name FROM distrib
WHERE (distrib.name LIKE '%y%' OR distrib.name LIKE '%Y%') 
AND (distrib.id_distrib = 42 OR distrib.id_distrib = 71
     OR  (distrib.id_distrib >= 62 AND <= 69) 
     OR	(distrib.id_distrib >= 88 AND < 91));


SELECT distrib.name FROM distrib
WHERE (distrib.name LIKE '%y%' OR distrib.name LIKE '%Y%') 
AND (distrib.id_distrib = 42 OR distrib.id_distrib = 71
     OR (distrib.id_distrib >= 62 AND < 70) 
     OR	(distrib.id_distrib >= 88 AND < 91));




SELECT name 
FROM distrib 
WHERE id_distrib = 42 
OR (id_distrib >= 62 AND id_distrib < 70)
OR id_distrib = 71 
OR (id_distrib >= 88 AND id_distrib < 91) 
AND (distrib.name LIKE '%y%' OR distrib.name LIKE '%Y%');

LENGTH(lower(name)) - LENGTH(REPLACE(lower(name), 'y', '')) = 2 LIMIT 2, 5;


SELECT name 
FROM distrib
WHERE id_distrib = 42 
OR (id_distrib >= 62 AND id_distrib < 70) 
OR id_distrib = 71 OR (id_distrib >= 88 AND id_distrib < 91) 
AND LENGTH(lower(name)) - LENGTH(REPLACE(lower(name), 'y', '')) = 2 LIMIT 2, 5;

SELECT name 
FROM distrib
WHERE id_distrib = 42 
OR (id_distrib >= 62 AND id_distrib < 70) 
OR id_distrib = 71 OR (id_distrib >= 88 AND id_distrib < 91) 
OR LENGTH(lower(name)) - LENGTH(REPLACE(lower(name), 'y', '')) = 2 LIMIT 2, 5;


