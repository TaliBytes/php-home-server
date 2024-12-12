<?php
    // get global variables immediately
    require_once '_globals.php';
    

    // prepare generic error handler
    function errorHandler($errno, $errstr, $errfile, $errline) {
        error_log("Error [$errno]: $errstr.. In $errfile on line $errline.");

        http_response_code(500);
        include '_onerror.php';
        exit;
    }

    // prepare generic exception handler
    function exceptionHandler($exception) {
        error_log("Uncaught exception: " . $exception->getMessage());

        http_response_code(500);
        include '_onerror.php';
        exit;
    }

    // enable prepared handlers
    set_error_handler('errorHandler');
    set_exception_handler('exceptionHandler');


    // show the offline mode page if site is currently offline
    if ($offlineMode == true) {include '_offline.php'; exit;}

    // protect against unwanted requests
    require_once 'lib_requestProtection.php';   

    
    // direct to the appropriate module for the request
    switch ($app) {
        case 'home': include 'page_home.php'; exit;
        default: trigger_error("The requested module for /$app could not be found.",);
    }
?>
