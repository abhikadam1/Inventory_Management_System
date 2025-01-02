<?php
if (!function_exists('getMonth')) {
    function getMonth($date)
    {
        $months = array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        );
        // return strtotime($date);
        return $months[(date('n', strtotime($date)) - 1)];
        // return $months[date('n') - 1];
    }

}

if (!function_exists('pr')) {
    function pr($data, $exit = true, $pre = true)
    {

        if ($pre !== false) {
            echo "<pre>";
        }
        print_r($data);        
        if ($exit !== false) {
            exit;
        }
    }

}