<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\RouterosApi;
use Illuminate\Http\Request;
use App\Models\Server as ServerModel;

class DashboardController extends Controller
{
    public function show($id){

        $servers = Server::all();

        $item = ServerModel::findOrFail($id);

        $ip = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $ip_address = $API->comm('/ip/hotspot/ip-binding/print', array(
                '?comment' => 'NodeMCU'
            ));
            $resource = $API->comm('/system/resource/print');
            $identity = $API->comm('/system/identity/print');

            $data = [
                'id' => $id,
                'ip_address' => $ip_address[0]['address'],
                'board_name'  => $resource[0]['board-name'],
                'identity' => $identity[0]['name'],
                'servers' => $servers
            ];

            return view('dashboard.index', $data);

        } else{
            return view('failed');
        }
    }

    public function uptime($id) 
    {
        $item = ServerModel::findOrFail($id);

        $ip = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

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
        $item = ServerModel::findOrFail($id);

        $ip = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

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

    public function countUserAndIncome($id)
    {
        $item = ServerModel :: findOrFail($id);

        $ip = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $hotspot_user = $API->comm('/ip/hotspot/user/print');
            // $hotspot_user = $API->comm('/ip/hotspot/user/print', array(
            //     '?profile' => 'default'
            // ));

            $limitUptimeArray = array(); // Initialize an empty array to store limit-uptime values

            foreach ($hotspot_user as $userInfo) {
                // Check if the 'limit-uptime' key exists in the current user's information
                if (isset($userInfo['limit-uptime'])) {
                    $duration = $userInfo['limit-uptime'];

                    // Extract both days and hours from the duration string
                    if (preg_match('/(\d+)d(\d+)h/', $duration, $matches)) {
                        // If both days and hours are present in the format "XdYh"
                        $days = intval($matches[1]);
                        $hours = intval($matches[2]);
                    } elseif (preg_match('/(\d+)h/', $duration, $matches)) {
                        // If only hours are present in the format "Xh"
                        $days = 0;
                        $hours = intval($matches[1]);
                    } else {
                        // Handle other formats or invalid input
                        $days = 0;
                        $hours = 0;
                    }

                    // Convert days to hours and add the hours part
                    $totalHours = ($days * 24) + $hours;

                    // Add the 'totalHours' value to the $limitUptimeArray
                    $limitUptimeArray[] = $totalHours;
                }
            }

            // Calculate the sum of all 'totalHours' values
            $totalSumHours = array_sum($limitUptimeArray);


            $data = [
                'id' => $id,
                'total_income'  => ($totalSumHours / 2) * 1000 ,
                'count_user' => count($hotspot_user)
            ];

            //dd($data);

            return view('realtime.total-user-income', $data);

        } else{
            return view('failed');
        }
    }


    public function countActiveUserAndIncome($id)
    {

        $item = ServerModel::findOrFail($id);

        $ip = $item['host'];
        $user = $item['username'];
        $password = $item['password'];

        $API = new RouterosApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $hotspot_active = $API->comm('/ip/hotspot/active/print');

            $data = [
                'id' => $id,
                'count_active_user'  => count($hotspot_active),
                //'today_income' => count($hotspot_active) * 1000
            ];

            //dd($data);

            return view('realtime.active-user-income', $data);

        } else{
            return view('failed');
        } 
        
    }

}
