<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $author_id
 * @property string|null $img
 * @property string|null $date_release
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author_id', 'description', 'date_release'], 'required'],
            [['author_id'], 'integer'],
            [['date_release'], 'safe'],
            [['name', 'img'], 'string', 'max' => 255, 'min' => 2],
            ['description', 'string', 'max' => 1000, 'min' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название книги',
            'description' => 'Описание',
            'author_id' => 'Автор',
            'author.name' => 'Автор',
            'img' => 'Изображение',
            'date_release' => 'Дата выпуска',
            'genres' => 'Набор жанров',
            'genres.name' => 'Набор жанров',
        ];
    }


    /**
     * Gets query for [[Author]].
     */
    public function getAuthor(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }


    /**
     * Gets query for [[BookGenres]].

     */
    public function getBookGenres(): \yii\db\ActiveQuery
    {
        return $this->hasMany(BookGenre::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Genres]].

     */
    public function getGenres(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Genre::class, ['id' => 'genre_id'])
            ->via('bookGenres');
    }

}
