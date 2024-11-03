private static function process_downloaded_file($key, $file_path) {
    $unencrypted_zip = self::decryptZipFile($file_path, $password);
    if (!$unencrypted_zip) {
        One_Click_Migration::write_to_log("Error: Unable to decrypt file '$key'");
        exit;
    }
    One_Click_Migration::write_to_log("Successfully decrypted file: '$key'");
    
    // Proceed with extraction
    self::extract_file($unencrypted_zip, $key);
}
