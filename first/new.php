<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] . '/portfolio/';
define('BASE_URL', $protocol . $host);