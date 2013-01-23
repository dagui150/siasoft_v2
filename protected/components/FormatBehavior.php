<?php

class FormatBehavior extends DecimalI18NBehavior {

    public $columns = array();

    public function beforeSave($event) {
        $this->columns = $this->formats;
        $model = $this->owner;
        foreach ($this->columns as $key => $value) {
            $model->$key = Controller::unformat($model->$key);
        }

        parent::beforeSave($event);
    }

}