<?php

namespace Pixelpeter\Genderize\Models;

use Carbon\Carbon;

class BaseModel
{
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
