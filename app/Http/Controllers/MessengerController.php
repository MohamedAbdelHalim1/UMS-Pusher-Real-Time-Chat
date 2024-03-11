<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\PusherBroadcast;

class MessengerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        $user = User::find($id);
        return view('messenger' , compact('user'));
    }

    public function broadcast(Request $request){
        broadcast(new PusherBroadcast($request->get('messege')))->toOthers();
        return view('broadcast' , ['messege'=>$request->get('messege')]);
    }

    public function receive(Request $request){
        return view('receive' , ['messege'=>$request->get('messege')]);
    }
}
