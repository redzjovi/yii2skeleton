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

    public static function buildTree($data = [], $parent = 0)
    {
        $tree = array();

        foreach ($data as $d) {
            if ($d['parent'] == $parent)  {
                $children = self::buildTree($data, $d['id']);
                if (! empty($children))  {
                    $d['child'] = $children;
                }
                $tree[] = $d;
            }
        }

        return $tree;
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

    public static function printTree($tree, $prefixType = '-', $r = 0, $p = null, $data = [])
    {
        foreach ($tree as $i => $t) {
            $prefix = ($t['parent'] == 0) ? '' : str_repeat($prefixType, $r).' ';
            $data[$t['id']] = $t;
            $data[$t['id']]['name_tree'] = $prefix.$t['name'];
            if ($t['parent'] == $p) {
                // reset $r
                $r = 0;
            }
            if (isset($t['child'])) {
                $data = self::printTree($t['child'], $prefixType, ++$r, $t['parent'], $data);
            }
        }

        return $data;
    }
}
