<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form of `common\models\Book`.
 */
class BookSearch extends Book
{
    const COUNT_BOOKS_FOR_PAGE = 16;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'description', 'img', 'date_release'], 'safe'],
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
            'query' => $query,
            'pagination' => [
                'pageSize' => $params['per-page'] ?? self::COUNT_BOOKS_FOR_PAGE
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $perPage = self::COUNT_BOOKS_FOR_PAGE;
        if (\Yii::$app->session->has('frontend_count_book_for_page')) {
            $perPage = \Yii::$app->session->get('frontend_count_book_for_page');
        }

        $dataProvider->setPagination([
            'pageSize' => $perPage
        ]);


        return $dataProvider;
    }
}
