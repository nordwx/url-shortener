<?php
/**
 * Get the original URL
 *
 * @param $shortUrl
 * @param string $dir
 * @return mixed
 */
function getOriginalUrl($shortUrl, string $dir = 'php'): mixed
{
    $urls = getAllUrls($dir);
    return $urls[$shortUrl];
}

/**
 * Get all URLs
 *
 * @param string $dir
 * @return mixed
 */
function getAllUrls(string $dir = 'php'): mixed
{
    $json = $dir == '/' ? 'data.json' : '../data.json';
    return json_decode(file_get_contents($json), true);
}

/**
 * Save URLs to json file
 *
 * @param $data
 * @param string $dir
 * @return void
 */
function save($data, string $dir = 'php'): void
{
    $json = $dir == '/' ? 'data.json' : '../data.json';
    file_put_contents($json, json_encode($data));
}