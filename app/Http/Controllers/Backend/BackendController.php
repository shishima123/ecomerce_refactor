<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

/**
 * BackendController
 */
class BackendController extends Controller
{
    protected $pagination;
    protected $backendUrl;

    /**
     * BackendController constructor.
     */
    public function __construct()
    {
        $this->pagination = config('constants.backend.pagination');
        $this->backendUrl = ('constants.backend.url');
    }
}
