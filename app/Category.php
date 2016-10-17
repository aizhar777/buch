<?php

namespace App;

use App\Modules\Category\Http\Requests\CreateCategoryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Baum\Node;

class Category extends Node
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'categories';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'cat_type',
    ];

    // /**
    //  * Column to perform the default sorting
    //  *
    //  * @var string
    //  */
    // protected $orderColumn = null;

    // /**
    // * With Baum, all NestedSet-related fields are guarded from mass-assignment
    // * by default.
    // *
    // * @var array
    // */
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * Get all products of the subdivision's.
     */
    public function subdivision()
    {
        return $this->morphMany('App\Products', 'subdivision');
    }

    /**
     * Get all products of the stock's.
     */
    public function stock()
    {
        return $this->morphMany('App\Products', 'stock');
    }

    public function classes()
    {
        return $this->belongsTo('App\Classes', 'cat_type', 'class');
    }


    /**
     * Create category
     *
     * @param CreateCategoryRequest $request
     * @return Category|bool
     */
    public static function createCategory(CreateCategoryRequest $request)
    {
        if(empty($request->get('parent_id')))
            return self::createRootCategory($request);

        $root = self::whereId($request->get('parent_id'))->firstOrFail();
        return self::createChildCategory($root, $request);
    }

    /**
     * Create root category
     *
     * @param CreateCategoryRequest $request
     * @return bool|Category
     */
    protected static function createRootCategory(CreateCategoryRequest $request)
    {
        $cat = self::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'cat_type' => $request->get('cat_type'),
        ]);

        if(!$cat instanceof Category)
            return false;

        return $cat;
    }

    /**
     * Create children category
     *
     * @param CreateCategoryRequest $request
     * @return bool|Category
     */
    protected static function createChildCategory(Category $root, CreateCategoryRequest $request)
    {
        $cat = $root->children()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'cat_type' => $request->get('cat_type'),
        ]);

        if($cat instanceof Category)
            return $cat;
        return false;

    }

    /**
     * Check the Nested Set
     * If it is not valid to rebuild.
     *
     * @return bool|null
     */
    public static function checkAndOrRebuild()
    {
        if(!self::isValidNestedSet()){
            self::rebuild();
            return null;
        }
        return true;
    }

    public static function deleteCategory($id)
    {
        $cat = self::find($id)->firstOrFail();
        if($cat->delete()){
            self::checkAndOrRebuild();
            return true;
        }
        return false;
    }

    public function renderNodeAsList($node) {
        if( $node->isLeaf() ) {
            return '<li>' . $node->name . '</li>';
        } else {
            $html = '<li>' . $node->name;

            $html .= '<ul>';

            foreach($node->children as $child)
                $html .= $this->renderNodeAsList($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }

    public function renderNodeAsOption($node, $selected = null)
    {
        $select = '';
        if( $node->isLeaf() ) {
            if($selected != null){
                $select = '';
                if($selected == $node->id)
                    $select = ' selected ';
            }
            if($node->isRoot()) {
                $html = '<option value="' . $node->id . '"' . $select . '>' . $node->name . '</option>';
            }else{
                $html = '<option value="' . $node->id . '"' . $select . '> - ' . $node->name . '</option>';
            }
        } else {
            if($selected != null){
                if($selected == $node->id)
                    $select = ' selected ';
            }
            $html = '<optgroup label="'.$node->classes->name.'"><option value="' . $node->id . '"' . $select . '>Root</option>';

            foreach($node->children as $child)
                $html .= $this->renderNodeAsOption($child);

            $html .= '</optgroup>';
        }

        return $html;
    }
}
