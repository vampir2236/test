<?php

namespace controllers;

class Client extends \core\Controller
{
    private $db;
    private $model;

    public function __construct()
    {
        $this->db = \core\Database::getInstance();
        $this->model = new \models\Client($this->db);
    }


    public function getIndex()
    {
        $clients = $this->model->all();

        if (isset($clients['name'])) $clients['name'] = $this->sanitizeString($clients['name']);
        if (isset($clients['gender'])) $clients['gender'] = $this->sanitizeString($clients['gender']);
        if (isset($clients['birthday'])) {
            $clients['birthday'] = date('d.m.Y', strtotime($this->sanitizeString($clients['birthday'])));
        }
        if (isset($clients['phone'])) $clients['phone'] = $this->sanitizeString($clients['phone']);

        $content = $this->render('clients.tpl', array('clients' => $clients));
        echo $this->render('base.tpl', array('content' => $content));
    }


    public function getCreate()
    {
        $content = $this->render('client.edit.tpl');
        echo $this->render('base.tpl', array('content' => $content));
    }


    public function postCreate()
    {
        $values = $this->getValues(
            array('name', 'gender', 'birthday', 'phone'),
            $_POST
        );

        if ($this->model->validate($values, $validationError)) {
            $values['birthday'] = date('Y-m-d', strtotime($values['birthday']));
            $this->model->create($values);
            \core\Redirect::locate('clients');
        } else {
            $values['validationError'] = $validationError;
            $content = $this->render('client.edit.tpl', $values);
            echo $this->render('base.tpl', array('content' => $content));
        }
    }


    public function getEdit($id)
    {
        $client = $this->model->findById($id);

        $values = $this->getValues(
            array('client_id', 'name', 'gender', 'birthday', 'phone'), $client
        );

        if (isset($values['birthday'])) {
            $values['birthday'] = date('d.m.Y', strtotime($values['birthday']));
        }

        $content = $this->render('client.edit.tpl', $values);
        echo $this->render('base.tpl', array('content' => $content));
    }


    public function postEdit($id)
    {
        $values = $this->getValues(
            array('name', 'gender', 'birthday', 'phone'), $_POST
        );

        $values['client_id'] = $id;

        if ($this->model->validate($values, $validationError)) {
            $values['birthday'] = date('Y-m-d', strtotime($values['birthday']));
            $this->model->update($id, $values);
            \core\Redirect::locate('clients');
        } else {
            $values['validationError'] = $validationError;
            $content = $this->render('client.edit.tpl', $values);
            echo $this->render('base.tpl', array('content' => $content));
        }
    }


    public function getDelete($id)
    {
        $model = new \models\Client($this->db);
        $model->delete($id);
        \core\Redirect::locate('clients');
    }
}
