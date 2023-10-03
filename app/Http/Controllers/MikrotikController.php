<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\RouterOsApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MikrotikController extends Controller
{
    public function checkMikrotikStatus(Request $request)
    {
        $router = Server::findOrFail($request->id);
        $ip = $router->host;
        $user = $router->username;
        $password = $router->password;
         
        $API = new RouterOsApi();   

        try {
            $API->debug = false;
            if ($API->connect($ip, $user, $password)) {
                $response = $API->comm('/system/resource/print');
                $identity = $API->comm('/system/identity/print');

                // Extract the RouterOS version
                $routerOSVersion = $response[0]['version'];
                $boardName = $response[0]['board-name'];
                $identityName = $identity[0]['name'];

                $API->disconnect();

                return response()->json([
                    'status' => 'success',
                    'title' => 'MikroTik Status Checked',
                    'message' => 'MikroTik is online',
                    'routerOSVersion' => $routerOSVersion,
                    'boardName' => $boardName,
                    'identityName' => $identityName,
                    
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
