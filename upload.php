<?php require_once __DIR__ . '/inc/header.php'?>
<div class="container-fluid">
    <div class="row">
        <div class="upload-form">
            <?php
                $formProvider = new VideoDetailsFormProvider();
                echo $formProvider->createUploadForm();

                $categories = DB::query('SELECT * FROM categories');
                debug($categories);
            ?>

        </div>
    </div>
</div>
<?php require_once __DIR__ . '/inc/footer.php'?>