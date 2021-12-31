<?php

namespace common\models;

use Yii;
use yii\base\Security;
use yii\db\ActiveRecord;

/**
 * @property mixed|null ticket
 * @property mixed|null order
 * @property mixed|null bar_code
 * @property mixed|null cost
 * @property mixed|null ticket_id
 * @property mixed|null order_id
 * @property mixed|null id
 */
class OrderTicket extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%order_ticket}}';
    }

    public function rules()
    {
        return [
            [['order_id', 'ticket_id', 'bar_code', 'cost'], 'required'],
            [['order_id', 'ticket_id', 'cost'], 'integer'],
            [['bar_code'], 'string', 'max' => 255],
            [['bar_code'], 'unique'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::class, 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'ID Заказа',
            'ticket_id' => 'ID Билета',
            'bar_code' => 'Уникальный код',
            'cost' => 'Цена',
        ];
    }

    public function beforeValidate()
    {
        if(!$this->bar_code)
            $this->bar_code =\Yii::$app->security->generateRandomString();
        return parent::beforeValidate();
    }

    public function checktickets()
    {
        $tickets = 0;
        $queryOrders = Order::find()->where(['event_id' => $this->order->event_id])->all();
        foreach ($queryOrders as $order){
            $queryTickets = OrderTicket::find()->where(['order_id' => $order->id])->count();
            $tickets += $queryTickets;
        }
        if($tickets >= $this->order->event->count){
            $this->order->event->status = Event::STATUS_3;
        }else{
            $this->order->event->status = Event::STATUS_1;
        }
        $this->order->event->save();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->checktickets();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->checktickets();

    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }
}
