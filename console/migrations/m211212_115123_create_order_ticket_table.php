<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_ticket}}`.
 */
class m211212_115123_create_order_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_ticket}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'ticket_id' => $this->integer()->notNull(),
            'bar_code' => $this->string()->notNull()->unique(),
            'cost' => $this->smallInteger()->unsigned()->notNull(),
        ]);

        $this->addForeignKey('fk_order_ticket_to_order', '{{%order_ticket}}','order_id', '{{%order}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_ticket_to_ticket', '{{%order_ticket}}','ticket_id', '{{%ticket}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_ticket}}');
    }
}
