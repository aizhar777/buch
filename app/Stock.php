<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'subdivision_id',
        'responsible',
        'address',
    ];

    public function subdivision()
    {
        return $this->belongsTo('App\Subdivision','subdivision_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','responsible', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\products', 'id', 'stock_id');
    }

    /**
     * Create new stock
     *
     * @param array $data
     * @return bool|static
     */
    public static function createNewStorage(array $data)
    {
        $address = null;
        $responsible = null;
        $description = null;

        if(!empty($data['address']))
            $address = $data['address'];

        if(!empty($data['responsible']))
            $responsible = $data['responsible'];

        if(!empty($data['description']))
            $description = $data['description'];

        if(empty($data['name']))
            return false;

        if(empty($data['slug']))
            return false;

        if(empty($data['subdivision_id']))
            return false;

        $newStorage = self::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $description,
            'subdivision_id' => $data['subdivision_id'],
            'responsible' => $responsible,
            'address' => $address,
        ]);

        if ($newStorage instanceof self)
            return $newStorage;
        return false;
    }

    /**
     * Update stock
     *
     * @param array $data
     * @return bool|static
     */
    public static function updateStorage($id, array $data)
    {
        $stock = self::where('id',$id)->firstOrFail();

        $address = null;
        $responsible = null;
        $description = null;

        if(empty($data['name']))
            return false;

        if(empty($data['slug']))
            return false;

        if(empty($data['subdivision_id']))
            return false;

        if(!empty($data['name']) && $stock->name != $data['name'])
            $stock->name = $data['name'];

        if(!empty($data['slug']) && $stock->slug != $data['slug'])
            $stock->slug = $data['slug'];

        if(!empty($data['description']) && $stock->description != $data['description'])
            $stock->description = $data['description'];

        if(!empty($data['subdivision_id']) && $stock->subdivision_id != $data['subdivision_id'])
            $stock->subdivision_id = $data['subdivision_id'];

        if(!empty($data['responsible']) && $stock->responsible != $data['responsible'])
            $stock->responsible = $data['responsible'];

        if(!empty($data['address']) && $stock->address != $data['address'])
            $stock->address = $data['address'];


        if ($stock->save())
            return $stock;
        return false;
    }
}
