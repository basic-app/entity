<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

use CodeIgniter\Entity\Entity;

trait EntityTrait
{

    protected $safeAttributes;

    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false) : array
    {
        $return = parent::toArray($onlyChanged, $cast, $recursive);

        if ($this->safeAttributes !== null)
        {
            foreach($return as $key => $value)
            {
                if (array_search($key, $this->safeAttributes) === false)
                {
                    unset($return[$key]);
                }
            }
        }

        return $return;
    }

    public function fill(array $data = null)
    {
        if (($this->safeAttributes !== null) && $data)
        {
            foreach($data as $key => $value)
            {
                if (array_search($key, $this->safeAttributes) === false)
                {
                    unset($data[$key]);
                }
            }            
        }

        return parent::fill($data);
    }

    public function unsafeFill(array $data = null)
    {
        return parent::fill($data);
    }

    public function hasOne(string $modelName, $foreignKey, ?string $prefix = null, bool $keepPrefix = true) : ?Entity 
    {
        $model = model($modelName, false);

        if ($prefix)
        {
            $attributes = [];

            $notEmpty = false;

            foreach($this->attributes as $key => $value)
            {
                if (mb_substr($key, 0, mb_strlen($prefix)) == $prefix)
                {
                    if (!$keepPrefix)
                    {
                        $key = mb_substr($key, mb_strlen($prefix));
                    }

                    $attributes[$key] = $value;

                    if ($value)
                    {
                        $notEmpty = true;
                    }
                }
            }

            if ($notEmpty)
            {
                return $model->createEntity($attributes);
            }
        }

        if (is_array($foreignKey))
        {
            $where = [];

            foreach($foreignKey as $to => $from)
            {
                $where[$to] = $this->$from;
            }

            return $model->where($where)->first();
        }

        return $model->findOne($this->$foreignKey);
    }

    public function setAttribute(string $attribute, $value, bool $setOriginal = false)
    {
        $this->attributes[$attribute] = $value;

        if ($setOriginal)
        {
            $this->setOriginal($attribute, $value);
        }

        return $this;
    }

    public function setOriginal(string $attribute, $value)
    {
        $this->original[$attribute] = $value;
    
        return $this;
    }

}