<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index(){
        return view('subscribers.index');
    }

    /**
     * Get subscribers via ajax. Used by datatables
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribersAjax(Request $request){
        $subscribers = Subscriber::query();

        $datatable = DataTables::of($subscribers);

        return $datatable->make(true);
    }
}
