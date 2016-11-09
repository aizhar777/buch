<?php

namespace App\Http\Controllers;

use App\Library\Traits\NoAccess;
use App\Library\Traits\PerPage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Library\Traits\CurrentUserModel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, NoAccess, CurrentUserModel, PerPage;

    /**
     * @const int MAX_ITEMS a maximum of items per page
     */
    const MAX_ITEMS = 100;

    /**
     * @const int MIN_ITEMS a minimum of items per page
     */
    const MIN_ITEMS = 10;

}
