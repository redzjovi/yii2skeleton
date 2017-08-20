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
            [['weight', 'sell_price', 'stock'], 'integer'],
            [['product_name'], 'string', 'max' => 70],
            [['description'], 'string', 'max' => 2000],
        ];
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
            'weight' => Yii::t('app', 'Weight'),
            'sell_price' => Yii::t('app', 'Sell Price'),
            'stock' => Yii::t('app', 'Stock'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
