<?php

namespace common\components\helpers;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    public static function addKeyVisible($array, $permissions = [], $oldkey = 'auth_item_name', $newkey = 'visible')
    {
        if (is_array($array)) {
            foreach ((array) $array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::addKeyVisible($value, $permissions, $oldkey, $newkey);
                } else {
                    if (empty($array[$oldkey])) {
                        $array[$newkey] = true;
                    } else if ($permissions) {
                        $array[$newkey] = in_array($array[$oldkey], $permissions);
                    } else {
                        $array[$newkey] = false;
                    }
                }
            }
        }

        return $array;
    }

    public static function buildTree($elements = [], $parent = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent'] == $parent) {
                $children = self::buildTree($elements, $element['id']);
                if ($children)  {
                    $element['child'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public static function changeKeyName($array, $oldkey, $newkey)
    {
        if (is_array($array)) {
            foreach ((array) $array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::changeKeyName($value, $oldkey, $newkey);
                } else {
                    $array[$newkey] = $array[$oldkey];
                }
            }
        }

        unset($array[$oldkey]);
        return $array;
    }

    public static function copyKeyName($array, $oldkey, $newkey)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::copyKeyName($value, $oldkey, $newkey);
                } else {
                    $array[$newkey] = $array[$oldkey];
                }
            }
        }

        return $array;
    }

    public static function printTree($elements, $prefix = '-', $parent = 0, $branch = [])
    {
        foreach ($elements as $element) {
            $tree_prefix = ($element['parent'] == 0) ? '' : $prefix;
            $branch[$element['id']] = $element;
            $branch[$element['id']]['tree_name'] = $tree_prefix.$element['name'];
            $branch[$element['id']]['tree_prefix'] = $tree_prefix;
            if (isset($element['child'])) {
                $branch = self::printTree($element['child'], $tree_prefix.$prefix, $element['parent'], $branch);
            }
        }

        return $branch;
    }
}
