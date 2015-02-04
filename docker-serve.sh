#!/bin/bash

docker run -it -v "$(pwd)":/var/www -w /var/www -p 80:80 -p 9000:9000 -d find-my-flickr-photos \
/usr/sbin/apache2ctl -D FOREGROUND
