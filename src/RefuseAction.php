<?php
namespace App;

class RefuseAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute): bool {

        if ($idCurrentUser === $idExecute) {
            return true;
        }

        return false;
    }

    public function getNameAction(): string {
        return 'Отказаться';
    }

    public function getInnerNameAction(): string {
        return 'action_refuse';
    }
}
