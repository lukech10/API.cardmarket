<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Models\User;
use App\Models\Card;
use App\Models\Colection;

class cardController extends Controller
{
    
    public function createCard(Request $request)
    {
      
        $response = "";

        //Leer el contenido de la petición
        $data = $request->getContent();

        //Decodificar el json
        $data = json_decode($data);

        //Si hay un json válido, crear el card
        if($data){
            $card = new Card();
           
            //TODO: Validar los datos antes de guardar el card

          
            $card->name = $data->name;
            $card->description = $data->description;
            $card->collection = $data->collection;
            $namecollection = $data->collection;
           
            if (Colection::where('namecollection', $namecollection)->get()->first()) {
                 echo "Carta añadida a colección ya existente";
            
            } else{
               $colection = new colection();
                $colection->namecollection = $data->collection;
                $colection->save();
            }
            
         
            try{
                $card->save();
               
                $response = "OK";
            }catch(\Exception $e){
                $response = $e->getMessage();
            }

        }

        return response($response);
    
    }}
