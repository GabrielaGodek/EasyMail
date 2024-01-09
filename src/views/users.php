<?php
require dirname(__DIR__) . "/partials/header.html";
require dirname(__DIR__) . "/db/query.php";
$users = getAllUsers();
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>All available users:</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user["user_id"] ?></td>
                            <td><?php echo $user["name"] ?></td>
                            <td><?php echo $user["lastname"] ? $user["lastname"] : "-" ?></td>
                            <td><?php echo $user["email"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php include dirname(__DIR__) . "/partials/backBtn.html" ?>
        </div>
    </div>
    <?php require dirname(__DIR__) . "/partials/footer.html" ?>