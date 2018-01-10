<?php

namespace InetStudio\RSS\Console\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
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
     * Список дополнительных команд.
     *
     * @var array
     */
    protected $calls = [];

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->initCommands();

        foreach ($this->calls as $info) {
            if (! isset($info['command'])) {
                continue;
            }

            $this->line(PHP_EOL.$info['description']);
            $this->call($info['command'], $info['params']);
        }
    }

    /**
     * Инициализация команд.
     *
     * @return void
     */
    private function initCommands(): void
    {
        $this->calls = [
            [
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\RSS\Providers\RSSServiceProvider',
                    '--tag' => 'config',
                ],
            ],
        ];
    }
}
