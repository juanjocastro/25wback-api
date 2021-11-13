<?php

namespace App\Http\Controllers;

use App\Mail\SendData;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;




class ApiUsuariosController extends Controller
{
    public function saveUsuarios(Request $request)
    {
        try {
            if($request->email) {

                Usuarios::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'message' => $request->message
                ]);

                $details = [
                    'title' => 'PIN - Martinez, Valentina y Storero, Franco',
                    'body' => 'Email de prueba'
                ];

                Mail::to("proyecto25wsmpt@gmail.com")->send(new SendData($details));

                //return json_encode(['status' => 'ok']);
                return 'Email ENVIADO';
            }
            
            //return $request;
            //return json_encode($request);

        } catch (\ErrorException $e) {
            return json_encode(['status' => 'faild', 'message' => $e->getMessage()]);
        }
    }
}
