<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $product_name
 * @property string $description
 * @property integer $weight
 * @property integer $sell_price
 * @property integer $stock
 * @property string $status
 *
 * @property ProductImages[] $productImages
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'description', 'weight', 'sell_price', 'stock', 'status'], 'required'],
            [['description', 'status'], 'string'],
            [['weight', 'sell_price', 'stock'], 'integer', 'except' => ['backend_products']],
            [['product_name'], 'string', 'max' => 70],
            [['description'], 'string', 'max' => 2000],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['backend_products'] = ['product_name', 'description', 'weight', 'sell_price', 'stock', 'status'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_name' => Yii::t('app', 'Product Name'),
            'description' => Yii::t('app', 'Description'),
            'weight' => Yii::t('app', 'Weight (Grams)'),
            'sell_price' => Yii::t('app', 'Sell Price'),
            'stock' => Yii::t('app', 'Stock'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id']);
    }
}
