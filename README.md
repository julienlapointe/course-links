# Course Links

This is the GitHub tutorial component of my Sheridan IMM Tech Studio Project. This tutorial is designed to get a new developer up and running with Course Links on their local or hosted server. 

## Overview
[Course Links](http://bit.ly/course-links-demo) is an app for students to share links (articles, resources, etc.) with their classmates. Watch the [demo video](https://www.youtube.com/watch?v=Bhli3L8BpnQ&feature=youtu.be) to see the app in action. 

## Technologies
* PHP
* MySQL
* HTML
* CSS
* jQuery

## Features
Checked features are included in this release. Unchecked are planned for future releases. Feel free to suggest new features!
- [x] Log in, logout, and create a new user (passwords encrypted with MD5 hashing)
- [x] Add new courses
- [x] Post new links 
- [x] Vote on links (NOTE: I will restrict the ability to “like” links to only authenticated users in the next release)
- [x] Search for courses, links, and users 
- [x] Form validation
- [ ] User sign up form
- [ ] Different privileges based on account type (ex. standard user vs. admin user)
- [ ] Rank links by number of votes
- [ ] Follow courses and other users
- [ ] Community management features (ex. report abusive users, report links that are inappropriate or posted to the wrong course, etc.)
- [ ] Comment on links, vote on comments, and delete their own comments
- [ ] Receive “reputation points” as other users upvote their links or comments
- [ ] Receive notifications when another user interacts with them (ex. follows them, upvotes their link or comment)
- [ ] Receive content recommendations based on their past activity (ex. links liked, courses and users followed)
- [ ] Updated UI

## Installation
Download and unzip the repo. You will find an SQL file along with 2 folders:
1. "public" folder: contains the index.php file along with other PHP, JS, and CSS files that you can make accessible to anyone on the Internet.
2. "includes" folder: contains PHP files that you should make private (ex. contains your database login credentials).
 
#### Local Server (MAMP on Mac)
1. Download and install [MAMP](https://www.mamp.info/en/) on your Mac. You can follow these instructions on [WAMP (Windows)](http://www.wampserver.com/en/) or [LAMP (Linux)](https://bitnami.com/stack/lamp/installer), however some steps may be different.
2. Open the WebStart page and access phpMyAdmin.
3. Create a new database. Remember the name of your database - we will need it later.
4. Import the SQL file by following these steps:
  1. Click the "Import" tab in your new database.
  2. Click "Choose File", navigate to the course-links.sql file in the repo folder, and select it. 
  3. Click "Go".
5. Navigate back to the phpMyAdmin homepage and click the "Users" tab. The "root" user with password "root" should already have "ALL PRIVILEGES" for your new database. If not, you can edit the "root" user or create a new user by following these steps:
  1. Click "Add user". 
  2. Assign a username and password. Remember your username and password - we will need them later.
  3. Click "Check All" for Global Privileges.
  4. Click "Go".
6. Enter your database name, username, and password (leave server as "localhost") into the following files:
  1. includes > db_connection_open.php
  2. public > like_config.inc.php (NOTE: I will merge this file with db_connection_open.php in the next release)
7. Move the "public" and "includes" folders to the MAMP root directory (/Applications/MAMP/htdocs by default) or change the Document Root in MAMP under the Preferences > Web Server sub-menu to the "public" folder.
8. Open your browser to [http://localhost:8888/](http://localhost:8888/) (or whatever your Apache port is set to in MAMP's Preferences > Ports sub-menu) and you should see the app running in your local environment!

#### Hosted Server
1. Log into your hosting account (ex. [GoDaddy](https://ca.godaddy.com/hosting/web-hosting)).
2. Access phpMyAdmin via your host's cPanel (or equivalent hosting platform).
3. Create a new database. Remember the name of your database - we will need it later.
4. Import the SQL file by following these steps:
  1. Click the "Import" tab in your new database.
  2. Click "Choose File", navigate to the course-links.sql file in the repo folder, and select it. 
  3. Click "Go".
5. Navigate back to the phpMyAdmin homepage and click the "Users" tab. If you do not already have a user with "ALL PRIVILEGES" for your new database (it is **not** recommended to use the "root" user beyond your local server), then create a new user by following these steps:
  1. Click "Add user". 
  2. Assign a username and password. Remember your username and password - we will need them later.
  3. Click "Check All" for Global Privileges.
  4. Click "Go".
6. Enter your database name, username, password, and server (sometimes "localhost", but check with your host) into the following files:
  1. includes > db_connection_open.php
  2. public > like_config.inc.php (NOTE: I will merge this file with db_connection_open.php in the next release)
7. Upload / FTP the contents of the "public" folder into the "public_html" folder that should already exist on your server.
8. Upload / FTP the "includes" folders to parent directory. The "includes" folder should be at the same level as the "public_html" folder.
9. Open your browser to your domain name or to the temporary URL provided by your host and you should see the app running on the web!

## Credits
The content management system built in [Lynda.com PHP and MySQL Essential Training course](https://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html) was used as the foundation for this app. I also used the [Smart Like Buttons script from CodeCanyon.net](https://codecanyon.net/item/smart-like-buttons/5299190?s_rank=4) for the voting system.
