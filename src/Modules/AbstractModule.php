<?php

namespace Roots\Soil\Modules;

use Roots\Soil\Exceptions\LifecycleException;
use Roots\Soil\Options;

use function add_action;
use function add_filter;
use function apply_filters;
use function doing_action;
use function did_action;
use function is_admin;
use function wp_doing_ajax;

abstract class AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name;

    /**
     * Module options.
     *
     * @var Options
     */
    protected $options = false;

    /**
     * Default options.
     *
     * @var array
     */
    protected $defaults = ['enabled' => true];

    /**
     * Whether this module has already loaded.
     *
     * @var bool
     */
    protected $loaded = false;

    /**
     * Name of the hook at which this module will run.
     *
     * @var string
     */
    protected $hook = 'soil/init';

    /**
     * Invoke the module.
     *
     * @internal Used by {@see static::$hook}
     *
     * @return void
     */
    public function __invoke()
    {
        if (! $this->condition()) {
            return;
        }

        $this->handle();
    }

    /**
     * Module handle.
     *
     * @return void
     */
    abstract protected function handle();

    /**
     * Register the module.
     *
     * This attaches the module to its hook.
     *
     * @param array|Options $options
     * @return string
     * @throws LifecycleException
     */
    public function register($options = null)
    {
        if ($this->loaded) {
            throw new LifecycleException(
                sprintf('Module %s has already loaded.', get_class($this))
            );
        }

        if (did_action($this->hook) || doing_action($this->hook)) {
            throw new LifecycleException(
                sprintf('Hook %s has already been fired.', $this->hook)
            );
        }

        $this->options = $this->processOptions($options);
        $this->loaded = add_action($this->hook, $this);
    }

    /**
     * Generate Options object based on input options array.
     *
     * @param array|Options $options
     * @return Options
     */
    protected function processOptions($options)
    {
        if (! isset($options['enabled'])) {
            $options = ['enabled' => true];
        }

        $options = $options instanceof Options ? $options : new Options($options);

        return $options->merge($this->defaults);
    }

    /**
     * Retrieve module options.
     *
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Internal hook handler
     *
     * @param string $hook Name of the hook
     * @param string $method Method of $this to be executed
     * @param int $priority Hook priority
     * @param int $numArgs Number of arguments supported by the $method
     * @return void
     */
    protected function filter($hook, $method, $priority = 10, $numArgs = 1)
    {
        add_filter($hook, [$this, $method], $priority, $numArgs);
    }

    /**
     * Internal hook handler
     *
     * @param string[] $hook Name of the hook
     * @param string $method Method of $this to be executed
     * @param int $priority Hook priority
     * @param int $numArgs Number of arguments supported by the $method
     * @return void
     */
    protected function filters($hooks, $method, $priority = 10, $numArgs = 1)
    {
        $count = count($hooks);
        array_map(
            [$this, 'filter'],
            (array) $hooks,
            array_fill(0, $count, $method),
            array_fill(0, $count, $priority),
            array_fill(0, $count, $numArgs)
        );
    }

    /**
     * Condition under which the module is loaded.
     *
     * By default, modules are disabled in admin panel.
     *
     * @return bool
     */
    protected function condition()
    {
        return apply_filters(
            'soil/load-module/' . $this->provides(),
            $this->options->enabled && (!is_admin() || wp_doing_ajax())
        );
    }

    /**
     * Name of feature provided by the module.
     *
     * @return string
     */
    public function provides()
    {
        if (! $this->name) {
            $this->name = strtolower(preg_replace(
                ['/([a-z\d])([A-Z])/', '/([^-])([A-Z][a-z])/'],
                '$1-$2',
                basename(strtr(static::class, ['\\' => '/', 'Module' => '']))
            ));
        }

        return $this->name;
    }

    /**
     * Render the specified view.
     *
     * @param string $view
     * @param array $data
     * @return string
     */
    protected function render($view = null, $data = [])
    {
        if (is_array($view) && empty($data)) {
            $data = $view;
            $view = null;
        }

        if (empty($data)) {
            $data = $this->options->all();
        }

        $view = $view ?: ($this->provides() . '.php');
        extract($data); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
        ob_start();
        include __DIR__ . "/../../resources/views/{$view}";
        return ob_get_clean();
    }
}
