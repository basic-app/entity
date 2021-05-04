<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

trait EntityTrait
{

    protected $allowedFields = null;

    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false) : array
    {
        $return = parent::toArray($onlyChanged, $cast, $recursive);

        if ($this->allowedFields !== null)
        {
            foreach($return as $key => $value)
            {
                if (array_search($key, $this->allowedFields) === false)
                {
                    unset($return[$key]);
                }
            }
        }

        return $return;
    }

    public function fill(array $data = null, bool $allowedOnly = false)
    {
        if ($allowedOnly && ($this->allowedFields !== null))
        {
            if ($data)
            {
                foreach($data as $key => $value)
                {
                    if (array_search($key, $this->allowedFields) === false)
                    {
                        unset($data[$key]);
                    }
                }
            }
        }

        return parent::fill($data, false);
    }

}