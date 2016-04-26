<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/24
 * Time: 21:52
 */
class BaseController extends \Phalcon\Mvc\Controller
{
    private $debug = false;

    public function result($results)
    {
        $ret = array(
            "errorCode" => Error::None,
            "results" => $results);

        if ($this->debug)
        {
            $timeConsuming = microtime(true) - $this->beginTime;
            $ret = array_merge($ret, array("consuming" => $timeConsuming));
        }
        echo json_encode($ret);
        return true;
    }
}