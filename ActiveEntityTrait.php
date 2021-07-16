<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Entity;

use Webmozart\Assert\Assert;

trait ActiveEntityTrait
{

    /**
     * @var string|null The model that holding this resource's data
     */
    protected $modelName;

    /**
     * @var object|null The model that holding this resource's data
     */
    protected $model;

    /**
     * Allows filling in Entity parameters during construction.
     *
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        Assert::notEmpty($this->modelName, lang('Property "{0}" not defined in "{1}" class.', ['modelName', get_class($this)]));

        $this->model = model($this->modelName, false);

        Assert::notEmpty($this->model, lang('Model not found: {0}', [$this->modelName]));

        parent::__construct($data);
    }

    public function beforeSave(&$error = null) : bool
    {
        return true;
    }

    public function afterSave()
    {
    }

    public function save(&$error = null) : bool
    {
        if (!$this->beforeSave($error))
        {
            return false;
        }

        $return = $this->model->save($this, $error);
    
        if (!$return)
        {
            return false;
        }

        $this->afterSave();

        return true;
    }

    public function saveOrFail($error = null)
    {
        $return = $this->save($errors);

        Assert::true($return, $errors ? implode(', ', $errors) : lang('{0} not saved.', [get_class($this)]));
    }

    public function delete($error = null)
    {
        $id = $this->getIdValue();

        Assert::notEmpty($id, lang('Primary key not found.'));

        $return = $this->model->delete($id);
    
        Assert::true($return, $error ?? lang('Entity not deleted.'));

        return $return;
    }

    public function getIdValue(bool $checkInsertID = false)
    {
        $return = $this->model->getIdValue($this);
    
        if (!$return && $checkInsertID)
        {
            return $this->getInsertId();
        }

        return $return;
    }

    public function getInsertID()
    {
        return $this->model->getInsertID();
    }

    public function errors() : array
    {
        return (array) $this->model->errors();
    }
    
    public function validate(): bool
    {
        return $this->model->validate($this->toArray());
    }

}