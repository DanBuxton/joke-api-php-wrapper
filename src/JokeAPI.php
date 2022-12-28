<?php

namespace JokeApiWrapper;

use Exception;
use JokeApiWrapper\Models\Joke;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JokeAPI
{
    private string $api_base_url = 'https://v2.jokeapi.dev/joke/';

    private HttpClientInterface $client;

    public function __construct() {
        $this->client = HttpClient::create();
    }

    /**
     * @throws Exception
     */
    public function get_random_joke(): Joke
    {
        return Joke::make($this->make_api_call('get', $this->api_base_url));

//        throw new Exception('Not implemented');
    }

    /**
     * @throws Exception
     * @throws TransportExceptionInterface
     */
    public function create_random_joke(): Joke
    {
        return Joke::make($this->make_api_call('post', $this->api_base_url, ['body'=>null]));

//        throw new Exception('Not implemented');
    }

    /**
     * @throws Exception
     */
    private function make_api_call(string $method, string $url, array $options = null): array
    {
        try {
            $response = $this->client->request($method, $url, $options);

            if ($response->getStatusCode() >= 300)
            {
                //TODO: Use custom exception
                throw new Exception('API response error');
            }
        }
        catch (TransportExceptionInterface $e)
        {
//            TODO: Use custom exception
            throw new Exception('API response error');
        }

        try {
            $json = json_decode($response->getContent(), true);

            if ($json === null || $json === false)
            {
                throw new Exceptions\MalformedResponse();
            }

            return $json;
        }
        catch (TransportExceptionInterface $e)
        {
//            TODO: Use custom exception
            throw new Exception('Malformed response');
        }
    }
}

