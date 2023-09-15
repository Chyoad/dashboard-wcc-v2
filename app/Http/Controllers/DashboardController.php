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

            

             //dd($limitUptimeArray);

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
            ];

            //dd($data);

            return view('realtime.income', $data);

        } else{
            return view('failed');
        }

    }

}
