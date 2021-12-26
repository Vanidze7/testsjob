<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * @property mixed|null id
 * @property mixed|null event
 * @property mixed|null user
 * @property mixed|null status
 * @property int|mixed|null user_id
 * @property mixed|null event_id
 */
class Order extends \yii\db\ActiveRecord
{

    const STATUS_1 = 1;
    const STATUS_2 = 2;

    public static $statusLabels = [
        self::STATUS_1 => 'Ждет оформления',
        self::STATUS_2 => 'Оформлен',
    ];

    public static function tableName()
    {
        return '{{%order}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['order_date'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),//текущее значение
            ],
        ];
    }

    public function rules()
    {
        return [
            [['user_id', 'event_id', 'status'], 'required'],
            [['user_id', 'event_id', 'status'], 'integer'],
            [['order_date'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::class, 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'event_id' => 'ID События',
            'order_date' => 'Дата заказа',
            'status' => 'Статус',
        ];
    }

    /* public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($this->event->status != Event::STATUS_3){
            $query = OrderTicket::find()->select('order_id')->where(['order_id' => $this->id])->count();
            if($query == $this->event->count){
                $this->event->status = Event::STATUS_3;
                $this->event->save();
            }
        }
    }*/

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    public function getOrderTickets()
    {
        return $this->hasMany(OrderTicket::class, ['order_id' => 'id']);
    }
    public static function getOrderList()
    {
        $arrays = self::find()->select('id')->column(); // ->scalar();
        return $arrays;//ArrayHelper::map($arrays, 'id', 'id');
    }
}
