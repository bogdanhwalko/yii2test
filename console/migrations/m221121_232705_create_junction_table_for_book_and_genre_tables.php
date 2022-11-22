<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_genre}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%book}}`
 * - `{{%genre}}`
 */
class m221121_232705_create_junction_table_for_book_and_genre_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_genre}}', [
            'book_id' => $this->integer(),
            'genre_id' => $this->integer(),
            'PRIMARY KEY(book_id, genre_id)',
        ]);

        // creates index for column `book_id`
        $this->createIndex(
            '{{%idx-book_genre-book_id}}',
            '{{%book_genre}}',
            'book_id'
        );

        // add foreign key for table `{{%book}}`
        $this->addForeignKey(
            '{{%fk-book_genre-book_id}}',
            '{{%book_genre}}',
            'book_id',
            '{{%book}}',
            'id',
            'CASCADE'
        );

        // creates index for column `genre_id`
        $this->createIndex(
            '{{%idx-book_genre-genre_id}}',
            '{{%book_genre}}',
            'genre_id'
        );

        // add foreign key for table `{{%genre}}`
        $this->addForeignKey(
            '{{%fk-book_genre-genre_id}}',
            '{{%book_genre}}',
            'genre_id',
            '{{%genre}}',
            'id',
            'CASCADE'
        );

        $this->insertData();
    }


    private function insertData(): void
    {
        $this->batchInsert('book_genre', ['book_id', 'genre_id'], [
            [1, 5], [1, 6], [1, 8],
            [2, 7], [2, 8],
            [3, 7], [3, 8],
            [4, 11], [4, 12],
            [5, 10], [5, 9],
            [6, 8],
            [7, 1], [7, 2], [7, 3], [7, 4]
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%book}}`
        $this->dropForeignKey(
            '{{%fk-book_genre-book_id}}',
            '{{%book_genre}}'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            '{{%idx-book_genre-book_id}}',
            '{{%book_genre}}'
        );

        // drops foreign key for table `{{%genre}}`
        $this->dropForeignKey(
            '{{%fk-book_genre-genre_id}}',
            '{{%book_genre}}'
        );

        // drops index for column `genre_id`
        $this->dropIndex(
            '{{%idx-book_genre-genre_id}}',
            '{{%book_genre}}'
        );

        $this->dropTable('{{%book_genre}}');
    }
}
