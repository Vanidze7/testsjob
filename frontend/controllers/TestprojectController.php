<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\OrderTicket;
use common\models\Ticket;
use common\models\User;
use frontend\models\CreateOrderForm;

class TestprojectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateOrder()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        /** @var User $user */
        $user = \Yii::$app->user;

        $form = new CreateOrderForm();

        if($form->load(\Yii::$app->request->post()) && $form->validate())
        {
            \Yii::$app->session->setFlash('success', 'Заказ успешно создан');

            $order = new Order();
            $order->user_id = $user->id;
            $order->event_id = $form->event_id;
            $order->status = Order::STATUS_1;
            $order->save();

            $ticketsOrder = new OrderTicket();
            $ticketsOrder->order_id = $order->id;
            $string_ticket = Ticket::find()->select(['id', 'price'])->where(['type' => $form->type, 'adult' => $form->adult])->one();
            $ticketsOrder->ticket_id = $string_ticket->id;
            $ticketsOrder->bar_code = \Yii::$app->security->generateRandomString();
            $ticketsOrder->cost = $string_ticket->price;
            $ticketsOrder->save();

        }

        return $this->render('create-order-form', [
            'model' => $form
        ]);
    }
}
