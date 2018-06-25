<?php
/**
 * @author 马雄飞 <xiongfei.ma@pactera.com>
 * @date   2017/12/25 下午9:29
 */

function list_to_tree_key($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = [];
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = [];
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[$data['id']] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    /*$parent[$child][$data['id']] = &$list[$key];*/
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }

    return $tree;
}

function BA(array $array = [])
{
    $array['type'] = isset($array['type']) ? $array['type'] : 'a';
    $array['data'] = isset($array['data']) && !empty($array['data']) ?$array['data']: '';
    $slug = $array['slug'];
    $route = $array['route'];
    $user = Auth::user();
    if (!$user->can($slug) && !in_array($slug,['admin.userInfo.edit'])) {
        return '';
    }

    $jsonData = htmlentities(json_encode($array), ENT_QUOTES, 'UTF-8');
//    print_r($array);
    if ($array['type'] == 'a') {
        return "<a href='" . route($route, $array['params']) . "' js_mark_class='" . $array['mark'] . "' class='" . $array['class'] . "' data-json='" . $jsonData . "'>{$array['title']}</a>";
    } elseif ($array['type'] == 'button') {
        return "<button type='button' data-href='" . route($route, $array['params']) . "' js_mark_class='" . $array['mark'] . "' class='" . $array['class'] . "' data-json='" . $jsonData . "'>{$array['title']}</a>";
    }

}

function debug($data, $type = 0, $break = 1)
{
    echo '<pre>';
    !empty($type) ? var_dump($data) : print_r($data);
    !empty($break) && exit();
}