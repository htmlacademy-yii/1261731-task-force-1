<?php
namespace App;

class CompleteAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute): bool {

        if ($idCurrentUser === $idCustomer) {
            return true;
        }

        return false;
    }

    public function getNameAction(): string {
        return 'Выполненно';
    }

    public function getInnerNameAction(): string {
        return 'action_complete';
    }
}
