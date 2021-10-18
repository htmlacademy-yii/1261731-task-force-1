<?php
namespace App;

use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;
use App\SqlGenerator;

use SplFileObject;

class SqlTasksGenerator extends SqlGenerator {

    public function written():void {

        $this->fileObject = new SplFileObject($this->filename, "a");

        foreach ($this->data as $items) {
            $item_o = implode(',', $items);
            $item_o = (string) $item_o;
            $user_id = rand(1, 17);
            $city_id = rand(1, 69);
            $current_executor_id = rand(1, 17);

            $sql = "INSERT INTO $this->tablename ( $this->columns ) VALUES ( $item_o, $user_id, $city_id, $current_executor_id, now())" . "\n";

            $written = $this->fileObject->fwrite($sql);

        }

    }
}
