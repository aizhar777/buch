<?php

namespace App\Library\Interfaces;


interface FieldsPluginInterface
{
    public function createField($name, $type, array $params);
    public function findById($id, $type);
    public function findByName($name, $type);
    public function findBySlug($slug, $type);
    public function findParamId($id, $type);
    public function all($type);
}