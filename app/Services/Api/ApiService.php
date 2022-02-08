<?php

declare(strict_types=1);

namespace App\Services\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Utils;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Log;

class ApiService
{
    public const API_SERVICE_NAMESPACE = 'API Service: ';

    /**
     * @var array
     */
    protected $response = [];

    /**
     * @param string $url
     *
     * @return Collection|null
     */
    protected function get(string $url): ?Collection
    {
        return $this->request('GET', $url);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @param bool $topLevel
     *
     * @return Collection|null
     */
    protected function request(
        string $method,
        string $url,
        array $params = [],
        bool $topLevel = true
    ): ?Collection {
        try {
            $client = new Client();
            $response = $client->request($method, $url, $params);

            if (! isset($params['headers'])) {
                $params['headers'] = [
                    'Accept' => 'application/json'
                ];
            }

            if ($response) {
                $data = Utils::jsonDecode($response->getBody()->getContents(), true);

                $this->response = array_key_exists('results', $data) ?
                    array_merge($this->response, $data['results']) : $data;

                if (isset($data['next'])) {
                    $this->request($method, $data['next'], $params, false);
                }
            }
        } catch (GuzzleException $e) {
            Log::error(self::API_SERVICE_NAMESPACE . $e->getMessage());
        }

        return $topLevel ? ($this->response ? collect($this->response) : null) : null;
    }
}
