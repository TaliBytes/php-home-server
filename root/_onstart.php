<?php
    // get global variables immediately
    require_once "_globals.php";
    

    // prepare generic error handler
    function errorHandler($errno, $errstr, $errfile, $errline) {
        error_log("Error [{$errno}]: {$errstr}... In {$errfile} on line {$errline}.");
        global $errCaption;

        http_response_code(500);
        $errCaption = $errCaption ?? "An Error Has Occurred";
        $errorMessage = isset($errstr) ? $errstr : "An error has occurred. Please try again later or contact a system administrator if you need immediate assistance. If you type the URL manually, please check if for accuracy.";
        include "_onerror.php";
    }

    // prepare generic exception handler
    function exceptionHandler($exception) {
        error_log("Uncaught exception: {$exception->getMessage()}");
        global $errCaption;

        http_response_code(500);
        $errCaption = (isset($errCaption)) ? $errCaption : 'An Exception Has Occurred';
        $errorMessage = $exception->getMessage() != null ? $exception->getMessage() : "An error has occurred. Please try again later or contact a system administrator if you need immediate assistance. If you type the URL manually, please check if for accuracy.";
        include "_onerror.php";
    }

    // enable prepared handlers
    set_error_handler("errorHandler");
    set_exception_handler("exceptionHandler");



    // show the offline mode page if site is currently offline
    if ($offlineMode == true) {
        global $errCaption;
        
        $errCaption = "Website Offline";
        $errorMessage = "Our website is currently offline for scheduled development and maintenance. Please try return to the website later. Thank you for your patience as we improve!";
        include "_onerror.php";
    }

    // protect against unwanted requests
    require_once "lib_requestProtection.php";   

    
    // direct to the appropriate module for the request
    switch ($app) {
        case "home": include "page_home.php"; exit;
        default: trigger_error("The requested module for /$app could not be found.");
    }
?>
