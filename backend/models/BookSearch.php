<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form of `common\models\Book`.
 */
class BookSearch extends Book
{
    public $genres_id = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'description', 'img', 'date_release', 'genres_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Book::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->sort->attributes['author.name'] = [
            'asc' => ['author.surname' => SORT_ASC, 'author.name' => SORT_ASC],
            'desc' => ['author.surname' => SORT_DESC, 'author.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['genres'] = [
            'asc' => ['genre.name' => SORT_ASC],
            'desc' => ['genre.name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['author', 'genres']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'date_release' => $this->date_release,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
