<?php

namespace App\Controllers;

use App\Models\Customers;

class SearchController extends AppController
{
    public function index()
    {
        $request = new \Request;
        $data = $request->get('q');

        $params = [];
        if (isset($data)) {
            $customers = new Customers;
            $customersSearch = $customers->search($data);
            $params['customers'] = $customersSearch;
            $params['customers_count'] = count($customersSearch);
            $params['query'] = $data;
        }

        return view('search', $params);
    }

    public function updateData(\Request $request)
    {
        $data = $request->get('lang');
        $resources = [
            'en' => env('MOCKY_ID_EN', '5d9f39263000005d005246ae'),
            'es' => env('MOCKY_ID_ES', '5d9f38fd3000005b005246ac'),
        ];

        $customerData = new \CustomerData;
        $response = $customerData->request(
            'GET',
            'http://www.mocky.io/v2/' . $resources[$data ?? 'en'] . '?mocky-delay=10s'
        );

        if ($response) {
            $customers = new Customers;
            $customers->truncate();
            $customers->insert($customers->validateData($response['objects'], ($data ?? 'en')));

            return json(['message' => 'Success'], 200);
        }

        return json(['message' => 'Error'], 500);
    }
}
