<?php

namespace App\Http\Controllers;

use App\Models\Client as ClientModel;
use App\Models\RouterosApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id){
        $item = ClientModel::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $hotspot_active = $API->comm('/ip/hotspot/active/print');

            $data = [
            'id' => $id,
            'uptime'  => $resource[0]['uptime'],
            ];

            //dd($data);

            return view('realtime.uptime', $data);

        } else{
            return view('failed');
        }
    }

    public function activeUser($id) {
        $item = ClientModel::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $hotspot_active = $API->comm('/ip/hotspot/active/print');

            $data = [
                'id' => $id,
                'count_active_user'  => count($hotspot_active),
            ];

            //dd($data);

            return view('realtime.activeUser', $data);

        } else{
            return view('failed');
        }
    }

    public function user($id) {
        $item = ClientModel::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $hotspot_user = $API->comm('/ip/hotspot/user/print', array(
                '?profile' => 'default'
            ));

            $data = [
                'id' => $id,
                'count_user'  => count($hotspot_user),
            ];

            //dd($data);

            return view('realtime.user', $data);

        } else{
            return view('failed');
        }
    }
}
