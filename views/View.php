<?php

class View {
    private $vars;
    private $output;

    public function __construct() {

    }

    public function render($file, $vars = null) {
        $this->vars = $vars;
        $file = './views/layout/' . $file;
        ob_start();
        
        $this->includeFile($file);
        $output = ob_get_contents();
        ob_end_clean();

        $this->output = $output;
        return $this->output;
    }

    private function includeFile($file) {
        if(isset($this->vars) && is_array($this->vars)) {
            foreach($this->vars as $field => $value) {
                global ${$field};
                ${$field} = $value;
            }
        }

        if(file_exists($file)) {
            return include $file;
        } else if(file_exists($file. ".php")) {
            return include $file. ".php";
        } else if(file_exists($file. ".html")) {
            return include $file. ".html";
        } else {
            echo "<h2>No existe el archivo $file</h2>";
        }
    }
}