<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wp_options".
 *
 * @property integer $id
 * @property string $option_name
 * @property string $option_value
 * @property string $autoload
 */
class WpOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wp_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_name', 'option_value'], 'required'],
            [['option_value', 'autoload'], 'string'],
            [['option_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'option_name' => Yii::t('app', 'Option Name'),
            'option_value' => Yii::t('app', 'Option Value'),
            'autoload' => Yii::t('app', 'Autoload'),
        ];
    }
}
