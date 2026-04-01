FROM php:8.2-apache
# Cài đặt extension mysqli để PHP kết nối được với MySQL
RUN docker-php-ext-install mysqli
# Copy code vào thư mục web mặc định của Apache
COPY ./index.php /var/www/html/