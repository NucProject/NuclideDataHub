
<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/24
 * Time: 22:34
 */
class WorkDeviceData extends \Phalcon\Mvc\Model
{
    private $device_id = 0;

    private $sensor_id = 0;

    public function set($device_id, $sensor_id) {
        $this->device_id = $device_id;
        $this->sensor_id = $sensor_id;
    }

    public function getSource() {
        return "pre_app_work_sensor_{$this->device_id}_{$this->sensor_id}";
    }

}