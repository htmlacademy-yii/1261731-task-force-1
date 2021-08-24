<?php
namespace App;

class CancelAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        if ($idCurrentUser === $idCustomer) {
            return true;
        }

        return false;
}

    public function getNameAction() {
        return 'Отменить';
    }

    public function getInnerNameAction() {
        return 'action_cancel';
    }
}
