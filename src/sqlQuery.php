<?php
namespace App;

use App\Exceptions\SourceFileException;
use SplFileObject;
use mysqli;

class SqlQuery {
    const PATH_FILE = "..\data\\";
    private $fileSql;
    private $fileObject;
    private $result = [];

    public function export(string $filesql) {

        $this->fileSql = self::PATH_FILE . $filesql;

        $mysqli = new mysqli("localhost", "root", "root", "taskforce");

        if (!file_exists($this->fileSql)) {
            throw new SourceFileException("Файл не существует");
        }

        try {
            $this->fileObject = new SplFileObject($this->fileSql);
        }
        catch (RuntimeException $exception) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $resource = @fopen($this->fileSql, "r");

        while (($buffer = fgets($resource, 4096)) !== false) {
            $mysqli->query($buffer);
        }
    }

    private function getNextLine():?iterable {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgets();
        }

        return $result;
    }


}
