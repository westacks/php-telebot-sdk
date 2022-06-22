<?php

namespace WeStacks\TeleBot;

use GuzzleHttp\Client;
use WeStacks\TeleBot\Exceptions\TeleBotException;
use WeStacks\TeleBot\Traits\HandlesUpdates;
use WeStacks\TeleBot\Traits\HasTelegramMethods;

/**
 * This class represents a bot instance. This is main controller for sending and handling your Telegram requests.
 *
 * @see https://core.telegram.org/bots/api
 */
class TeleBot
{
    use HasTelegramMethods;
    use HandlesUpdates;

    /**
     * Actual bot config.
     * @var array
     */
    protected $config = [];

    /**
     * Guzzle HTTP client.
     * @var Client
     */
    protected $client;

    /**
     * Kernel for handling incoming updates.
     * @var Kernel
     */
    protected $kernel;

    /**
     * Async trigger.
     * @var bool
     */
    protected $async;

    /**
     * Exception trigger.
     * @var bool
     */
    protected $exceptions;

    /**
     * Create new instance of Telegram bot.
     * @param  array|string     $config Bot config. Path telegram bot API token as string, or array of parameters
     * @throws TeleBotException
     */
    public function __construct($config)
    {
        if (is_string($config)) {
            $config = ['token' => $config];
        }
        if (! isset($config['token'])) {
            throw new TeleBotException('Token is required.');
        }

        $this->config = [
            'token' => $config['token'],
            'name' => $config['name'] ?? null,
            'exceptions' => $config['exceptions'] ?? true,
            'async' => $config['async'] ?? false,
            'api_url' => $config['api_url'] ?? 'https://api.telegram.org/bot{TOKEN}/{METHOD}',
            'webhook' => $config['webhook'] ?? [],
            'poll' => $config['poll'] ?? [],
            'handlers' => $config['handlers'] ?? null,
        ];

        $this->client = new Client([
            'http_errors' => false,
        ]);

        if (is_subclass_of($handlers = $this->config['handlers'] ?? [], Kernel::class)) {
            $this->kernel = new $handlers();
        } else {
            $this->kernel = new Kernel($handlers);
        }
    }

    public function __call(string $method, array $arguments)
    {
        if (! $Method = static::method($method)) {
            throw new TeleBotException("Method '{$method}' not found.");
        }

        $method = new $Method(
            $this->client,
            $this->config['api_url'],
            $this->config['token'],
            $this->exceptions ?? $this->config['exceptions'],
            $this->async ?? $this->config['async'],
            $this->fake ?? false
        );

        $this->exceptions = null;
        $this->async = null;
        $this->fake = null;

        return $method(...$arguments);
    }

    /**
     * Get bot config.
     * @return mixed
     */
    public function config($value = null)
    {
        if ($value === null) {
            return $this->config;
        }

        return $this->config[$value] ?? null;
    }

    /**
     * Call next method asynchronously (bot method will return guzzle promise).
     * @param  bool $async
     * @return self
     */
    public function async(bool $async = true)
    {
        $this->async = $async;

        return $this;
    }

    /**
     * Call next method fake.
     * @param  bool $async
     * @return self
     */
    public function fake(bool $fake = true)
    {
        $this->fake = $fake;

        return $this;
    }

    /**
     * Throw exceptions on next method (bot method will throw `TeleBotException` on request error).
     * @param  bool $exceptions
     * @return self
     */
    public function exceptions(bool $exceptions = true)
    {
        $this->exceptions = $exceptions;

        return $this;
    }
}
