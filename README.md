# webapp-noti

# ขั้นตอนในการ Bulid Project
```sh
เรียงตามขั้นตอนดังต่อไปนี้ ...
 $ docker build -t wblntf .
 $ docker network create mynet
 $ docker run -d --name webme --network mynet --restart always -p 80:80 \
   wblntf

 $ docker pull bitnami/mysql:5.7
 $ docker run -d --name mysql --network mynet --restart always \
   -e MYSQL_ROOT_PASSWORD=password -e MYSQL_DATABASE=web_noti \
   bitnami/mysql:5.7

```

# ขั้นตอนการในการสร้าง Database 
```sh
มีขั้นตอนดังต่อไปนี้ ....
เข้าไปใน container mysql 
$ docker exec -it  <container_Name> sh

พิมพ์คำสั่งต่อไปนี้ 
$ mysql -u root -p password
$ use web_noti
$ mysql -u username -root p password < web_noti.sql
$ quit

```
