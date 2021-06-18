<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

use BasicApp\Entity\Casts\NullableCast;

abstract class BaseEntity extends \CodeIgniter\Entity\Entity
{

    use EntityTrait;

    public function __construct(...$params)
    {
        parent::__construct(...$params);

        $this->castHandlers['nullable'] = NullableCast::class;
    }
    
}