<?php
App::uses('Component', 'Controller');
App::uses('Model', 'Model');

class CsvComponent extends Component {

    /**
    * Get CSV output field names
    * @param $modelName String model name
    * e.g. 'Shop'
    * @return Array List of field names
    */
    public function getCsvOutputFields($modelName) {
        switch ($modelName) {
            case "Keyword":
                $csv_columns= [
                    [
                        'name'         => 'word',
                        'display_name' => __('Keyword'),
                        'model_name'   => 'Keyword',
                    ],
                    [
                        'name'         => 'point',
                        'display_name' => __('Point'),
                        'model_name'   => 'Keyword',
                    ]
                ];
                break;
        }

        return $csv_columns;
    }

    /**
     * get csv download header and data
     * @param $modelName String model name
     * e.g. 'Shop'
     * @param $data POST params of the form
     * @return Array list of csv download(header&data)
     */
    public function getDownloadCsvData($modelName, $conditions = []){
        $csvFields = $this->getCsvOutputFields($modelName);
        $default_fields = [];

        foreach($csvFields as $field){
            $default[] = [
                  'name'       => $field['name'],
                  'model_name' => $field['model_name']
            ];
            $default_fields[] = $field['model_name'] .'.'. $field['name'];
            $default_fields_display[] = ($field['display_name']);
        }

        switch ($modelName) {
            case "Keyword":
                $searchFunction = 'getKeywords';
                break;
        }

        $td = $this->$searchFunction($default_fields, true, $conditions);
        $th = $default_fields_display;
        $columnName = $default;
        $orderedData = [];

        foreach($td as $item){
            $row = [];
            foreach($columnName as $column){
                $row[$modelName][] = $item[$column['model_name']][$column['name']];
            }
            $orderedData[] = $row;
        }

        $csv = [];
        $csv['header'] = $th;
        $csv['data'] = $orderedData;
        return $csv;
    }

    /**
    * read file to utf-8
    * @return Returns a file pointer resource on success, or FALSE on error
    */
    public function utf8_fopen_read($fileName) {
        // store csv in variable
        $text = file_get_contents($fileName);
        // detect if not valid multibyte if not valid convert
        if (!mb_detect_encoding($text,
            mb_detect_order(), true)) {
            $fc = iconv('UTF-16LE', 'utf-8', $text);
        } else {
            // Force Auto detect line
            ini_set('auto_detect_line_endings', true);
            // iconv parameters
            // first param auto detect what encoding used.
            // second param make UTF-8
            $fc = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        }

        $handle=fopen("php://memory", "rw");
        fwrite($handle, $fc);
        fseek($handle, 0);
        return $handle;
    }

    public function getKeywords() {
        $this->Keyword = ClassRegistry::init('Keyword');
        $keywords = $this->Keyword->find('all', [
            'order' => ['word' => 'ASC']
        ]);

        return $keywords;
    }

    /**
     * responsible for csv output
     * @param $modelName String name of model
     * @param $settings Array used for query
     * @param $csv Bool
     * @return array
     * @author Jomari
     */
    public function returnResult($modelName, $settings, $csv = false) {
        if ($csv) {
            return $modelName->find('all', $settings);
        }
    }
}