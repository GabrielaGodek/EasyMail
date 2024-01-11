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
            <h1>Provide message</h1>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="src/app.php">
                <div class="form-group">
                    <label for="categories">Choose category to send appropriate users email</label>
                    <select class="form-control" id="categories" name="selectedCategory">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category["category_id"] ?>"><?php echo $category["category_name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Type subject here" required></input>
                </div>
                <div class="form-group">
                    <label for="alt">Alt message</label>
                    <input type="text" class="form-control" id="alt" name="alt" placeholder="Type alt here" required></input>

                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" placeholder="Type your message here" required></textarea>

                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block mx-auto w-50">Send</button>
            </form>
            <?php include dirname(__DIR__) . "/partials/backBtn.html" ?>
        </div>
    </div>
</div>



<?php require dirname(__DIR__) . "/partials/footer.html" ?>