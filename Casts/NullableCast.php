<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity\Casts;

class NullableCast extends \CodeIgniter\Entity\Cast\BaseCast
{

    public static function get($value, array $params = [])
    {
        if (!$value)
        {
            return null;
        }

        return $value;
    }

    public static function set($value, array $params = [])
    {
        if (!$value)
        {
            return null;
        }

        return $value;
    }

}