<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

interface ActiveEntityInterface
{

    public function save(&$errors = null) : bool;

    public function saveOrFail($error = null);

    public function delete($error = null);

    public function getIdValue();

    public function getInsertID();

    public function errors() : array;

}