private static function replace_directory($new_dir, $old_dir) {
    if (is_dir($old_dir) && !self::deleteDir($old_dir)) {
        One_Click_Migration::write_to_log("Error: Could not delete old directory '$old_dir'");
        return;
    }

    if (!@rename($new_dir, $old_dir)) {
        One_Click_Migration::write_to_log("Error: Could not move '$new_dir' to '$old_dir'");
    } else {
        One_Click_Migration::write_to_log("Restoration of '$old_dir' completed successfully.");
    }
}
