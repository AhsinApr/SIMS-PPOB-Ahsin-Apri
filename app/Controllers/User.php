<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    // public function index()
    // {
    //     $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/profile';
    //     $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/banner';
    //     $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/services';
    //     $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/balance';

    //     $token = session('token'); 

    //     $ch = curl_init($apiUrl);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         'Authorization: Bearer ' . $token,
    //     ]);

    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     $result = json_decode($response, true);

    //     if ($result['status'] == 0) {
    //         $data['profile'] = $result['data'];
    //         return view('/User/index', $data);
    //     } else {

    //         return redirect()->to(base_url('/'))->with('error', 'Failed to fetch profile.');
    //     }

    //     // return view('/User/index');
    // }
    public function index()
    {
        $profileUrl = 'https://take-home-test-api.nutech-integrasi.app/profile';
        $bannerUrl = 'https://take-home-test-api.nutech-integrasi.app/banner';
        $servicesUrl = 'https://take-home-test-api.nutech-integrasi.app/services';
        $balanceUrl = 'https://take-home-test-api.nutech-integrasi.app/balance';

        $token = session('token');

        // Mengambil data dari API profile
        $profileData = $this->fetchApiData($profileUrl, $token);

        // Mengambil data dari API banner
        $bannerData = $this->fetchApiData($bannerUrl, $token);

        // Mengambil data dari API services
        $servicesData = $this->fetchApiData($servicesUrl, $token);

        // Mengambil data dari API balance
        $balanceData = $this->fetchApiData($balanceUrl, $token);

        return view('/User/index', [
            'profile' => $profileData['status'] == 0 ? $profileData['data'] : null,
            'banner' => $bannerData['status'] == 0 ? $bannerData['data'] : null,
            'services' => $servicesData['status'] == 0 ? $servicesData['data'] : null,
            'balance' => $balanceData['status'] == 0 ? $balanceData['data'] : null,
        ]);
        // $data = [
        //     'profile' => $profileData['status'] == 0 ? $profileData['data'] : null,
        //     'banner' => $bannerData['status'] == 0 ? $bannerData['data'] : null,
        //     'services' => $servicesData['status'] == 0 ? $servicesData['data'] : null,
        //     'balance' => $balanceData['status'] == 0 ? $balanceData['data'] : null,
        // ];
        // // dd($data);
        // return view('User/index', $data);
    }

    // Fungsi untuk mengambil data dari API menggunakan cURL
    private function fetchApiData($apiUrl, $token)
    {
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }




    // akun


    public function akun()
    {
        // Ambil data profile dari API
        $profileData = $this->fetchApiData('https://take-home-test-api.nutech-integrasi.app/profile', session('token'));

        // Kirim data ke view
        return view('User/akun', [
            'profile' => $profileData['status'] == 0 ? $profileData['data'] : null,
        ]);
    }

    public function updateProfile()
    {
        // Ambil data dari formulir
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');

        // Token dari sesi
        $token = session('token');

        // Data yang akan dikirim ke API
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
        ];

        // Kirim request ke API untuk pembaruan profil
        $result = $this->sendApiRequest('https://take-home-test-api.nutech-integrasi.app/profile/update', $token, $data);
        // dd($result);
        if ($result['status'] == 0) {
            session()->setFlashdata('success', $result['message']);
            return redirect()->to('/akun'); // Redirect to user profile page
        } else {
            session()->setFlashdata('error', $result['message']);
            return redirect()->to('/akun'); // Redirect to user profile page even on error
        }
        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }
    private function sendApiRequest($url, $token, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Set the request method to PUT
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);

            return [
                'status' => -1,
                'message' => 'Failed to connect to the API. Error: ' . $error,
            ];
        }

        curl_close($ch);

        if ($httpCode >= 400) {
            return [
                'status' => $httpCode,
                'message' => 'API request failed with HTTP code ' . $httpCode,
            ];
        }

        $result = json_decode($response, true);

        if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => -2,
                'message' => 'Invalid JSON response from the API. Error: ' . json_last_error_msg(),
            ];
        }

        return $result;
    }

    // topup
    public function topup()
    {
        $profileUrl = 'https://take-home-test-api.nutech-integrasi.app/profile';
        $balanceUrl = 'https://take-home-test-api.nutech-integrasi.app/balance';

        $token = session('token');

        $profileData = $this->fetchApiData($profileUrl, $token);
        $balanceData = $this->fetchApiData($balanceUrl, $token);

        return view('/User/topup', [
            'profile' => $profileData['status'] == 0 ? $profileData['data'] : null,
            'balance' => $balanceData['status'] == 0 ? $balanceData['data'] : null,
        ]);
    }
    public function updateTopup()
    {
        $token = session('token');
        // dd($token);
        $jwtPayload = json_decode(base64_decode(explode('.', $token)[1]), true);
        $userEmail = $jwtPayload['email'];

        $topUpAmount = $this->request->getPost('top_up_amount');

        // Validate amount
        if (!is_numeric($topUpAmount) || $topUpAmount < 0) {
            return redirect()->to('/topup')->with('error', 'Amount must be a number and cannot be less than 0');
        }

        // Prepare data for API request
        $data = [
            'top_up_amount' => $topUpAmount,
            'email' => $userEmail,
        ];

        // Send API request
        $result = $this->sendApiRequestopup('https://take-home-test-api.nutech-integrasi.app/topup', $token, $data);

        // Handle API response
        if ($result['status'] == 0) {
            // Top Up success
            // Perform actions such as updating the database, displaying success message, etc.
            return redirect()->to('/topup')->with('success', $result['message']);
        } else {
            // Top Up failed
            // Handle error, display error message, etc.
            return redirect()->to('/topup')->with('error', $result['message']);
        }
    }

    private function sendApiRequestopup($url, $token, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);

            return [
                'status' => -1,
                'message' => 'Failed to connect to the API. Error: ' . $error,
            ];
        }

        curl_close($ch);

        if ($httpCode >= 400) {
            return [
                'status' => $httpCode,
                'message' => 'API request failed with HTTP code ' . $httpCode,
            ];
        }

        $result = json_decode($response, true);

        if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => -2,
                'message' => 'Invalid JSON response from the API. Error: ' . json_last_error_msg(),
            ];
        }

        return $result;
    }
    // transaction
    public function transaction()
    {
        $profileUrl = 'https://take-home-test-api.nutech-integrasi.app/profile';
        $balanceUrl = 'https://take-home-test-api.nutech-integrasi.app/balance';
        $riwayatUrl = 'https://take-home-test-api.nutech-integrasi.app/transaction/history';

        $token = session('token');

        // Mengambil data dari API profile

        $profileData = $this->fetchApiData($profileUrl, $token);
        $riwayatData = $this->fetchApiData($riwayatUrl, $token);
        // Mengambil data dari API balance
        $balanceData = $this->fetchApiData($balanceUrl, $token);

        return view('/User/transaction', [
            'profile' => $profileData['status'] == 0 ? $profileData['data'] : null,
            'balance' => $balanceData['status'] == 0 ? $balanceData['data'] : null,
            'riwayat' => $riwayatData['status'] == 0 ? $riwayatData['data'] : null,
        ]);
        // $data = [
        //     'profile' => $profileData['status'] == 0 ? $profileData['data'] : null,
        //     'balance' => $balanceData['status'] == 0 ? $balanceData['data'] : null,
        //     'riwayat' => $riwayatData['status'] == 0 ? $riwayatData['data'] : null,
        // ];
        // dd($data);
    }

    public function logout()
    {

        return redirect()->to('/')->with('success', 'Logout successful');
    }
}
