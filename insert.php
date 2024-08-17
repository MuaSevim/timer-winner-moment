<?php

// Including files
include './includes/init.php';
$connection = include './includes/db.php';

// Initializing dates array and inserting them to Winner Table
$timer = new Timer(DATE_START, DATE_END);
$dates = $timer->generateMultipleDates(100);


sort($dates);
Winner::initDates($connection, $dates);
