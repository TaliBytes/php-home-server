<?php
    // no request protections in place yet

    class tACL_profile {
        public $ACLRiskScore; public $previousACLRiskScore;
        public $CAPTCHAScore;
        public $errorScore;
        public $locationScore;

        public $spiderLevel = 0;
        public $isBanned = false;


        public function __construct() {
            $this -> ACLRiskScore = 0;
            $this -> previousACLRiskScore = 0;
            $this -> CAPTCHAScore = 0;
            $this -> errorScore = 0;
            $this -> locationScore = 0;
            $this -> spiderLevel = 0;

            # Step 1 - VALIDATE IP
            # Step 2 - CHECK SPIDER LEVEL

            // deny L.4 and L.5 spiders
            $this->spiderLevel = $this->detectSpider();
            if($this->spiderLevel > 3) {
                global $errCaption;
                $errCaption = "Denied Spider Access";
                trigger_error("Our system detected that you are a spider, so you have been denied access to the website. If this is in error, please contact us.");
            }

            # Step 3 - CHECK IF BANNED
            # Step 4 - GET ACL DATA FROM DB
            # Step 5 - CAPTCHA / ASSESS RISK
        }


        // L.1 = good,  L.2 = okay,  L.3 = neutral,  L.4 = block,  L.5 = malicious
        private function detectSpider() {
            global $ipAddress;
            $agent = $_SERVER["HTTP_USER_AGENT"];
            $level = 0; // return spiderLevel/level

            // filter user agents
            if (stripos($agent, "addthis.com")) {$level = 3;}
            if (stripos($agent, "ahrefsbot")) {$level = 3;}
            if (stripos($agent, "baidu")) {$level = 4;}
            if (stripos($agent, "bingbot")) {$level = 1;}
            if (stripos($agent, "bytespider")) {$level = 4;}
            if (stripos($agent, "changedetection")) {$level = 3;}
            if (stripos($agent, "dynzbot")) {$level = 3;}
            if (stripos($agent, "dotbot")) {$level = 3;}
            if (stripos($agent, "easouspider")) {$level = 4;}
            if (stripos($agent, "ezooms")) {$level = 3;}
            if (stripos($agent, "fatbot")) {$level = 3;}
            if (stripos($agent, "genieo")) {$level = 3;}
            if (stripos($agent, "googlebot")) {$level = 1;}
            if (stripos($agent, "go-http-client/2.0")) {$level = 3;}
            if (stripos($agent, "go.mail.ru")) {$level = 5;}
            if (stripos($agent, "hosttracker")) {$level = 2;}
            if (stripos($agent, "majestic12")) {$level = 3;}
            if (stripos($agent, "megaindex")) {$level = 3;}
            if (stripos($agent, "mozlila") || stripos($agent, "bulid") || stripos($agent, "moblie")) {$level = 5;}
            if (stripos($agent, "msnbot")) {$level = 2;}
            if (stripos($agent, "niki-bot")) {$level = 5;}
            if (stripos($agent, "pinterestbot")) {$level = 3;}
            if (stripos($agent, "proximic")) {$level = 3;}
            if (stripos($agent, "python-requests")) {$level = 3;}
            if (stripos($agent, "scrapy")) {$level = 5;}
            if (stripos($agent, "seekport.com")) {$level = 5;}
            if (stripos($agent, "semirush")) {$level = 4;}
            if (stripos($agent, "semrush")) {$level = 3;}
            if (stripos($agent, "shopwiki")) {$level = 3;}
            if (stripos($agent, "slurp")) {$level = 1;}
            if (stripos($agent, "synapse")) {$level = 3;}
            if (stripos($agent, "thefind")) {$level = 3;}
            if (stripos($agent, "voilaBot")) {$level = 5;}
            if (stripos($agent, "yandex.com")) {$level = 4;}
            
            return $level;
        }
    }

    $aclProfile = new tACL_profile;
?>
