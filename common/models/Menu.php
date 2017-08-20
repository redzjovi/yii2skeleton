<?php

namespace common\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 */
class Menu extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE_MENU = 'create_menu';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE_MENU] = ['name'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['name', 'parent_id', 'lft', 'rgt', 'depth'], 'required'],
            // [['parent_id', 'lft', 'rgt', 'depth'], 'integer'],
            // [['name'], 'string', 'max' => 255],

            [['name'], 'required', 'on' => self::SCENARIO_CREATE_MENU],
            [['name'], 'string', 'max' => 255, 'on' => self::SCENARIO_CREATE_MENU],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
        ];
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                // 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
