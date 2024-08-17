<?php

require dirname(__DIR__) . '\includes\init.php';
$connection = dirname(__DIR__) . '\includes\db.php';

class Timer
{
    private $timeStampStart;

    private $timeStampEnd;

    private $dates = [];

    public function __construct($dateStart, $dateEnd)
    {
        $this->timeStampStart = strtotime($dateStart);
        $this->timeStampEnd = strtotime($dateEnd);
    }


    public function generateSingleDate()
    {

        $timeStampRandom = mt_rand($this->timeStampStart, $this->timeStampEnd);

        $hourStart = intval(date('H', $timeStampRandom));
        $hourEnd = intval(date('H', $timeStampRandom));

        if ($hourStart >= 8 && $hourEnd <= 22)
            return date('Y-m-d H:i:s', $timeStampRandom);

        return $this->generateSingleDate($this->timeStampStart, $this->timeStampEnd);
    }

    public function generateMultipleDates($dateTotal)
    {
        if ($dateTotal < 1)  return;

        for ($i = 0; $i < $dateTotal; $i++)
            $this->dates[] = $this->generateSingleDate();

        return $this->dates;
    }
}
