<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KhipuController extends Controller
{




    public function index()
    {
        return view('khipu');
    }





    public function obtenerBancos()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "x-api-key: b8fc13d0-b4d6-4e49-8af9-7ed7704c2de4"
            ],
            CURLOPT_URL => "https://payment-api.khipu.com/v3/banks",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);



        if ($error) {
            return view('khipu', ['error' => $error]);
        } else {
            $bancos = json_decode($response, true)['banks'];
            return view('khipu', ['bancos' => $bancos]);
        }




    }





    public function crearCobro()
    {
        $apiKey = 'b8fc13d0-b4d6-4e49-8af9-7ed7704c2de4'; // Tu API key

        $payload = [
            "amount" => 1000,
            "currency" => "CLP",
            "subject" => "Cobro de prueba desde Laravel"
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => $apiKey,
        ])->post('https://payment-api.khipu.com/v3/payments', $payload);

        if ($response->successful()) {
            $resultado = $response->json();
            return redirect($resultado['payment_url']); // Te redirige al pago
        } else {
            return response()->json([
                'error' => $response->body()
            ], 500);
        }
    }




}
