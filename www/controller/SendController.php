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
        // file_put_contents("d:\\post.txt", json_encode($payload) . "\n", FILE_APPEND);

        $time = $payload['time'];
        if ($this->saveSensorData($payload, $time, $type)) {
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
     * @param $time
     * @param $type
     * @return boolean
     */
    private function saveSensorData($data, $time, $type) {

        $deviceSn = $data['Device_id'];

        if ($type == 'work') {
            $ret = PreAppWorkDevice::getDeviceId($deviceSn);
            $deviceId = $ret[0];
            $stationId = $ret[1];
        } else {
            $ret = PreAppDevice::getDeviceId($deviceSn);
            $deviceId = $ret[0];
            $stationId = $ret[1];
        }

        $values = $data['values'];
        foreach ($values as $value) {
            $sensorName = $value['sensor']; // name or sensor?
            $sensorValue = $value['value'];

            if ($type == 'work') {
                $sensorId = PreAppWorkSensor::getSensorId($deviceId, $sensorName);
                // echo "($sensorName-$sensorId)";
                $dataObj = new WorkDeviceData();
                $dataObj->set($deviceId, $sensorId, $stationId);
                $dataObj->setLocation($data['Lat'], $data['Lng'], $data['Lat_gps'], $data['Lng_gps']);
            } else {
                $sensorId = PreAppSensor::getSensorId($deviceId, $sensorName);
                $dataObj = new DeviceData();
                $dataObj->set($deviceId, $sensorId, $stationId);
            }

            $dataObj->dateline = $time;
            $dataObj->data = $sensorValue;
            $result = $dataObj->save();
            if (!$result) {
                var_dump($dataObj->getMessages());
            }
        }

        return true;
    }


}