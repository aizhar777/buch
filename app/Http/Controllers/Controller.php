<?php

namespace App\Http\Controllers;

use App\Library\Traits\NoAccess;
use App\Library\Traits\PerPage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Library\Traits\CurrentUserModel;
use Vinkla\Hashids\HashidsManager;
use Hashids\Hashids;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, NoAccess, CurrentUserModel, PerPage;

    /**
     * @var Hashids
     */
    protected $hashids;

    /**
     * @const int MAX_ITEMS a maximum of items per page
     */
    const MAX_ITEMS = 100;

    /**
     * @const int MIN_ITEMS a minimum of items per page
     */
    const MIN_ITEMS = 10;

    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @param mixed $id
     * @return string
     */
    public function hashEncode($id)
    {
        return $this->hashids->encode($id);
    }

    /**
     * @param $hash
     * @return string
     */
    public function hashDecode($hash)
    {
        return $this->hashids->decode($hash)[0];
    }

}
