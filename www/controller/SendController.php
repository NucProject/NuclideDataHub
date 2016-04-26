<?php

/**
 * Created by PhpStorm.
 * User: healer_kx@163.com
 * Date: 2016/4/24
 * Time: 21:51
 */
class SendController extends BaseController
{

    public function dataAction() {
        if (!$this->request->isPost()) {
            return parent::result(array('error' => 1, 'msg' => 'Post required'));
        }
        $payload = json_decode($this->request->getRawBody());
        file_put_contents("d:\\post.txt", json_encode($payload) . "\n", FILE_APPEND);

        if ($this->saveSensorData($payload)) {
            return parent::result(array('error' => 0, 'msg' => 'Sensor data saved!'));
        } else {
            return parent::result(array('error' => 2, 'msg' => 'Sensor data save failed!'));
        }
    }

    /**
     * @param $data
     * @return boolean
     */
    private function saveSensorData($data) {
        // TODO:

        return true;
    }
}