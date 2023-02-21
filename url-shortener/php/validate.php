<?php
/**
 * Validate original URL
 *
 * @param $originalUrl
 * @return bool
 */
function validateUrl($originalUrl): bool
{
    if (filter_var($originalUrl, FILTER_VALIDATE_URL)) {
        return true;
    } else {
        return false;
    }
}
