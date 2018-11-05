<?php

namespace App\Tools;


use Carbon\Carbon;

class DatePostpone
{
    const MIN_1 = 1;
    const MIN_10 = 2;
    const MIN_30 = 3;
    const HOUR_1 = 4;
    const HOUR_3 = 5;
    const HOUR_6 = 6;
    const HOUR_12 = 7;
    const DAY_1 = 8;
    const DAY_7 = 9;
    const MONTH_1 = 10;

    const delay = [
        '1' => [
            'title' => '1 minute',
            'unit' => 'minutes',
            'value' => 1
        ],
        '2' => [
            'title' => '10 minutes',
            'unit' => 'minutes',
            'value' => 10
        ],
        '3' => [
            'title' => '30 minutes',
            'unit' => 'minutes',
            'value' => 30
        ],
        '4' => [
            'title' => '1 hour',
            'unit' => 'hours',
            'value' => 1
        ],
        '5' => [
            'title' => '5 hours',
            'unit' => 'hours',
            'value' => 5
        ],
        '6' => [
            'title' => '12 hours',
            'unit' => 'hours',
            'value' => 12
        ],
        '7' => [
            'title' => '1 day',
            'unit' => 'days',
            'value' => 1
        ],
        '8' => [
            'title' => '7 days',
            'unit' => 'days',
            'value' => 7
        ],
        '9' => [
            'title' => '1 month',
            'unit' => 'months',
            'value' => 1
        ],
    ];

    public static function getDateWithDelay(int $delay)
    {
        if ($delay > count(self::delay)) {
            return null;
        }

        $delayEntity = self::delay[$delay];
        $now = Carbon::now();

        switch ($delayEntity['unit']) {
            case 'minutes':
                return $now->addMinutes($delayEntity['value']);
            case 'hours':
                return $now->addHours($delayEntity['value']);
            case 'days':
                return $now->addDays($delayEntity['value']);
            case 'months':
                return $now->addMonths($delayEntity['value']);
        }
    }

    public static function getDelayNames()
    {
        foreach (self::delay as $key => $item) {
            $result[$key] = $item['title'];
        }

        return $result;
    }
}