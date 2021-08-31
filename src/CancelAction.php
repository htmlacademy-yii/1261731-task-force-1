<?php
namespace App;

class CancelAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute): bool {

        if ($idCurrentUser === $idCustomer) {
            return true;
        }

        return false;
}

    public function getNameAction(): string {
        return "Отменить";
    }

    public function getInnerNameAction(): string {
        return "action_cancel";
    }
}
