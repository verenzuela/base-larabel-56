<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use Auth;
use DB;
use App\Audit;

class AuditController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth', 'BlackList']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        try {
            if( Auth::user()->hasRole(['root']) ){
                $audits =  Audit::orderBy('id', 'desc')->paginate(10);
                return view('admin/tools/audit/index', ['audits' => $audits]);
            }else Handler::error(403, 401);

        } catch (Exception $e) {
            Handler::error(500, $e->getCode(), $e->getMessage());
        }
    }

}
