SELECT count(*), opinions.id 
FROM opinions, opinion_has_likes
GROUP BY opinion_id;


select opinion_id, count(*) from opinion_has_likes
where 1
group by opinion_id

SELECT 
opinions.id, 
opinions.theme_id, 
opinions.user_id, 
opinions.title, 
opinions.text, 
opinions.date, 
opinions.status, 
opinions.comments
COUNT(opinion_has_likes.opinion_id) AS like_count
FROM opinions WHERE opinions.theme_id = 8
JOIN opinion_has_likes ON opinions.id = opinion_has_likes.opinion_id
GROUP BY opinion_has_likes.like_status

SELECT
theme.id
COUNT(themes.id WHERE themes.parent = themes.id) AS subtheme_count
FROM
themes


-- Alle Meinungen eines Topics
SELECT themes.id, COUNT(topics.theme_id) AS topics_count
FROM themes
LEFT JOIN topics ON themes.id = topics.theme_id
WHERE themes.id = 1
GROUP BY topics.theme_id

-- Alle Topics, Meinungen und Kommentare eines Themas auflisten
SELECT themes.id AS theme_id, topics.id AS topic_id, COUNT(opinions.topic_id) AS opinion_count, COUNT(comments.opinion_id) AS comments_count
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
WHERE themes.id = 1
GROUP BY opinions.topic_id

-- Alle Topics, Meinungen und Kommentare eines Themas in einer Zeile anzeigen
SELECT themes.id AS theme_id, COUNT(topics.theme_id) AS topic_count, COUNT(opinions.topic_id) AS opinion_count, COUNT(comments.opinion_id) AS comments_count
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
WHERE themes.id = 1
GROUP BY themes.id

-- Theme-Level berechnen
SELECT themes.id AS theme_id, ((COUNT(topics.theme_id) * 15) + (COUNT(opinions.topic_id) * 10) + (COUNT(comments.opinion_id) * 1)) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
WHERE themes.id = 1 
GROUP BY themes.id

-- Theme-Level mit zeitlicher Eingrenzung berechnen
SELECT themes.id AS theme_id, ((COUNT(topics.theme_id) * 15) + (COUNT(opinions.topic_id) * 10) + (COUNT(comments.opinion_id) * 1)) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
WHERE 
topics.date BETWEEN FROM_UNIXTIME(1318763200 ) AND FROM_UNIXTIME(1478810979) AND
opinions.date BETWEEN FROM_UNIXTIME(1318763200 ) AND FROM_UNIXTIME(1478810979) AND
comments.date BETWEEN FROM_UNIXTIME(1318763200 ) AND FROM_UNIXTIME(1478810979)
GROUP BY themes.id


-- Theme-Level mit zeitlicher Eingrenzung berechnen
SELECT 
themes.id AS theme_id,
((COUNT(topics.theme_id) * 15) + topics.date/100000000000) AS topic_count,
((COUNT(opinions.topic_id) * 10) + opinions.date/100000000000) AS opinion_count,
((COUNT(comments.opinion_id) * 1) + IFNULL(comments.date, 0)/100000000000) AS comments_count,
(
    ((COUNT(topics.theme_id) * 15) + topics.date/100000000000) +
    ((COUNT(opinions.topic_id) * 10) + opinions.date/100000000000) +
	((COUNT(comments.opinion_id) * 1) + IFNULL(comments.date, 0)/100000000000)
) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
GROUP BY themes.id

SELECT
themes.id AS theme_id,
themes.link,
themes.name,
themes.teaser,
themes.date,
themes.image,
themes.status,
COUNT(topics.theme_id) AS topic_count,
COUNT(opinions.topic_id) AS opinion_count,
IFNULL(COUNT(comments.opinion_id), 0) AS comments_count,
(
	((COUNT(topics.theme_id) * 5) + DAY(topics.date) + MONTH(topics.date) + YEAR(topics.date)) +
	((COUNT(opinions.topic_id) * 8) + DAY(opinions.date) + MONTH(opinions.date) + YEAR(opinions.date))
) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
GROUP BY themes.id
LIMIT 2

SELECT
themes.id AS theme_id,
themes.link,
themes.name,
themes.teaser,
themes.date,
themes.image,
themes.status,
COUNT(topics.theme_id) AS topic_count,
(
	(COUNT(topics.theme_id) * 5) + (DAY(topics.date) + MONTH(topics.date) + YEAR(topics.date)) * COUNT(topics.theme_id)
) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
GROUP BY themes.id
LIMIT 2

SELECT
themes.id AS theme_id,
themes.link,
themes.name,
themes.teaser,
themes.date,
themes.image,
themes.status,
COUNT(topics.theme_id) AS topic_count,
COUNT(opinions.topic_id) AS opinion_count,
IFNULL(COUNT(comments.opinion_id), 0) AS comments_count,
(
	((COUNT(topics.theme_id) * 5) + (DAY(topics.date) + MONTH(topics.date) + YEAR(topics.date))*COUNT(topics.theme_id)) +
	((COUNT(opinions.topic_id) * 8) + (DAY(opinions.date) + MONTH(opinions.date) + YEAR(opinions.date))*COUNT(opinions.topic_id))
) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
GROUP BY themes.id
LIMIT 2

