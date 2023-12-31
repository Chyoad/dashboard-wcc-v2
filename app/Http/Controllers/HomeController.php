<?php

namespace App\Http\Controllers;

use RouterOS\Query;
use App\Models\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Initiate client with config object
        // $client = new Client([
        //     'host' => '172.16.115.222',
        //     'user' => 'admin',
        //     'pass' => 'admin',
        //     'port' => 8728,
        // ]);

        // //ip address and mac address
        // $identity = new Query('/ip/hotspot/host/print');
        // $identity->where('bypassed', 'true');

        // //hardware type
        // $type = new Query('/system/resource/print');

        // // Send the query and read the response from RouterOS
        // $totalUserQuery = $client->query($userQuery)->read();
        // $totalUserActiveQuery = $client->query($userActiveQuery)->read();
        // $identityQuery = $client->query($identity)->read();
        // $typeQuery = $client->query($type)->read();

        
        // // dd($typeQuery);
        
        // $countUser = count($totalUserQuery);
        // $countUserActive = count($totalUserActiveQuery);

        // // dd($totalMitraQuery);
        
        // return view('home', [
        //     'countUser' => $countUser, 
        //     'countUserActive' => $countUserActive, 
        //     'identityQuery' =>$identityQuery,
        //     'typeQuery' => $typeQuery
        // ]);

        $clients= Client::all();

        return view('home', [
            'clients' => $clients
        ]);
    }

    // public function uptime() {
    //     $client = new Client([
    //         'host' => '111.92.166.114',
    //         'user' => 'admin',
    //         'pass' => 'admin',
    //         'port' => 8728,
    //     ]); 

    //     $uptime = new Query('/system/resource/print');
    //     $uptimeQuery = $client->query($uptime)->read();
    //     $data = [
    //         'uptime' => $uptimeQuery['0']['uptime'],
    //     ];

    //     return view('realtime.uptime', $data);
    // }
}
