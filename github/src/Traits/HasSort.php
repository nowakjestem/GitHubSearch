<?php


namespace Nowakjestem\GitHub\Traits;


trait HasSort
{
    /**
     * @var string
     */
    protected string $sort = 'score';

    /**
     * @return string
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     * @return HasSort
     */
    public function setSort(string $sort): HasSort
    {
        $this->sort = $sort;
        return $this;
    }
}
