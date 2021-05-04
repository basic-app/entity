<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

abstract class BaseEntity extends \CodeIgniter\Entity
{

    use EntityTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);

        $this->init();
    }

    protected function init()
    {
    }

}