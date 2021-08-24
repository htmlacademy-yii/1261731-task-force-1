<?php
namespace App;

class CompleteAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        if ($idCurrentUser === $idCustomer) {
            return true;
        }

        return false;
    }

    public function getNameAction() {
        return 'Выполненно';
    }

    public function getInnerNameAction() {
        return 'action_complete';
    }
}
