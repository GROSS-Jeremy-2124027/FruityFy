<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiDiscogsService
{
private $urlApi;

private $discogsKey;

private $apiSecret;


    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->urlApi = $parameterBag->get('urlApi');
        $this->discogsKey = $parameterBag->get('discogsKey');
        $this->apiSecret = $parameterBag->get('apiSecret');
    }

    public function getUrlApi(): \UnitEnum|float|int|bool|array|string|null
    {
        return $this->urlApi;
    }

    public function getDiscogsKey(): \UnitEnum|float|int|bool|array|string|null
    {
        return $this->discogsKey;
    }

    public function getApiSecret(): \UnitEnum|float|int|bool|array|string|null
    {
        return $this->apiSecret;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function queryAll($fruit, $genre = '', $artiste='', $type="all", $year='', $format='', $I_page = 1, $perPage = 20): \Symfony\Contracts\HttpClient\ResponseInterface
    {
        $client = HttpClient::create();
        return $client->request('GET', $this->getUrlApi() . '/database/search', [
            'query' => [
                'q' => $fruit,
                'type' => $type,
                'genre' => $genre,
                'format' => $format,
                'artist' => $artiste,
                'year' => $year,
                'page' => $I_page,
                'per_page' => $perPage
            ],
            'headers' => [
                'Authorization' => 'Discogs key=' .$this->getDiscogsKey() . ', secret=' .$this->getApiSecret()
            ]
        ]);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function queryMaster($fruit, $I_page = 1, $perPage = 8): \Symfony\Contracts\HttpClient\ResponseInterface
    {
        $client = HttpClient::create();
        return $client->request('GET', $this->getUrlApi() . '/database/search', [
            'query' => [
                'q' => $fruit,
                'type' => 'master',
                'page' => $I_page,
                'per_page' => $perPage
            ],
            'headers' => [
                'Authorization' => 'Discogs key=' .$this->getDiscogsKey() . ', secret=' .$this->getApiSecret()
            ]
        ]);
    }

    public function queryGetMaster($discogsId): \Symfony\Contracts\HttpClient\ResponseInterface
    {
        $client = HttpClient::create();
        return $client->request('GET', $this->getUrlApi() . '/masters/' . $discogsId, [
            'query' => [
//               ' 'q' => $fruit,
//                'type' => 'master',
//                'page' => $I_page,
//                'per_page' => $perPage'
            ],
            'headers' => [
                'Authorization' => 'Discogs key=' .$this->getDiscogsKey() . ', secret=' .$this->getApiSecret()
            ]
        ]);
    }

}