<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Ticket
 * @package common\models
 *
 * @property integer $adult
 * @property integer $type
 * @property integer $price
 *
 */

class Ticket extends \yii\db\ActiveRecord
{
    const TYPE_1 = 1; // одиночный
    const TYPE_2 = 2; // групповой
    const TYPE_3 = 3; // льготвый
    const ADULT_1 = 1;
    const ADULT_2 = 2;
    const ADULT_3 = 3;

    public static $typeLabels = [
        self::TYPE_1 => 'Одиночный',
        self::TYPE_2 => 'Групповой',
        self::TYPE_3 => 'Льготный'
    ];

    public static $adultLabels = [
        self::ADULT_1 => 'Детский',
        self::ADULT_2 => 'Взрослый',
        self::ADULT_3 => 'Пенсионный',
    ];

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%ticket}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['adult', 'type', 'price'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'adult' => 'Возрастная категория',
            'type' => 'Тип',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTickets()
    {
        return $this->hasMany(OrderTicket::class, ['ticket_id' => 'id']);
    }

    public static function getTicketList()
    {
        $arrays = self::find()->select(['id', 'title'])->all();
        return ArrayHelper::map($arrays, 'id', 'title');
    }
}
