<?php

namespace Nowakjestem\GitHub\Services;

use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasOrder;
use Nowakjestem\GitHub\Traits\HasQualifiers;
use Nowakjestem\GitHub\Traits\HasSort;

class RepositorySearchService extends BaseSearchService
{
    use HasKeywords, HasQualifiers, HasSort, HasOrder;

    protected string $endpoint = '/search/repositories';

    protected function buildQuery(): string
    {
        return http_build_query([
            'q' => implode('+', $this->getKeywords() + $this->getQualifiers()),
            'sort' => $this->getSort(),
            'order' => $this->getOrder(),
        ]);
    }

    /**
     * Search keywords in name
     *
     * @return RepositorySearchService
     */
    public function inName()
    {
        return $this->addStringQualifier('in', 'name');
    }
    /**
     * Search keywords in description
     *
     * @return RepositorySearchService
     */
    public function inDescription()
    {
        return $this->addStringQualifier('in', 'description');
    }
    /**
     * Search keywords in readme
     *
     * @return RepositorySearchService
     */
    public function inReadme()
    {
        return $this->addStringQualifier('in', 'readme');
    }

    /**
     * Filter by user
     *
     * @param string $username
     * @return $this
     */
    public function byUser(string $username): self
    {
        return $this->addStringQualifier('user', $username);
    }

    /**
     * Search in organization
     *
     * @param string $organization
     * @return $this
     */
    public function inOrganization(string $organization): self
    {
        return $this->addStringQualifier('org', $organization);
    }

    /**
     * Filters by repository size
     *
     * @param int $size
     * @param string|null $operator
     * @return $this
     */
    public function addSizeQualifier(int $size, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('size', $size, $operator);
    }

    /**
     * Filter by repository size range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addSizeRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('size', $first, $second);
    }

    /**
     * Filters by followers count
     *
     * @param int $followers
     * @param string $operator
     * @return $this
     */
    public function addFollowersQualifier(int $followers, string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('followers', $followers, $operator);
    }

    /**
     * Filters by followers count range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addFollowersRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('followers', $first, $second);
    }

    /**
     * Filters by stars count
     *
     * @param int $stars
     * @param string $operator
     * @return $this
     */
    public function addStarsQualifier(int $stars, string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('stars', $stars, $operator);
    }

    /**
     * Filters by stars count range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addStarsRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('stars', $first, $second);
    }

    /**
     * Filters repositories that were created in given period of time
     *
     * @param string $created
     * @param string|null $operator
     * @return $this
     */
    public function addCreatedQualifier(string $created, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('created', $created, $operator);
    }

    /**
     * Filters repositories that were created in given period of time
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
     * Filters repositories that were pushed in given period of time
     *
     * @param string $pushed
     * @param string|null $operator
     * @return $this
     */
    public function addPushedQualifier(string $pushed, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('pushed', $pushed, $operator);
    }

    /**
     * Filters repositories that were pushed in given period of time
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addPushedRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('pushed', $first, $second);
    }

    /**
     * Filters repositories by language
     *
     * @param string $language
     * @return $this
     */
    public function byLanguage(string $language): self
    {
        return $this->addStringQualifier('language', $language);
    }

    /**
     * Filters repositories by topic
     *
     * @param string $topic
     * @return $this
     */
    public function byTopic(string $topic): self
    {
        return $this->addStringQualifier('topic', $topic);
    }

    /**
     * Filters by topics count
     *
     * @param int $topics
     * @param string $operator
     * @return $this
     */
    public function addTopicsQualifier(int $topics, string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('topics', $topics, $operator);
    }

    /**
     * Filters by topics count range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addTopicsRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('topics', $first, $second);
    }

    /**
     * Filters by license
     *
     * @param string $license
     * @return $this
     */
    public function byLicense(string $license): self
    {
        return $this->addStringQualifier('license', $license);
    }

    /**
     * Search public repositories
     *
     * @return $this
     */
    public function onlyPublic(): self
    {
        return $this->addStringQualifier('is', 'public');
    }

    /**
     * Search private repositories
     *
     * @return $this
     */
    public function onlyPrivate(): self
    {
        return $this->addStringQualifier('is', 'private');
    }

    /**
     * Search mirror repositories
     *
     * @return $this
     */
    public function onlyMirror(): self
    {
        return $this->addStringQualifier('mirror', 'true');
    }

    /**
     * Search non-mirror repositories
     *
     * @return $this
     */
    public function onlyNonMirror(): self
    {
        return $this->addStringQualifier('mirror', 'false');
    }

    /**
     * Search archived repositories
     *
     * @return $this
     */
    public function onlyArchived(): self
    {
        return $this->addStringQualifier('archived', 'true');
    }

    /**
     * Search non-archived repositories
     *
     * @return $this
     */
    public function onlyNonArchived(): self
    {
        return $this->addStringQualifier('archived', 'false');
    }


    /**
     * Filters by good-first-issues count
     *
     * @param int $goodFirstIssues
     * @param string $operator
     * @return $this
     */
    public function addGoodFirstIssuesQualifier(int $goodFirstIssues, string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('good-first-issues', $goodFirstIssues, $operator);
    }

    /**
     * Filters by good-first-issues count range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addGoodFirstIssuesRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('good-first-issues', $first, $second);
    }

    /**
     * Filters by help-wanted-issues count
     *
     * @param int $helpWantedIssues
     * @param string $operator
     * @return $this
     */
    public function addHelpWantedIssuesQualifier(int $helpWantedIssues, string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('help-wanted-issues', $helpWantedIssues, $operator);
    }

    /**
     * Filters by help-wanted-issues count range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function addHelpWantedIssuesRangeQualifier(int $first, int $second): self
    {
        return $this->addRangeQualifier('help-wanted-issues', $first, $second);
    }

}
