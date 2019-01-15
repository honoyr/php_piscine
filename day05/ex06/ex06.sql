SELECT title, summary FROM film;



SELECT title, summary FROM film 
WHERE sammary = "Vincent";

SELECT title, summary FROM film 
WHERE summary LIKE '%Vincent%';

SELECT title, summary FROM film 
WHERE summary LIKE '%Vincent%'
ORDER BY id_film ASC;