<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Models\User;
use App\Models\venta;
use App\Models\card;
use App\Models\Colection;

class VentaController extends Controller
{
    //
    public function createVenta(Request $request)
    {
       
        $response = "";
      
        //Leer el contenido de la petición
        $data = $request->getContent();

        //Decodificar el json
        $data = json_decode($data);

        //Si hay un json válido, crear el venta
        if($data){
            $venta = new venta();
           //buscamos los datos del ususario
            $usuario = User::where('nombre', $data->usuario)->get()->first();
            //buscamos los datos de la carta
         
            //TODO: Validar los datos antes de guardar el venta
             $venta->card_id = $data->card_id;
            //guardamos el id del ususario
            $venta->user_id = $usuario->id;
            $venta->stok = $data->stok;
            $venta->precio = $data->precio;
         
            try{
                $venta->save();
               
                $response = "OK";
            }catch(\Exception $e){
                $response = $e->getMessage();
            }

        }

        return response($response);
    }
    
    public function cardsList($cardname){

        $response = "";

        $cards = card::where('name', stripos(,$cardname))->get()->first();

        $response= [];

        foreach ($cards as $card) {
            $response[] = [
                "id" => $cards->id,
                "nombre" => $cards->name,
                "coleccion" => $cards->collection,
                "descripcion" => $cards->description
                
                
            ];
        
        }


        return response()->json($response);
    }
    }
