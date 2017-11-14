<?php
// ２次元連想配列用 array_columnを検討する
$arr = array(
    1 =>array(1,2),
    3 =>array(1),
    4 =>array(1),
);

$arr2 = array(
    1 =>array(1,3),
    3 =>array(21),
    5 =>array(1),
);
var_dump($arr);
var_dump($arr2);


var_dump(array_columns($arr,$arr2));
var_dump(array_columns1($arr,$arr2));
var_dump(array_columns2($arr,$arr2));
var_dump(array_columns3($arr,$arr2));
var_dump(array_columns4($arr,$arr2));
echo '-------------';


$arr = array(
    strval(1) =>array(1,2),
    strval(3) =>array(1),
);

$arr2 = array(
    strval(1) =>array(3),
    strval(3) =>array(21),
);
var_dump($arr);
var_dump($arr2);
var_dump($arr+$arr2);
var_dump(array_merge_recursive($arr,$arr2));
var_dump(array_merge($arr,$arr2));

echo '-------------';
$arr = array(
    '_1' =>array(1,2),
    '_3' =>array(1),
);

$arr2 = array(
    '_1' =>array(3),
    '_3' =>array(21),
);
var_dump($arr);
var_dump($arr2);
var_dump($arr+$arr2);
var_dump(array_merge_recursive($arr,$arr2));
var_dump(array_merge($arr,$arr2));
echo '-------------';

/*
----------------------------------------------------------------------------
* 以下関数定義エリア
*/


# 二次元連想配列のマージ関数
function array_columns($arr1,$arr2){
    foreach ($arr2 as $key => $val_arr) {
        if(array_key_exists($key,$arr1)){
            $r_arr1 = array_flip($arr1[$key]);
            $r_arr2 = array_flip($arr2[$key]);
            $r_merged = $r_arr1 + $r_arr2;
            $arr1[$key] = array_keys($r_merged);
        }else{
            $arr1[$key] = $val_arr;
        }
    }
    return $arr1;
}


# 二次元連想配列のマージ関数１
function array_columns1($arr1,$arr2){
    $arr = array();
    foreach ($arr2 as $key => $val_arr) {
        if(array_key_exists($key,$arr1)){
            $tmp_arr = $arr1[$key];
            foreach($val_arr as $val){
                if(!in_array($val ,$tmp_arr)){
                    $tmp_arr[] = $val;
                }
            }
            $arr[$key] = $tmp_arr;
        }else{
            $arr[$key] = $val_arr;
        }
    }
    return $arr;
}
# 二次元連想配列のマージ関数２
function array_columns2($arr1,$arr2){
    $arr = array();
    foreach ($arr2 as $key => $val_arr) {
        if(array_key_exists($key,$arr1)){
            $r_arr1 = array_flip($arr1[$key]);
            $r_arr2 = array_flip($arr2[$key]);
            $r_merged = $r_arr1 + $r_arr2;
            $arr[$key] = array_keys($r_merged);
        }else{
            $arr[$key] = $val_arr;
        }
    }
    return $arr;
}
# 二次元連想配列のマージ関数３
function array_columns3($arr1,$arr2){
    $arr = array();
    $keys = array_merge_recursive(array_keys($arr1),
array_keys($arr2));
    $r_keys = array_flip($keys);
    foreach ($r_keys as $key => $v) {
        $r_arr1 = null;
        $r_arr2 = null;
        $r_merged = null;
        if(array_key_exists($key,$arr1)){
            $r_arr1 = array_flip($arr1[$key]);
        }
        if(array_key_exists($key,$arr2)){
            $r_arr2 = array_flip($arr2[$key]);
        }
        if(is_array($r_arr1) && is_array($r_arr2)){
            $r_merged = $r_arr1 + $r_arr2;
        }elseif (is_array($r_arr1)) {
            $r_merged = $r_arr1;
        }elseif (is_array($r_arr2)) {
            $r_merged = $r_arr2;
        }
        $arr[$key] = array_keys($r_merged);
    }
    return $arr;
}


# 二次元連想配列のマージ関数４
function array_columns4($arr1,$arr2){
    $arr = array();
    foreach ($arr2 as $key => $val_arr) {
        if(array_key_exists($key,$arr1)){
            $r_arr1 = array_flip($arr1[$key]);
            $r_arr2 = array_flip($arr2[$key]);
            $r_merged = $r_arr1 + $r_arr2;
            $arr[$key] = array_keys($r_merged);
        }else{
            $arr[$key] = $val_arr;
        }
    }
    foreach ($arr1 as $key => $val_arr) {
        if(array_key_exists($key,$arr2)){
            $r_arr1 = array_flip($arr1[$key]);
            $r_arr2 = array_flip($arr2[$key]);
            $r_merged = $r_arr1 + $r_arr2;
            $arr[$key] = array_keys($r_merged);
        }else{
            $arr[$key] = $val_arr;
        }
    }
    return $arr;
}