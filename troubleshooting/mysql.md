# MySQL Problems

## Problem

I encountered SSL-related errors when trying to connect to the docker mysql-server from the command line on my Mac OS.

(I do not have this problem with MySQL Workbench or RMariaDB). 


## Solution

In order to connect, you need to use native authentication. This can be done by including the following statement in one of the `lamp-rm/mysql` startup files. However, note that with this setting, PhpMyAdmin will not be able to connect.

```
ALTER USER "root" IDENTIFIED WITH mysql_native_password BY "password";
```

You can then connect to mysql from the command line using the following:
```
mysql -h 0.0.0.0 -P 3000 -u root -p  --ssl-mode=disabled
```

## Alternative Solution

You can also log into the mysql container and run the appropriate MySQL command.  This can be done in a single step (replace *`c36` with the appropriate container ID):

```
 docker exec -it c36 bash -c 'mysql -u root --password=password -e "ALTER USER \"root\" IDENTIFIED WITH mysql_native_password BY \"password\""'
```

Native authentication will persist as long as the corresponding volume is not deleted.
