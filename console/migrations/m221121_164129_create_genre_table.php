<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre}}`.
 */
class m221121_164129_create_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genre}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->insertData();
    }


    private function insertData(): void
    {
        $this->batchInsert('genre', ['name'], [
            ['Філософія'],
            ['Історія'],
            ['Держава'],
            ['Суспільство'],
            ['Вірші'],
            ['Лірика'],
            ['Сучасна українська проза'],
            ['Література України'],
            ['Іноземна класика'],
            ['Зарубіжна література'],
            ['Комікси і графічні романи'],
            ['Художні новинки'],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%genre}}');
    }
}
