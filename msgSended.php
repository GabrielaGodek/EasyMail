<?php
require dirname(__DIR__) . "/EasyMail/src/partials/header.php"
?>
<div class="container">
    <div class="alert alert-success" role="alert">
        Message send successfully!
    </div>
    <div class="card-header">
        <h2>What to do now?</h2>
    </div>
    <div class="card-body">
        <a href="form.php" type="button" class="btn btn-info">Send another message</a>
        <a href="src/partials/usersView.php" type="button" class="btn btn-info">View all users</a>
        <a href="src/partials/categoriesView.php" type="button" class="btn btn-info">View all categories</a>
    </div>
</div>
<?php require dirname(__DIR__) . "/EasyMail/src/partials/footer.php" ?>