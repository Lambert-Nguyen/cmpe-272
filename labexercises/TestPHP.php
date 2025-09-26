<?php
$str = "Hello";
$i = 0;
for ($i= strlen($str)-1; $i >= 0; $i--){
    echo($str[$i]);
}
echo("\n");
$index = 0;
$sum=0;
for ($index = 1; $index < 11; $index++){
    $sum=$sum+$index;
}
echo($sum);

?>