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
