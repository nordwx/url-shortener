    <?php
include 'urls.php';
/**
 * Redirect user to original Url
 *
 * @param $shortUrl
 * @return void
 */
function redirectToOriginalUrl($shortUrl): void
{
    $url = getOriginalUrl($shortUrl, '/');
    $originalUrl = $url["original_url"];
    updateClicksCount($shortUrl);
    header('Location: ' . $originalUrl);
}

/**
 * Update the click count in the JSON file
 *
 * @param $shortUrl
 * @return void
 */
function updateClicksCount($shortUrl): void
{
    $urls = getAllUrls('/');
    $urls[$shortUrl]["click_count"]++;
    save($urls, '/');
}

/**
 * Check for existence of short url in json file
 *
 * @param $shortUrl
 * @return bool
 */
function checkShortUrl($shortUrl): bool
{
    if (getOriginalUrl($shortUrl, '/') != null) {
        return true;
    } else {
        return false;
    }
}