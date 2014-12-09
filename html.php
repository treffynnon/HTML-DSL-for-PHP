<?php

/**
 * A DSL for simple HTML generation
 */
namespace Treffynnon\Html {
    use \Treffynnon\Util as U;
    /**
     * Represents an HTML attribute
     */
    class Attribute {
        protected $name = '';
        protected $values = [];

        public function __construct($name, $values) {
            $this->name = $name;
            $this->values = U\ensure_array($values);
        }

        public function name() {
            return $this->name;
        }

        public function values() {
            return $this->values;
        }
    }

    /**
     * Create a new attribute
     * @param  $name
     * @param array|string|null $values
     * @return \Treffynnon\Html\Attribute
     */
    function attr($name, $values = null) {
        return new Attribute($name, $values);
    }

    /**
     * Create a div tag
     * @param string $content
     * @param array $attrs Array of Attribute instances
     * @return string
     */
    function div($content, array $attrs = []) {
        return tag('div', $content, $attrs);
    }

    /**
     * Create a section tag
     * @param string $content
     * @param array $attrs Array of Attribute instances
     * @return string
     */
    function section($content, array $attrs = []) {
        return tag('section', $content, $attrs);
    }

    /**
     * Create an HTML tag
     * @param string $type
     * @param string $content
     * @param array $attrs Array of Attribute instances
     * @return string
     */
    function tag($type, $content, array $attrs = []) {
        return "<$type" . attrs_to_html($attrs) . ">" . $content . "</$type>";
    }

    /**
     * Take an array of attributes and get them in HTML format
     * @param array $attrs Array of Attribute instances
     * @return string
     */
    function attrs_to_html(array $attrs) {
        return ($attrs) ?
                ' ' . implode(' ', array_map('\Treffynnon\Html\attr_to_html', $attrs)) :
                '';
    }

    /**
     * Convert an Attribute into an HTML attribute string
     * @param \Treffynnon\Html\Attribute $attr
     * @return string
     */
    function attr_to_html(Attribute $attr) {
        return render_attr($attr->name(), implode(' ', $attr->values()));
    }

    /**
     * Render an HTML attribute
     * @param string $name
     * @param string $value
     * @return string
     */
    function render_attr($name, $value = null) {
        return (is_null($value) || false === $value || '' === $value) ?
                $name :
                $name . '="' . esc_html($value) . '"';
    }

    /**
     * HTML escape an string
     * @param string $string
     */
    function esc_html($string) {
        return htmlspecialchars(
            $string,
            ENT_HTML5 | ENT_COMPAT | ENT_SUBSTITUTE,
            'UTF-8'
        );
    }
}