SELECT
themes.id AS theme_id,
themes.link,
themes.name,
themes.teaser,
themes.date,
themes.image,
themes.status,
COUNT(topics.theme_id) AS topic_count,
COUNT(opinions.topic_id) AS opinion_count,
IFNULL(COUNT(comments.opinion_id), 0) AS comments_count,
((COUNT(topics.theme_id) * 5) + (DAY(topics.date) + MONTH(topics.date) + YEAR(topics.date))*COUNT(topics.theme_id)) AS topic_level,
((COUNT(opinions.topic_id) * 8) + (DAY(opinions.date) + MONTH(opinions.date) + YEAR(opinions.date))*COUNT(opinions.topic_id)) AS opinion_level,
((COUNT(comments.opinion_id) * 1) + IFNULL((DAY(comments.date) + MONTH(comments.date) + YEAR(comments.date)) * COUNT(comments.opinion_id), 0)) AS comments_level,
(
    ((COUNT(topics.theme_id) * 5) + (DAY(topics.date) + MONTH(topics.date) + YEAR(topics.date))*COUNT(topics.theme_id)) +
    ((COUNT(opinions.topic_id) * 8) + (DAY(opinions.date) + MONTH(opinions.date) + YEAR(opinions.date))*COUNT(opinions.topic_id)) +
    (
        (COUNT(comments.opinion_id) * 1) + 
        IFNULL(
            (
                DAY(comments.date) + 
                MONTH(comments.date) + 
                YEAR(comments.date)
            ) * 
            COUNT(comments.opinion_id), 
            0
        )
    )
) AS theme_level
FROM topics
LEFT JOIN themes ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
GROUP BY themes.id
LIMIT 2


SELECT
themes.name AS theme_name,
topics.name AS topic_name,
topics.date AS topic_date,
SUM(DAY(topics.date)) + SUM(MONTH(topics.date)) + SUM(YEAR(topics.date)) AS topic_date_level,
topics.id AS topic_id
FROM themes
JOIN topics ON themes.id = topics.theme_id
GROUP BY themes.id


SELECT
themes.name AS theme_name,
topics.name AS topic_name,
topics.date AS topic_date,
topics.id AS topic_id,
SUM(IF(5 - DATEDIFF(CURRENT_DATE, DATE(topics.date)) < 0, 0, 10 - DATEDIFF(CURRENT_DATE, DATE(topics.date)))) AS topic_level
FROM themes
JOIN topics ON themes.id = topics.theme_id
GROUP BY themes.id

-- Levelcount-Berechnung durch Abzug einer faktorisierten Datumsdifferenz

-- Version phpmyadmin
SELECT
themes.id,
themes.id AS theme_id,
themes.link,
themes.name,
themes.teaser,
themes.date,
themes.image,
themes.status,
IFNULL(SUM(IF(5 - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/10) < 0, 0, 5 - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/10))), 0) AS topic_level,
IFNULL(SUM(IF(8 - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/10) < 0, 0, 8 - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/10))), 0) AS opinion_level,
IFNULL(SUM(IF(1 - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/10) < 0, 0, 1 - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/10))), 0) AS comment_level,
(
	IFNULL(SUM(IF(5 - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/10) < 0, 0, 5 - (DATEDIFF(CURRENT_DATE, 			DATE(topics.date))/10))), 0) +
	IFNULL(SUM(IF(8 - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/10) < 0, 0, 8 - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/10))), 0) +
	IFNULL(SUM(IF(1 - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/10) < 0, 0, 1 - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/10))), 0) 
) AS level_count
FROM themes
JOIN topics ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
GROUP BY themes.id
ORDER BY level_count DESC
LIMIT 1

-- Version live
SELECT
themes.id,
themes.id AS theme_id,
themes.link,
themes.name,
themes.teaser,
themes.date,
themes.image,
themes.status,
IFNULL(SUM(IF(:topic_fac - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/:time_fac) < 0, 0, :topic_fac - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/:time_fac))), 0) AS topic_level,
IFNULL(SUM(IF(:opinion_fac - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/:time_fac) < 0, 0, :opinion_fac - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/:time_fac))), 0) AS opinion_level,
IFNULL(SUM(IF(:comment_fac - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/:time_fac) < 0, 0, :comment_fac - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/:time_fac))), 0) AS comment_level,
(
        IFNULL(SUM(IF(:topic_fac - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/:time_fac) < 0, 0, :topic_fac - (DATEDIFF(CURRENT_DATE, DATE(topics.date))/:time_fac))), 0) +
        IFNULL(SUM(IF(:opinion_fac - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/:time_fac) < 0, 0, :opinion_fac - (DATEDIFF(CURRENT_DATE, DATE(opinions.date))/:time_fac))), 0) +
        IFNULL(SUM(IF(:comment_fac - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/:time_fac) < 0, 0, :comment_fac - (DATEDIFF(CURRENT_DATE, DATE(comments.date))/:time_fac))), 0) 
) AS level_count
FROM themes
JOIN topics ON themes.id = topics.theme_id
LEFT JOIN opinions ON topics.id = opinions.topic_id
LEFT JOIN comments ON opinions.id = comments.opinion_id
GROUP BY themes.id
ORDER BY level_count DESC
LIMIT $count