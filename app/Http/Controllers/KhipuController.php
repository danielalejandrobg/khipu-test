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





    public function getBanks()
    {
        $apiKey = env('KHIPU_API_KEY');
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "x-api-key: {$apiKey}"
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








    public function createPayment(Request $request)
    {


        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $apiKey = env('KHIPU_API_KEY');
        $amount = (int) $request->input('amount');

        $payload = [
            "amount" => $amount,
            "currency" => "CLP",
            "subject" => "Cobro de prueba desde Laravel"
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => $apiKey,
        ])->post('https://payment-api.khipu.com/v3/payments', $payload);

        if ($response->successful()) {
            $resultado = $response->json();
            return view('pago', [
                'payment_id' => $resultado['payment_id']
            ]);
        } else {
            return response()->json([
                'error' => $response->body()
            ], 500);
        }
    }








    public function getPaymentById($id)
    {
        $apiKey = env('KHIPU_API_KEY');

        $response = Http::withHeaders([
            'x-api-key' => $apiKey
        ])->get("https://payment-api.khipu.com/v3/payments/{$id}");

        if ($response->successful()) {
            $pago = $response->json();
            return view('estado-pago', ['pago' => $pago]);
        } else {
            return view('khipu', ['error' => 'Error al obtener el estado del pago: ' . $response->body()]);
        }
    }




    public function deletePaymentById($id)
    {
        $apiKey = env('KHIPU_API_KEY');

        $response = Http::withHeaders([
            'x-api-key' => $apiKey
        ])->delete("https://payment-api.khipu.com/v3/payments/{$id}");

        if ($response->successful()) {
            return redirect('/')->with('success', 'Pago eliminado correctamente.');
        } else {
            return redirect('/')->withErrors(['error' => 'Error al eliminar el pago: ' . $response->body()]);
        }
    }




}

