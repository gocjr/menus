<?php

declare(strict_types=1);

namespace Menus;

use App\Routing\Router;
use Cake\Core\App;
use Closure;

class ApplicationMap
{
    protected $_paths = [];
    protected $_defaults = [
        'type' => null,
        'plugin' => null,
        'typeName' => null,
    ];

    public function __construct(string $type = null)
    {
        $this->setType($type);
        $this->setPath();
    }

    public function __call($name, $arguments)
    {
        $key = lcfirst(substr($name, 3));
        $method = substr($name, 0, 3);
        if (!isset($this->_defaults[$key])) {
        }
        if ($method == 'set') {
            $this->_defaults[$key] = current($arguments);
        }
        return $this->_defaults[$key];
    }

    public function setType(string $type = null): void
    {
        $this->_defaults['type'] =  $type;
        if (preg_match('/(Table|Controller|Behavior|View|Component)/', $type, $typeName)) {
            $this->_defaults['typeName'] = current($typeName);
        }
    }

    public function setPath(string $plugin = null): void
    {
        $this->setPlugin($plugin);
        $paths = App::classPath($this->getType(), $this->getPlugin());
        $this->_paths[$plugin ?? 'App'] = current($paths);
    }

    public function routes(Closure $callback = null)
    {

        $rows = [];
        if (!is_callable($callback)) {
            return $rows;
        }

        foreach ($this->_paths as $dirname => $path) :
            if (is_dir($path)) {
                $files = $this->_loadFiles($path);
                foreach ($files as $file) :
                    $file = $this->_fileData($file, $dirname);
                    $rows[$file['class']] = $callback($file, $dirname);
                endforeach;
            }
        endforeach;

        return $rows;
    }

    public function models(Closure $callback = null): array
    {
        $rows = [];
        foreach ($this->_paths as $dirname => $path) :
            if (is_dir($path)) {
                $files = $this->_loadFiles($path);

                $files = is_callable($callback) ? $callback($files, $dirname) : $this->_clean($files, $dirname);
                $rows[$dirname] = $files;
            }
        endforeach;
        return $rows;
    }

    protected function _loadFiles(string $path): array
    {
        $typeExt =  $this->getTypeName() . '.php';
        $regex = '/[^(App|Error)]' .  $typeExt . '/';
        $files = scandir($path);
        foreach ($files as $i => $file) :
            if (!preg_match($regex, $file)) {
                unset($files[$i]);
                continue;
            }
            $files[$i] = str_replace($typeExt, '', $file);
        endforeach;
        return $files;
    }

    protected function _fileData(string $filename, string $dirname): array
    {
        $data = [];
        $data['dir'] = $dirname;
        $data['type'] = $this->getTypeName();
        $data['name'] = $filename;
        $data['class'] = $filename;
        if ($dirname != 'App') {
            $data['class'] = $dirname . '.' . $filename;
        }
        $data['namespace'] = App::className($data['class'], $this->getType(), $this->getTypeName());
        return $data;
    }

    protected function _clean(array $files = [], string $dir = null): array
    {

        foreach ($files as $i => $file) {
            $files[$this->_key($dir, $file)] = $file;
            unset($files[$i]);
        }
        return  $files;
    }

    protected function _key($dir, $className)
    {
        if ($dir != 'App') {
            return $dir . '.' . $className;
        }
        return $className;
    }
}
