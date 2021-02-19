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

        $cards =  card::where('name','like','%'. $cardname .'%')->get();

        $response= [];

        foreach ($cards as $card) {

            $response[] = [
                "id" => $card->id,
                "nombre" => $card->name,
                "coleccion" => $card->collection,
                "descripcion" => $card->description   
            ];

        }


        return response()->json($response);
    }
    public function listaCompra(Request $request, $name){

        $response = [];
        $error = "No hay cartas con ese nombre.";
        $compras = venta::orderBy('precio','asc')->get();

        $cards = card::where('name','like','%'. $name .'%')->get()->first();

        if (is_null($cards)) {
            $response[] =[
                'Error' => $error
            ];
        }elseif(str_contains($cards, $name)){

            for ($i=0; $i < count($compras) ; $i++) { 
               $card = card::find($compras[$i]->card_id);
               $user = User::find($compras[$i]->user_id);

               if( str_contains( $card->name, $name)){
                $response[] =[

                    'name' => $card->name,
                    'quantity' => $compras[$i]->stok,
                    'price' => $compras[$i]->precio,
                    'vendedor' => $user->nombre
                ];

            }
        }
        echo"estas son todas las ventas:";       
    }   
    return response()->json($response);
}

}
