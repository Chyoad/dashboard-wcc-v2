<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\RouterosApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser($id){

        $data = [
            'id' => $id
        ];

        return view('hotspots.all-user', $data);

    }

    public function showActive($id){

        $data = [
            'id' => $id
        ];  
        
        return view('hotspots.active-user', $data);

    }

    public function listUser($id) {
        $item = Server::findOrFail($id);

        $host = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($host, $user, $password)) {

            $hotspot_user = $API->comm('/ip/hotspot/user/print', array(
                '?profile' => 'default'
            ));

            $data = [
                'id' => $id,
                'all_users'  => $hotspot_user ,
                //'count_user' => count($hotspot_user)
            ];

            // dd($data);

            return view('realtime.list-user', $data);

        } else{
            return view('failed');
        }
    }

    public function listUserActive($id) {
        $item = Server::findOrFail($id);

        $host = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($host, $user, $password)) {
            $hotspot_active = $API->comm('/ip/hotspot/active/print');

            $data = [
                'id' => $id,
                'active_users' => $hotspot_active,
                //'count_active' => count($hotspot_active)
            ];

            // dd($data);

            return view('realtime.list-active-user', $data);

        } else{
            return view('failed');
        }
    }

}
