<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/24
 * Time: 22:34
 */
class DeviceData extends \Phalcon\Mvc\Model
{
    private $d = 0;

    private $n = 0;

    public function __construct($d, $n) {
        $this->d = $d;
        $this->n = $n;
    }

    public function getSource() {
        return "pre_app_sensor_{$this->d}_{$this->n}";
    }


}