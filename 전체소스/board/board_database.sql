CREATE TABLE `board_table` (
	`idx` INT(10,0) NOT NULL AUTO_INCREMENT COMMENT '게시글 일련번호',
	`board_title` CHAR(200) NOT NULL COMMENT '게시글 제목' COLLATE 'utf8mb4_unicode_ci',
	`username` CHAR(10) NOT NULL COMMENT '닉네임' COLLATE 'utf8mb4_unicode_ci',
	`id` CHAR(15) NOT NULL COMMENT '유저 아이디' COLLATE 'utf8mb4_unicode_ci',
	`create_date` CHAR(20) NOT NULL COMMENT '게시글 작성 날짜' COLLATE 'utf8mb4_unicode_ci',
	`click_count` INT(10,0) NOT NULL COMMENT '게시글 조회수',
	`content` TEXT(65535) NOT NULL COMMENT '게시글 내용' COLLATE 'utf8mb4_unicode_ci',
	`file_name` CHAR(40) NULL DEFAULT NULL COMMENT '첨부파일' COLLATE 'utf8mb4_unicode_ci',
	`file_type` CHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`file_copied` CHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`idx`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=6
;