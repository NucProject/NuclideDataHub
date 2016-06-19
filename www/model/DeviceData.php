<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/24
 * Time: 22:34
 */
class DeviceData extends \Phalcon\Mvc\Model
{
    private $device_id = 0;

    private $sensor_id = 0;

    private $station_id = 0;

    private $lat = 0;

    private $lng = 0;

    private $lat_gps = 0;

    private $lng_gps = 0;

    public function set($device_id, $sensor_id, $stationId) {
        $this->device_id = $device_id;
        $this->sensor_id = $sensor_id;
        $this->station_id = $stationId;
    }

    /*
    public function setLocation($lat, $lng, $lat_gps, $lng_gps) {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->lat_gps = $lat_gps;
        $this->lng_gps = $lng_gps;
    }
    */

    public function getSource() {
        return "pre_app_sensor_{$this->device_id}_{$this->sensor_id}";
    }

}