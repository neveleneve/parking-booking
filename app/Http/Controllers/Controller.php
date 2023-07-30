<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function konversiTanggal($dateString)
    {
        $indonesianMonths = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        $date = date_create_from_format('Y-m-d H:i:s', $dateString);
        $day = date_format($date, 'd');
        $monthNumber = date_format($date, 'n');
        $month = $indonesianMonths[$monthNumber];
        $year = date_format($date, 'Y');

        $indonesianDate = $day . ' ' . $month . ' ' . $year;

        return $indonesianDate;
    }

    public static function konversiTanggalWaktu($dateString)
    {
        $indonesianMonths = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        $date = date_create_from_format('Y-m-d H:i:s', $dateString);
        $day = date_format($date, 'd');
        $monthNumber = date_format($date, 'n');
        $month = $indonesianMonths[$monthNumber];
        $year = date_format($date, 'Y');
        $waktu = date_format($date, 'H:i');

        $indonesianDate = $day . ' ' . $month . ' ' . $year . ' ' . $waktu;

        return $indonesianDate;
    }
}
