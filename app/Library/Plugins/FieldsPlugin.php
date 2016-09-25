<?php

namespace App\Library\Plugins;


use App\Library\Interfaces\FieldsPluginInterface;
use App\Field;
use App\FieldParam;


class FieldsPlugin  implements FieldsPluginInterface
{
    /**
     * @var Field $fields_model Eloquent model
     */
    protected $fields_model;

    /**
     * @var FieldParam $params_model Eloquent model
     */
    protected $params_model;

    /**
     * @param $name
     * @param $type
     * @param array $params
     * @return mixed
     */
    public function createField($name, $type, array $params)
    {
        // TODO: Implement createField() method.
    }

    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    public function findById($id, $type)
    {
        // TODO: Implement findById() method.
    }

    /**
     * @param $name
     * @param $type
     * @return mixed
     */
    public function findByName($name, $type)
    {
        // TODO: Implement findByName() method.
    }

    /**
     * @param $slug
     * @param $type
     * @return mixed
     */
    public function findBySlug($slug, $type)
    {
        // TODO: Implement findBySlug() method.
    }

    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    public function findParamId($id, $type)
    {
        // TODO: Implement findParamId() method.
    }

    /**
     * @param $type
     * @return mixed
     */
    public function all($type)
    {
        // TODO: Implement all() method.
    }

}