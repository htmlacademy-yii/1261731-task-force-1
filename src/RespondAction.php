<?php
namespace App;

class RespondAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute) {

        if ($idCurrentUser === $idExecute) {
            return true;
        }

        return false;
    }

    public function getNameAction() {
        return 'Откликнуться';
    }

    public function getInnerNameAction() {
        return 'action_respond';
    }
}
