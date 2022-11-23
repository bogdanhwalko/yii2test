<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile = null;


    public function attributeLabels():array
    {
        return [
            'imageFile' => 'Изображение'
        ];
    }


    public function rules(): array
    {
        return [
            ['imageFile', 'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'maxSize' => 512000,
            ],
        ];
    }


    public function upload()
    {
        $filePath = '/images/book/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        if ($this->validate() && $this->imageFile->saveAs(Yii::getAlias('@frontend/web') . $filePath)) {
            return $filePath;
        }

        return false;
    }
}