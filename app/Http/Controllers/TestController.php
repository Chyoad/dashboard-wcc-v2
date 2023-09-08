<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use \RouterOS\Client;
use \RouterOS\Query;

class TestController extends Controller
{
    //
    public function index(){
        
        // Initiate client with config object
        $client = new Client([
            'host' => '192.168.0.237',
            'user' => 'admin',
            'pass' => 'admin',
            'port' => 8728,
        ]);

        // Create "where" Query object for RouterOS
        $query = (new Query('/ip/hotspot/user/print'));

        // Send query and read response from RouterOS
        $response = $client->query($query)->read();

        dd($response);

    }
}
