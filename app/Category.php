<?php

namespace App;

use App\Modules\Category\Http\Requests\CreateCategoryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
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
        'left_key',
        'right_key',
        'level',
        'cat_type',
    ];

    /**
     * Create new category
     *
     * @param CreateCategoryRequest $request
     * @return bool|Category
     */
    public static function addNewCategory(CreateCategoryRequest $request, $id_parrent = null)
    {
        if($id_parrent == null) {
            $newCategory = self::createCategory($request);
        }else{
            $newCategory = self::createCategoryWithParent($request, $id_parrent);
        }

        if($newCategory instanceof Category)
            return $newCategory;
        return false;
    }

    protected static function createCategoryWithParent(Request $request, int $id_parrent)
    {

        $parentCat = self::find($id_parrent)->firstOrFail();
        if (!$parentCat instanceof Category)
            return false;

        $right_key = $parentCat->right_key;
        $level = $parentCat->level;
        \DB::update("UPDATE categories SET right_key = right_key + 2, left_key = IF(left_key > $right_key, left_key + 2, left_key) WHERE right_key >= $right_key");

        $newCategory = self::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'cat_type' => $request->get('cat_type'),
            'left_key' => $right_key,
            'right_key' => ($right_key +1),
            'level' => ($level +1)
        ]);

        if($newCategory instanceof Category)
            return $newCategory;
        return false;
    }

    protected static function createCategory(Request $request)
    {
        $rightKeyMax = self::getMaxKey();
        $right_key = $rightKeyMax->max_right_key;
        $level = 0;

        \DB::update("UPDATE categories SET right_key = right_key + 2, left_key = IF(left_key > $right_key, left_key + 2, left_key) WHERE right_key >= $right_key");

        $newCategory = self::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'cat_type' => $request->get('cat_type'),
            'left_key' => $right_key,
            'right_key' => ($right_key +1),
            'level' => ($level +1)
        ]);

        if($newCategory instanceof Category){
            return $newCategory;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Query\Expression
     */
    public static function getMaxKey()
    {
        return \DB::selectOne('SELECT COUNT(id) as count, MIN(left_key) as min_left_key, MAX(right_key) as max_right_key FROM categories');
    }

    public static function deleteCategory($id)
    {
        $cat = self::find($id)->firstOrFail();
        $left_key = $cat->left_key;
        $right_key = $cat->right_key;

        $result = \DB::table('categories')
            ->where('left_key', '>=', $left_key)
            ->where('right_key', '>=', $right_key)
            ->delete();

        #\DB::update("UPDATE categories SET right_key = right_key – ($right_key - $left_key + 1) WHERE right_key > $right_key AND left_key < $left_key");
        #\DB::update("UPDATE categories SET left_key = left_key – ($right_key - $left_key + 1), right_key = right_key – ($right_key - $left_key + 1) WHERE left_key > $right_key");
        \DB::update("UPDATE categories SET left_key = IF(left_key > $left_key, left_key – ($right_key - $left_key + 1), left_key), right_key = right_key – ($right_key - $left_key + 1) WHERE right_key > $right_key");

        return $result;
    }
}
