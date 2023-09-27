<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RouterOsApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MikrotikController extends Controller
{
    public function checkMikrotikStatus(Request $request)
    {
        $router = Client::findOrFail($request->id);
        $ip = $router->ip;
        $user = $router->name;
        $password = $router->pass;

        $API = new RouterOsApi();   

        try {
            $API->debug = false;
            if ($API->connect($ip, $user, $password)) {
                $response = $API->comm('/system/resource/print');

                // Extract the RouterOS version
                $routerOSVersion = $response[0]['version'];
                $boardName = $response[0]['board-name'];

                $API->disconnect();

                return response()->json([
                    'status' => 'success',
                    'title' => 'MikroTik Status Checked',
                    'message' => 'MikroTik is online',
                    'routerOSVersion' => $routerOSVersion,
                    'boardName' => $boardName,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Router sedang offline!',
                    'message' => 'Failed to connect to MikroTik.',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'title' => 'Error checking MikroTik status!',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
