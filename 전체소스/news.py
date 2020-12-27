#!/usr/bin/python3
#-*- coding: utf-8 -*-


from urllib.request import urlopen
from bs4 import BeautifulSoup
import pymysql


# MySQL Connection 연결
conn = pymysql.connect(host='cs.cqwkirpcobml.ap-northeast-2.rds.amazonaws.com', user='dbhost', password='',
                       db='csdb', charset='utf8')
 
# Connection 으로부터 Cursor 생성
curs = conn.cursor()




# 크롤링 작업

html = urlopen("https://news.daum.net/digital#1")

bsObject = BeautifulSoup(html, "html.parser")

#for link in bsObject.find_all('a'):
#    print(link.text.strip(), link.get('href'))

link_title = bsObject.find_all('a',{'data-tiara-layer':'article_main'})

del_sql = "delete from news"
curs.execute(del_sql)

for title in link_title:
    ar_id = title.get('data-tiara-id')
    ar_title = title.text.strip()
    ar_link = title.get('href')
    link_img = bsObject.find('img',{'alt':title.text.strip()}).get('src')
    # SQL문 실행

    insert_sql = "insert into news(id,title, link, img) values(%s,%s,%s,%s)"
    val = (ar_id,ar_title,ar_link,link_img)
    curs.execute(insert_sql,val)

#
conn.commit()

# Connection 닫기
conn.close()
