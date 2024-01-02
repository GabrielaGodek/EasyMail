<?php
include dirname(__DIR__) . "/db/db_conn.php";
// 
function createUser()
{
    global $conn;

    $data = [];
    $data["name"] = "Gabriela";
    $data["lastname"] = "Godek";
    $data["email"] = "godekgabriela39@gmail.com";

    // Konkatenacja wartości w zapytaniu SQL
    $sql = "INSERT INTO `subscribers` ( `name`, `lastname`, `email`) VALUES (('{$data["name"]}', '{$data["lastname"]}', '{$data["email"]}'))";

    // Wykonaj zapytanie SQL
    $result = mysqli_query($conn, $sql);

    // Sprawdź, czy zapytanie się powiodło
    if ($result) {
        echo "User created successfully!<br/>";
        return $data;
    } else {
        die("Error creating user: " . mysqli_error($conn));
    }
}
function createCategory()
{
    global $conn;

    $data = [];
    $data["category_name"] = "cat_3";

    // Konkatenacja wartości w zapytaniu SQL
    $sql = "INSERT INTO `categories` (`id`, `category_name`) VALUES ('{$data["category_name"]}')";

    // Wykonaj zapytanie SQL
    $result = mysqli_query($conn, $sql);

    // Sprawdź, czy zapytanie się powiodło
    if ($result) {
        echo "User created successfully!<br/>";
        return $data;
    } else {
        die("Error creating categories: " . mysqli_error($conn));
    }
}



function getUsers()
{
    global $conn;

    $sql = "SELECT * FROM `subscribers`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        die("Error fetching users: " . mysqli_error($conn));
    }
}
function getCategories()
{
    global $conn;

    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        die("Error fetching users: " . mysqli_error($conn));
    }
}
