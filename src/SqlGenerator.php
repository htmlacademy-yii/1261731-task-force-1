<?php
namespace App;

use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

use SplFileObject;

class SqlGenerator {
    const PATH_FILE = "..\data\\";

    private $filename;
    private $data;

    public function __construct(string $filename, ScvImporter $SvcData) {
        $this->filename = self::PATH_FILE . $filename;
        $SvcData->import();
        $this->$data = $SvcData->getData();
    }

    public function written():void {

        $this->fileObject = new SplFileObject($this->filename, "a");

        foreach ($this->$data as $items) {
            foreach ($items as $item) {
                $item = $item . "\n";
                $written = $this->fileObject->fwrite($item);
            }
        }

    }
}
