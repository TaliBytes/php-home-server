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
- An online "console" where approved users (see access rights) can manage various data such as the previously mentioned.

## Getting Started

### Prerequisites

This project is running on the LAMP stack (Linux, Apache, MySQL, PHP). However, the only critical parts of this are MySQL and PHP (ie, the goal is to design this to be PHP-MySQL centric allowing for use via other OS's such as Windows and web-servers such as IIS... or really any combination compatible with PHP and MySQL)

#### For Linux

Make sure dependencies are installed

1 - `sudo apt-get update && sudo apt-get upgrade -y`

2 - `sudo apt install apache2 -y`

3 - `sudo apt install php -y`

4 - `sudo apt install mysql-server`

I found [this article](https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu#step-6-testing-database-connection-from-php-optional) (unaffiliated) very helpful. It details how to setup the LAMP stack, configure the necessities for Apache running PHP/MySQL, etc...

[This article](https://scriptstown.com/how-to-setup-cloudflare-ssl-and-configure-origin-certificate-for-apache/) was helpful for configuring my Cloudflare Origin Certificate and PEM for my Apache server. I also have my Cloudflare configured to have A Name (example.com) point to my home server public IP. The home server has ports 443, 80, and 3389 (RDP) open. My router is configured to port-forward for 80 and 443.

#### For Windows

1 - Download php from [their website](https://windows.php.net/download). Microsoft recommends using Web PI instead. Instructions linked in item 3.

- For IIS, be sure to use the (NTS) version.

2 - Enable IIS as per [Microsoft's Instructions](https://techcommunity.microsoft.com/blog/iis-support-blog/how-to-enable-iis-and-key-features-on-windows-server-a-step-by-step-guide/4229883)

3 - Configure IIS and PHP to run together. Microsoft's instructions [here](https://learn.microsoft.com/en-us/previous-versions/windows/it-pro/windows-server-2012-r2-and-2012/hh994592(v=ws.11)) are quite helpful.

### Once The Server Is Configured

- In your CLI, navigate to the folder the server utilizes for the static files (eg index.php under /var/www/yourdomain on Linux or C:/inetpub/root on Windows). Initialize a git repository.
- Clone this repo using `git clone https://github.com/TaliBytes/php-home-server`
- restart Apache/IIS/your web-server
  - `systemctl restart apache2` for Linux
  - `cd C:\xampp\apache\bin` then `httpd -k restart` for Windows
  - right click to start and stop Application Pool and Website in IIS

## Directories

- /root is where the source files are stored (ie, *.php)

## Contributing

This project is currently not allowing outside contribution.

## License

This project is licensed under the MIT License. I simply ask those using/branching from it to refer back to my repository (though it is not a requirement). Thank you.
