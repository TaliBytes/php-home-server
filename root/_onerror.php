<?php
$output = "
<!DOCTYPE html>
<html>
    <head>
        <title>${errCaption}</title>
        <link rel='stylesheet' href='/static/globalStyles.css'/>
    </head>
    <body>
        <div style='display:block; width:100%; min-height:108px; font-size:1.3rem; text-align:center; color:white; font-weight:bold; background-color:rgb(0, 66, 110);'>
            <br/><span>${errCaption}</span><br/><br/>
            <span style='display:block; width:95%; margin:auto; font-weight:normal; font-size:1.2rem;'>
                ${errorMessage}
            </span><br/>
        </div>
    </body>
</html>
";

echo $output;
exit;
?>
