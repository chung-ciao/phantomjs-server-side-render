<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use Excel;
class ExportService
{
    protected $config;
    protected $data;
    public function __construct($config, $data) {
        $this->config = $config;
        $this->data = $data;
    }

    public function export () {
        Excel::create($this->config['file_name'], function ($excel) {
            $excel->setTitle('Ciao');
            $excel->sheet($this->config['sheet_name'], function ($sheet) {
                $sheet->setFontFamily('Microsoft JhengHei');

                // 印標題
                $sheet->row(1, $this->createHeader());

                // 印資料
                foreach ($this->data as $index => $data) {
                    $sheet->row($index+2, $this->createRowData($data, $index));
                }
            });
        })->download($this->config['format'], [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    protected function createHeader() {
        $header = [];
        foreach ($this->config['colum'] as $colum_name => $colum) {
            array_push($header, $colum['label']);
        }
        return $header;
    }

    /**
     * @param $data {object} - filter出來的所有資料
     * @param $index {number} - 資料索引
     * @return array - Excel印出該行的資料
     */
    protected function createRowData($data, $index) {
        $output = [];
        foreach ($this->config['colum'] as $colum_name => $colum) {
            $output_type = $colum['type'];

            switch ($output_type) {
                case 'boolean':
                    $output_text = $data[$colum_name];
                    if($output_text == true) $output_text = $colum['true_label'];
                    if($output_text == false) $output_text = $colum['false_label'];
                    break;
                case 'relation':
                    $relationArray = $data[$colum_name];
                    $output_text = '';
                    foreach($relationArray as $index => $relation) {
                        if($index > 0) $output_text .= ", ";
                        $output_text .= $relation[$colum['output']];
                    }
                    break;
                default:
                    $output_text = $data[$colum_name];
                    break;
            }
            array_push($output, $output_text);
        }
        return $output;
    }
}