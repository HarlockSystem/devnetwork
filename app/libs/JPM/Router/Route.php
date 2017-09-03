<?php

namespace JPM\Router;

/**
 * A Route object is an url with required/allowed/default parameters
 * It make the link between an url and a controller
 *
 * @author linkus
 */
class Route
{
    protected $pattern;
    protected $path;
    protected $requirements = [];
    protected $defaultValues = [];
    protected $methods = [];
    protected $host = null;
    protected $schemes = [];

    /**
     * 
     * @param string $path path pattern to match
     * @param array $defaults default parameter values
     * @param array $requirements requirements for parameters as regexes
     * @param string|array $methods required HTTP method or an array of restricted methods
     * @param type $host host pattern to match
     * @param type $schemes equired URI scheme or an array of restricted schemes
     */
    public function __construct($path, // url
            array $defaults = [], // default values
            array $requirements = [], // requirements
            $methods = [], // methods
            $host = [], // methods
            $schemes = []) // methods
    {
        $this->path = $path;
        $this->defaults = $this->sanitize($defaults);
        $this->requirements = $this->sanitize($requirements);
        $this->methods = is_string($methods) ? [$methods] : $methods;
        $this->host = $host;
        $this->schemes = is_string($schemes) ? [$schemes] : $schemes;
//        $this->generatePattern();
    }

    /**
     * Generate a regex to match url
     * 
     * @throws \InvalidArgumentException
     */
    public function generatePattern()
    {
        $pattern = $this->path;
        $defaults = $this->defaults;
        $requirements = $this->requirements;

        $matches = null;
        preg_match_all('#\{(\w+)\}#', $this->path, $matches);

        // missing requirement
        foreach ($matches[1] as $term) {
            if (!isset($requirements[$term])) {
                $msg = sprintf('Missing parameter "%s" in "%s".', $term, $this->path);
                throw new \InvalidArgumentException($msg);
            }
            if (isset($defaults[$term])) {
                $regex = '/?(' . $requirements[$term] . '|' . $defaults[$term] . '?)';
                $pattern = str_replace('/{' . $term . '}', $regex, $pattern);
            } else {
                $regex = '(' . $requirements[$term] . ')';
                $pattern = str_replace('{' . $term . '}', $regex, $pattern);
            }
            unset($requirements[$term]);
        }
        // missing mask in url
        $missingPatern = null;
        foreach ($requirements as $key => $regex) {
            $missingPatern[] = $key . ' => ' . $regex;
        }
        if (!empty($missingPatern)) {
            $msg = sprintf('Missing pattern in url "%s" for parametter "%s".', $this->path, implode(', ', $missingPatern));
            throw new \InvalidArgumentException($msg);
        }

        $this->pattern = $pattern . '$';
    }

    /**
     * Check valid arguments
     * 
     * @param array $params
     * @return array
     * @throws \InvalidArgumentException
     */
    public function sanitize(array $params)
    {
        foreach ($params as $key => $string) {
            if (!is_scalar($string)) {
                throw new \InvalidArgumentException(sprintf('Routing requirement for "%s" must be a string.', $key));
            }
        }
        return $params;
    }

    /**
     * Return generated regex
     * 
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Return path
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Add path to Route
     * 
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Return defaults parameters
     * 
     * @return array
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * Add defaults parameters
     * 
     * @param array $defaults
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = $this->sanitize($defaults);
    }

    /**
     * Return required parameters
     * 
     * @return array
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Add required parameters
     * 
     * @param array $requirements
     */
    public function setRequirements(array $requirements)
    {
        $this->requirements = $this->sanitize($requirements);
    }

    /**
     * Return allowed methods
     * 
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * Add required methods
     * 
     * @param string|array $methods
     */
    public function setMethods($methods)
    {
        $this->methods = is_string($methods) ? [$methods] : $methods;
    }

    /**
     * Return required host
     * 
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Add required host
     * 
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Return allowed schemes
     * 
     * @return array
     */
    public function getSchemes()
    {
        return $this->schemes;
    }

    /**
     * Add allowed schemes
     * 
     * @param string|array $schemes
     */
    public function setSchemes($schemes)
    {
        $this->schemes = is_string($schemes) ? [$schemes] : $schemes;
    }

}
