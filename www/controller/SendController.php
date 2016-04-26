<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/24
 * Time: 21:51
 */
class SendController extends BaseController
{
    /**
     * @param $type
     * @return bool
     * 常规数据
     */
    public function dataAction($type) {
        if (!$this->request->isPost()) {
            return parent::result(array('error' => 1, 'msg' => 'Post required'));
        }
        $payload = json_decode($this->request->getRawBody());
        file_put_contents("d:\\post.txt", json_encode($payload) . "\n", FILE_APPEND);

        if ($this->saveSensorData($payload, $type)) {
            return parent::result(array('error' => 0, 'msg' => 'Sensor data saved!'));
        } else {
            return parent::result(array('error' => 2, 'msg' => 'Sensor data save failed!'));
        }
    }


    /**
     * @param $data
     * @param $type
     * @return boolean
     */
    private function saveSensorData($data, $type) {
        // TODO:

        $deviceSn = $data['Device_id'];
        $values = $data['values'];
        $deviceId = PreAppDevice::getDeviceId($deviceSn);

        foreach ($values as $value) {
            $sensorName = $value['name'];
            $sensorValue = $value['value'];

            $sensorId = PreAppSensor::getSensorId($sensorName);

            if ($type == 'work') {
                $data = new WorkDeviceData($deviceId, $sensorId);
            } else {
                $data = new DeviceData($deviceId, $sensorId);
            }

            $data->data = $sensorValue;
            return $data->save();
        }
    }


}