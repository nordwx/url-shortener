<?php
include 'urls.php';

if (isset($_GET['key'])) {
    $urls = getAllUrls();
    unset($urls[$_GET['key']]);
    if ($urls == null){
        save(null);
    } else {
        save($urls);
    }
    header('Location: ../');
} elseif (isset($_GET['all'])) {
    save(null);
    header('Location: ../');
}