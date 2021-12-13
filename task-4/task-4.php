<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Test 3
    </title>
</head>
<body>
<?php

$arrays = [
    "1x1" => [
        "question" => [
            [1,],
        ],
        "answer"   => [[1]]
    ],
    "2x2" => [
        "question" => [
            [1, 2,],
            [3, 4,],
        ],
        "answer"   => [[3, 1], [4, 2]]
    ],
    "3x3" => [
        "question" => [
            [1, 2, 3,],
            [4, 5, 6,],
            [7, 8, 9,],
        ],
        "answer"   => [[7, 4, 1], [8, 5, 2], [9, 6, 3]]
    ],
    "4x4" => [
        "question" => [
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            [9, 10, 11, 12],
            [13, 14, 15, 16],
        ],
        "answer"   => [[13, 9, 5, 1], [14, 10, 6, 2], [15, 11, 7, 3], [16, 12, 8, 4]]
    ],
];

$arr2D_full = $arrays["3x3"]; // take an example
$arr2D_     = $arr2D_full["question"];
$arr2D      = $arr2D_;

echo "<pre>";
echo "Question &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:";
print_r(json_encode($arr2D));
echo "</pre>";

// @1nd Method
echo "@1st Method</br>";

$length = count($arr2D);

for ($i = 0; $i < $length; $i++) {
    for ($j = $i; $j < $length; $j++) {
        $temp          = $arr2D[$i][$j];
        $arr2D[$i][$j] = $arr2D[$j][$i];
        $arr2D[$j][$i] = $temp;
    }
}

for ($i = 0; $i < $length; $i++) {
    for ($j = 0; $j < floor($length / 2); $j++) {
        $temp                        = $arr2D[$i][$j];
        $arr2D[$i][$j]               = $arr2D[$i][$length - 1 - $j];
        $arr2D[$i][$length - 1 - $j] = $temp;
    }
}

echo "<pre>";
echo "My Result &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:";
print_r(json_encode($arr2D));
echo "</br>";
echo "Expected Result :";
print_r(json_encode($arr2D_full["answer"]));
echo "</pre>";

//-----------------------------------------------------------------------

// @2nd Method
echo "@2nd Method</br>";

$length = count($arr2D_);

foreach ($arr2D_ as $index => $arr) {
    $temp                         = $arr2D_[$length - 1 - $index];
    $arr2D_[$length - 1 - $index] = $arr;
    $arr2D_[$index]               = $temp;

    if ($index >= floor($length / 2) - 1) {
        break;
    }
}

for ($i = 0; $i < $length; $i++) {
    for ($j = 0; $j < $length; $j++) {
        for ($k = 0; $k < ($length - 1 - $i); $k++) {
            if ($i === $j && ($i + $k + 1 < $length && $j + $k + 1 < $length)) {
                $temp                    = $arr2D_[$i + $k + 1][$j];
                $temp2                   = $arr2D_[$i][$j + $k + 1];
                $arr2D_[$i + $k + 1][$j] = $temp2;
                $arr2D_[$i][$j + $k + 1] = $temp;
            }
        }
    }
}

echo "<pre>";
echo "My Result &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:";
print_r(json_encode($arr2D_));
echo "</br>";
echo "Expected Result :";
print_r(json_encode($arr2D_full["answer"]));
echo "</pre>";

?>
</body>
</html>
