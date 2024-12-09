<?php
    include 'globals.php'
?>

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

        <h3>Welcome to the website!</h3>
    </body>
</html> 
