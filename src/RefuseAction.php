<?php
require_once "vendor/autoload.php";

class CompleteAction extends AbstractAction {

public function __construct() {
    $this->alterNameAction = self::ACTION_REFUSE;
}

public function validateAcccessUser() {
    $this->result = false;

    if ($this->idCurrentUser === $this->idCustomer) {
        $this->result = true;
    }

    return $this->result;
}

public function getNameAction() {
    return self::GET_MAP_ACTIONS[$this->alterNameAction];
}

public function getAlterNameAction() {
    return $this->alterNameAction;
}
}
