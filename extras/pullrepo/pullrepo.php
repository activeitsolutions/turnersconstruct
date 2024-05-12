<?php
// Function to download and extract zip file
function downloadAndExtractZip($url, $destination) {
    $tempZip = tempnam(sys_get_temp_dir(), 'repo_zip');
    $zipFile = file_get_contents($url);
    file_put_contents($tempZip, $zipFile);
    
    $zip = new ZipArchive;
    $res = $zip->open($tempZip);
    if ($res === TRUE) {
        // Extract zip file
        $zip->extractTo($destination);
        $zip->close();
        unlink($tempZip);

        // Find extracted folder
        $extractedFolder = glob($destination . '/*', GLOB_ONLYDIR)[0];
        
        // Move contents of extracted folder to root
        $files = glob($extractedFolder . '/*');
        foreach ($files as $file) {
            // Move files directly to root directory
            $fileDestination = dirname(dirname(__DIR__)) . '/' . basename($file);
            // Check if file is .htaccess
            if (basename($file) === '.htaccess') {
                // Remove existing .htaccess file if it exists
                $existingHtaccess = dirname(dirname(__DIR__)) . '/.htaccess';
                if (file_exists($existingHtaccess)) {
                    unlink($existingHtaccess);
                }
            }
            rename($file, $fileDestination);
        }

        // Remove extracted folder
        rmdir($extractedFolder);

        return true;
    } else {
        unlink($tempZip);
        return false;
    }
}

// GitHub repo URL
$repoUrl = "https://github.com/activeitsolutions/turnersconstruct/archive/refs/heads/main.zip";

// Destination folder where the contents will be extracted
$destinationFolder = dirname(dirname(__DIR__)) . '/repo';

// Check if the folder exists, if not create it
if (!is_dir($destinationFolder)) {
    mkdir($destinationFolder, 0777, true);
}

// Download and extract the zip file
if (downloadAndExtractZip($repoUrl, $destinationFolder)) {
    echo "Repository pulled successfully!";
} else {
    echo "Failed to pull repository.";
}
?>
