# E-vote
E-vote - Your digital voting system

E-vote is a voting system designed to be used for meetings with a limited number of people. For example with different kind of associations or communities. E-vote guarantees the anonymity of every voter and gives easy control of every voting session by using personal and temporary codes that every voter has to identify him- or herself with.

Down below follows a user and a installation guide.

## User guide
The system has three kind of users that can log in on the website:
* Admin
* Election admin
* Adjuster

When the system is installed you will have an admin user. Log in with this user and you can easily create other users.

##### Admin
The admin is the user that is responsible for that the system works. This user can create and handle other users and open and close election meetings.

##### Election admin
The election admin is responsible for the voting (often the election leader). This user creates and ends the voting sessions and can also see the voting result.

##### Adjuster
The adjuster is only an observer. This user can only see the result of the different voting sessions.

### How to create a new election meeting
Log in as an admin user. Press the tab “Hantera valtillfälle”. If no election meeting is ongoing you  should be prompted with the name of the meeting and the maximum number of personal codes that will be generated. When you have filled the information in and press “Skapa” the codes will be prompted in a pdf-document. Print this document now, as the codes only will be generated once. Then the election meeting is open and the election admin can start voting sessions.

### How to close a election meeting
Log in as an admin user. Press the tab “Hantera valtillfälle”. Enter your password and press “Stäng val”.

### How the voting works
The election admin creates voting sessions by logging in and enter the correct information. The “temporary code” is the code that is needed to vote in just this voting session. Press the button “Starta ny valomgång” to start the election session. Now can the persons present in the voting room vote at the different options given. They do this by marking the option/options they want and entering their personal code along with the temporary code and then pressing “Rösta”. When the voting is finished the election admin closes the voting session and the result is now shown for the election admin and the adjuster.

### Code handling
A good strategy of handling the personal codes of a meeting is to create the election meeting before the actual meeting starts and print out the codes. Then the personal codes have to be distributed to the voters and this is easiest handled by letting those who are responsible for the election meeting see the ID of every participant and then give the code. It is very important that every voter only has one personal code and sticks to it during the whole meeting.

## Installation guide
E-vote is written in PHP and works as an ordinary website. Therefore you just have to install and configure your server to host the site. Down below is a small guide on how you do this on a Linux (distributions based on Debian) server.

1. Download the source code of this repository and put it on your server.

2.  Install your web server program, DataBase Management System (preferably MySQL) and PHP.

    The following command should provide the required packages for MySQL and PHP:
    ```
    sudo apt-get install mysql-server php5-fpm php5-mysql php5-ldap
    ```

3. Configure your web server to host a PHP website.

  (Guides can be found on the internet. For example: https://secure.php.net/manual/en/install.php)

  Down below is a example of the configuration file for E-vote for Nginx.
  
  __Note: Your website must use a proper SSL-certificate to provide proper encryption, otherwise E-vote will _not_ be secure. _Let's Encrypt_ provide free certification and is a good alternative.__
  ```
  server {
        listen   80;
        server_name evote.<your domain name>;
        access_log  /<path to logs>/access.log;
        error_log  /<path to logs>/error.log;
        root   /<path to source code>;
        index  index.html index.php;

        location ~ \.php$ {
                include php.conf;
        }


        location / {
                try_files $uri @evote;
        }

        # Always rewrite to index.php
        location @evote {
            rewrite ^(.*)$  /index.php$1    break;
            include php.conf;
        }
  }
  ```

  Create the files or replace the content of `php.conf` and `fastcgi_params` in `/etc/nginx/` so they have the following content:

  php.conf:
  ```
  fastcgi_split_path_info ^(.+\.php)(/.+)$;
  fastcgi_pass unix:/var/run/php5-fpm.sock;
  fastcgi_index index.php;
  include fastcgi_params;

  ```
  fastcgi_params:
  ```
  fastcgi_param  QUERY_STRING       $query_string;
  fastcgi_param  REQUEST_METHOD     $request_method;
  fastcgi_param  CONTENT_TYPE       $content_type;
  fastcgi_param  CONTENT_LENGTH     $content_length;

  fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
  fastcgi_param  SCRIPT_FILENAME    $document_root$fastcgi_script_name;
  fastcgi_param  PATH_INFO          $fastcgi_path_info;
  fastcgi_param  REQUEST_URI        $request_uri;
  fastcgi_param  DOCUMENT_URI       $document_uri;
  fastcgi_param  DOCUMENT_ROOT      $document_root;
  fastcgi_param  SERVER_PROTOCOL    $server_protocol;
  fastcgi_param  HTTPS              $https if_not_empty;

  fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
  fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;

  fastcgi_param  REMOTE_ADDR        $remote_addr;
  fastcgi_param  REMOTE_PORT        $remote_port;
  fastcgi_param  SERVER_ADDR        $server_addr;
  fastcgi_param  SERVER_PORT        $server_port;
  fastcgi_param  SERVER_NAME        $server_name;

  # PHP only, required if PHP was built with --enable-force-cgi-redirect
  fastcgi_param  REDIRECT_STATUS    200;
  ```
  (if your get a white page when trying to access your E-vote, try adding `fastcgi_param PATH_TRANSLATED $document_root$fastcgi_script_name;`)

4. In the installation folder of the E-vote code there is a SQL dump that creates the needed tables for the database. Login as root to MySQL and create the database evote:
  ```
  CREATE DATABASE evote;
  ```
  Then create a user in MySQL that that can operate on the database:
  ```
  GRANT ALL PRIVILEGES ON evote.* TO <username>@localhost IDENTIFIED BY '<password>' WITH GRANT OPTION;
  ```
  (change \<username\> to the username you choose and \<password\> to the password you choose for the user. Remember these as you will use them later)

  Import the tables to the database named evote by running the following command in the command line:
  ```
  mysql -u <username> -p evote < evote.sql
  ```

  (\<username\> is the username of the user you just created in MySQL and evote.sql is the SQL dump given in this repository in the install/ folder)

5. The site should now be working and you can access it in your browser at the host address you entered in the configuration file. For example http://evote.yourdomain.com. (To be able to          do this you must redirect that subdomain to your server, or edit the `/etc/hosts` file if you are running Linux on your laptop/desktop)

  If it works you will see the E-vote website in your browser but you will be prompted that you have to configure E-vote. Do so by entering http://evote.yourdomain.com/install/setup.php in your browser and enter the correct data. By doing this you create the websites configuration file.
  But to be able to do this the “data/” folder in the repository must have full write privileges. If the setup script won´t work for some reason the config file has the following structure:
  ```
  <?php
  define("MYSQL_PASS", "password");
  define("MYSQL_USER", "username");
  define("MYSQL_DB", "evote");
  define("MYSQL_HOST", "localhost");
  define("SUPERUSER", "superuser"); // This user can never be deleted
  define("LOCAL_CONST_HASH_PEPPER"); // Used to hash personal codes (must be constant)
  ?>
  ```

  When this is done you can go back to  http://evote.yourdomain.com and login as the user you just created in the setup scrpit and the system should be up and running.
