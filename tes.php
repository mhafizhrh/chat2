<?php

$date1 = new DateTime("2019-11-01 16:12:12");
$now = new DateTime();

$difference_in_seconds = $date1->format('U') - $now->format('U');

echo $now->format('U');