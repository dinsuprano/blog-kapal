<?php

function copyFiles($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);

    while(false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                copyFiles($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

$source = '/home/u883355420/domains/airworthinessforum.com/public_html/storage/app/public';
$destination = '/home/u883355420/domains/airworthinessforum.com/public_html/public/storage';

copyFiles($source, $destination);

echo "Files copied successfully!";
