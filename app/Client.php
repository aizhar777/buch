<?php

namespace App;

use App\Library\BFields;
use App\Modules\Clients\Http\Requests\CreateClientAndRequisiteRequest;
use App\Modules\Clients\Http\Requests\EditClientAndRequisiteRequest;
use App\Modules\Clients\Http\Requests\EditClientRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function fields()
    {
        return $this->morphMany('App\Field', 'accessory');
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
                }
            }

            if ($resultTransaction)
                return $newClient;

            \DB::rollBack();
            return false;
    }

    public static function editClientAndRequisite($id, EditClientAndRequisiteRequest $request)
    {
        $client = self::find($id)->firstOrFail();
        \DB::beginTransaction();

        if ($client instanceof Client){

            $client = self::updateClient($client, $request);


            if($client instanceof Client){
                $reuisite = Requisite::updateRequisietForClient($client, $request);

                if($reuisite instanceof Requisite) {
                    \DB::commit();
                    return $client;
                }
            }
        }

        \DB::rollBack();
        return false;
    }

    /**
     * Edit Client
     *
     * @param $id
     * @param EditClientRequest $request
     * @return Client|bool
     */
    public static function editClient($id, EditClientRequest $request)
    {
        $client = self::find($id)->firstOrFail();
        return self::updateClient($client, $request);
    }

    /**
     * Update Client
     *
     * @param Client $client
     * @param EditClientRequest $request
     * @return Client|bool
     */
    protected static function updateClient(Client $client, Request $request)
    {

        if ($client->name != $request->get('name'))
            $client->name = $request->get('name');

        if ($client->email != $request->get('email'))
            $client->email = $request->get('email');

        if ($client->phone != $request->get('phone'))
            $client->phone = $request->get('phone');

        if ($client->curator != $request->get('curator'))
            $client->curator = $request->get('curator');

        if(!$client->save()){
            return false;
        }

        $bFields = BFields::getInstance();
        $bFields->updateOrCreate($client, $request);
        return $client;
    }

    public static function deleteClientById($id)
    {
        $client = self::find($id)->firstOrFail();
        $fields = $client->fields;
        $requisites = $client->requisites;

        foreach ($fields as $field){
            if($field instanceof Field) $field->delete();
        }

        foreach ($requisites as $requisite){
            if($requisite instanceof Requisite) $requisite->delete();
        }

        if($client->delete())
            return true;
        return false;
    }

}
