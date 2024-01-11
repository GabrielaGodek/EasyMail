<?php
include dirname(__DIR__) . "/db/db_conn.php";

function getAllData($tableName)
{
    global $conn;

    $sql = "SELECT * FROM `$tableName`";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        die("Error fetching $tableName: " . mysqli_error($conn));
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
