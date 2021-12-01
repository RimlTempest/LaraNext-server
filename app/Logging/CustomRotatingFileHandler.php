<?php

namespace App\Logging;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;

class CustomRotatingFileHandler extends RotatingFileHandler
{
    public function __construct(string $filename, int $maxFiles = 0, $level = Logger::DEBUG, bool $bubble = true, ?int $filePermission = null, bool $useLocking = false)
    {
        $this->pushProcessor(new IntrospectionProcessor($level, ['Illuminate\\']));
        parent::__construct($filename, $maxFiles, $level, $bubble, $filePermission, $useLocking);
    }
}