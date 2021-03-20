<?php

/**
 * Wrapper for wp_redirect
 *
 * @param $url
 */
function _redirect($url)
{
    wp_redirect($url);
    exit;
}