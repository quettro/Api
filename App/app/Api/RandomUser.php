<?php

namespace App\Api;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class RandomUser
{
    /**
     * @var int
     */
    private int $timeout = 60;

    /**
     * @var int
     */
    private int $connectTimeout = 60;

    /**
     * @var mixed
     */
    private mixed $endpoint = 'https://randomuser.me/api/';

    /**
     * @var array
     */
    private array $query = [];

    /**
     * @var Response|null
     */
    private Response|null $response = null;

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @return Collection
     */
    public function getCollectionFromResponse(): Collection
    {
        return $this->response->collect('results');
    }

    /**
     * @param array|string $value
     * @return $this
     */
    public function setInc(array|string $value): static
    {
        $this->query['inc'] = is_array($value) ? implode(',', $value) : $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setCount(int $value): static
    {
        $this->query['results'] = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setTimeout(int $value): static
    {
        $this->timeout = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setConnectTimeout(int $value): static
    {
        $this->connectTimeout = $value;

        return $this;
    }

    /**
     * @param Response $response
     * @return void
     * @throws RequestException
     */
    public function toExceptionIf(Response $response): void
    {
        if ($response->failed() || $response->json('error') !== null)
            throw new RequestException($response);
    }

    /**
     * @return $this
     * @throws RequestException
     */
    public function fetch(): static
    {
        $client = Http::baseUrl($this->endpoint)->connectTimeout($this->connectTimeout)->timeout($this->timeout);

        $this->response = $client->get('/', $this->getQuery());
        $this->response->throwIf(fn (Response $response) => $this->toExceptionIf($response));

        return $this;
    }
}
