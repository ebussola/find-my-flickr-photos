#!/bin/bash
cd "`dirname "$0"`"

# Start boot2docker
boot2docker up
$(boot2docker shellinit)

# Remove any running container
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)

# Build, start the server and open it on the browser
./docker-build.sh
./docker-serve.sh
open http://$(boot2docker ip)/