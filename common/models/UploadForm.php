<?php

namespace common\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules() {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }

    public function upload() {
        $file_name = [];
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file_path = Yii::getAlias('@approot') . "/uploads/{$file->baseName}.{$file->extension}";
                $file->saveAs($file_path);
//                $file->saveAs('' . $file->baseName . '.' . $file->extension);
                $file_name[] = $file->baseName . '.' . $file->extension;
            }
            return $file_name;
        } else {
            return false;
        }
    }

}
