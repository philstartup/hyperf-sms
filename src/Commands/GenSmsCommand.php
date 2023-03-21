<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Commands;

use Hyperf\Devtool\Generator\GeneratorCommand;

class GenSmsCommand extends GeneratorCommand
{
    public function __construct()
    {
        parent::__construct('gen:sms');
        $this->setDescription('Create a new SMS message class');
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/message.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    protected function getDefaultNamespace(): string
    {
        return $this->getConfig()['namespace'] ?? 'App\\Sms';
    }
}
