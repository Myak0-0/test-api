<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $host = 'http://109.73.206.144:6969';
    protected $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

    public function fetchData($point, $params = [])
    {
        $response = Http::get("{$this->host}/api/{$point}", $params);

        return $response->json();
    }
}
