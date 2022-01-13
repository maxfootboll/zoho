<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ClientController extends Controller
{	

	public function ZohoApiKayCreate(){
	
	$token = json_decode(file_get_contents('token.json'));

	if (isset($token->refresh_token)) {	
	$answer = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
	"refresh_token" => $token->refresh_token,
    "grant_type" => "refresh_token",
    "client_id" => "1000.A9Y0AY4NT94Q53NI2MGDRUVOQOEIML",
    "client_secret" => "e15351a1005f53fc20193b63f701c93105dc592ede"]);
	}
	return  $answer;
	}
	

    public function lead( Request $data )
    {
 		$token =  json_decode(ClientController::ZohoApiKayCreate());

 		$prepeaRequst = ['Deal_Name' => $data->DealName, 'Stage' => 'Picklist', 'Pipeline' => '5171589000000006801'];

 		$newDeal = (new InsertRecords())->zohoCreate($token->access_token, 'Deals', $prepeaRequst);

 		$prepeaRequst = ['Subject' => $data->SubjectTask, 'What_Id' => $newDeal['data'][0]['details']['id'], '$se_module' => 'Deals'];

 		$newTask = (new InsertRecords())->zohoCreate($token->access_token, 'Tasks', $prepeaRequst);

 		$answer = 'Данные добавленны';
 		return view('zoholead', compact('answer'));
    }
}