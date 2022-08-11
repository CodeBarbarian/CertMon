<?php

namespace App\Models;

use Core\Model;
use Core\Plugins\Flashcard\Flashcard;

/**
 * File Model Class
 * @version: PHP: 8.1
 *
 * @FileModel
 */
class FileModel extends Model {
	private const maxFileSize =  2000000;

	/**
	 * Check if the file size is within limits
	 *
	 * @param array $Data
	 * @return bool
	 */
	private static function validateFileSize(array $Data = []): bool {
		// Validate Size
		return !($Data['file']['size'] > self::maxFileSize);
	}

	/**
	 * Validate the extension of the file
	 *
	 * @param array $Data
	 * @return bool
	 */
	private static function validateFileExtension(array $Data = []): bool {
		// Get the filename and the extension
		$Filename = $Data['file']['name'];
		$Extension = pathinfo($Data['file']['name'], PATHINFO_EXTENSION);

		// Validate extension
		if (!in_array($Extension, \App\Config\Files::ALLOWED_FILE_TYPES)) {
			return false;
		}

		return true;
	}

	/**
	 * Validate if the file is already present
	 *
	 * @param array $Data
	 * @return bool
	 */
	private static function validateFilePresent(array $Data = []): bool {
		// Check if file already exists
		$Files = glob('./certificates/*.cer');
		$Certificates = array();

		foreach($Files as $Value) {
			$Certificates[] = basename($Value);
		}

		if (in_array(static::createNewFilename($Data), $Certificates)) {
			return false;
		}

		return true;
	}

	/**
	 * Move the uploaded file
	 *
	 * @param $Data
	 * @return bool
	 */
	private static function moveUploadedFile($Data): bool {
		if (!move_uploaded_file($Data['file']['tmp_name'], './certificates/'.static::createNewFilename($Data))) {
			return false;
		}

		return true;
	}

	/**
	 * Validate the file upload
	 *
	 * @param array $Data
	 * @return bool
	 */
	private static function validateFile(array $Data = []): bool {
		$Flashcard = new Flashcard();

		//  Try to upload the file to the temporary directory
		if (is_uploaded_file($Data['file']['tmp_name']) === false) {
			Flashcard::addMessage("Unable to upload file, no file?", "danger");
			return false;
		}

		// Validate File size
		if (!static::validateFileSize($Data)) {
			Flashcard::addMessage("File is larger than 2MB!", "danger");
			return false;
		}

		// Validate the extension
		if (!static::validateFileExtension($Data)) {
			Flashcard::addMessage("No extension on the file found?", "danger");
			return false;
		}

		// Validate if the file is already present
		if (!static::validateFilePresent($Data)) {
			Flashcard::addMessage("Certificate is already monitored!", "warning");
			return false;
		}

		// try and move the uploaded file
		if (!static::moveUploadedFile($Data)) {
			Flashcard::addMessage("Unable to move file after uploading, is the path correct?", "danger");
			return false;
		}

		Flashcard::addMessage("Certificate uploaded successfully!", "success");
		return true;
	}

	/**
	 * Create the new filename for the certificate based on the file hash
	 *
	 * @param array $Data
	 * @return string
	 */
	private static function createNewFilename(array $Data = []): string {
		$HashedFilename = hash_file('sha256', $Data['file']['tmp_name']);
		$Extension = pathinfo($Data['file']['name'], PATHINFO_EXTENSION);

		return $HashedFilename.'.'.$Extension;
	}

	/**
	 * Function for uploading the file (Certificate)
	 *
	 * @param array $Data
	 * @return bool
	 */
	public static function uploadFile(array $Data = []): bool {
		if (!static::validateFile($Data)) {
			return false;
		}

        return true;
    }
}