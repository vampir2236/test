<?php

namespace core;

abstract class Controller
{

    public function render($templateFile, $values = array())
    {
        extract($values);

        ob_start();
        require TEMPLATES_DIR . $templateFile;
        return ob_get_clean();
    }


    public function sanitizeString($string) {
        $string = strip_tags(trim($string));
        return htmlspecialchars($string);
    }


    public function getValues($fields, $data)
    {
        $values = array();
        if (is_array($data)) {
            foreach ($fields as $field) {
                if (isset($data[$field])) {
                    $values[$field] = $this->sanitizeString($data[$field]);
                }
            }
        }
        return $values;
    }

}