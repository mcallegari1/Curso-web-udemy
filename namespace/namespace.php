<?php

require '../namespace/lib1/Cliente.php';
require '../namespace/lib2/Cliente.php';

use Lib1\Cliente as C1;
use Lib2\Cliente as C2;

$c1 = new C1();
print_r($c1);

echo '<hr>';

$c2 = new C2();
print_r($c2);
