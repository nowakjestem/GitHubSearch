<?php


namespace Nowakjestem\GitHub\Services;


use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasOrder;
use Nowakjestem\GitHub\Traits\HasSort;

class LabelsSearchService extends BaseSearchService
{
    use HasKeywords, HasSort, HasOrder;

    protected string $endpoint = '/search/labels';

    protected int $repositoryId;

    protected function buildQuery(): string
    {
        return http_build_query([
            'repository_id' => $this->getRepositoryId(),
            'q' => implode('+', $this->getKeywords()),
            'sort' => $this->getSort(),
            'order' => $this->getOrder(),
        ]);
    }

    public function getRepositoryId(): int
    {
        return $this->repositoryId;
    }

    public function setRepositoryId(int $repositoryId): LabelsSearchService
    {
        $this->repositoryId = $repositoryId;
        return $this;
    }
}
