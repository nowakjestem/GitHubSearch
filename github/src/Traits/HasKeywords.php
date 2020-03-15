<?php


namespace Nowakjestem\GitHub\Traits;


trait HasKeywords
{
    /**
     * @var array|string[]
     */
    protected array $keywords;

    /**
     * Gets keyword list
     *
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Adds keyword
     *
     * @param string $keyword
     * @return $this
     */
    public function addKeyword(string $keyword): self
    {
        $this->keywords[] = $keyword;

        return $this;
    }
}
