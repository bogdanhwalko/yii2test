<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m221121_164111_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'author_id' => $this->integer()->notNull(),
            'img' => $this->string()->null(),
            'date_release' => $this->date()
        ]);

        $this->insertData();
    }


    private function insertData(): void
    {
        $this->batchInsert('book', ['name', 'description', 'author_id', 'img', 'date_release'], [
            ['Тамплієри', 'Нова книжка українського поета номер один.', '3', NULL, '2016-01-01'],
            ['Депеш Мод', 'Роман Сергія Жадана «Депеш Мод» — чтиво не для нервових і не для «правильних»', '3', NULL, '2014-01-01'],
            ['Інтернат', '«Інтернат» — глибокий та захопливий роман, який відбив бачення автора життя в зоні АТО', '3', NULL, '2017-01-01'],
            ['1984. Графічний роман', 'Вінстон Сміт — рядовий партійний функціонер у тоталітарній державі, робота якого полягає в тому, щоб переписувати історію, підганяючи її під поточні потреби.', '2', NULL, '2022-01-01'],
            ['Колгосп тварин', 'Владу над фермою перейняли спрацьовані, зневажені тварини. ', '2', NULL, '2015-01-01'],
            ['Ковток повітря', 'Герой роману «Ковток повітря» розуміє, що в його житті щось не так, а насправді – все.', '2', NULL, '2019-01-01'],
            ['Шлях до рабства', 'Чому до влади приходять найгірші? Це не риторичне запитання, а назва розділу із цієї книжки', '1', NULL, '2022-01-01'],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
