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
        $ipQuery = new Query('/ip/hotspot/ip-binding/print');
        $ipQuery->where('comment','wifi coin');

        $resourceQuery = new Query('/system/resource/print');

        // Send the query and read the response from RouterOS
        $ip_address = $client->query($ipQuery)->read();
        $resource = $client->query($resourceQuery)->read();

        //dd($resource[0]['board-name']);
        return view('dashboard.index', [
            'ip_address' => $ip_address[0]['address'],
            'board_name' => $resource[0]['board-name'], 
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
