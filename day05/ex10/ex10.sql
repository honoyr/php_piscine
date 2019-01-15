SELECT title 'Title' FROM film;

SELECT title 'Title', summary 'Summary', genre FROM film WHERE genre like '%erotic%';


SELECT title 'Title', summary 'Summary' FROM film INNER JOIN genre ON film.id_genre=genre.id_genre WHERE genre like '%erotic%';

SELECT title 'Title', summary 'Summary' FROM film INNER JOIN genre ON film.id_genre=genre.id_genre;

SELECT title 'Title', summary 'Summary', prod_year FROM film
INNER JOIN genre ON film.id_genre=25
ORDER BY prod_year DESC;

SELECT title 'Title', summary 'Summary', prod_year FROM film
INNER JOIN genre ON film.id_genre=genre.id_genre
ORDER BY prod_year DESC;

SELECT title AS 'Title', summary AS 'Summary', prod_year FROM film
INNER JOIN genre ON film.id_genre=genre.id_genre
WHERE genre.name = 'erotic'
ORDER BY prod_year DESC;