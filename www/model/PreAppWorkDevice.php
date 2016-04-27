<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/26
 * Time: 21:27
 */
class PreAppWorkDevice extends \Phalcon\Mvc\Model
{
    public static function getDeviceId($deviceSn) {
        $device = PreAppWorkDevice::findFirst(array("device_sn='$deviceSn'"));
        if ($device) {
            return $device->device_id;
        }
        return false;
    }

}