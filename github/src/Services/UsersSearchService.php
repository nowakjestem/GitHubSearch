<?php


namespace Nowakjestem\GitHub\Services;


use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasOrder;
use Nowakjestem\GitHub\Traits\HasQualifiers;
use Nowakjestem\GitHub\Traits\HasSort;

class UsersSearchService extends BaseSearchService
{
    use HasKeywords, HasQualifiers, HasOrder, HasSort;

    protected string $endpoint = 'search/users';

    protected function buildQuery(): string
    {
        return http_build_query([
            'q' => implode('+', $this->getKeywords() + $this->getQualifiers()),
            'sort' => $this->getSort(),
            'order' => $this->getOrder(),
        ]);
    }

    /**
     * Filter by type
     *
     * @param string $type
     * @return $this
     */
    public function byType(string $type): self
    {
        return $this->addStringQualifier('type', $type);
    }

    /**
     * Filter by number of repositories
     *
     * @param int $number
     * @param string|null $operator
     * @return $this
     */
    public function addReposNumberQualifier(int $number, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('repos', (string)$number, $operator);
    }

    /**
     * Filter by range of number of repositories
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addReposRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('repos', $first, $second);
    }

    /**
     * Filter by location
     *
     * @param string $location
     * @return $this
     */
    public function byLocation(string $location): self
    {
        return $this->addStringQualifier('location', $location);
    }

    /**
     * Filter by language
     *
     * @param string $language
     * @return $this
     */
    public function byLanguage(string $language): self
    {
        return $this->addStringQualifier('language', $language);
    }

    /**
     * Filter by creation date
     *
     * @param string $date
     * @param string|null $operator
     * @return $this
     */
    public function addCreatedQualifier(string $date, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('created', $date, $operator);
    }

    /**
     * Filter by creation date in range
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addCreatedRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('created', $first, $second);
    }

    /**
     * Filter by followers count
     *
     * @param int $followers
     * @param string|null $operator
     * @return $this
     */
    public function addFollowersQualifier(int $followers, ?string $operator): self
    {
        return $this->addSingleRangeQualifier('followers', $followers, $operator);
    }

    /**
     * Filter by followers count in range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addFollowersRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('followers', $first, $second);
    }
}
