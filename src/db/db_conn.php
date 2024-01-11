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
    $allowedTables = ['users', 'categories', 'user_categories'];

    if (!in_array($tableName, $allowedTables)) {
        die("Invalid table name: " . htmlspecialchars($tableName));
    }
    $sql = "SELECT * FROM `$tableName`";

    // Prevent SQL Injection
    $result = $conn->query($sql);

    if (!$result) {
        die("Error fetching $tableName: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}


function getUsersByCategory($conn, $cat)
{
    $cat = intval($cat);

    $sql = "SELECT * FROM `users` WHERE user_id IN (SELECT user_id FROM `user_categories` WHERE category_id = ?)";

    // Prevent SQL Injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cat);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Error fetching users by category: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
