FROM debian:wheezy

RUN apt-get upgrade -y
RUN apt-get update
RUN apt-get install -y wget ca-certificates

RUN wget -qO - http://www.dotdeb.org/dotdeb.gpg | apt-key add -
ADD docker-resources/dotdeb.list /etc/apt/sources.list.d/dotdeb.list

RUN apt-get update
RUN apt-get install -y php5 php5-curl php-pear php5-dev git
RUN pecl install xdebug

RUN php -r "readfile('https://getcomposer.org/installer');" | php
RUN mv composer.phar /usr/local/bin/composer

ADD docker-resources/xdebug.ini /etc/php5/mods-available/xdebug.ini
RUN echo "date.timezone = America/Sao_Paulo" > /etc/php5/mods-available/timezone.ini
RUN echo "intl.default_locale = pt_BR" >> /etc/php5/mods-available/intl.ini
RUN php5enmod xdebug && php5enmod timezone

RUN a2enmod php5
RUN a2enmod rewrite
ADD docker-resources/apache-site-default.conf /etc/apache2/sites-available/default