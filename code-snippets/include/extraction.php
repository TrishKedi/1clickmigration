private static function extract_file($zip_file, $key) {
    $zip = new ZipArchive;
    if ($zip->open($zip_file) === true) {
        $extract_path = WP_CONTENT_DIR . "/$key";
        $zip->extractTo($extract_path);
        $zip->close();
        One_Click_Migration::write_to_log("Successfully extracted '$key' to '$extract_path'");
    } else {
        One_Click_Migration::write_to_log("Error: Could not extract '$key'");
    }
    
    // Handle directory replacement
    $old_dir = WP_CONTENT_DIR . "/$key";
    self::replace_directory($extract_path, $old_dir);
}
