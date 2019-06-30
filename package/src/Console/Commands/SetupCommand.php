<?php

namespace InetStudio\RSS\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:rss:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup rss package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Requests forms setup',
                'command' => 'inetstudio:rss:feeds:setup',
            ],
        ];
    }
}
