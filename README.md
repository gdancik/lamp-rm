# lamp-rm
  
## Docker Compose configuration for LAMP stack with R and Mongo 

This repo contains code for creating a webserver using *Docker Compose* that does the following:
- provides access to a mysql database running on port 3000
    - SQL scripts in `lamp-rm/mysql` are run when container is created
- provides access to a mongo database 
    - JS scripts in `lamp-rm/mongo` are run when container is created 
- includes basic R installation
- allows dynamic page generation through PHP and R Markdown

Note the following directory structure:
- `lamp-rm/mysql` - SQL scripts in this directory are run when MySQL database is created
- `lamp-rm/mongo` - JS scripts in this directory are run when the Mongo database is created
- `lamp-rm/html` - directory at root of webserver, e.g. localhost:8080 points to lamp-rm/html/index.html

## Usage:
Get the code by running 

``` 
git clone https://github.com/gdancik/lamp-rm.git
```

### Start the webserver by running the following from the *lamp-rm* directory:

```
docker-compose up
```

To run in the background (in a 'detached' state), type

```
docker-compose up -d
```

This will launch the webserver (PHP + MySQL + R + Mongo). The MySQL database will load data from the `lamp-rm/mysql` directory (currently an *employees* database). 

### Open a web browser and go to [localhost:8080](localhost:8080). 

Click on the links to test database and PHP/R functionality.

### To shutdown the docker containers, type the following from the *lamp-rm* directory:

```
docker-compose down
```

### Connecting to the mysql database

To connect to mysql database from your local host, use

```
user=root
password=password
host=0.0.0.0
port=3000
```

Note: MySQL is configured to use *mysql_native_password* as its default authentication. SSL related issues without this configuration are described [here](https://github.com/gdancik/lamp-rm/blob/main/troubleshooting/mysql.md).

To run only mysql server, use
```
docker run -d --name some-mysql -e MYSQL_ROOT_PASSWORD=password -v lamp-rm_mysql-data:/var/lib/mysql mysql:8.0.19
```

### MySQL data persistence

MySQL will mount data to the `lamp-rm_mysql-data` volume, which will persist between docker sessions.

To list volumes use

```
docker volume ls
```

To remove volumes use 

```
volume rm volume_name
```

To remove all volumes use

```
docker volume rm $(docker volume ls -q)
```



