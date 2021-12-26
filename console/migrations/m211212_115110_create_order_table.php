<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m211212_115110_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'event_id' => $this->integer()->notNull(),
            'order_date' => $this->dateTime(),
            'status' => $this->smallInteger()->notNull()->unsigned(),
        ]);

        //имя информационное, текущая таблица, ее столбик, связываемая таблица, ее столбик, постоянные значения
        $this->addForeignKey('fk_order_to_user', '{{%order}}','user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_to_event', '{{%order}}','event_id', '{{%event}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
