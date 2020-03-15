<?php


namespace Nowakjestem\GitHub\Services;


use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasQualifiers;

class TopicSearchRepository extends BaseSearchService
{
    use HasKeywords, HasQualifiers;

    protected string $endpoint = '/search/topics';

    protected function buildQuery(): string
    {
        return http_build_query([
            'q' => implode('+', $this->getKeywords() + $this->getQualifiers()),
        ]);
    }
}
