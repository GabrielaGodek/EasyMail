<?php require dirname(__DIR__) . "/partials/header.html" ?>
<div class="container">
    <div class="alert alert-danger" role="alert">
        <h3>Message could not be send.</h3>
        <p><?php echo $mail->ErrorInfo ?></p>
    </div>
    <?php include dirname(__DIR__) . "/partials/backBtn.html" ?>
</div>
<?php require dirname(__DIR__) . "/partials/footer.html" ?>