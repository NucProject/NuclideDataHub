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
     *
     * @return bool
     * 常规数据
     */
    public function dataAction() {
        $this->actionHandler('common');
    }

    public function workDataAction() {
        $this->actionHandler('work');
    }

    private function actionHandler($type) {
        if (!$this->request->isPost()) {
            return parent::result(array('error' => 1, 'msg' => 'Post required'));
        }
        $payload = json_decode($this->request->getRawBody(), true);
        file_put_contents("d:\\post.txt", json_encode($payload) . "\n", FILE_APPEND);

        if ($this->saveSensorData($payload, time(), $type)) {
            return parent::result(array('error' => 0, 'msg' => 'Sensor data saved!'));
        } else {
            return parent::result(array('error' => 2, 'msg' => 'Sensor data save failed!'));
        }
    }

    public function saveTestAction() {
        $data = file_get_contents('payload.txt');
        $payload = json_decode($data, true);

        $this->saveSensorData($payload, time(), 'work');
    }

    /**
     * @param $data
     * @param $type
     * @return boolean
     */
    private function saveSensorData($data, $time, $type) {

        $deviceSn = $data['Device_id'];

        if ($type == 'work') {
            $deviceId = PreAppWorkDevice::getDeviceId($deviceSn);
        } else {
            $deviceId = PreAppDevice::getDeviceId($deviceSn);
        }

        $values = $data['values'];
        foreach ($values as $value) {
            $sensorName = $value['sensor']; // name or sensor?
            $sensorValue = $value['value'];

            if ($type == 'work') {
                $sensorId = PreAppWorkSensor::getSensorId($sensorName);
                // echo "($sensorName-$sensorId)";
                $data = new WorkDeviceData();
                $data->set($deviceId, $sensorId);
            } else {
                $sensorId = PreAppSensor::getSensorId($sensorName);
                $data = new DeviceData();
                $data->set($deviceId, $sensorId);
            }

            $data->dateline = $time;
            $data->data = $sensorValue;
            $result = $data->save();
            if (!$result) {
                var_dump($data->getMessages());
            }
        }

        return true;
    }


}