#!/bin/bash

#Build docker image
clear
docker remove connect4
docker build . -t connect4




