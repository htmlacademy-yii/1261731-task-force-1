<?php
namespace App;

use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

use SplFileObject;

class SqlGenerator {
    const PATH_FILE = "..\data\\";

    protected $filename;
    protected $data;
    protected $columns;
    protected $tablename;

    public function __construct(string $filename, ScvImporter $SvcData, array $columns) {
        $this->tablename = str_replace('.sql', '', $filename);
        $this->filename = self::PATH_FILE . $filename;
        //$SvcData->import();
        $this->data = $SvcData->getData();
        $this->columns = implode(',', $columns);
    }

    public function written():void {

        $this->fileObject = new SplFileObject($this->filename, "a");


        foreach ($this->data as $items) {
            $item_o = implode(',', $items);
            $item_o = (string) $item_o;

            $sql = "INSERT INTO $this->tablename ( $this->columns ) VALUES ( $item_o, now(), now())" . "\n";

                $written = $this->fileObject->fwrite($sql);

        }

    }
}
