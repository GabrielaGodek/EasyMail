# EasyMail
This documentation outlines the functionality and implementation details of a PHP program designed to send emails with MySQL integration. The program involves three tables in the database: `users`, `categories`, and `users_categories`.

## Installation
1. Clone this repo: `https://github.com/GabrielaGodek/EasyMail.git`.
2. Open XAMPP and run `Apache Web Server` and `MySQL Database`. 
3. Open an type in the browser `localhost/phpmyadmin`.
4. Upload `easymail.sql` from src/db folder.
5. In the EasyMail folder install dependencies `composer install`.
6. Open `http://localhost/path_to/EasyMail/index` at your browser.

## Routing
The application uses a simple routing system. The main entry point is `http://localhost/path_to/EasyMail/index`, and the different actions can be accessed by appending appropriate routes. For example:
- `http://localhost/path_to/EasyMail/form` for the "Send message" action.
- `http://localhost/path_to/EasyMail/users` for viewing all users.
- `http://localhost/path_to/EasyMail/categories` for viewing all categories.

## Usage
1. Choose the action:
    1. Send message.
    2. View all users
    3. View all categories

### Send message action
1. Select category from dropdown menu.
2. Input the subject, alt message and message.
3. Click "Send" to dispatch the message to users associated with the selected category.

### Additional information
1. For `cat_1` there are two suitable users.
2. For `cat_2` and `cat_3` there is only one.

## SQL Operations
All functions can be found in `/src/db/db_conn.php`

### Get users by category
```php

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
```

### Get all data
```php
/**
 * Retrieves all data from a specified database table.
 *
 * @param mysqli $conn An object representing the database connection (mysqli).
 * @param string $tableName The name of the table from which data should be retrieved.
 *
 * @return array|false Returns an associative array with data if successful. Exits the script in case of an error.
 */
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
```

## Preview
![Preview](public/app_preview.png)
