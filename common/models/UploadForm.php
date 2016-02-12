<?php

namespace common\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

class UploadForm extends Model {

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules() {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }

    public function upload($upload_dir = 'product_image') {
        $file_name = [];
        if ($this->validate()) {

            $app_root = Yii::getAlias('@approot');
            $upload_path = "{$app_root}/uploads/{$upload_dir}/";
            if (!file_exists($upload_path)) {
                BaseFileHelper::createDirectory($upload_path, 0777, TRUE);
            } else {
                if (!is_dir($upload_path)) {
                    unlink($upload_path);
                    $this->upload($upload_dir);
                }
            }
            
            foreach ($this->imageFiles as $file) {
                $file_path = "{$upload_path}{$file->baseName}.{$file->extension}";
                $file->saveAs($file_path);
                $file_info['name'] = 'product_image';
                $file_info['type'] = $file->type;
                $file_info['value'] = $file->baseName . '.' . $file->extension;
                $file_name[] = $file_info;
            }
            return $file_name;
        } else {
            return false;
        }
    }

}
