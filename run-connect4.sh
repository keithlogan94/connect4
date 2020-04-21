#!/bin/bash

#clear
#echo "stopping last container"
#docker stop connect4-server
#echo "removing last container"
#docker rm connect4-server
#echo "starting connect4-server"
docker-compose down -v
docker-compose build
docker-compose up -d
#docker run --name connect4-server -d -p 8377:80 -it connect4
echo "started server"
# running server on port 8378 to avoid conflict with any server running on common ports
echo "Access the server at http://localhost:8085"




