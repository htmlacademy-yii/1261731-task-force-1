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

    public function __construct(string $filesql) {

        $this->fileSql = self::PATH_FILE . $filesql;
    }

    public function export() {

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

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
            print_r($line);
            //$mysqli->query("INSERT INTO cities (name, lat, longe, created_at, updated_at) VALUES('Абакан', 53.7223661, 91.4437792, now(), now())");
            $mysqli->query($line);
        }
    }
/*
    public function getData():array {
        return $this->result;
    }
*/
    private function getNextLine():?iterable {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgets();
        }

        return $result;
    }


}
