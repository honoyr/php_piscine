SELECT COUNT(*) AS 'nb_susc',
FLOOR(AVG(subscription.price)) AS 'av_susc',
(SUM(subscription.duration_sub) % 42) AS 'ft' 
FROM subscription;