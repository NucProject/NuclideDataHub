<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/26
 * Time: 21:27
 */
class PreAppDevice extends \Phalcon\Mvc\Model
{
    public static function getDeviceId($deviceSn) {
        $device = PreAppDevice::findFirst(array("device_sn='$deviceSn'"));
        if ($device) {
            return array($device->device_id, $device->sid); //$device->device_id;
        }
        return false;
    }

}