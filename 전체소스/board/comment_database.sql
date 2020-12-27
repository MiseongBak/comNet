CREATE TABLE `comment_table` (
	`com_key` INT(10,0) NOT NULL AUTO_INCREMENT COMMENT '댓글 고유번호',
	`board_index` INT(10,0) NOT NULL COMMENT '게시글 번호',
	`comment` LONGTEXT NOT NULL COMMENT '댓글 내용' COLLATE 'utf8mb4_unicode_ci',
	`writer` VARCHAR(50) NOT NULL COMMENT '작성자' COLLATE 'utf8mb4_unicode_ci',
	`com_date` DATETIME NOT NULL COMMENT '작성일',
	PRIMARY KEY (`com_key`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;