<?php

namespace App\Library;


use App\Field;
use App\FieldParam;
use App\Library\Interfaces\PluginInterface;

class BFields implements PluginInterface
{
    private static $_instance = null;

    private function __construct()
    {}

    private function __clone()
    {}

    public static function getInstance()
    {
        if(is_null(self::$_instance))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function createMapField(array $params)
    {
        //TODO: Validate $params

        return FieldParam::create([
            'name' => $params['name'],
            'slug' => $params['slug'],
            'default_value' => $params['default_value'],
            'description' => $params['description'],
            'accessory_type' => $params['accessory_type'],
            'is_many_values' => $params['is_many_values'],
        ]);
    }

    /**
     * All fields array
     *
     * @param $id
     * @param $type
     * @return array|null
     */
    public function all($id, $type)
    {
        $fieldMap = $this->getAllFieldMap($type);

        if($fieldMap->count() != 0){
            $fields = [];
            foreach ($fieldMap as $fParam){
                $field = $fParam->fields()->where('accessory_id', $id)->first();
                if($field != null) {
                    $fields[$field->slug] = $field->value;
                }else{
                    $defaultValue = null;
                    if($fParam->is_many_values){
                        $defaultValue = explode("|", $fParam->default_value);
                    }else{
                        $defaultValue = $fParam->default_value;
                    }
                    $fields[$fParam->slug] = $defaultValue;
                }
            }
            return $fields;
        }

        return null;

    }

    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    protected function getAllField($id, $type)
    {
        return Field::where('accessory_id','=',"$id AND accessory_type= $type")->get();
    }

    /**
     * @param $type
     * @return mixed
     */
    protected function getAllFieldMap($type)
    {
        return FieldParam::where('accessory_type',$type)->get();
    }
}