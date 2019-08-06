<?php require_once __DIR__ . '/inc/header.php'; ?>
<?php
debug($_POST);
debug($_FILES);

if (!isset($_POST['uploadButton'])) {
    echo 'No file sent to page';
    exit();
}

// create file upload data
$videoUploadData = new VideoUploadData(
        $_FILES['fileInput'],
        $_POST['titleInput'],
        $_POST['descriptionInput'],
        $_POST['privacyInput'],
        $_POST['categoryInput'],
        'REPLACE-THIS'
);

// Process video data upload

$videoProcessor = new VideoProcessor();
$wasSuccessful = $videoProcessor->upload($videoUploadData);

// Check if upload was successful

?>
<?php require_once __DIR__ . '/inc/footer.php'; ?>
