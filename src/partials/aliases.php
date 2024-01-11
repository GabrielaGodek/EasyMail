<?php
// $alias = $_GET['page'];

// switch ($alias) {
//     case 'form':
//         include 'src/views/form.php';
//         break;
//     case 'users':
//         include 'src/views/users.php';
//         break;
//     case 'categories':
//         include 'src/views/categories.php';
//         break;

//     default:

//         echo '404 Not Found';
//         break;
// }

$request = basename($_SERVER['REQUEST_URI']);
// echo "$request";
switch ($request) {
    case '':
    case 'index.':
        // require 'index.php';
        // echo  'basename index.php';
        break;
    case 'users':
        require 'src/views/users.php';
        break;

    case 'form':
        $url = dirname(__DIR__) . '/EasyMail/src/views/form.php';
        require $url;
        // echo "$url";
        break;
}
