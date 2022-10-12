// $client = new \GuzzleHttp\Client(['cookies' => true]);
        // $jar = new \GuzzleHttp\Cookie\CookieJar;
        // $r = $client->request('GET', 'http://httpbin.org/cookies', [
        //     'cookies' => $jar
        // ]);
        $client = new Client();
        $id = "SNK-778034308"; //$request->transaction_id;
        $requestPaymentVerify = $client->request('GET', 'https://api.flutterwave.com/v3/transactions/{$id}/verify', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer FLWSECK_TEST-b4d2f626639fadc77e5187e428352e2b-X' //self::flutterToken()
                ],
                'http_errors' => false,

        ]);
        $response = json_decode($requestPaymentVerify->getBody()->getContents(), true);
        // 3525016
        // $response = $request->getBody()->getContents();
        return $response;
       
        // if($response['status'] == "successful"){
        //     $query = DB::table('payments')->insert([
        //         'user_id' => session('LoggedUser'),
        //         'amount' => $response['data']['amount'],
        //         'currency' => $response['data']['currency'],
        //         'payment_id' => $response['data']['transaction_id'],
        //         'reference' => $response['data']['tx_ref'],
        //         'message' => $response['status']
        //     ]);
           
        //     if($query){
        //         $newAmount = $response['data']['amount'];
        //         $user_id = session('LoggedUser');

        //         $update_balance = DB::table('wallet_balance')
        //                         ->where('user_id', $user_id)
        //                         ->increment('user_balance', $newAmount);

        //         return $response;
        //     }else{
        //         return "Error occured";
        //     }
        // }else{
        //     $response ="Payment could not be completed";
        //     return $response;
        // }



        {{-- {{ substr(rand(0,time()), 0,7) }} --}}