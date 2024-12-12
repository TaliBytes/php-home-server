<!DOCTYPE html>
<html>
    <head>
        <title>Welcome!</title>
        <link rel="stylesheet" href="/static/globalStyles.css"/>
    </head>

    <body>
        <?php
            if($globalAlertMsg != null) {echo "<div id='globalAlertBanner'>$globalAlertMsg</div>";}
        ?>

        <h3>Welcome to the website!</h3><br/>
        <span>You may have noticed that there isn't much here yet. That's because the website is currently under the earliest stages of development.<br/>Please see my <a href="https://github.com/talibytes/php-home-server">GitHub project</a> to see more about this website is intended to become. Thank you!</span>
    </body>
</html> 
