<?php
require_once "vendor/autoload.php";

class CencelAction extends AbstractAction {

public function __construct(int $idCurrentUser, int $idCustomer, int $idExecute) {
    parent::__construct(int $idCurrentUser, int $idCustomer, int $idExecute);
    $this->alterNameAction = self::ACTION_CENCEL;
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
