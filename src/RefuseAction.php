<?php
namespace App;

class RefuseAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        if ($idCurrentUser === $idExecute) {
            return true;
        }

        return false;
    }

    public function getNameAction() {
        return 'Отказаться';
    }

    public function getInnerNameAction() {
        return 'action_refuse';
    }
}
