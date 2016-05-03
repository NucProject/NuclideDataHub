<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/26
 * Time: 21:27
 */
class PreAppWorkSensor extends \Phalcon\Mvc\Model
{

    public static function getSensorId($deviceId, $sensorName) {
        $sensor = PreAppWorkSensor::findFirst(array("device_id=$deviceId and sensor_name='$sensorName'"));
        if ($sensor) {
            return $sensor->sensor_id;
        }
        return false;
    }
}