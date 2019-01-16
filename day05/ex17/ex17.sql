SELECT AVG(subscription.price) FROM subscription;

SELECT COUNT(*) AS 'nb_susc', AVG(subscription.price) AS 'av_susc' FROM subscription;

SELECT COUNT(*) AS 'nb_susc', FLOOR(AVG(subscription.price)) AS 'av_susc' FROM subscription;

SELECT COUNT(*) AS 'nb_susc', FLOOR(AVG(subscription.price)) AS 'av_susc', (SUM(subscription.duration_sub)) FROM subscription;

SELECT COUNT(*) AS 'nb_susc', FLOOR(AVG(subscription.price)) AS 'av_susc', (SUM(subscription.duration_sub) % 42) FROM subscription;

SELECT COUNT(*) AS 'nb_susc',
FLOOR(AVG(subscription.price)) AS 'av_susc',
(SUM(subscription.duration_sub) % 42) AS 'ft' 
FROM subscription;