<?php

namespace App\Http\Controllers;

use RouterOS\Query;
use RouterOS\Client;
use Illuminate\Http\Request;
use App\Models\Client as ClientModel;

class DashboardController extends Controller
{
    public function show($id){
        $item = ClientModel::findOrFail($id);

        // Initiate client with config object
        $client = new Client([
            'host' => $item['ip'],
            'user' => $item['name'],
            'pass' => $item['pass'],
            'port' => 8728,
        ]);

        // Create "where" Query object for RouterOS
        $userQuery = new Query('/ip/hotspot/ip-binding/print');
        $userQuery->where('profile', 'default');
        //$userQuery = new Query('/ip/hotspot/user/print');

        // Send the query and read the response from RouterOS
        $totalUserQuery = $client->query($userQuery)->read();
        $countUser = count($totalUserQuery);

        return view('dashboard.index', [
            'countUser' => $countUser, 
            'id' => $id,
        ]);
        
    }

    public function uptime($id) {
        $item = ClientModel::findOrFail($id);

        $client = new Client([
            'host' => $item['ip'],
            'user' => $item['name'],
            'pass' => $item['pass'],
            'port' => 8728,
        ]); 

        $uptime = new Query('/system/resource/print');

        $uptimeQuery = $client->query($uptime)->read();

        $data = [
            'id' => $id,
            'uptime' => $uptimeQuery['0']['uptime'],
        ];

        // dd($data);

        return view('realtime.uptime', $data);
    }

}
