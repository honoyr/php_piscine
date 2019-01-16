SELECT cinema.floor_number AS 'floor' 
FROM cinema 
GROUP BY cinema.floor_number;

SELECT cinema.floor_number AS 'floor', cinema.nb_seats AS 'seats' 
FROM cinema 
GROUP BY cinema.floor_number;

SELECT cinema.floor_number AS 'floor', SUM(cinema.nb_seats) AS 'seats' 
FROM cinema 
GROUP BY cinema.floor_number;

SELECT cinema.floor_number AS 'floor', SUM(cinema.nb_seats) AS 'seats' 
FROM cinema 
GROUP BY cinema.floor_number
ORDER BY SUM(cinema.nb_seats) DESC;