<?php

namespace App\Traits;

use Excel;

trait FileHelper
{
    /** FILE HELPER */
    public function downloadFile($data, $title = '', $type = 'csv')
    {
        return Excel::create('Filename', function ($excel) use ($data, $title) {

            $excel->sheet('Sheetname', function ($sheet) use ($data, $title) {

                // Sheet manipulation
                $sheet->fromArray($data);

                // Auto filter for entire sheet
                // $sheet->setAutoFilter();
                // Loading a view for a single sheet
                // $header = array_keys($data->toArray()[0]);
                // $sheet->loadView('reports.report', array('data' => $data, 'header' => $header, 'title' => $title));

            });

        })->export($type);
    }
}