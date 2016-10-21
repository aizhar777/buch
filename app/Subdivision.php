<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subdivisions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'responsible',
        'address',
    ];

    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }

    public function user()
    {
        return $this->belongsTo('App\User','responsible', 'id');
    }

    /**
     * Create new subdivision
     *
     * @param array $data
     * @return bool|static
     */
    public static function createNewSub(array $data)
    {
        if (empty($data['name']))
            return false;
        if (empty($data['slug']))
            return false;

        $address = null;
        $responsible = null;
        $description = null;

        if(!empty($data['address']))
            $address = $data['address'];

        if(!empty($data['responsible']))
            $responsible = $data['responsible'];

        if(!empty($data['description']))
            $description = $data['description'];

        $newSub = self::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $description,
            'responsible' => $responsible,
            'address' => $address,
        ]);

        if ($newSub instanceof self)
            return $newSub;
        return false;
    }

    /**
     * Update subdivision
     *
     * @param array $data
     * @return bool|static
     */
    public static function updateSub($id, array $data)
    {
        $sub = self::where('id',$id)->firstOrFail();

        if(!empty($data['name']) && $sub->name != $data['name'])
            $sub->name = $data['name'];

        if(!empty($data['slug']) && $sub->slug != $data['slug'])
            $sub->slug = $data['slug'];

        if(!empty($data['description']) && $sub->description != $data['description'])
            $sub->description = $data['description'];

        if(!empty($data['address']) && $sub->address != $data['address'])
            $sub->address = $data['address'];

        if(!empty($data['responsible']) && $sub->responsible != $data['responsible'])
            $sub->responsible = $data['responsible'];

        if ($sub->save())
            return $sub;
        return false;
    }
}
