<?php


namespace Nowakjestem\GitHub\Services;


use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasOrder;
use Nowakjestem\GitHub\Traits\HasQualifiers;
use Nowakjestem\GitHub\Traits\HasSort;

class IssuesSearchService extends BaseSearchService
{
    use HasKeywords, HasQualifiers, HasOrder, HasSort;

    protected string $endpoint = 'search/issues';

    protected function buildQuery(): string
    {
        return http_build_query([
            'q' => implode('+', $this->getKeywords() + $this->getQualifiers()),
            'sort' => $this->getSort(),
            'order' => $this->getOrder(),
        ]);
    }

    /**
     * Search only issues
     *
     * @return $this
     */
    public function onlyIssues(): self
    {
        return $this->addStringQualifier('type', 'issue');
    }

    /**
     * Search only pull requests
     *
     * @return $this
     */
    public function onlyPullRequests(): self
    {
        return $this->addStringQualifier('type', 'pr');
    }

    /**
     * Search in title
     *
     * @return $this
     */
    public function inTitle(): self
    {
        return $this->addStringQualifier('in', 'title');
    }

    /**
     * Search in body
     *
     * @return $this
     */
    public function inBody(): self
    {
        return $this->addStringQualifier('in', 'body');
    }

    /**
     * Search in comments
     *
     * @return $this
     */
    public function inComments(): self
    {
        return $this->addStringQualifier('in', 'comments');
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
     * Filter to open issues/PRs
     *
     * @return $this
     */
    public function onlyOpen(): self
    {
        return $this->addStringQualifier('state', 'open');
    }

    /**
     * Filter to closed issues/PRs
     *
     * @return $this
     */
    public function onlyClosed(): self
    {
        return $this->addStringQualifier('state', 'closed');
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

    /**
     * Filter by author
     *
     * @param string $username
     * @return $this
     */
    public function byAuthor(string $username): self
    {
        return $this->addStringQualifier('author', $username);
    }

    /**
     * Search created by integrated account
     *
     * @param string $appname
     * @return $this
     */
    public function byApp(string $appname): self
    {
        return $this->byAuthor('app/' . $appname);
    }

    /**
     * Filter assigned to user
     *
     * @param string $username
     * @return $this
     */
    public function byAssignee(string $username): self
    {
        return $this->addStringQualifier('assignee', $username);
    }

    /**
     * Search with mentioned user
     *
     * @param string $byMention
     * @return $this
     */
    public function byMention(string $byMention): self
    {
        return $this->addStringQualifier('mentions', $byMention);
    }

    /**
     * Search with mentioned team
     *
     * @param string $organization
     * @param string $team
     * @return $this
     */
    public function byTeamMention(string $organization, string $team): self
    {
        return $this->addStringQualifier('team', $organization . '/' . $team);
    }

    /**
     * Search with comments by user
     *
     * @param string $username
     * @return $this
     */
    public function byCommenter(string $username): self
    {
        return $this->addStringQualifier('commenter', $username);
    }

    /**
     * Search with user involved
     *
     * @param string $username
     * @return $this
     */
    public function byInvolved(string $username): self
    {
        return $this->addStringQualifier('involves', $username);
    }

    /**
     * Search by label
     *
     * @param string $label
     * @return $this
     */
    public function byLabel(string $label): self
    {
        return $this->addStringQualifier('label', $label);
    }

    /**
     * Search by milestone
     *
     * @param string $milestone
     * @return $this
     */
    public function byMilestone(string $milestone): self
    {
        return $this->addStringQualifier('milestone', $milestone);
    }

    /**
     * Search by project board
     *
     * @param string $board
     * @param string $username
     * @param string|null $repository
     * @return IssuesSearchService
     */
    public function byProjectBoard(string $board, string $username, ?string $repository = null)
    {
        if ($repository) {
            return $this->addStringQualifier('project', $username . '/' . $repository . '/' . $board);
        }

        return $this->addStringQualifier('project', $username . '/' , $board);
    }

    /**
     * Filter only with pending commits
     *
     * @return $this
     */
    public function onlyPendingCommits(): self
    {
        return $this->addStringQualifier('status', 'pending');
    }

    /**
     * Filter only with success commits
     *
     * @return $this
     */
    public function onlySuccessCommits(): self
    {
        return $this->addStringQualifier('status', 'success');
    }

    /**
     * Filter only with failure commits
     *
     * @return $this
     */
    public function onlyFailureCommits(): self
    {
        return $this->addStringQualifier('status', 'failure');
    }

    /**
     * Search by commit SHA
     *
     * @param string $sha
     * @return $this
     */
    public function byCommitSHA(string $sha): self
    {
        return $this->addStringQualifier('SHA', $sha);
    }

    /**
     * Search only pull-requests created from branch
     *
     * @param string $branchName
     * @return $this
     */
    public function byHead(string $branchName): self
    {
        return $this->addStringQualifier('head', $branchName);
    }

    /**
     * Search only pull-request merged to given branch
     *
     * @param string $branchName
     * @return $this
     */
    public function byBase(string $branchName): self
    {
        return $this->addStringQualifier('base', $branchName);
    }

    /**
     * Search by language
     *
     * @param string $language
     * @return $this
     */
    public function byLanguage(string $language): self
    {
        return $this->addStringQualifier('language', $language);
    }

    /**
     * Search by number of interactions
     *
     * @param int $number
     * @param string|null $operator
     * @return $this
     */
    public function byNumberOfInteractions(int $number, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('interactions', $number, $operator);
    }

    /**
     * Search by number of interactions in range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function byNumberOfInteractionsInRange(int $first, int $second): self
    {
        return $this->addRangeQualifier('interactions', $first, $second);
    }
    /**
     * Search by number of reactions
     *
     * @param int $number
     * @param string|null $operator
     * @return $this
     */
    public function byNumberOfReactions(int $number, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('reactions', $number, $operator);
    }

    /**
     * Search by number of reactions in range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function byNumberOfReactionsInRange(int $first, int $second): self
    {
        return $this->addRangeQualifier('reactions', $first, $second);
    }


    /**
     * Filter only pull requests in draft
     *
     * @return $this
     */
    public function onlyDrafts(): self
    {
        return $this->addStringQualifier('draft', true);
    }

    /**
     * Filter only pull requests that are not in draft
     *
     * @return $this
     */
    public function withoutDrafts(): self
    {
        return $this->addStringQualifier('draft', false);
    }

    /**
     * Filter pull requests without reviews
     *
     * @return $this
     */
    public function filterNonReviewed(): self
    {
        return $this->addStringQualifier('review', 'none');
    }

    /**
     * Filter pull requests that require a review before they can be merged
     *
     * @return $this
     */
    public function filterRequiresReview(): self
    {
        return $this->addStringQualifier('review', 'required');
    }

    /**
     * Filter approved pull requests
     *
     * @return $this
     */
    public function filterApproved(): self
    {
        return $this->addStringQualifier('review', 'approved');
    }

    /**
     * Filter pull requests that require changes
     *
     * @return $this
     */
    public function filterChangesRequested(): self
    {
        return $this->addStringQualifier('review', 'changes_required');
    }

    /**
     * Filter pull requests reviewed by user
     *
     * @param string $username
     * @return $this
     */
    public function filterReviewedBy(string $username): self
    {
        return $this->addStringQualifier('revieved_by', $username);
    }

    /**
     * Filters pull requests where a specific person is requested for review
     *
     * @param string $username
     * @return $this
     */
    public function filterReviewByUserRequested(string $username): self
    {
        return $this->addStringQualifier('review-requested', $username);
    }

    /**
     * Filters pull requests that have review requests from the team
     *
     * @param string $teamName
     * @return $this
     */
    public function filterReviewByTeamRequested(string $teamName): self
    {
        return $this->addStringQualifier('team-review-requested', $teamName);
    }

    /**
     * Filters pull requests/issues that were created in given period of time
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
     * Filters pull requests/issues that were created in given period of time
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
     * Filters pull requests/issues that were updated in given period of time
     *
     * @param string $updated
     * @param string|null $operator
     * @return $this
     */
    public function addUpdatedQualifier(string $updated, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('updated', $updated, $operator);
    }

    /**
     * Filters pull requests/issues that were updated in given period of time
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addUpdatedRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('updated', $first, $second);
    }

    /**
     * Filters pull requests/issues that were closed in given period of time
     *
     * @param string $closed
     * @param string|null $operator
     * @return $this
     */
    public function addClosedQualifier(string $closed, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('closed', $closed, $operator);
    }

    /**
     * Filters pull requests/issues that were closed in given period of time
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addClosedRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('closed', $first, $second);
    }

    /**
     * Filters pull requests/issues that were merged in given period of time
     *
     * @param string $merged
     * @param string|null $operator
     * @return $this
     */
    public function addMergedQualifier(string $merged, ?string $operator = '>'): self
    {
        return $this->addSingleRangeQualifier('merged', $merged, $operator);
    }

    /**
     * Filters pull requests/issues that were merged in given period of time
     *
     * @param string $first
     * @param string $second
     * @return $this
     */
    public function addMergedRangeQualifier(string $first, string $second): self
    {
        return $this->addRangeQualifier('merged', $first, $second);
    }

    /**
     * Filters only merged pull requests
     *
     * @return $this
     */
    public function filterMerged(): self
    {
        return $this->addStringQualifier('is', 'merged');
    }


    /**
     * Filters only unmerged pull requests
     *
     * @return $this
     */
    public function filterUnmerged(): self
    {
        return $this->addStringQualifier('is', 'unmerged');
    }

    /**
     * Filters only archived pull requests
     *
     * @return $this
     */
    public function filterArchived(): self
    {
        return $this->addStringQualifier('archived', 'true');
    }

    /**
     * Filter only not archived pull requests
     *
     * @return $this
     */
    public function filterNotArchived(): self
    {
        return $this->addStringQualifier('archived', 'false');
    }

    /**
     * Filter only pull requests with locked conversations
     *
     * @return $this
     */
    public function filterWithLockedConversation(): self
    {
        return $this->addStringQualifier('is', 'locked');
    }

    /**
     * Filter only pull requests with unlocked conversations
     *
     * @return $this
     */
    public function filterWithUnlockedConversation(): self
    {
        return $this->addStringQualifier('is', 'unlocked');
    }

    /**
     * Filter pull requests without labels
     *
     * @return $this
     */
    public function filterWithoutLabels(): self
    {
        return $this->addStringQualifier('no', 'label');
    }

    /**
     * Filter pull requests without milestone
     *
     * @return $this
     */
    public function filterWithoutMilestone(): self
    {
        return $this->addStringQualifier('no', 'milestone');
    }

    /**
     * Filter pull requests without assigned users
     *
     * @return $this
     */
    public function filterWithoutAssignee(): self
    {
        return $this->addStringQualifier('no', 'assignee');
    }

    /**
     * Filter pull requests without project
     *
     * @return $this
     */
    public function filterWithoutProject(): self
    {
        return $this->addStringQualifier('no', 'project');
    }
}
