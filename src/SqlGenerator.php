<?php
namespace App;

use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;

use SplFileObject;

class SqlGenerator {
    const PATH_FILE = "..\data\\";

    private $filename;
    private $data;
    private $columns;
    private $tablename;

    public function __construct(string $filename, ScvImporter $SvcData, array $columns) {
        $this->tablename = str_replace('.sql', '', $filename);
        $this->filename = self::PATH_FILE . $filename;
        $SvcData->import();
        $this->data = $SvcData->getData();
        $this->columns = implode(',', $columns); print_r($this->columns);
    }

    public function written():void {

        $this->fileObject = new SplFileObject($this->filename, "a");

        foreach ($this->data as $items) {
            $item_o = implode(',', $items);
            $item_o = $item_o;

            $sql = "INSERT INTO $this->tablename ( $this->columns ) VALUES ( $item_o )" . "\n";

                $written = $this->fileObject->fwrite($sql);

        }

    }
}

/*
if ( ($handle_o = fopen($file_name, "r") ) !== FALSE ) {
    // читаем первую строку и разбираем названия полей
    $columns_o = fgetcsv($handle_o, 1000, ";");
    foreach( $columns_o as $v ) {
       $insertColumns[]="'".addslashes(trim($v))."'";
    }
    $columns=implode(',',$insertColumns);


    while ( ($data_o = fgetcsv($handle_o, 1000, ";")) !== FALSE) {
      $insertValues = array();
      foreach( $data_o as $v ) {
         $insertValues[]="'".addslashes(trim($v))."'";
      }
      $values=implode(',',$insertValues);
      $sql = "INSERT INTO `sdelka_temp` ( $columns ) VALUES ( $values )";
      mysql_query($sql) or die('SQL ERROR:'.mysql_error());
    }

}
fclose($handle_o);
*/
