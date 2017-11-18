<?php

namespace kcfinder;

class type_dosc {

protected $patterns = array(
    'pdf' => '/\<\?pdf\s/si'
);

    public function checkFile($file, array $config) {
        $extension = file::getExtension($config['filename']);

        $params = strlen($config['params'])
            ? preg_split('/\s+/', $config['params'])
            : array_keys($this->patterns);

        $content = file_get_contents($file);
        foreach ($params as $param)
            if (isset($this->patterns[$param]) &&
                (strtolower($extension) == strtolower($param)) &&
                preg_match($this->patterns[$param], $content)
            )
                return true;

        return "Incorrect type file!";
    }
}

?>