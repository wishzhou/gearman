# gearman
gearman实现mysql与redis数据同步
mysql中数据库结构：
	1 id	int(6)		UNSIGNED	AUTO_INCREMENT	
	2	name	varchar(32)	utf8_general_ci	 	default		
	3	age	tinyint(3)		UNSIGNED	
mysql中触发器：
  SET @ret=gman_do_background('delToRedis', json_object(OLD.name as `oldname`))
  SET @ret=gman_do_background('syncToRedis', json_object(NEW.id as `id`, NEW.name as `name`, NEW.age as `age`)); 
  SET @ret=gman_do_background('updateToRedis', json_object(NEW.id as`id`, NEW.name as`name`,NEW.age as `age`,OLD.name as `oldname`))
mysql中对数据进行操作，包括insert，update，delete后，触发触发器，由gearman将数据发至redis_work.php，redis_work.php对redis进行操作！
  
