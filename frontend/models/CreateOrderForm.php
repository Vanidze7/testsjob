<?php


namespace frontend\models;


class CreateOrderForm extends \yii\base\Model
{
    public $event_id;
    public $type;
    public $adult;

    public function rules()
    {
        return [
            [['event_id', 'type', 'adult'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'event_id' => 'Выбрать событие',
            'type' => 'Тип билета',
            'adult' => 'Возрастной статус',
        ];
    }
}