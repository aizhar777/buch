<?php

namespace App;

use App\Modules\Clients\Http\Requests\CreateClientAndRequisiteRequest;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'clients';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'email',
        'phone',
        'curator',
    ];

    public function requisites()
    {
        return $this->morphMany('App\Requisite', 'relation');
    }

    public function supervise()
    {
        return $this->belongsTo('App\User', 'curator');
    }


    /**
     * Create new client
     *
     * @param CreateClientAndRequisiteRequest $request
     * @return Client|bool
     */
    public static function addClient(CreateClientAndRequisiteRequest $request)
    {
        $reqCurator = $request->get('curator');
        $curatorID = null;
        if($reqCurator !== null && $reqCurator != 'null' && is_numeric($reqCurator)) {
            $curator = User::find($request->get('curator'))->first();
            if($curator instanceof User)
                $curatorID = $curator->id;
        }
        $newClient = new self();
        $newClient->name = $request->get('name');
        $newClient->email = $request->get('email');
        $newClient->phone = $request->get('phone');
        $newClient->curator = $curatorID;

        if($newClient->save()){
            return $newClient;
        }

        return false;
    }

    /**
     * Create client and requisite for client
     *
     * @param CreateClientAndRequisiteRequest $request
     * @return Client|bool
     */
    public static function createClientAndRequisite(CreateClientAndRequisiteRequest $request)
    {
        $resultTransaction = false;

        \DB::beginTransaction();
            $newClient = self::addClient($request);
            if ($newClient instanceof Client){

                $newRequisite = Requisite::createNewRequisietForClient($newClient, $request);

                if($newRequisite instanceof Requisite){
                    \DB::commit();
                    $resultTransaction = true;
                }else{
                    \DB::rollBack();
                }

            }else{
                \DB::rollBack();
            }

            if ($resultTransaction)
                return $newClient;
            return false;
    }

}
