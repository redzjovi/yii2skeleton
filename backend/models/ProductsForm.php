<?php
namespace backend\models;

use common\models\ProductImages;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;

class ProductsForm extends Model
{
    public $product_id;
    public $product_images;
    public $product_images_array;

    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_images_array'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 5],
            [['product_id', 'product_images', 'product_images_array'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_images_array' => Yii::t('app', 'Product Images'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $newFiles = [];
            $path = 'uploads/products/' . $this->product_id;

            if (is_array($this->product_images)) {
                $files = array_unique($this->product_images);
                $files = array_values($files);

                FileHelper::createDirectory($path, $mode = 0755, $recursive = true);

                foreach ($files as $key => $file) {
                    $filePathinfo = pathinfo($file);
                    $fileBasename = $filePathinfo['basename'];
                    $fileDirname = $filePathinfo['dirname'];
                    $fileExtension = $filePathinfo['extension'];

                    if ($fileDirname != $path) {
                        FileHelper::copyDirectory($fileDirname, $path);
                    }

                    $productImages = ProductImages::find()->where([
                        'product_id' => $this->product_id,
                        'name' => $fileBasename,
                    ])->one();
                    if ($productImages === null) {
                        $productImages = new ProductImages();
                    }
                    $productImages->product_id = $this->product_id;
                    $productImages->name = $fileBasename;
                    $productImages->path = $path . '/' .$fileBasename;
                    $productImages->size = filesize($path . '/' .$fileBasename);
                    $productImages->type = $fileExtension;
                    $productImages->mime = FileHelper::getMimeTypeByExtension($path . '/' .$fileBasename);
                    $productImages->position = $key + 1;
                    $productImages->save();

                    $newFiles[] = $fileBasename;
                }
            }

            ProductImages::deleteAll([
                'AND',
                ['product_id' => $this->product_id],
                ['NOT IN', 'name', $newFiles]
            ]);
            foreach( glob($path .'/*') as $file ) {
                if (! in_array(basename($file), $newFiles) ) {
                    unlink($file);
                }
            }
        }
    }

}
