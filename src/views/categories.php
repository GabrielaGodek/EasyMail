<?php
require dirname(__DIR__) . "/partials/header.html";
require dirname(__DIR__) . "/db/db_conn.php";

$conn = openConnection();
$categories = getAllData($conn, 'categories');
closeConnection($conn);
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>All available categories:</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?php echo $category["category_id"] ?></td>
                            <td><?php echo $category["category_name"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php include dirname(__DIR__) . "/partials/backBtn.html" ?>
        </div>
    </div>
</div>
<?php require dirname(__DIR__) . "/partials/footer.html" ?>