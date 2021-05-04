<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

trait EntityTrait
{

    protected $allowedAttributes = null;

    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false) : array
    {
        $return = parent::toArray($onlyChanged, $cast, $recursive);

        if ($this->allowedAttributes !== null)
        {
            foreach($return as $key => $value)
            {
                if (array_search($key, $this->allowedAttributes) === false)
                {
                    unset($return[$key]);
                }
            }
        }

        return $return;
    }

    public function fill(array $data = null, bool $allowedOnly = false)
    {
        if ($allowedOnly && ($this->allowedAttributes !== null))
        {
            if ($data)
            {
                foreach($data as $key => $value)
                {
                    if (array_search($key, $this->allowedAttributes) === false)
                    {
                        unset($data[$key]);
                    }
                }
            }
        }

        return parent::fill($data, false);
    }

}