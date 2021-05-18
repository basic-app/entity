<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

abstract class BaseEntity extends \CodeIgniter\Entity\Entity
{

    use EntityTrait;

    protected $dates = [];
    
}