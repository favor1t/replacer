<?php
/**
 * Created by PhpStorm.
 * User: favor1t
 * Date: 17.06.2017
 * Time: 21:28
 */

namespace app\favor1t;


/**
 * Class UrlPage
 * @package app\favor1t
 */
class UrlPage
{
    /**
     * @param $url
     * @return mixed
     */
    static function getContent($url)
    {
        $ch = curl_init($url);
        $options = [
            CURLOPT_HEADER => false,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,

        ];

        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return $content;
    }
}