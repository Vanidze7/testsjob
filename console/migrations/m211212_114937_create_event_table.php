<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m211212_114937_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
            'status' => $this->tinyInteger()->unsigned(),
            'count' => $this->tinyInteger()->unsigned(),//кол-во мест
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
