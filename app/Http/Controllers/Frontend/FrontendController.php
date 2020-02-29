<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * FrontendController
 */
class FrontendController extends Controller
{
    protected $pagination;

    /**
     * FrontendController constructor.
     */
    public function __construct()
    {
        $this->pagination = config('constants.backend.pagination');
    }
}
