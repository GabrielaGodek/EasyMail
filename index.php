<?php
require dirname(__DIR__) . "/EasyMail/src/partials/header.html";
// $success = $_GET("success")
?>
<div class="container">
    <?php if (isset($_GET['success']) && $_GET['success'] === 'true') : ?>
        <div class="alert alert-success" role="alert">
            Message send successfully!
        </div>
    <?php endif ?>
    <div class="card-header">
        <h2>What to do?</h2>
    </div>
    <div class="card-body">
        <a href="src/views/form.php" type="button" class="btn btn-info">Send message</a>
        <a href="src/views/users.php" type="button" class="btn btn-info">View all users</a>
        <a href="src/views/categories.php" type="button" class="btn btn-info">View all categories</a>
    </div>
</div>
<?php require dirname(__DIR__) . "/EasyMail/src/partials/footer.html" ?>