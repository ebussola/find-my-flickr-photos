#!/bin/bash

mkdir logs
docker build -t find-my-flickr-photos .
./docker-run.sh composer install
