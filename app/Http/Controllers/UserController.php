<?php

namespace App\Http\Controllers;

use App\Models\Client as ClientModel;
use RouterOS\Query;
use RouterOS\Client;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $userQuery = new Query('/ip/hotspot/active/print');

        // Send the query and read the response from RouterOS
        $totalUserQuery = $client->query($userQuery)->read();
        $countUser = count($totalUserQuery);


        return view('dashboard.index', [
            'countUser' => $countUser, 
            'id' => $id,
        ]);
        
    }

    public function activeUser($id) {
        $item = ClientModel::findOrFail($id);

        $client = new Client([
            'host' => $item['ip'],
            'user' => $item['name'],
            'pass' => $item['pass'],
            'port' => 8728,
        ]); 

        $activeUsersQuery = new Query('/ip/hotspot/active/print');
    
        $activeUsers = $client->query($activeUsersQuery)->read();


        $countActiveUser = count($activeUsers);

        $data = [
            'id' => $id,
            'countActiveUser' => $countActiveUser,
        ];

        return view('realtime.activeUser', $data);
    }

    public function user($id) {
        $item = ClientModel::findOrFail($id);

        $client = new Client([
            'host' => $item['ip'],
            'user' => $item['name'],
            'pass' => $item['pass'],
            'port' => 8728,
        ]); 

        $userQuery = new Query('/ip/hotspot/user/print');
        $userQuery->where('profile', 'default');

        $users = $client->query($userQuery)->read();
        
        $countUsers = count($users);


        $data = [
            'id' => $id,
            'countUsers' => $countUsers,
        ];

        return view('realtime.user', $data);
    }
}
