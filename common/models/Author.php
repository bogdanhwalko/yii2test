<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string|null $surname
 * @property string|null $date_birth
 * @property string|null $phone
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_birth'], 'safe'],
            [['name', 'surname', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'date_birth' => 'Date Birth',
            'phone' => 'Phone',
        ];
    }


    public static function getFormatNamesForSelect(): array
    {
        $authors = self::find()
            ->select(['id', 'concat(name, SPACE(1), surname) as full_name'])
            ->asArray()
            ->all();

        return ArrayHelper::map($authors, 'id', 'full_name');
    }


    public function getFullName(): string
    {
        return $this->surname .' '. $this->name;
    }
}
