<?php

namespace App\Library;


use App\Field;
use App\FieldParam;
use App\Library\Interfaces\PluginInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    /**
     * Create Field param
     *
     * @param array $params
     * @return FieldParam
     */
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

                $is_many = false;
                $defaultValue = null;
                $field = $fParam->fields()->where('accessory_id', $id)->first();

                if($field != null) {
                    if($fParam->is_many_values){
                        $is_many = true;
                        $defaultValue = explode("|", $fParam->default_value);
                    }else{
                        $defaultValue = $field->default_value;
                    }
                    $fields[$field->slug] = [
                        'name' => $field->name,
                        'data' => $field->value,
                        'default' => $defaultValue,
                        'is_many' => $is_many,
                        'is_required' => $fParam->is_required,
                        'is_hidden' => $fParam->is_hidden,
                    ];
                }else{
                    $defaultValue = null;
                    if($fParam->is_many_values){
                        $is_many = true;
                        $defaultValue = explode("|", $fParam->default_value);
                        $value = $defaultValue[0];
                    }else{
                        $defaultValue = $value = $fParam->default_value;
                    }
                    $fields[$fParam->slug] = [
                        'name' => $fParam->name,
                        'data' => $value,
                        'default' => $defaultValue,
                        'is_many' => $is_many,
                        'is_required' => $fParam->is_required,
                        'is_hidden' => $fParam->is_hidden,
                    ];
                }
            }
            return $fields;
        }

        return null;
    }

    /**
     * Update or create fields
     *
     * @param Model $model
     * @param Request $request
     */
    public function updateOrCreate(Model $model, Request $request)
    {
        $fieldMap = $this->getAllFieldMap($model::TYPE);

        $data = $request->get('fields');

        foreach ($fieldMap as $fParam){
            if($fParam->is_hidden) {
                continue;
                $slug = $fParam->slug;
                if(method_exists($this, $slug)){
                    $this->$slug($fParam, $model, $request);
                }
            }

            $this->createOrUpdate($fParam, $model, $data);
        }
    }

    /**
     * Create or update Field model
     *
     * @param FieldParam $param
     * @param Model $model
     * @param array $data
     * @return bool
     */
    protected function createOrUpdate(FieldParam $param, Model $model, array $data)
    {
        $field = $param->fields()->where('accessory_id', $model->id)->first();
        if($field != null) {
            if(!empty($data[$field->slug])){

                if($param->is_many_values){

                    $defaultValue = explode("|", $param->default_value);
                    $validator = \Validator::make($data, [
                        $param->slug => 'required|in:'.implode(',',$defaultValue)
                    ]);

                    if ($validator->fails()) {
                        return false;
                    }

                    $field->value = $data[$field->slug];

                }else{
                    $field->value = $data[$field->slug];
                }

                if($field->save())
                    return true;
            }
        }else{
            $field = Field::create([
                'name' => $param->name,
                'slug' => $param->slug,
                'value' => $data[$param->slug],
                'default_value' => $param->default_value,
                'param_id' => $param->id,
                'accessory_id' => $model->id,
                'accessory_type' => $model::TYPE,
            ]);
            if ($field instanceof Field)
                return true;
        }

        return false;
    }

    /**
     * Create or update User image
     *
     * @param FieldParam $param
     * @param Model $model
     * @param Request $request
     * @return bool
     */
    protected function param_user_image(FieldParam $param, Model$model, Request $request)
    {
        $value = $param->default_value;
        if(!$request->hasFile('param_user_image'))
            return false;

        $file = $request->file('param_user_image');
        $destinationPath = base_path() . '/public/upload/images/';
        $image_name = time() . "_" . $file->getClientOriginalName();
        $file->move($destinationPath , $image_name);
        $value = $image_name;

        $this->createOrUpdate($param, $model, [
            $param->slug => $value
        ]);
    }
}