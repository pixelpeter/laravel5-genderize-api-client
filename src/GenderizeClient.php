<?php

namespace Pixelpeter\Genderize;

use Pixelpeter\Genderize\Models\GenderizeResponse;
use Unirest\Request;

class GenderizeClient
{
    /**
     * @var array $names Holds one or more names to check
     */
    protected $names;

    /**
     * @var string $lang The language used for the check
     */
    protected $lang;

    /**
     * @var string $country The country used for the check
     */
    protected $country;

    /**
     * @var string $apikey The api key used for the request
     */
    protected $apikey;

    /**
     * @var \Unirest\Request
     */
    protected $request;

    /**
     * @const API_URL The URL of the api endpoint
     */
    const API_URL = 'https://api.genderize.io';


    /**
     * Create new instance of Pixelpeter\Genderize\GenderizeClient
     */
    public function __construct(Request $request)
    {
        $this->apikey = config('genderize.apikey');
        $this->request = $request;
    }

    /**
     * Fluent setter for names given as string
     *
     * @param string $name
     * @return $this|GenderizeClient
     */
    public function name($name = '')
    {
        if (is_array($name)) {
            return $this->names($name);
        }

        $this->names = [$name];

        return $this;
    }

    /**
     * Fluent setter for names given as array
     *
     * @param array $names
     * @return $this
     */
    public function names(array $names)
    {
        $this->names = $names;

        return $this;
    }

    /**
     * Fluent setter for language
     *
     * @param null $lang
     * @return $this
     */
    public function lang($lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Fluent setter for country
     *
     * @param null $country
     * @return $this
     */
    public function country($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Send the request
     *
     * @return GenderizeResponse
     */
    public function get()
    {
        $headers = array('Accept' => 'application/json');

        $response = $this->request->get(self::API_URL, $headers, $this->buildQuery());

        return new GenderizeResponse($response);
    }

    /**
     * Build the query
     *
     * @return array
     */
    protected function buildQuery()
    {
        $query = [
            'name' => $this->names,
            'country_id' => $this->country,
            'language_id' => $this->lang,
            'apikey' => $this->apikey
        ];

        return array_filter($query);
    }
}
