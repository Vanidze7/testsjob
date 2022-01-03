<?php


namespace frontend\models;


class CreateOrderForm extends \yii\base\Model
{
    public $type;
    public $adult;

    public function rules()
    {
        return [
            [['type', 'adult'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type' => 'Тип билета',
            'adult' => 'Возрастной статус',
        ];
    }
}