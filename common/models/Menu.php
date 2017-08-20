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
    const SCENARIO_CREATE_MENU_ITEM = 'create_menu_item';

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
        $scenarios[self::SCENARIO_CREATE_MENU_ITEM] = ['name', 'parent_id'];
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

            [['name', 'parent_id'], 'required', 'on' => self::SCENARIO_CREATE_MENU_ITEM],
            [['parent_id'], 'integer', 'on' => self::SCENARIO_CREATE_MENU_ITEM],
            [['name'], 'string', 'max' => 255, 'on' => self::SCENARIO_CREATE_MENU_ITEM],
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
            'parent_name' => Yii::t('app', 'Parent Name'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
        ];
    }

    public function getAfterName()
    {
        $strip = str_repeat('---', $this->depth - 2);
        return $strip.' After '.$this->name;
    }

    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
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
