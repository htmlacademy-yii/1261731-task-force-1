<?php
namespace App;

use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

use SplFileObject;

class SqlGenerator {
    const PATH_FILE = "..\data\\";

    private $filename;
    private $SvcData;

    public function __construct(string $filename, $SvcData) {
        $this->filename = self::PATH_FILE . $filename;
        $this->SvcData = $SvcData;
    }

    public function written():void {

        $this->fileObject = new SplFileObject($this->filename, "w");
        $written = $this->fileObject->fwrite($this->SvcData);

    }
}
