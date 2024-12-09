<?php
    include 'globals.php';
    if ($offlineMode == true) {include 'page_websiteOffline.php'; exit;}        # show the offline mode page if site is currently offline

    // filter requests, store information about them
    include 'lib_requestProtection.php';
    
    // direct to the appropriate module
    switch ($app) {
        case null: include 'page_notFound.php'; exit;
        case 'home': include 'page_home.php'; exit;
        default: include 'page_notFound.php'; exit;
    }
?>
