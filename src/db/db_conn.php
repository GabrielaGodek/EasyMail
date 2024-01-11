<?php
function openConnection($serverName = "localhost", $username = "root", $password = "", $dbName = "easymail")
{
    $conn = new mysqli($serverName, $username, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeConnection($conn)
{
    $conn->close();
}

function getAllData($conn, $tableName)
{
    $sql = "SELECT * FROM `$tableName`";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        die("Error fetching $tableName: " . $conn->error);
    }
}


function getUsersByCategory($conn, $cat)
{
    $cat = intval($cat);

    $categoryQuery = "SELECT user_id FROM `user_categories` WHERE category_id=?";
    $categoryStmt = $conn->prepare($categoryQuery);
    $categoryStmt->bind_param("i", $cat);
    $categoryStmt->execute();
    $categoryResult = $categoryStmt->get_result();

    if (!$categoryResult) {
        die("Error fetching users by category: " . $conn->error);
    }

    $userIDs = $categoryResult->fetch_all(MYSQLI_ASSOC);

    if (empty($userIDs)) {
        return [];
    }

    $userIDs = array_column($userIDs, 'user_id');
    $placeholders = implode(',', array_fill(0, count($userIDs), '?'));

    $userQuery = empty($placeholders) ? "SELECT * FROM `users`" : "SELECT * FROM `users` WHERE user_id IN ($placeholders)";
    $userStmt = $conn->prepare($userQuery);

    if (!empty($placeholders)) {
        $userStmt->bind_param(str_repeat("i", count($userIDs)), ...$userIDs);
    }

    $userStmt->execute();
    $userResult = $userStmt->get_result();

    if (!$userResult) {
        die("Error fetching users: " . $conn->error);
    }

    return $userResult->fetch_all(MYSQLI_ASSOC);
}
