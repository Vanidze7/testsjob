<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property mixed|null status
 * @property mixed|null count
 * @property mixed|null id
 */
class Event extends \yii\db\ActiveRecord
{

    public $ticket_buy;

    const STATUS_1 = 1;
    const STATUS_2 = 2;
    const STATUS_3 = 3;

    public static $statusLabels = [
        self::STATUS_1 => 'Активно',
        self::STATUS_2 => 'Прошло',
        self::STATUS_3 => 'Билетов нет',
    ];

    public static function tableName()
    {
        return '{{%event}}';
    }

    public function rules()
    {
        return [
            [['status', 'count'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'status' => 'Статус',
            'count' => 'Кол-во билетов',
            'ticket_buy' => 'Купленно билетов'
        ];
    }


    public function afterFind()//
    {
        $count = 0;
        $eventOrders = $this->getOrders()->all();
        foreach ($eventOrders as $order)
            $count += count($order->getOrderTickets()->all());

        $this->ticket_buy = $count;

        parent::afterFind();
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['event_id' => 'id']);
    }

    public static function getEventList()
    {
        $arrays = self::find()->select(['id', 'title'])->where(['status' => self::STATUS_1])->all();
        /**
         * [
         *  ['id' => 1, 'title' => 'cinema']
         * ]
         *
         * [
         *  1 => 'cinema'
         * ]
         *
         */
        return ArrayHelper::map($arrays, 'id', 'title');
    }


}
