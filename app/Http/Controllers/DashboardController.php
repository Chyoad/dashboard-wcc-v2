<?php

namespace App\Http\Controllers;

use App\Models\RouterosApi;
use Illuminate\Http\Request;
use App\Models\Client as ClientModel;

class DashboardController extends Controller
{
    public function show($id){

        $item = ClientModel::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $ip_address = $API->comm('/ip/hotspot/ip-binding/print', array(
                '?comment' => 'NodeMCU'
            ));

            // $user = $API->comm('/ip/hotspot/user/print', array(
            //     '?profile' => 'default',
            // ));

            $resource = $API->comm('/system/resource/print');

            // $limitUptimeArray = array(); // Initialize an empty array to store limit-uptime values

            // foreach ($user as $userInfo) {
            //     // Check if the 'limit-uptime' key exists in the current user's information
            //     if (isset($userInfo['limit-uptime'])) {

            //          $duration = $userInfo['limit-uptime'];

            //         list($days, $hours) = sscanf($duration, "%dd%dh");
            //         $totalHours = ($days * 24) + $hours;

            //         // Add the 'limit-uptime' value to the $limitUptimeArray
            //         $limitUptimeArray[] = $totalHours;
            //     }
            // }
            
            // $total = array_sum($limitUptimeArray);
            
            // dd($total*1000);

            $data = [
                'id' => $id,
                'ip_address' => $ip_address[0]['address'],
                'board_name'  => $resource[0]['board-name'],
            ];

            //dd($data);

            return view('dashboard.index', $data);

        } else{
            return view('failed');
        }
    }

    public function uptime($id) 
    {
        $item = ClientModel::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $resource = $API->comm('/system/resource/print');

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

    public function status($id) 
    {
        $item = ClientModel::findOrFail($id);

        $ip = $item['ip'];
        $user = $item['name'];
        $password = $item['pass'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $ip_binding = $API->comm('/ip/hotspot/ip-binding/print', array(
                '?comment' => 'NodeMCU'
            ));
            $ip_address = $ip_binding[0]['address'];
            $response = $API->comm('/ping', array(
                'address' => $ip_address,
                'count' => '1'
            ));

            if($response[0]['packet-loss'] === '0' ){    
                return $status = 'online';
            } else {
                return $status = 'offline';
            };

            $data = [
                'id' => $id,
                'node_mcu_status' => $status,
            ];

            //dd($data);

            return view('realtime.status', $data);

        } else{
            return view('failed');
        }        
    }

    public function income($id)
    {
        $item = ClientModel :: findOrFail($id);

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
                'total_income'  => count($hotspot_user) * 1000,
            ];

            //dd($data);

            return view('realtime.income', $data);

        } else{
            return view('failed');
        }

    }

}
