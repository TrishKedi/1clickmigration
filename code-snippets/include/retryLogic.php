foreach ($presigned_urls as $key => $download_url) {
    $retry_count = get_option("ocm_restore_download_retry_$key", 0);
    while ($retry_count <= 2) {
        One_Click_Migration::write_to_log("Attempting to download file: '$key' (Retry #$retry_count)");
        
        $downloadTmpPathFile = download_url($download_url);
        if (is_wp_error($downloadTmpPathFile)) {
            $retry_count++;
            update_option("ocm_restore_download_retry_$key", $retry_count, true);
            continue; // Retry on error
        }
        
        // Process the downloaded file (e.g., decryption, extraction)
        self::process_downloaded_file($key, $downloadTmpPathFile);
        break; // Exit retry loop on success
    }
}
