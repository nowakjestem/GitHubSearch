<?php


namespace Nowakjestem\GitHub\Services;


use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class BaseSearchService
{
    protected string $endpoint;

    /**
     * Builds a query string
     *
     * @return string
     */
    abstract protected function buildQuery(): string;

    /**
     * Executes search
     *
     * @param bool|null $withTextMatches
     * @return Response
     */
    public function search(?bool $withTextMatches = false): Response
    {
        $query = $this->buildQuery();

        $fullUrl = config('github.domain') . $this->endpoint . '?' . $query;

        $client = Http::asJson();

        if ($withTextMatches) {
            $client = $client->withHeaders([
                'Accept' => 'application/vnd.github.v3.text-match+json',
            ]);
        }

        return $client->get($fullUrl);
    }
}
