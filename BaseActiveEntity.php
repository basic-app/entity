<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

abstract class BaseActiveEntity extends Entity implements ActiveEntityInterface
{

    use ActiveEntityTrait;

}