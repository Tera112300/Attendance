<?php
namespace Attendance\Controller\Component;

use Cake\Controller\Component;
use Cake\Chronos\Chronos;
class CalendarComponent extends Component
{
    public function getDaysOfMonth(int $addYear = 0, int $addMonth = 0) {
        $daysOfMonth = [];
        $time = Chronos::now()->startOfMonth();
        if ($addYear !== 0) {
            $time = $time->addYear($addYear);
        }
        if ($addMonth !== 0) {
            $time = $time->addMonths($addMonth);
        }
        $start = $time->startOfMonth()->day;
        $end = $time->endOfMonth()->day;
    
        for($i = $start; $start <= $end; $start++) {
            $daysOfMonth[] = $time;
            $time = $time->addDay();
        }
        return $daysOfMonth;
    }
}
