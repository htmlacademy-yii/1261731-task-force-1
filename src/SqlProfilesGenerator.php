<?php
namespace App;

use App\Exceptions\SourceFileException;
use App\Exceptions\FileFormatException;
use App\SqlGenerator;

use SplFileObject;

class SqlProfilesGenerator extends SqlGenerator {

    public function written():void {

        $this->fileObject = new SplFileObject($this->filename, "a");

        foreach ($this->data as $items) {
            $item_o = implode(',', $items);
            $item_o = (string) $item_o;
            $user_id = rand(1, 17);
            $city_id = rand(1, 69);
            $is_notefecation_enabled = rand(0, 1);
            $show_contacts = rand(0, 1);
            $show_profile = rand(0, 1);

            $sql = "INSERT INTO $this->tablename ( $this->columns ) VALUES ( $item_o, $user_id, $is_notefecation_enabled, $show_contacts, $show_profile, $city_id, now())" . "\n";

            $written = $this->fileObject->fwrite($sql);

        }

    }

}

