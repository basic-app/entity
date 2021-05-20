<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

trait EntityTrait
{

    protected $allowedAttributes = [];

    protected $nullableAttributes = [];

    public function getAllowedAttributes() : array
    {
        return $this->allowedAttributes;
    }

    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false) : array
    {
        $return = parent::toArray($onlyChanged, $cast, $recursive);

        $allowedAttributes = $this->getAllowedAttributes();

        if ($allowedAttributes)
        {
            foreach($return as $key => $value)
            {
                if (array_search($key, $allowedAttributes) === false)
                {
                    unset($return[$key]);
                }
            }
        }

        return $return;
    }

    public function fill(array $data = null)
    {
        $allowedAttributes = $this->getAllowedAttributes();

        if ($allowedAttributes)
        {
            if ($data)
            {
                foreach($data as $key => $value)
                {
                    if (array_search($key, $allowedAttributes) === false)
                    {
                        unset($data[$key]);
                    }
                }
            }
        }

        return parent::fill($data);
    }

    public function __set(string $key, $value = null)
    {
        if (!$value && (array_search($key, $this->nullableAttributes) !== false))
        {
            $value = null;
        }

        return parent::__set($key, $value);
    }

}