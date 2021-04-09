<?php
class CompleteAction extends AbstractAction {

public function __construct() {
    $this->alterNameAction = self::ACTION_COMPLETE;
}

public function validateAcccessUser() {
    if ($this->idCurrentUser === $this->idCustomer) {
        $this->result = true;
    } else {
        $this->result = false;
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
