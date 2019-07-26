<?php


class VideoDetailsFormProvider
{
    public function createUploadForm()
    {
        return '<form action="processing.php" method="post" enctype="multipart/form-data">'
                  . $this->createFileInput() .
                    $this->createTitleInput() .
                    $this->createDescriptionInput() .
                    $this->createPrivacyInput().
                '</form>';
    }

    private function createFileInput()
    {
        return  '<div class="form-group">
                    <label for="exampleFormControlFile1">Your File</label>
                    <input type="file" class="form-control-file" name="fileInput" id="exampleFormControlFile1" required>
                  </div>';
    }

    private function createTitleInput()
    {
        return '<div class="form-group">
                    <input type="text" class="form-control" placeholder="Title" name="titleInput">
                </div>';
    }

    private function createDescriptionInput()
    {
        return '<div class="form-group">
                    <textarea class="form-control" placeholder="Description" name="descriptionInput" rows="6"></textarea>
                </div>';
    }

    private function createPrivacyInput()
    {
        return '<div class="form-group">
                     <select class="form-control" name="privacyInput">
                      <option value="0">Private</option>
                      <option value="1">Public</option>
                     </select>
                </div>';
    }
}