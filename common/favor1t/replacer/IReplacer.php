<?php
/**
 * Created by PhpStorm.
 * User: favor1t
 * Date: 17.06.2017
 * Time: 23:25
 */

namespace app\favor1t\replacer;


use app\favor1t\helper\SingletonTrait;

/**
 * Class IReplacer
 * @package app\favor1t\replacer
 */
class IReplacer extends Replacer
{
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

    use SingletonTrait;

    /**
     * IReplacer constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @param $conditions
     */
    function addConditions($conditions)
    {
        parent::addConditions(array_flip($conditions));
    }

    /**
     * @param $k
     * @param $v
     */
    function addCondition($k, $v)
    {
        parent::addCondition($v, $k);
    }

    /**
     * @return mixed
     */
    function getResult()
    {
        $this->result = str_replace(
            array_keys($this->conditions),
            array_values($this->conditions),
            $this->str
        );
        return $this->result;
    }

}