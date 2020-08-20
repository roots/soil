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
     * Create an instance of Soil.
     *
     * @param string[]|object[]
     * @return void
     */
    public function __construct($modules = [])
    {
        $this->modules = $modules;
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
        if (($index = array_search($module, $this->modules)) === false) {
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

        foreach ($modules as $module) {
            if (is_string($module)) {
                /** @var \Roots\Soil\Modules\AbstractModule */
                $module = new $module();
            }

            $module->register();
        }

        do_action('soil/init');
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
