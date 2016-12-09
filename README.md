# Course Links

## Overview
[Course Links](http://bit.ly/course-links-demo) is an app for students to share links (articles, resources, etc.) with their classmates. This is the GitHub tutorial component of my Sheridan IMM Tech Studio Project. The following technologies were used:
* PHP
* MySQL
* HTML
* CSS
* jQuery

## Installation
1. Download and unzip the repo. There is an SQL file along with 2 folders:
  1. "public" folder: contains the index.php file along with other PHP, JS, and CSS files that you can make accessible to anyone on the Internet
  2. "includes" folder: contains PHP files that you should make private (ex. contains your database username, password, etc.)
 
### Local Server
If you want to run the app locally, then follow these steps:
1. Download and install the MAMP (Mac), WAMP (Windows), or LAMP (Linux) local server environment
2. Move the "public" and "includes" folders to the root directory (/Applications/MAMP/htdocs on Mac) or change the Document Root in MAMP under the Preferences > Web Server sub-menu to the "public" folder.
3. Open the WebStart page and access phpMyAdmin.
4. Create a new database. Remember the name.
5. Click the "Import" tab in your new database.
6. Click "Choose File", navigate to the course-links.sql file in the repo folder, select it then click "Go".
7. Now navigate back to the phpMyAdmin homepage and click the "Users" tab. If you do not already have a user with "ALL PRIVILEGES" for your new database (it is not recommended to use "root" beyond your local server), then create a new user by clicking "Add user", then assign a username, password, and click "Check All" for Global Privileges, then click "Go".
8. Enter your database name, username, and password (leave server as "localhost") into the following files:
  1. includes > db_connection_open.php
  2. public > like_config.inc.php (I plan to merge this file with db_connection_open.php in the next version of this app)
9. Open your browser to [http://localhost:8888/](http://localhost:8888/) (or whatever your Apache port is in MAMP's Preferences > Ports sub-menu) and you should see the app running in your local environment!

### Hosted Server
If you want to run the app on a hosted server, then follow these steps:
3. Access phpMyAdmin via your host's Control Panel.
4. Create a new database. Remember the name.
5. Click the "Import" tab in your new database.
6. Click "Choose File", navigate to the course-links.sql file in the repo folder, select it then click "Go".
7. Now navigate back to the phpMyAdmin homepage and click the "Users" tab. If you do not already have a user with "ALL PRIVILEGES" for your new database (it is not recommended to use "root" beyond your local server), then create a new user by clicking "Add user", then assign a username, password, and click "Check All" for Global Privileges, then click "Go".
8. Enter your database name, username, and password (leave server as "localhost") into the following files:
  1. includes > db_connection_open.php
  2. public > like_config.inc.php (I plan to merge this file with db_connection_open.php in the next version of this app)
1. Upload or FTP the contents of the "public" folder into the "public_html" folder that should already exist on your server.
2. Upload or FTP the "includes" folders to parent directory that holds the "public_html" folder.
9. Open your browser to [http://localhost:8888/](http://localhost:8888/) (or whatever your Apache port is in MAMP's Preferences > Ports sub-menu) and you should see the app running in your local environment!

2. Create a new database in your MySQL database management system - usually phpMyAdmin, which can be accessed via your local server environment or your host's Control Panel.

## Credits
The content management system built in [Lynda.com PHP and MySQL Essential Training course](https://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html) was used as the foundation for this app. I also used the [Smart Like Buttons script from CodeCanyon.net](https://codecanyon.net/item/smart-like-buttons/5299190?s_rank=4) for the voting system.
