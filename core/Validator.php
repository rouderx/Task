<?php

/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 24.02.2017
 * Time: 12:26
 */
namespace App\Core;

/**
 * Class Validator slúžiaca na validáciu zadaných parametrov podľa zadaných pravidiel
 * @package App\Core
 */
class Validator
{
    /**
     * @param $data Pole údajov na validáciu
     * @param $formRules Pole pravidiel
     * @return bool
     * Funkcia, ktorá zkontroluje či sú údaje valídne
     */
    public static function required($data,$formRules)
    {
        $translation = [
            'name' => 'meno',
            'surname' => 'priezvisko',
            'pass' => 'heslo',
            'age' => 'vek',
            'city' => 'mesto',
            'security' => 'bezp. heslo'
        ];

        $_SESSION['errors'] = "";

        foreach ($formRules as $key => $formRule)
        {
            $attrRules = explode('|',$formRule);
            $error = "";

            foreach ($attrRules as $attrRule)
            {
                $attr = explode(':',$attrRule);

                switch ($attr[0])
                {
                    case 'required':
                            if(empty($data[$key]))
                            {
                                $error .= ucfirst($translation[$key])." musí byť vyplnené. ";
                            }
                        break;

                    case 'min':
                            if(strlen($data[$key]) < $attr[1])
                            {
                                $error .= ucfirst($translation[$key])." musí mať min dĺžku {$attr[1]}. ";
                            }
                        break;

                    case 'max':
                            if(strlen($data[$key]) > $attr[1])
                            {
                                $error .= ucfirst($translation[$key])." musí mať max dĺžku {$attr[1]}. ";
                            }
                        break;

                    case 'numeric':
                        if(!is_numeric($data[$key]))
                        {
                            $error .= ucfirst($translation[$key])." musí byť číslo. ";
                        }
                        break;

                    case 'secure':
                        if (!password_verify($data[$key],'$2y$10$DiQQyM6qD04Ct0oz6zDDYOtoKmHPoUvpqUDi5/qzcfvSeKNlZI.Lu'))//heslo: stol
                        {
                            $error .= "Zlé bezpečnostné heslo. ";
                        }
                        break;
                }
            }
            if(!empty($error)){
                $_SESSION['errors'][$key] = $error;
            }
        }

        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            return true;
        }
        else
        {
            return false;
        }
    }
}

