#!/bin/bash

#Run Connect4 in Docker container
clear
echo "stopping last container"
docker stop connect4-server
echo "removing last container"
docker rm connect4-server
echo "starting connect4-server"
docker run --name connect4-server -d -p 8080:80 -it connect4
echo "started server"
echo "Access the server at http://localhost:8080"




