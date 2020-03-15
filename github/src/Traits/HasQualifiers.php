<?php


namespace Nowakjestem\GitHub\Traits;


trait HasQualifiers
{
    /**
     * @var array|string[]
     */
    protected array $qualifiers;

    public function getQualifiers(): array
    {
        return $this->qualifiers;
    }

    /**
     * Adds string qualifier
     *
     * @param string $name
     * @param string $value
     * @param bool $negative
     * @return $this
     */
    public function addStringQualifier(string $name, string $value, bool $negative = false): self
    {
        $this->qualifiers[] = sprintf('%s%s:%s', $negative ? '-' : '', $name, $value);

        return $this;
    }

    /**
     * Adds range qualifier using an operator
     *
     * @param string $name
     * @param $value
     * @param string $operator
     * @return $this
     */
    public function addSingleRangeQualifier(string $name, $value, string $operator = '>'): self
    {
        if (in_array($operator, [
            '<',
            '<=',
            '>',
            '>=',
        ])) {
            $this->qualifiers[] = sprintf('%s:%s%s', $operator, $name, $value);
        }

        return $this;
    }

    /**
     * Adds range qualifier between two numbers
     *
     * @param string $name
     * @param $first
     * @param $second
     * @return $this
     */
    public function addRangeQualifier(string $name, $first, $second): self
    {
        $format = '%s:%s..%s';
        if ($first < $second) {
            $this->qualifiers[] = sprintf($format, $name, $first, $second);
        } else {
            $this->qualifiers[] = sprintf($format, $name, $second, $first);
        }

        return $this;
    }
}
