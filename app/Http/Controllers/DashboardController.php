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

        $ipQuery = (new Query('/ip/hotspot/ip-binding/print'))
            //->where('comment','wifi coin')
            ->where('comment','NodeMCU');
            // ->operations('|');

        


        $interfaceQuery = (new Query('/interface/ethernet/print'));

        $resourceQuery = new Query('/system/resource/print');

        // Send the query and read the response from RouterOS
        $ip_address = $client->query($ipQuery)->read();
        $resource = $client->query($resourceQuery)->read();
        $interface = $client->query($interfaceQuery)->read();

    
        return view('dashboard.index', [
            'ip_address' => $ip_address[0]['address'],
            'board_name' => $resource[0]['board-name'], 
            'id' => $id,
        ]);
        
    }

    public function uptime($id) 
    {
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

    public function status($id) 
    {
        $item = ClientModel::findOrFail($id);

        $client = new Client([
            'host' => $item['ip'],
            'user' => $item['name'],
            'pass' => $item['pass'],
            'port' => 8728,
        ]); 


        $ipQuery = (new Query('/ip/hotspot/ip-binding/print'))
            //->where('comment','wifi coin')
            ->where('comment','NodeMCU');
            // ->operations('|');        

        $ip_address = $client->query($ipQuery)->read();
        $ip = $ip_address[0]['address']; 

        $responseQuery = (new Query('/ping'))
            ->equal('address', $ip )
            ->equal('count', '1');

        $response = $client->query($responseQuery)->read();

            if($response[0]['packet-loss'] === '0' ){    
                return $status = 'online';
            } else {
                return $status = 'offline';
            }
        

        $data = [
            'id' => $id,
            'status' => $status,
        ];

        // dd($data);

        return view('realtime.status', $data);

    }

    

}
