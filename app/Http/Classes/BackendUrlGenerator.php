<?php

namespace App\Http\Classes;


use Illuminate\Routing\UrlGenerator;

class BackendUrlGenerator extends UrlGenerator
{
    /**
     * Real root
     *
     * @var string
     */
    protected $RealRoot;

    /**
     * Generate the URL to an application asset.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    public function asset($path, $secure = null)
    {
        if ($this->isValidUrl($path)) {
            return $path;
        }

        $root = $this->formatRoot($this->formatScheme($secure)) . '/backend';

        return $this->removeIndex($root).'/'.trim($path, '/');
    }

    /**
     * Generate an absolute URL to the given path.
     *
     * @param  string  $path
     * @param  mixed  $extra
     * @param  bool|null  $secure
     * @return string
     */
    public function to($path, $extra = [], $secure = null)
    {
        // First we will check if the URL is already a valid URL. If it is we will not
        // try to generate a new one but will simply return the URL as is, which is
        // convenient since developers do not always have to check if it's valid.
        if ($this->isValidUrl($path)) {
            return $path;
        }

        $tail = implode('/', array_map(
                'rawurlencode', (array) $this->formatParameters($extra))
        );

        // Once we have the scheme we will compile the "tail" by collapsing the values
        // into a single string delimited by slashes. This just makes it convenient
        // for passing the array of parameters to this URL as a list of segments.
        $root = $this->formatRoot($this->formatScheme($secure)) . '/admin';

        list($path, $query) = $this->extractQueryString($path);

        return $this->format(
                $root, '/'.trim($path.'/'.$tail, '/')
            ).$query;
    }

}