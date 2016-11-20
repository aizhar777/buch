<?php

namespace App;

use App\Modules\Clients\Http\Requests\CreateClientAndRequisiteRequest;
use App\Modules\Clients\Http\Requests\EditClientAndRequisiteRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Requisite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'requisites';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Requisite';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'legal_name',
        'bank',
        'iik',
        'iin',
        'bin',
        'cbe',
        'relation_id',
        'relation_type',
    ];

    public function relation()
    {
        return $this->morphTo();
    }

    /**
     * Create Requisite for client
     *
     * @param Client $model
     * @param CreateClientAndRequisiteRequest $request
     * @return Requisite|bool
     */
    public static function createNewRequisietForClient(Client $model, CreateClientAndRequisiteRequest $request)
    {
        return self::createRequisite($model, $request);
    }

    /**
     * Create Requisite for client
     *
     * @param User $model
     * @param Request $request
     * @return Requisite|bool
     */
    public static function createNewRequisietForUser(User $model, Request $request)
    {
        //TODO: Измить в параметрах класс Request на FormRequest или аналогичный
        return self::createRequisite($model, $request);
    }

    /**
     * Update Requisite for Client
     *
     * @param Client $model
     * @param EditClientAndRequisiteRequest $request
     * @return Requisite|bool
     */
    public static function updateRequisietForClient(Client $model, EditClientAndRequisiteRequest $request)
    {
        return self::updateRequisite($model, $request);
    }

    /**
     * Create Requisite
     *
     * @param Model $model
     * @param Request $request
     * @return Requisite|bool
     */
    protected static function createRequisite(Model $model, Request $request)
    {
        $newRequisite = new self();
        $newRequisite->legal_name = $request->get('legal_name');
        $newRequisite->bank = $request->get('bank');
        $newRequisite->iik = $request->get('iik');
        $newRequisite->iin = $request->get('iin');
        $newRequisite->bin = $request->get('bin');
        $newRequisite->cbe = $request->get('cbe');
        $newRequisite->relation_id = $model->id;
        $newRequisite->relation_type = $model::TYPE;

        if ($newRequisite->save())
            return $newRequisite;
        return false;
    }

    /**
     * Update Requisites
     *
     * @param Model $model
     * @param Request $request
     * @param mixed $name array name in request (string), for requisite data, true if not array or null for default name array 'requisite'
     * @return bool|mixed
     */
    protected static function updateRequisite(Model $model, Request $request, $name = null)
    {
        $newRequisite = $model->requisites()->firstOrFail();

        //TODO: Сделать проверку если в Model'е больше одного реквизита

        if($newRequisite instanceof Requisite) {

            switch ($name){
                case null:
                    $data = $request->get('requisite');
                    break;
                case true:
                    $data = $request->all();
                    break;
                default:
                    $data = $request->get($name);
            }

            //TODO: Сделать проверку если в request'е больше одного реквизита


            if ($newRequisite->legal_name != $data['legal_name'])
                $newRequisite->legal_name = $data['legal_name'];

            if ($newRequisite->bank != $data['bank'])
                $newRequisite->bank = $data['bank'];

            if ($newRequisite->iik != $data['iik'])
                $newRequisite->iik = $data['iik'];

            if ($newRequisite->bin != $data['bin'])
                $newRequisite->bin = $data['bin'];

            if ($newRequisite->cbe != $data['cbe'])
                $newRequisite->cbe = $data['cbe'];

            if ($newRequisite->relation_type != $model::TYPE or $newRequisite->relation_id != $model->id) {
                $newRequisite->relation_id = $model->id;
                $newRequisite->relation_type = $model::TYPE;
            }

            if ($newRequisite->save())
                return $newRequisite;
        }

        return false;
    }
}
