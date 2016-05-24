<?php

namespace Pixelpeter\Genderize\Models;

class Name extends BaseModel
{
    protected $gender;
    protected $name;
    protected $probability;
    protected $count;


    /**
     * Create new instance of Name model
     *
     * @param $data
     */
    public function __construct($data)
    {
        $data = $this->prepareData($data);

        $this->name = $data->name;
        $this->gender = $data->gender;
        $this->probability = $data->probability;
        $this->count = $data->count;
    }

    /**
     * Merge data with default so every field is available
     *
     * @param $data
     * @return object
     */
    protected function prepareData($data)
    {
        $default = new \StdClass;
        $default->name = null;
        $default->gender = null;
        $default->probability = null;
        $default->count = null;

        return (object) array_merge(
            (array) $default,
            (array) $data
        );
    }

    /**
     * Check if name is male
     *
     * @return bool
     */
    public function isMale()
    {
        return $this->gender === 'male';
    }

    /**
     * Check if name is not male
     *
     * @return bool
     */
    public function isNotMale()
    {
        return $this->gender !== 'male';
    }

    /**
     * Check if name is female
     *
     * @return bool
     */
    public function isFemale()
    {
        return $this->gender === 'female';
    }

    /**
     * Check if name is not female
     *
     * @return bool
     */
    public function isNotFemale()
    {
        return $this->gender !== 'female';
    }
}
