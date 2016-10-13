<?php

namespace App;

use App\Modules\Clients\Http\Requests\CreateClientAndRequisiteRequest;
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
        $newRequisite = new self();
        $newRequisite->legal_name = $request->get('legal_name');
        $newRequisite->bank = $request->get('bank');
        $newRequisite->iik = $request->get('iik');
        $newRequisite->bin = $request->get('bin');
        $newRequisite->cbe = $request->get('cbe');
        $newRequisite->relation_id = $model->id;
        $newRequisite->relation_type = $model::TYPE;

        if ($newRequisite->save())
            return $newRequisite;
        return false;
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
        $newRequisite = new self();
        $newRequisite->legal_name = $request->get('legal_name');
        $newRequisite->bank = $request->get('bank');
        $newRequisite->iik = $request->get('iik');
        $newRequisite->bin = $request->get('bin');
        $newRequisite->cbe = $request->get('cbe');
        $newRequisite->relation_id = $model->id;
        $newRequisite->relation_type = $model::TYPE;

        if ($newRequisite->save())
            return $newRequisite;
        return false;
    }
}
