<?php
include dirname(__DIR__) . "/db/db_conn.php";
function createUser()
{
    global $conn;

    $data = [];
    $data["name"] = "g0gab1s";
    $data["lastname"] = "";
    $data["email"] = "godekgabriela39@gmail.com";

    $sql = "INSERT INTO `users` ( `name`, `lastname`, `email`) 
    VALUES ('{$data["name"]}', '{$data["lastname"]}', '{$data["email"]}')";

    $result = mysqli_query($conn, $sql);

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

    $sql = "INSERT INTO `categories` (`category_name`) VALUES ('{$data["category_name"]}')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "User created successfully!<br/>";
        return $data;
    } else {
        die("Error creating categories: " . mysqli_error($conn));
    }
}

function assignUserToCategories($userId, $categoriesToAssign)
{
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($categoriesToAssign as $categoryId) {
        $checkSql = "SELECT * FROM user_categories WHERE user_id = '$userId' AND category_id = '$categoryId'";
        $result = $conn->query($checkSql);

        if ($result->num_rows === 0) {
            $insertSql = "INSERT INTO user_categories (user_id, category_id) VALUES ('$userId', '$categoryId')";

            if ($conn->query($insertSql) !== TRUE) {
                echo "Error assigning user to category with ID $categoryId: " . $conn->error . "<br>";
            }
        } else {
            echo "User is already assigned to category with ID $categoryId.<br>";
        }
    }

    echo "User assigned to categories successfully";

    $conn->close();
}

// Example usage:
// $userToAssign = 2;
// $categoriesToAssign = [3, 2];
// 
// assignUserToCategories($userToAssign, $categoriesToAssign);

function getAllUsers()
{
    global $conn;

    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        die("Error fetching users: " . mysqli_error($conn));
    }
}
function getUsersByCategory($cat)
{
    global $conn;

    $cat = intval($cat);

    $categoryQuery = "SELECT user_id FROM `user_categories` WHERE category_id=$cat";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    if (!$categoryResult) {
        die("Error fetching users by category: " . mysqli_error($conn));
    }

    $userIDs = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);
    if (empty($userIDs)) {
        return [];
    }
    $userIDs = array_column($userIDs, 'user_id');
    $sanitizedIds = implode(',', array_map('intval', $userIDs));
    $userQuery = empty($sanitizedIds) ? "SELECT * FROM `users`" : "SELECT * FROM `users` WHERE user_id IN ($sanitizedIds)";
    $userResult = mysqli_query($conn, $userQuery);

    if (!$userResult) {
        die("Error fetching users: " . mysqli_error($conn));
    }

    return mysqli_fetch_all($userResult, MYSQLI_ASSOC);
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
