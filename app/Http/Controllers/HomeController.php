<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use DB;

use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function company(Request $request){
        
        $cityData = array();
       
        $data = array();
    
        return view('seic.company',compact('data','cityData'));
    }

    public function getData()
{

    $data = DB::table('company_info');
    
    return DataTables::of($data)->make(true);
}
}
