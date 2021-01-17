<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\card;    
use App\Models\collection;
class collectionController extends Controller
{
   
    public function updatecollection(Request $request, $id){
        $response = "";
        //Buscar el collection por su id
        $collection = collection::find($id);
        if($collection){
            //Leer el contenido de la petición
            $data = $request->getContent();
            //Decodificar el json
            $data = json_decode($data);
            //Si hay un json válido, buscar el collection
            if($data){
                //TODO: Validar los datos antes de guardar el collection
                $collection->name = (isset($data->name) ? $data->name : $collection->name);
                $collection->simbol = (isset($data->simbol) ? $data->simbol : $collection->simbol);
                try{
                    $collection->save();
                    $response = "OK";
                }catch(\Exception $e){
                    $response = $e->getMessage();
                }
            }
        }else{
            $response = "No collection";
        }
        return response($response);
    }
}