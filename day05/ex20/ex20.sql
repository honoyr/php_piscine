SELECT	genre.id_genre 'id_genre',
		genre.name 'name_genre', 
		distrib.id_distrib 'id_distrib', 
		distrib.name 'name_distrib',
		film.title 'title_film'
FROM film 
LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib 
LEFT JOIN genre ON genre.id_genre = film.id_genre 
WHERE (film.id_genre > 3 AND film.id_genre < 9);


SELECT	genre.id_genre 'id_genre',
		genre.name 'name_genre', 
		distrib.id_distrib 'id_distrib', 
		distrib.name 'name_distrib',
		film.title 'title_film'
FROM film 
RIGHT JOIN distrib ON distrib.id_distrib = film.id_distrib 
RIGHT JOIN genre ON genre.id_genre = film.id_genre 
WHERE (film.id_genre > 3 AND film.id_genre < 9);