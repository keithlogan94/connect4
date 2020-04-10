#!/bin/bash

#Build docker image
clear
docker image rm connect4_server
docker image rm connect4
docker build . -t connect4




