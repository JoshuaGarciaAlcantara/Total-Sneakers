<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'pages/index';

// List of allowed pages (relative paths to the HTML files)
$allowedPages = [
    'pages/index',
    'pages/generalinfo',
    'pages/help',
    'login',
    'signup',
    'sneakers',
    'support'
];

if (in_array($page, $allowedPages)) {
    include("./client/pages/$page.html");
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
}
?>
