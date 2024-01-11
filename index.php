<?php
require dirname(__DIR__) . "/EasyMail/src/partials/header.html";

?>
<div class="container content-container">
    <?php
    if (isset($_GET['success']) && $_GET['success'] === 'true') {
        echo '<div class="alert alert-success" role="alert">Message sent successfully!</div>';
    } ?>
    <div class="card-header">
        <h2>What to do?</h2>
    </div>
    <div class="card-body ">
        <a href="users" class="btn btn-info">View all users</a>
        <a href="form" class="btn btn-info">Send message</a>
        <a href="categories" class="btn btn-info">View all categories</a>
    </div>
</div>


<?php require dirname(__DIR__) . "/EasyMail/src/partials/footer.html" ?>