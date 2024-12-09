<?php // global variables that are stored and used across the website

    //if the website should display the offline/maintenance page
    $offlineMode = true;                            

    // a global message the is displayed on page load                 
    $globalAlertMsg = null;                           



    // the client's connecting IP address
    $ipaddress = $_SERVER['CF-CONNECTING-IP'] ?? $_SERVER['REMOTE_ADDR'];
    $ipv4 = (str_contains($ipaddress, '.')) ? $ipaddress : null;
    $ipv6 = (str_contains($ipaddress, ':')) ? $ipaddress : null;

    // if the server is a test server or not
    $testServer = ($_SERVER['HTTP_HOST'] == 'localhost') ? true : false;

    // get the requested app
    $app = basename($_SERVER['REQUEST_URI'], '/');
    $app = ($app != null) ? $app : 'home';

    $testParam = isset($_GET['test']) ? $_GET['test'] : null;
?>
