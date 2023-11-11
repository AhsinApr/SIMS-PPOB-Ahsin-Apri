<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('Auth/Login');
    }

    public function register()
    {
        // Memuat layanan sesi
        // $this->session = \Config\Services::session();

        // Periksa apakah metode request adalah POST
        if ($this->request->getMethod() === 'post') {
            $postData = $this->request->getPost();

            // Memastikan semua field wajib diisi
            if (empty($postData['email']) || empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['password'])) {
                return $this->failValidationError('Semua field wajib diisi sebelum registrasi.');
            }

            // Kirim data ke API untuk registrasi
            $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/registration';
            $httpClient = \Config\Services::curlrequest();

            $response = $httpClient->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $postData,
            ]);

            // Cek apakah registrasi sukses atau gagal
            $responseData = json_decode($response->getBody(), true);

            // Cek apakah registrasi sukses atau gagal
            if ($response->getStatusCode() == 200) {
                // Registrasi sukses
                session()->setFlashdata('success', $responseData['message']);
            } else {
                // Registrasi gagal
                session()->setFlashdata('error', $responseData['message']);
            }

            // Redirect kembali ke halaman registrasi
            return redirect()->to('/viewregister');
        }


        return view('/viewregister');
    }

    public function viewregister()
    {
        return view('Auth/Registrasi');
    }
    public function authenticate()
    {
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/login';
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $postData = [
            'email' => $email,
            'password' => $password,
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($result['status'] == 0) {
            $token = $result['data']['token'];

            // Simpan token di sesi CodeIgniter
            session()->set('token', $token);


            return redirect()->to(base_url('/user'));
        } else {
            // Tampilkan pesan error jika login gagal
            return redirect()->to(base_url('/'))->with('error', 'Login failed.');
        }
    }
}
