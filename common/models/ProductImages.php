<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_images".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $path
 * @property integer $size
 * @property string $type
 * @property string $mime
 * @property integer $position
 *
 * @property Products $product
 */
class ProductImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'name', 'path', 'size', 'type', 'mime', 'position'], 'required'],
            [['product_id', 'size', 'position'], 'integer'],
            [['name', 'path'], 'string'],
            [['type', 'mime'], 'string', 'max' => 50],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
            'type' => Yii::t('app', 'Type'),
            'mime' => Yii::t('app', 'Mime'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
