<?php
require dirname(__DIR__) . "/EasyMail/src/partials/header.php";

require dirname(__DIR__) . "/EasyMail/src/db/query.php";
$categories = getCategories();
?>
<form method="POST" enctype="multipart/form-data" action="app.php">
    <div class="form-group">
        <label for="categories">Choose category to send appropriate users email</label>
        <select class="form-control" id="categories" name="selectedCategory">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category["category_id"] ?>"><?php echo $category["category_name"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" placeholder="Type your message here"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send</button>
</form>


<?php require dirname(__DIR__) . "/EasyMail/src/partials/footer.php" ?>