<?php
namespace App;

class RespondAction extends AbstractAction {

    public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute): bool {

        if ($idCurrentUser === $idExecute) {
            return true;
        }

        return false;
    }

    public function getNameAction(): string {
        return 'Откликнуться';
    }

    public function getInnerNameAction(): string {
        return 'action_respond';
    }
}
