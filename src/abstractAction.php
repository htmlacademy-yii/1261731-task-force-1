<?php
/*
ЗАДАНИЕ
Добавить главную способность классу Task — определение списка доступных действий
для текущего статуса задания и роли пользователя. Набор доступных действий
ограничивается не только текущим статусом, но еще и ролью пользователя.

Задание в статусе «В работе»:
1. может иметь действие «Отказаться», но сделать это может только пользователь,
   чей id совпадает с id исполнителя задания. -> приводит к статусу провалено.
2. может иметь действие "Выполнено", но сделать это может только пользователь, чей
   id совпадает с id заказчика задания. -> приводит к статусу выполнено.
Задание в статусе «Новое»:
1. может иметь действие "Отменить", но сделать это может только только пользователь, чей
   id совпадает с id заказчика задания. -> приводит к статусу отменено.
2. может иметь действие "Откликнуться", но сделать это может только только пользователь,
   чей id совпадает с id исполнитель задания. -> приводит к статусу в работе.

Порядок действий
1. Опишите абстрактный класс-действие AbstractAction.
   Класс AbstractAction - отвечает за одно действий. Например, «Отмена».
   Этот класс имеет три публичных метода для возврата названия действия,
   внутреннего имени действия и для проверки прав.
   Пример: CompleteAction: «Завершить» → «act_complete» → функция, сравнивающая id
   исполнителя с id юзера.

2. Реализуйте его наследников по общему количеству доступных действий.
   Каждый класс-действие наследуется от абстрактного базового класса AbstractAction,
   где все эти три метода определены абстрактными.

3. В классе Task перепишите метод получения действий для статуса: теперь он должен
   возвращать не строку-название действия, а объект класса действия.
   Начните с небольшого рефакторинга.
   В текущей реализации класса все доступные
   действия заданы строковыми константами этого класса. Эти константы мы заменим на
   объекты классов-действий.


Метод проверки прав.

Этот метод принимает
id исполнителя задания,
id заказчика задания
id текущего пользователя.
Метод возвращает true или false в зависимости от доступности выполнения этого действия.

К примеру, действие отмены доступно только если id пользователя и id заказчика совпадают.

Метод получения списка доступных действий класса Task.

Возвращает действия, доступные пользователю и по статусу задания.
Фильтрует(перебирает) действия на доступность текущему пользователю,
вызывая метод списка проверки прав и передавая в него все необходимые идентификаторы.

Примеры:

на новое задание могут откликнуться только пользователи с ролью исполнитель.
отменить задание можно только если оно новое, и только если это действие выполняет
его автор.

=====================================================================================
*/
abstract class AbstractAction {
    const ACTION_CENCEL = 'action_cencel';
    const ACTION_RESPOND = 'action_respond';
    const ACTION_REFUSE = 'action_refuse';
    const ACTION_COMPLETE = 'action_complete';

    const GET_MAP_ACTIONS = [
        self::ACTION_CENCEL => 'Отменить',
        self::ACTION_RESPOND => 'Откликнуться',
        self::ACTION_REFUSE => 'Отказаться',
        self::ACTION_COMPLETE => 'Выполненно'
  ];

    protected $idCurrentUser;
    protected $idCustomer;
    protected $idExecute;
    protected $currentStatusTask;
    protected $result;
    protected $alterNameAction;

    public function __construct(int $idCurrentUser, int $idCustomer, int $idExecute, string $currentStatusTask) {
        $this->idCurrentUser = $idCurrentUser;
        $this->idCustomer = $idCustomer;
        $this->idExecute = $idExecute;
        $this->currentStatusTask = $currentStatusTask;
    }

    abstract public function getNameAction();
    abstract public function getAlterNameAction();
    abstract public function validateAcccessUser();
}

class CencelAction extends AbstractAction {

    public function __construct() {
        $this->alterNameAction = self::ACTION_CENCEL;
    }

    public function validateAcccessUser() {
        if ($this->idCurrentUser === $this->idCustomer) {
            $this->result = true;
        } else {
            $this->result = false;
        }

        return $this->result;
    }

    public function getNameAction() {
        return self::GET_MAP_ACTIONS[$this->alterNameAction];
    }

    public function getAlterNameAction() {
        return $this->alterNameAction;
    }
}

class RespondAction extends AbstractAction {

    public function __construct() {
        $this->alterNameAction = self::ACTION_RESPOND;
    }

    public function validateAcccessUser() {
        if ($this->idCurrentUser === $this->idCustomer) {
            $this->result = true;
        } else {
            $this->result = false;
        }

        return $this->result;
    }

    public function getNameAction() {
        return self::GET_MAP_ACTIONS[$this->alterNameAction];
    }

    public function getAlterNameAction() {
        return $this->alterNameAction;
    }
}
