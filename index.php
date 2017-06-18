<?php
/**
 * Created by PhpStorm.
 * User: favor1t
 * Date: 17.06.2017
 * Time: 3:32
 */
require(__DIR__ . '/../vendor/autoload.php');

$url = "http://192.168.0.19/file?id=1";
$replacer = new Replacer();
$replacer->setUrl($url);


$condition = ["gif" => "GIFFFFF", "Doc" => "dOCCCC", "free" => "FREEEE"];
$replacer->addConditions($condition);
$replacer->addCondition("bgd", "BGD");
$replacer->addCondition("free", "FREE111");


echo $replacer->getResult();
echo $replacer->initInverse()->getResult();