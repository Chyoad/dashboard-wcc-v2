<?php

namespace App\Http\Controllers;
use App\Models\RouterosApi;
use App\Models\Server;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index($id) 
    {
        $item = Server::findOrFail($id);

        $ip = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

        $API = new RouterosApi();
        $API->debug = false;
        
        if ($API->connect($ip, $user, $password)) {
            $getData = $API->comm("/system/script/print");

			$TotalReg = count($getData);

            // $gettimezone = $API->comm("/system/script/print");
	        // $timezone = $gettimezone[0]['time-zone-'];

            // $resource = $API->comm('/system/resource/print');
            // $secret = $API->comm('/ppp/secret/print');
            // $secretactive = $API->comm('/ppp/active/print');
            // $interface = $API->comm('/interface/ethernet/print');
            // $routerboard = $API->comm('/system/routerboard/print');
            // $identity = $API->comm('/system/identity/print');

            // dd($query);

            $data = [
                // 'timezonename' =>  $gettimezone[0]['time-zone-name'],
                // 'timezonetime' =>  $gettimezone[0]['time'],
                // 'timezonedate' =>  $gettimezone[0]['date'],

                // 'totalsecret' => count($secret),
                // 'totalhotspot' => count($hotspotactive),
                // 'hotspotactive' => count($hotspotactive),
                // 'secretactive' => count($secretactive),
                // 'active' => $query,
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
            dd($TotalReg);
        }else{
            return view('failed');
        };
        }
}