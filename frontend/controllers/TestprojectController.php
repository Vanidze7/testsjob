<?php

namespace frontend\controllers;

use common\models\Event;
use common\models\Order;
use common\models\OrderTicket;
use common\models\Ticket;
use common\models\User;
use frontend\models\CreateOrderForm;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class TestprojectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Event::find()->where(['status' => Event::STATUS_1])->all();

        return $this->render('index', ['events' => $query]);
    }

    public function actionViewEvent($id)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = \Yii::$app->user;

        $query = Event::findOne($id);
        $form = new CreateOrderForm();


        if($form->load(\Yii::$app->request->post()) && $form->validate())
        {
            \Yii::$app->session->setFlash('success', 'Заказ успешно создан');

            $order = new Order();
            $order->user_id = $user->id;
            $order->event_id = $query->id;
            $order->status = Order::STATUS_1;
            $order->save();

            $ticketsOrder = new OrderTicket();
            $string_ticket = Ticket::find()->select(['id', 'price'])->where(['type' => $form->type, 'adult' => $form->adult])->one();
            $ticketsOrder->order_id = $order->id;
            $ticketsOrder->ticket_id = $string_ticket->id;
            $ticketsOrder->bar_code = \Yii::$app->security->generateRandomString();
            $ticketsOrder->cost = $string_ticket->price;
            $ticketsOrder->save();
        }

        return $this->render('view-event', ['event' => $query, 'model' => $form, 'price' => $string_ticket->price]);
    }

    public function actionUserOrders()
    {
        $user = \Yii::$app->user->identity;
        $query = new ActiveDataProvider([
            'query' => Order::find()->where(['user_id' => $user->id]),
        ]);

        return $this->render('user-orders', [
            'user' => User::findOne($user->id),
            'orders' => $query
        ]);
    }

    public function actionViewOrder($id)
    {
        $user = \Yii::$app->user->identity;
        $queryorder = Order::findOne($id);

        $querytickets = new ActiveDataProvider([
            'query' => OrderTicket::find()->where(['order_id' => $id])
        ]);

        return $this->render('view-order', [
            'order' => $queryorder,
            'tickets' => $querytickets,
            'user' => $user
        ]);
    }

}
