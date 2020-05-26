<?php 
namespace Source\Controllers;


require "../../vendor/autoLoad.php";

require "../config.php";
use Source\Models\Validations;
use Source\Models\Users as User;

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        $data = json_decode(file_get_contents("php://input"), false);
       if(!$data){
            header("HTTP 1.1/ 401 UNAUTHORIZED");
           echo  json_encode(array("response"=> "nenhum dado encontrado"));
        }

        $erros = array();

        if(!Validations::validationString($data->first_name)){
            array_push($erros, "Nome");
     }
        
        if(!Validations::validationString($data->last_name)){
         array_push($erros, "Sobrenome");
        }
        
        if(!Validations::validationEmail($data->email)){
            array_push($erros, "Email");
        }

        if(count($erros) > 0){
            header("HTTP 1.1/ Bad request");
            echo json_encode(array("responde"=>"Ha erros em seu formulario \n", "Fields"=>$erros));
        break;
        }
        $user = new User();
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;

       
        $userId = $user->save();

        if($user->fail()){
            header("HTTP 1.1/ Internal Server Error");
            echo json_encode(array("response"=>$user->fail()->getMessage()));
            exit;
        }

        header("HTTP 1.1/ Created");
        echo json_encode(array("response"=>"User Criado com sucesso"));

        break;  
        
    case "GET":
        header("HTTP 1.1/ 200 ok");
        $users = new User();
       
        if($users->find()->Count() > 0){
            $return = array();
            foreach($users->find()->fetch(true) as $user){
                array_push($return, $user->data());
            }
            echo json_encode(array("responde"=>$return));
        }else{
            echo json_encode(array("responde"=>"Nenhum usuario Encontrado"));
        }

    break;

    case "PUT":
        $user_id = filter_input(INPUT_GET, "id");
        if(!$user_id){
            header("HTTP:// USUER bad request");
            echo json_encode(array("response"=>"user not found"));
            break;
        }

        $data = json_decode(file_get_contents("php://input"), false);

        if(!$data){
            header("HTTP 1.1/ 401 UNAUTHORIZED");
           echo  json_encode(array("response"=> "nenhum dado encontrado"));
            break;
        }


        $erros = array();

        if(!Validations::validationString($data->first_name)){
            array_push($erros, "Nome");
        }
        
        if(!Validations::validationString($data->last_name)){
         array_push($erros, "Sobrenome");
        }
        
        if(!Validations::validationEmail($data->email)){
            array_push($erros, "Email");
        }

        if(count($erros) > 0){
            header("HTTP 1.1/ Bad request");
            echo json_encode(array("responde"=>"Ha erros em seu formulario \n", "Fields"=>$erros));
            break;
        }

        $user = (new User())->findById($user_id);
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;

        if($user->fail()){
            header("HTTP 1.1/ Internal Server Error");
            echo json_encode(array("response"=>$user->fail()->getMessage()));
            exit;
        }
        $user->save();
        header("HTTP 1.1/ Created");
        echo json_encode(array("response"=>"User Editado com sucesso"));

        break;  

       

    break;




    default:
        header("HTTP 1.1/ 401 UNAUTHORIZED");
        echo  json_encode(array("response"=> "method not prevent at api"));
        break;
}


