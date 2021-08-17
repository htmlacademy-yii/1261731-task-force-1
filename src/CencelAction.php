<?php
require_once "vendor/autoload.php";

class CencelAction extends AbstractAction {

    public function validateAcccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        $this->idCurrentUser = $idCurrentUser;
        $this->idCustomer = $idCustomer;
        $this->idExecute = $idExecute;

        if ($this->idCurrentUser === $this->idCustomer) {
            return true;
        }

        return false;
}

    public function getNameAction() {
        return 'Отменить';
    }

    public function getAlterNameAction() {
        return 'action_cencel';
    }
}
