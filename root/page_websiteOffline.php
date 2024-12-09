<?php
    include 'globals.php';
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Page Not Found</title>
        <link rel="stylesheet" href="/static/globalStyles.css"/>
    </head>
    <body>
        <?php
            if($globalAlertMsg != null) {echo "<div id='globalAlertBanner'>$globalAlertMsg</div>";}
        ?>

        <div style="display:block; width:100%; min-height:108px; font-size:1.3rem; text-align:center; color:white; font-weight:bold; background-color:rgb(0, 66, 110);">
            <br/><span>Website Offline</span><br/><br/>
            <span style="display:block; width:95%; margin:auto; font-weight:normal; font-size:1.2rem;">
                Our website is currently offline for scheduled development and maintenance. Please try return to the website later. Thank you for your patience as we improve!
            </span><br/>
        </div>
    </body>
</html> 
