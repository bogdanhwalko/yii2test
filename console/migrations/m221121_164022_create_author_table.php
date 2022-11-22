<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m221121_164022_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'date_birth' => $this->date(),
            'phone' => $this->string()->null(),
        ]);

        $this->insertData();
    }


    private function insertData(): void
    {
        $this->batchInsert('author', ['name', 'surname', 'date_birth', 'phone'], [
            ['Фрідріх', 'Гаєк', '1899-08-05', '380971111111'],
            ['Джордж', 'Орвелл', '1903-06-25', '380971111112'],
            ['Сергій', 'Жадан', '1974-08-23', '380971111113'],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
