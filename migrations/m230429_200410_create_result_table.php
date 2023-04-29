<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%result}}`.
 */
class m230429_200410_create_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%result}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'hours' => $this->integer(),
            'start' => $this->time(),
            'numberOfLines' => $this->integer(),
            'result' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%result}}');
    }
}
