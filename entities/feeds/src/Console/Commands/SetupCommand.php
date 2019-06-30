<?php

namespace InetStudio\RSS\Feeds\Console\Commands;

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
    protected $name = 'inetstudio:rss:feeds:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup rss feeds package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\RSS\Feeds\Providers\ServiceProvider',
                    '--tag' => 'config',
                ],
            ],
        ];
    }
}
