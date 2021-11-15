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

                /* validar los datos que llegan, en caso de no ser correcto, hay que mostrar el error en pantalla (react, mediante el status). se me ocurre que mediante el return de laravel, le puedo enviar una respuesta a react y de alli sumarlo a la logica empleada en el componenete coontact y fromMensaje  */

                Usuarios::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'message' => $request->message
                ]);

                $details = [
                    'name' => 'Name: ' . $request->name,
                    'email' => 'Email: ' . $request->email,
                    'phone' => 'Phone: ' .$request->phone,
                    'messsage' => 'Message: ' . $request->message,
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
