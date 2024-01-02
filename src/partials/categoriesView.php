<?php
require dirname(__DIR__) . "/partials/header.php";
require dirname(__DIR__) . "/db/query.php";
$categories = getCategories();
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
        </div>
    </div>
</div>
<?php require dirname(__DIR__) . "/partials/footer.php" ?>