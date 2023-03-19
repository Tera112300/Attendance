<?php
namespace Attendance\View\Helper;

use Cake\View\Helper;


class CalendarHelper extends Helper
{
    public function getDaySearch($key,$data,$column_name) {
        // $res = array_search($key,array_column($data,$column_name));
        $res = array_search($key,array_column($this->calendar_format($data,$column_name),$column_name));
        return $res;
    }

    private function calendar_format($data,$column_name) {
       $array = [];
       foreach($data as $index => $a){
        if(!isset($a[$column_name])) continue;

        $dateTime = new \DateTime($a[$column_name]);
        $array[$index][$column_name] = $dateTime->format('Y-m-d');
       }

       return $array;
    }
}