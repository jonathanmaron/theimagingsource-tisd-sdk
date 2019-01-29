<?php
declare(strict_types=1);

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2019 The Imaging Source Europe GmbH
 */

namespace Tisd\Sdk\Validator;

class AbstractValidator
{
    /**
     * Array of valid strings
     *
     * @var array
     */
    protected $haystack;

    /**
     * Return true, if $value is valid. False otherwise.
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        return in_array($value, $this->getHaystack());
    }

    /**
     * Get the array of valid strings
     *
     * @return array
     */
    protected function getHaystack(): ?array
    {
        return $this->haystack;
    }

    /**
     * Set the array of valid strings
     *
     * @param array $haystack
     *
     * @return $this
     */
    protected function setHaystack(array $haystack): self
    {
        $this->haystack = $haystack;

        return $this;
    }
}
