# PHP Personal News/Blog Site

A while back I had some significant life changes that led me to wanting a place to post about religion, politics, etc... so I could feel like my voice was heard. However, I didn't want to use a service anyone else had previously created. I need complete control over the service. Therefore, I decided to make this project.

What is it? My goal is to create a LAMP-based home server that allows me to post content and (optionally) allow user interaction (determined on a case by case basis). Essentially, this is a glorified blog hosted on my Linux (Debian) server.

## Features

Some specific feature goals of this project are as follows:

- Use PHP to create a blog-like website for personal content
- Integrate into MySQL to store/process:
  - articles
  - users
  - access rights (eg cx service, article writers, etc)
  - article interactions (eg comments, votes, follows)
  - statistical information such as article view counts/popularity, etc
- An online "console" where approved users (see access rights) can manage various data such as the previously mentioned

## Getting Started

### Prerequisites

This project is running on the LAMP stack (Linux, Apache, MySQL, PHP). However, the only critical parts of this are MySQL and PHP (ie, the goal is to design this to be PHP-MySQL centric allowing for use via other OS's such as Windows and web-servers such as IIS... or really any combination compatible with PHP and MySQL).

#### For Linux

Make sure dependencies are installed:

1 - `sudo apt-get update && sudo apt-get upgrade -y`

2 - `sudo apt install apache2`

3 - `sudo apt install php libapache2-mod-php php-mysql`

4 - `sudo apt install mysql-server`

5 - I recommend reordering the default application using `sudo nano /etc/apache2/mods-enabled/dir.conf`

6 - use `sudo a2enmod rewrite`. This project handles routing thru PHP instead of a file directory or Apache

7a - run `sudo nano /etc/apache2/sites-available/your_site.conf` and add

```XML
<Directory /var/www/your_site>
    AllowOverride All
</Directory>
```

7b - in the same your_site.conf file, make sure bindings and aliases are properly configured:
```
<VirtualHost *:80>
    ServerName your_site
    ServerAlias *.your_site.uld
    ServerAdmin webmaster@your_site.uld
    DocumentRoot /var/www/your_domain
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

8 - Save and close. Run `systemctl restart apache2`. 

&nbsp;

9 - (***optional but recommended for public facing sites***)... configure SSL authentication. Start with `sudo mkdir /etc/apache2/ssl`.

10 - run `sudo a2enmod ssl`.

11 - generate a Origin Certificate and Private Key from a CDN (such as Cloudflare). Save to the server in `/etc/apache2/ssl/your_site.pem` and `/etc/apache2/ssl/your_site.key` (respectively). Update directory permissions using `sudo chmod -R 655 /etc/apache2/ssl` and ownership using `sudo chown -R www-data:www-data /etc/apache2/ssl`.

12 - To enable SSL bindings for the site, edit config file using `sudo nano /etc/apache2/sites-available/your_site.conf` and add the following into *:443 Virtual Host data:
```
<VirtualHost *:443> 
    ...
	  SSLEngine on
	  SSLCertificateFile /etc/apache2/ssl/example.com.pem
	  SSLCertificateKeyFile /etc/apache2/ssl/example.com.key
</VirtualHost>
```

13 - enable the file using `sudo a2ensite your_site.conf`.

14 - restart and reload apache `sudo service apache2 reload` then `systemctl restart apache2`.

15 - Setup MySQL using `sudo mysql_secure_installation` ... DO set password, remove anonymous users, disallow root login remote, remove test database, reload privileges table.

15b - If password was not set, run `sudo mysql` then `ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '[your_password]';`

16 - Sign in with `sudo mysql -u root -p`.

&nbsp;

**Helpful Articles**:

- I found [this article](https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu#step-6-testing-database-connection-from-php-optional) (unaffiliated) very helpful. It details how to setup the LAMP stack, configure the necessities for Apache running PHP/MySQL, etc...

- [This article](https://scriptstown.com/how-to-setup-cloudflare-ssl-and-configure-origin-certificate-for-apache/) was helpful for configuring my Cloudflare Origin Certificate and Private Key for my Apache server. To use this, Cloudflare also needs route your_domain to the server IP using A Name records. The home server has ports 443, 80, and 3389 open, and ports 443 and 80 forwarded. (3389 is open on the server so I can remote into it for development, when connected to my own network).

&nbsp;

#### For Windows (Using IIS)

1 - Download php from [their website](https://windows.php.net/download). Microsoft recommends using Web PI instead. Instructions linked in item 3.

- For IIS, be sure to use the (NTS) version.

2 - Enable IIS as per [Microsoft's Instructions](https://techcommunity.microsoft.com/blog/iis-support-blog/how-to-enable-iis-and-key-features-on-windows-server-a-step-by-step-guide/4229883)

3 - Configure IIS and PHP to run together. Microsoft's instructions [here](https://learn.microsoft.com/en-us/previous-versions/windows/it-pro/windows-server-2012-r2-and-2012/hh994592(v=ws.11)) are quite helpful.

4 - Download and follow [Oracle's Instructions](https://dev.mysql.com/downloads/installer/) for MySQL installation.

Note: Using Apache on Windows will be fairly similar to the configuration detailed in the "For Linux" section above. At this time, I don't have specific instructions for enabling the ability to rewrite URLs or use SSL via Apache for Windows. This should be possible but will take research on your part. To use SSL with IIS, [this video tutorial](https://youtu.be/azfgoGXqhNg) is a good starting point.

&nbsp;

### Once The Server Is Configured

- In your CLI, navigate to the folder the server utilizes for the static files (eg _onstart.php under /var/www/your_site on Linux or C:/inetpub/root on Windows). Initialize a git repository.
- Clone this repo using `git clone https://github.com/TaliBytes/php-home-server`
- restart Apache/IIS/your web-server
  - `systemctl restart apache2` for Linux
  - `cd C:\xampp\apache\bin` then `httpd -k restart` for Windows (Apache)
  - right click to start and stop Application Pool and Website for Windows (IIS)

- Follow instructions in /sql/readme.md

## Directories

- /root is where the source files are stored (ie, *.php)
- /sql is where MySQL schema, etc is stored

## Contributing

This project is currently not allowing outside contributions.

## License

This project is licensed under the MIT License. I simply ask those using/branching from it to refer back to my repository (though it is not a requirement). Thank you.
