<?php


namespace Nowakjestem\GitHub\Services;


use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasOrder;
use Nowakjestem\GitHub\Traits\HasQualifiers;
use Nowakjestem\GitHub\Traits\HasSort;

class CommitSearchService extends BaseSearchService
{
    use HasKeywords, HasQualifiers, HasSort, HasOrder;

    protected string $endpoint = 'search/commit';

    protected function buildQuery(): string
    {
        return http_build_query([
            'q' => implode('+', $this->getKeywords() + $this->getQualifiers()),
            'sort' => $this->getSort(),
            'order' => $this->getOrder(),
        ]);
    }

    /**
     * Filter by author
     *
     * @param string $username
     * @return $this
     */
    public function filterByAuthor(string $username): self
    {
        return $this->addStringQualifier('author', $username);
    }

    /**
     * Filter by committer
     *
     * @param string $username
     * @return $this
     */
    public function filterByCommitter(string $username): self
    {
        return $this->addStringQualifier('committer', $username);
    }

    /**
     * Filter where author name contains given string
     *
     * @param string $needle
     * @return $this
     */
    public function filterAuthorNameContains(string $needle): self
    {
        return $this->addStringQualifier('author-name', $needle);
    }

    /**
     * Filter where committer name contains given string
     *
     * @param string $needle
     * @return $this
     */
    public function filterCommitterNameContains(string $needle): self
    {
        return $this->addStringQualifier('committer-name', $needle);
    }

    /**
     * Filter by author's email
     *
     * @param string $email
     * @return $this
     */
    public function filterByAuthorsEmail(string $email): self
    {
        return $this->addStringQualifier('author-email', $email);
    }

    /**
     * Filter by committer's email
     *
     * @param string $email
     * @return $this
     */
    public function filterByCommitterEmail(string $email): self
    {
        return $this->addStringQualifier('committer-email', $email);
    }

    /**
     * Filter by authored date
     *
     * @param string $date
     * @param string|null $operator
     * @return $this
     */
    public function addAuthorDateQualifier(string $date, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('author-date', $date, $operator);
    }

    /**
     * Filter by authored date in range
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addAuthorDateRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('author-date', $first, $second);
    }

    /**
     * Filter by committed date
     *
     * @param string $date
     * @param string|null $operator
     * @return $this
     */
    public function addCommittedDateQualifier(string $date, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('committer-date', $date, $operator);
    }

    /**
     * Filter by committed date in range
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addCommittedDateRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('committer-date', $first, $second);
    }

    /**
     * Filter only merge commits
     *
     * @return $this
     */
    public function filterMergeCommits(): self
    {
        return $this->addSingleRangeQualifier('merge', 'true');
    }

    /**
     * Filter only non-merge commits
     *
     * @return $this
     */
    public function filterNonMergeCommits(): self
    {
        return $this->addSingleRangeQualifier('merge', 'false');
    }

    /**
     * Filter by hash
     *
     * @param string $hash
     * @return $this
     */
    public function byHash(string $hash): self
    {
        return $this->addStringQualifier('hash', $hash);
    }

    /**
     * Filter by parent's hash
     *
     * @param string $hash
     * @return $this
     */
    public function byParent(string $hash): self
    {
        return $this->addStringQualifier('parent', $hash);
    }

    /**
     * Filter by tree's hash
     *
     * @param string $hash
     * @return $this
     */
    public function byTree(string $hash): self
    {
        return $this->addStringQualifier('tree', $hash);
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
     * Search only in repository
     *
     * @param string $username
     * @param string $repository
     * @return $this
     */
    public function inRepository(string $username, string $repository): self
    {
        return $this->addStringQualifier('repo', $username . '/' . $repository);
    }

    /**
     * Search in public repositories
     *
     * @return $this
     */
    public function onlyPublic(): self
    {
        return $this->addStringQualifier('is', 'public');
    }

    /**
     * Search in private repositories
     *
     * @return $this
     */
    public function onlyPrivate(): self
    {
        return $this->addStringQualifier('is', 'private');
    }
}
