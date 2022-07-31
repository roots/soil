<?php

namespace Roots\Soil;

use ReflectionClass;
use Roots\Soil\Modules\AbstractModule;

use function apply_filters;
use function do_action;

class Soil
{
    /**
     * List of module classes.
     *
     * @var string[]|object[]
     */
    protected $modules;

    /**
     * List of supported modules and options.
     *
     * @var array[]
     */
    protected $features;

    /**
     * Create an instance of Soil.
     *
     * @param string[]|object[]
     * @return void
     */
    public function __construct($modules = [], $features = [])
    {
        $this->modules = $modules;
        $this->features = $this->features($features);
    }

    /**
     * Add a module to the list of modules.
     *
     * @param string|object $module
     * @return void
     */
    public function addModule($module)
    {
        $this->modules[] = $module;
    }

    /**
     * Remove a module from the list of modules.
     *
     * @param string|object $module
     * @return bool True on success, false on failure
     */
    public function removeModule($module)
    {
        if (($index = array_search($module, $this->modules, true)) === false) {
            return false;
        }
        unset($this->modules[$index]);
        return true;
    }

    /**
     * Retrieve list of modules.
     *
     * @return string[]|object[]
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Invokes Soil.
     *
     * @internal Used by `after_setup_theme`
     *
     * @return void
     */
    public function __invoke()
    {
        $modules = array_unique(array_filter(
            apply_filters('soil/modules', (array) $this->modules)
        ));

        if (!$this->features) {
            $this->features = isset($GLOBALS['_wp_theme_features']['soil'][0])
                ? $this->features($GLOBALS['_wp_theme_features']['soil'][0])
                : null;
        }

        if (!$this->features) {
            return;
        }

        foreach ($modules as $module) {
            if (is_string($module)) {
                /** @var \Roots\Soil\Modules\AbstractModule */
                $module = new $module();
            }

            if (!$this->features) {
                $module->register(['enabled' => true]);
                continue;
            }

            if (isset($this->features[$module->provides()]) && $this->features[$module->provides()]) {
                $module->register($this->features[$module->provides()]);
            }
        }

        do_action('soil/init');
    }

    protected function features($features = [])
    {
        $modules = [];

        foreach ((array) $features as $module => $options) {
            // add_theme_support('soil', ['module'])
            if (is_int($module)) {
                $module = $options;
                $options = ['enabled' => true];
            }

            // add_theme_support('soil', ['module' => true])
            if (is_bool($options)) {
                $options = ['enabled' => $options];
            }

            // add_theme_support('soil', ['module' => 'some-option'])
            if (!is_array($options)) {
                $options = ['options' => $options];
            }

            // if an option is specified,
            // let's assume the module should be enabled
            // add_theme_support('soil', ['module' => ['option' => 'value']])
            if (!isset($options['enabled'])) {
                $options['enabled'] = true;
            }

            $modules[$module] = (array) $options;
        }

        return $modules;
    }

    public static function discoverModules($glob = __DIR__ . '/Modules/*Module.php', $namespace = __NAMESPACE__ . '\\Modules')
    {
        $namespace = rtrim($namespace, '\\');

        return array_map(static function ($file) use ($namespace) {
            $className = basename($file, '.php');

            $module =  "{$namespace}\\{$className}";

            if (is_subclass_of($module, AbstractModule::class) && !(new ReflectionClass($module))->isAbstract()) {
                return $module;
            }
        }, glob($glob));
    }
}
