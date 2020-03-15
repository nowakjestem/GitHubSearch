<?php


namespace Nowakjestem\GitHub\Traits;


trait HasOrder
{
    /**
     * @var string
     */
    protected string $order = 'desc';

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @param string $order
     * @return HasOrder
     */
    public function setOrder(string $order): HasOrder
    {
        $this->order = $order;
        return $this;
    }
}
