<?php

namespace models;

class Client extends \core\Model
{
    protected $table = 'clients';
    protected $keyField = 'client_id';

    public function validate($values, &$validationError)
    {
        if (!isset($values['name']) || trim($values['name']) === '') {
            $validationError = array('name', 'Введите имя');

        } else if (!isset($values['gender']) || trim($values['gender']) === '') {
            $validationError = array('gender', 'Выберите пол');

        } else if (!isset($values['birthday'])
            || !\DateTime::createFromFormat('d.m.Y', $values['birthday'])) {
            $validationError = array('birthday', 'Дата рождения введена неверно');

        } else if (!isset($values['phone']) || !preg_match('/^8 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/', trim($values['phone']))) {
            $validationError = array('phone', 'Телефон введен неверно');
        }

        return !$validationError;
    }
}