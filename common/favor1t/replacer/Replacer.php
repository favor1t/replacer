<?php
/**
 * Created by PhpStorm.
 * User: favor1t
 * Date: 16.06.2017
 * Time: 14:35
 */

namespace app\favor1t\replacer;

use app\favor1t\UrlPage;

/**
 * Class IReplacer
 * @package app\favor1t\replacer
 *
 * @property string $url
 * @property string $str is a content from url
 * @property array $conditions is condicition in a replace action
 * @property string $result is a replaced content
 * @property int $flag 0|1 is true if $url is correct else false
 * @property string $regexp is pattern
 * @property object $inverse
 */
class Replacer
{
    /**
     * @var
     */
    private $url;
    /**
     * @var
     */
    private $str;
    /**
     * @var array
     */
    private $conditions = [];
    /**
     * @var
     */
    private $result;
    /**
     * @var bool
     */
    private $flag = false;
    /**
     * @var string
     */
    private $regexp = "@^(?:http://)?([^/]+)@i";
    /**
     * @var null
     */
    private $inverse = null;

    /**
     * Replacer constructor.
     * @param null $url
     */
    private function __construct($url = null)
    {
        if (!is_null($url))
            $this->setUrl($url);
    }

    /**
     * @param $k
     * @param $v
     */
    function addCondition($k, $v)
    {
        $this->conditions[$k] = $v;
        if ($this->flag) {
            $this->_replace();
        }
    }

    /**
     * @param $cnds
     */
    function addConditions($cnds)
    {
        $this->conditions = array_merge($this->conditions, $cnds);
        if ($this->flag) {
            $this->_replace();
        }
    }


    /**
     * @param $url
     * @return bool
     */
    function setUrl($url)
    {
        $this->conditions = [];
        return $this->_checkUrl($url);
    }

    /**
     * @return IReplacer|object
     */
    function getInverse()
    {
        if (is_null($this->inverse)) {
            $this->inverse = new IReplacer();
        }
        return $this->inverse;
    }

    /**
     * @return string
     */
    function getResult()
    {
        return $this->result;
    }

    /**
     * @return IReplacer|object
     */
    function initInverse()
    {
        if (is_null($this->inverse)) {
            return $this->inverse = new IReplacer();
        }
        return $this->inverse;
    }

    /**
     * @param $url
     * @return bool
     */
    private function _checkUrl($url)
    {
        if (preg_match($this->regexp, $url)) {
            $this->url = $url;
            $this->getContent();
            return $this->flag = true;
        }

        return $this->flag = false;

    }

    /**
     *
     */
    private function _replace()
    {
        $this->_checkConditions();

        $this->result = str_replace(
            array_keys($this->conditions),
            array_values($this->conditions),
            $this->str
        );
    }

    /**
     *
     */
    private function _checkConditions()
    {
        $isCdn = [];
        foreach ($this->conditions as $k => $v) {
            if (array_key_exists($v, $this->conditions)
                || in_array($k, $this->conditions)
                || array_key_exists($v, $isCdn)
            ) {
                unset($this->conditions[$k]);
            }
            $isCdn[$v] += 1; //
        }

    }

    /**
     *
     */
    private function getContent()
    {
        $this->str = UrlPage::getContent($this->url);
    }
}


