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

    public function __construct(array $data = null)
    {
        $data = array_merge($this->defaultAttributes($data), $data ?? []);

        parent::__construct($data);
    }

    public function getAllowedAttributes()
    {
        return $this->allowedAttributes;
    }

    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false) : array
    {
        $return = parent::toArray($onlyChanged, $cast, $recursive);

        $allowedAttributes = $this->getAllowedAttributes();

        if ($allowedAttributes !== null)
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

    public function fill(array $data = null, bool $allowedOnly = false)
    {
        $allowedAttributes = $this->getAllowedAttributes();

        if ($allowedOnly && ($allowedAttributes !== null))
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

    public function defaultAttributes(array $data = null) : array
    {
        return [];
    }

    public function setAttributes(array $data)
    {
        return parent::setAttributes(array_merge($this->defaultAttributes($data), $data));
    }

}