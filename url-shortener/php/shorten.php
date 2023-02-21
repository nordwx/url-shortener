<?php
include 'validate.php';
include 'urls.php';
/**
 * Generate a unique short URL for each long URL
 *
 * @param $originalUrl
 * @return string
 */
function generateShortUrl($originalUrl): string
{
    return hash("crc32b", $originalUrl);
}

/**
 * Store the long URL, short URL, and click count in a JSON file
 *
 * @param $originalUrl
 * @return void
 */
function storeUrl($originalUrl): void
{
    $shortUrl = generateShortUrl($originalUrl);
    $urls = getAllUrls();
    $urls[$shortUrl] = array("original_url" => $originalUrl, "click_count" => 0);
    save($urls);
}

/**
 * @param $originalUrl
 * @return void
 */
function createShortUrl($originalUrl): void
{
    if (validateUrl($originalUrl)) {
        storeUrl($originalUrl);
    } else {
        http_response_code(400);
        echo "Error: Invalid URL!\n\nPlease, enter valid URL address";
        die();
    }
}

createShortUrl($_POST['original-url']);