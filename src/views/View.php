<?php

namespace views;

/**
 * Handles the rendering and display of templates.
 *
 * The View class facilitates the management of data assignment to templates
 * and offers methods to render or display them.
 */
class View
{
    /**
     * Holds the data to be passed to the templates.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * The base directory path where templates are located.
     *
     * @var string
     */
    protected string $basePath = __DIR__ . '/../views/';

    /**
     * Assigns a value to a specific name that can be accessed within a template.
     *
     * @param string $name The name to which the value should be assigned.
     * @param mixed  $value The value to be assigned.
     * @return void
     */
    public function assign(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * Includes and displays a template file.
     *
     * @param string $template The relative path to the template from the base path.
     * @return void
     */
    public function display(string $template): void
    {
        include $this->basePath . $template;
    }

    /**
     * Renders the template and returns the generated content as a string.
     *
     * @param string $template The relative path to the template from the base path.
     * @return string The rendered content of the template.
     */
    public function render(string $template): string
    {
        ob_start();

        include $this->basePath . $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
