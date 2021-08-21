<?php
namespace App;

class CompleteAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        $this->idCurrentUser = $idCurrentUser;
        $this->idCustomer = $idCustomer;
        $this->idExecute = $idExecute;

        if ($this->idCurrentUser === $this->idCustomer) {
            return true;
        }

        return false;
    }

    public function getNameAction() {
        return 'Выполненно';
    }

    public function getAlterNameAction() {
        return 'action_complete';
    }
}
