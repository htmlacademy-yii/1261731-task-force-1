<?php
namespace App;

class RespondAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        $this->idCurrentUser = $idCurrentUser;
        $this->idCustomer = $idCustomer;
        $this->idExecute = $idExecute;

        if ($this->idCurrentUser === $this->idExecute) {
            return true;
        }

        return false;
    }

    public function getNameAction() {
        return 'Откликнуться';
    }

    public function getAlterNameAction() {
        return 'action_respond';
    }
}
