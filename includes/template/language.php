<?php

session_start();

$locale = $_SESSION["language"];

if (defined('LC_MESSAGES')) {
    setlocale(LC_MESSAGES, $locale); // Linux
    bindtextdomain("messages", "./locale");
    bind_textdomain_codeset("messages", 'UTF-8');
} else {
    putenv("LC_ALL={$locale}"); // windows
    bindtextdomain("messages", ".\locale");
    bind_textdomain_codeset("messages", 'UTF-8');
}

textdomain("messages");

?>