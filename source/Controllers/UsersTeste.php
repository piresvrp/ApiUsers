<?php 
namespace Source\Controllers;

require "../../vendor/autoLoad.php";

require "../config.php";
use Source\Models\Validations;
use Source\Models\Users as User;
echo "teeste";
class UsersTeste
{
  
    public function index()
    {
        echo "hshshs";
    }
    public function create()
    {
        echo("teste");
        $data = json_decode(json_decode(file_get_contents("php://input"), false));
        var_dump($data);
        die;
        if (!$data) {
            header("HTTP 1.1/ 401 UNAUTHORIZED");
            echo  json_encode(array("response"=> "nenhum dado encontrado"));
        }
 
        $erros = array();
 
        if (!Validations::validationString($data->first_name)) {
            array_push($erros, "Nome");
        }
         
        if (!Validations::validationString($data->last_name)) {
            array_push($erros, "Sobrenome");
        }
         
        if (!Validations::validationEmail($data->email)) {
            array_push($erros, "Email");
        }
 
        if (count($erros) > 0) {
            header("HTTP 1.1/ Bad request");
            echo json_encode(array("responde"=>"Ha erros em seu formulario \n", "Fields"=>$erros));
        }

        $user = new User();
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $userId = $user->save();

        if ($user->fail()) {
            header("HTTP 1.1/ Internal Server Error");
            echo json_encode(array("response"=>$user->fail()->getMessage()));
            exit;
        }
        header("HTTP 1.1/ Created");
        echo json_encode(array("response"=>"User Criado com sucesso"));
    }
    public function getBy()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}