<?php
// Standalone symlink script
$targetFolder = __DIR__ . '/storage/app/public';
$linkFolder = __DIR__ . '/public/storage';

if (file_exists($linkFolder)) {
    // If an old broken shortcut exists, remove it first
    if (is_link($linkFolder)) {
        unlink($linkFolder);
    } else {
        echo "A physical folder already exists at public/storage. Please delete it via file manager first.<br>";
    }
}

if (symlink($targetFolder, $linkFolder)) {
    echo "SUCCESS! The storage shortcut link has been securely created.<br>";
    echo "Target: " . $targetFolder . "<br>";
    echo "Shortcut: " . $linkFolder;
} else {
    echo "Failed to create symlink. Check your directory permission levels.";
}