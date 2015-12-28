<?php

namespace Tisd\Sdk\Exception;

class RuntimeException extends \RuntimeException implements ExceptionInterface
{
    protected $usage = '';

    public function __construct($message, $usage = '')
    {
        $this->usage = $usage;

        parent::__construct($message);
    }

    public function getUsageMessage()
    {
        return $this->usage;
    }
}
