<?php
    $this->Csv->addRow($th);
    foreach($orderedData as $t) {
        $this->Csv->addField($t[$modelName]);
        $this->Csv->endRow();
    }
    $this->Csv->setFilename($filename);

    echo $this->Csv->render(true, 'UTF-16LE', 'utf-8');
?>