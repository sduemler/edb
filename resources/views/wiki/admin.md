# Admin Document

## Installation

### Server Requirements

 - PHP >= 7.0.0
   - OpenSSL PHP Extension
   - PDO PHP Extension
   - Mbstring PHP Extension
   - Tokenizer PHP Extension
   - XML PHP Extension
 - [composer](https://getcomposer.org/)
 - Apache Web Server
   - this project is configured for Apache web server. It is possible to deploy this project to a Nginx web server. If you are using Nginx, the following directive in your site configuration will direct all requests to the `index.php` front controller:
       ```bash
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
       ```
 - MySQL >= 5.6
 
### Download Application Package

clone project folder to local machine (server)

```bash
git clone https://github.com/mingchaoliao/edb.git edb-src
```

get into project folder

```bash
cd edb-src
```

make `artisan` executable

```bash
chmod 777 artisan
```

download dependencies

```bash
composer update
```

### Configuration

make a copy of `.env.example` and name it to `.env`

```bash
cp .env.example .env
```

generate application key (do not re-generate key for server migration)

```bash
php artisan key:generate
```

create database in MySQL (user `root` account, or account with certain privilege)

```sql
DREATE DATABASE <database name>;
```

open `.env` file

 - change `DB_HOST` to the MySQL server address (ip address)
 - change `DB_DATABASE` to the name of database created in previous step
 - change `DB_USERNAME` to the database user name you wanted to use
   - if you want to create a new database user (using `root` account)
     - create user
       ```sql
       CREATE USER '<username>'@'localhost' IDENTIFIED BY '<password>';
       ```
     - grant user with access to the application database
       ```sql
       GRANT ALL PRIVILEGES ON <database name created in previous step> . * TO '<username created in previous step>'@'localhost';
       ```
     - reload all the privileges
       ```sql
       FLUSH PRIVILEGES;
       ```
 - change `DB_PASSWORD` to password of corresponding user
 - change `APP_ADMIN_NAME` to one of administrator name
 - change `APP_ADMIN_EMAIL` to email of administrator
 - change `DUMP_BINARY_PATH` to path of directory which contains binay file: mysqldump, in ubuntu, it's in `/usr/bin`

```bash
APP_ENV=local
APP_KEY=<application key generated from previous step>
APP_DEBUG=false
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=<server host name / IP address, e.g. loclhost>
DB_PORT=3306
DB_DATABASE=<database name>
DB_USERNAME=<database username>
DB_PASSWORD=<database password>

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

APP_ADMIN_NAME=<admin name>
APP_ADMIN_EMAIL=<admin email>

DUMP_BINARY_PATH=<path of directory which contains binay file: mysqldump, in ubuntu, it's in /usr/bin>
```

### Create Database Table With Pre-filled Data

```bash
php artisan migrate
```

note: after executing this command, a default super administrator account have been created.

 - email: `admin@localhost`
 - password: same as value of `APP_KEY` in `.env` file

### Make Current User Have Access To Application Folder (For Apache Web Server)

get current user

```bash
whoami
```

figure out default group for web content (in Ubuntu and Debian is `www-data`)

add current user to web group
```bash
sudo usermod -a -G www-data <current user>
sudo chgrp -R www-data /var/www
sudo chmod -R g+w /var/www
sudo find /var/www -type d -exec chmod 2775 {} \;
sudo find /var/www -type f -exec chmod ug+rw {} \;
```

### Create Symlink For Accessing Application

```bash
ln -s /path/to/edb-src/public /path/to/application_name
```

## Database Management

Warning: modifying raw databse is not recommended. Modifying ONLY when necessary !

### Tables

 - `migrations`: used to manage table migrations
   - DANGER: DO NOT MODIFY THIS TABLE !
 - password_resets
   - used to reset user password
   - Note: this table is currently not being used
   - DANGER: DO NOT MODIFY THIS TABLE !
 - `requests`: store creation/modification requests (requested by contributors) which need administrators/researchers to approve/deny
 - `roles`: store user roles
   - 1 -> administrator
   - 2 -> researcher
   - 3 -> contributor
   - 4 -> guest
   - DANGER: DO NOT MODIFY THIS TABLE !
 - `schemes`: store schema of species 
   - DANGER: DO NOT MODIFY THIS TABLE !
 - `species`: store species data (with version)
 - `users`: store user information
   - Warning: Do not delete user. Instead, changing has_deleted to 1
   
## Frequently Asked Questions

### How to change security roles for a user?

Click “Actions” in the navigation bar and click “User Management” and click “Edit” under the action column next to the specific user.  Click the “Role” drop down and change the drop down value.  Then click “Update”.

### How to delete a user?

Click “Actions” in the navigation bar and click “User Management” and click “Delete” under the action column next to the specific user.  Then click “Deactivate”.  

### How to restore a user?

Click “Actions” in the navigation bar and click “User Management” and click “Restore” under the action column next to the specific user.

### How to create a user with a specific role?

Click “Actions” in the navigation bar and click “User Management” and click “Create User”.  Enter the name, email address, password, and click the “Role” drop down to choose the user’s role.  Then click “Add User”.

### How to import data?

Click “Actions” on the navigation bar and click “Data Import” and upload a file using the instructions on the page.

### How to back up data?

Click “Actions” on the navigation bar and click “Backup” and click “Create New Backup”.
