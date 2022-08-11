<?php

namespace App\Models;

use Core\Model;

use Core\Plugins\Flashcard\Flashcard;

class FileModel extends Model {
    public static function uploadFile(array $Data = []) {
        $Flashcard = new Flashcard();
        
        if (is_uploaded_file($Data['file']['tmp_name']) === false) {
            Flashcard::addMessage("Unable to upload file, no file?", "danger");
            return false;
        }
        
        // Get the filename and the extension
        $Filename = $Data['file']['name'];
        //$Extension = strtolower(substr($Filename, strripos($Filename, '.')+1));
        $Extension = pathinfo($Data['file']['name'], PATHINFO_EXTENSION);
        
        // Validate extension
        if (!in_array($Extension, \App\Config\Files::ALLOWED_FILE_TYPES)) {
            Flashcard::addMessage("No extension on the file found?", "danger");
            return false;
        }
        
        // Validate Size
        if ($Data['file']['size'] > 2000000) {
            Flashcard::addMessage("File is larger than 2MB!", "danger");
            return false;
        }
        
        // Let us create a has to identify the file with
        //$HashedFilename = hash('SHA256', $Filename);
        $HashedFilename = hash_file('sha256', $Data['file']['tmp_name']);
        
        // Add the extension to the newly hashed filename
        $NewFilename = $HashedFilename.'.'.$Extension;
        
        // Check if file already exists
        $Files = glob('./certificates/*.cer');
        $Certificates = array();
    
        foreach($Files as $Value) {
            $Certificates[] = basename($Value);
        }

        if (in_array($NewFilename, $Certificates)) {
            Flashcard::addMessage("Certificate is already monitored!", "warning");
            return false;
        }
        
        // try and move the uploaded file
        if (!move_uploaded_file($Data['file']['tmp_name'], './certificates/'.$NewFilename)) {
            Flashcard::addMessage("Unable to move file after uploading, is the path correct?", "danger");
            return false;
        }
        
        Flashcard::addMessage("Certificate uploaded successfully!", "success");
        return true;
    }
}