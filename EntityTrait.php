<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

trait EntityTrait
{

    protected $unsafeAttributes = [];

    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false) : array
    {
        $return = parent::toArray($onlyChanged, $cast, $recursive);

        if ($this->unsafeAttributes)
        {
            foreach($return as $key => $value)
            {
                if (array_search($key, $this->unsafeAttributes) !== false)
                {
                    unset($return[$key]);
                }
            }
        }

        return $return;
    }

}