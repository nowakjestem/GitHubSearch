<?php


namespace Nowakjestem\GitHub\Services;


use Nowakjestem\GitHub\Traits\HasKeywords;
use Nowakjestem\GitHub\Traits\HasOrder;
use Nowakjestem\GitHub\Traits\HasQualifiers;
use Nowakjestem\GitHub\Traits\HasSort;

class CodeSearchService extends BaseSearchService
{
    use HasKeywords, HasQualifiers, HasOrder, HasSort;

    protected string $endpoint = '/search/code';

    protected function buildQuery(): string
    {
        return http_build_query([
            'q' => implode('+', $this->getKeywords() + $this->getQualifiers()),
            'sort' => $this->getSort(),
            'order' => $this->getOrder(),
        ]);
    }

    /**
     * Filter only code that appears in file context
     *
     * @return $this
     */
    public function filterOnlyInFiles(): self
    {
        return $this->addStringQualifier('in', 'file');
    }

    /**
     * Filters only code where keywords appears in file path
     *
     * @return $this
     */
    public function filterOnlyInPaths(): self
    {
        return $this->addStringQualifier('in', 'file');
    }

    /**
     * Filter only code where keywords appears in code context or in file path
     *
     * @return $this
     */
    public function filterInCodeAndPaths(): self
    {
        return $this->addStringQualifier('in', 'file,path');
    }

    /**
     * Filters code owned by user
     *
     * @param string $username
     * @return $this
     */
    public function filterByUser(string $username): self
    {
        return $this->addStringQualifier('user', $username);
    }

    /**
     * Filters code owned by organization
     *
     * @param string $organizationName
     * @return $this
     */
    public function filterByOrganization(string $organizationName): self
    {
        return $this->addStringQualifier('org', $organizationName);
    }

    /**
     * Filters code in specific repository
     *
     * @param string $username
     * @param string $repositoryName
     * @return $this
     */
    public function filterByRepository(string $username, string $repositoryName): self
    {
        return $this->addStringQualifier('repo', $username . '/' . $repositoryName);
    }

    /**
     * Filters code by file location
     *
     * @param string $path
     * @return $this
     */
    public function filterByFileLocation(string $path): self
    {
        return $this->addStringQualifier('path', $path);
    }

    /**
     * Filters only code in specific language
     *
     * @param string $language
     * @return $this
     */
    public function filterByLanguage(string $language): self
    {
        return $this->addStringQualifier('language', $language);
    }

    /**
     * Filters only files within size range
     *
     * @param int $size
     * @param string|null $operator
     * @return $this
     */
    public function filterBySize(int $size, ?string $operator): self
    {
        return $this->addSingleRangeQualifier('size', $size, $operator);
    }

    /**
     * Filters only files within size range
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function filterBySizeRange(int $first, int $second): self
    {
        return $this->addRangeQualifier('size', $first, $second);
    }

    /**
     * Filters only files with specific filename
     *
     * @param string $filename
     * @return $this
     */
    public function filterByFilename(string $filename): self
    {
        return $this->addStringQualifier('filename', $filename);
    }

    /**
     * Filters files with specific extension
     *
     * @param string $extension
     * @return $this
     */
    public function filterByExtension(string $extension): self
    {
        return $this->addStringQualifier('extension', $extension);
    }
}
