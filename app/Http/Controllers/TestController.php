<?php

namespace App\Http\Controllers;
use App\Models\RouterosApi;
use App\Models\Client;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index($id) 
    {
        $item = Client::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;
        
        if ($API->connect($ip, $user, $password)) {
            $ip = $API->comm('/ping', array(
              'address' => '10.0.10.254',
              'count' => '5',
            ));
            // $resource = $API->comm('/system/resource/print');
            // $secret = $API->comm('/ppp/secret/print');
            // $secretactive = $API->comm('/ppp/active/print');
            // $interface = $API->comm('/interface/ethernet/print');
            // $routerboard = $API->comm('/system/routerboard/print');
            // $identity = $API->comm('/system/identity/print');

            $data = [
                // 'totalsecret' => count($secret),
                // 'totalhotspot' => count($hotspotactive),
                // 'hotspotactive' => count($hotspotactive),
                // 'secretactive' => count($secretactive),
                'ip_address' => $ip,
                // 'cpu' => $resource[0]['cpu-load'],
                // 'uptime' => $resource[0]['uptime'],
                // 'version' => $resource[0]['version'],
                // 'interface' => $interface,
                // 'boardname' => $resource[0]['board-name'],
                // 'freememory' => $resource[0]['free-memory'],
                // 'freehdd' => $resource[0]['free-hdd-space'],
                // 'model' => $routerboard[0]['model'],
                // 'identity' => $identity[0]['name'],
            ];

            // return view('testview', $data);
            dd($data);
        }else{
            return view('error');
        };
        }
}