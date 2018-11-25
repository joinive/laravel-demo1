<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/25
 * Time: 18:59
 */


for($i=0;$i<3;$i++) {
    for($j=0;$j<5;$j++) {
        while(true) {
            $a = mt_rand(10, 99);
            $b = mt_rand(10, 99);
            $c = $a + $b ;
            $g1 = $a % 10 ;
            $g2 = $b % 10;
            if ($g1 == $g2) {
                continue;
            }
            $s1 = floor($a/10);
            $s2 = floor($a/10);
//            if ($s1 == $s2) {
//                continue;
//            }
            if ($g1 + $g2 > 10) {
                continue;
            }
            if ($c > 100) {
                continue;
            }
            if ($c % 5 == 0 ) {
                continue;
            }
            echo "$a + $b \t";
            break;
        }
    }
    echo "\n";
}

$arr = [];
$gArr = [];
$sArr = [];

for($n=0;$n<8; $n++) {
    while (true) {
        $a = mt_rand(10, 99);
        $g = $a % 10;
        $s = floor($a/10);
//        if (in_array($g, $gArr)) {
//            continue;
//        }
//        $gArr[] = $g;
//        if (in_array($s, $sArr)) {
//            continue;
//        }
        $sArr[] = $s;
        if (in_array($a, $arr)) {
            continue;
        }
        $arr[] = $a;
        break;
    }

}
foreach ($arr as $b) {
    echo "$b\t";
}