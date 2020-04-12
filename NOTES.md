# Notes


## How to build this project

This project uses docker and docker compose for a convenient build process.

To build this project please make sure that docker, and docker-compose are installed on your host computer.

Then please run `docker-compose up -d` or you can run the bash script that I have built `./rebuild-run.sh`



## IMPORTANT Port Info

I have setup the `docker-compose.yml` file to serve the server over port 8378, becuase I wanted to avoid any conflict with any existing server using a common port (80,8080).

If the port needs to be changed, then there are two files that need to be updated to make this change. I have tried to make this as convenient as possible.

The port needs to be updated in `docker-compose.yml` and `settings.ini` to match whichever port is wanted.

If the port is not changed then after running `docker-compose up -d` or `./rebuild-run.sh`
you can run the application by going to  [http://localhost:8378/](http://localhost:8378/)






