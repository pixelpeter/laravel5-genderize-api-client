<?php

namespace Pixelpeter\Genderize\Models;

use Illuminate\Support\Collection;

class GenderizeResponse extends BaseModel
{
    protected $meta;
    protected $result;

    public function __construct($response)
    {
        $this->result = $this->setResult($response);
        $this->meta = $this->setMeta($response);
    }

    protected function setMeta($data)
    {
        return new Meta($data);
    }

    protected function setResult($response)
    {
        if (is_array($response->body)) {
            return $this->returnWithCollection($response);
        }

        return new Name($response->body);
    }

    protected function returnWithCollection($response)
    {
        $collection = new Collection();

        foreach ($response->body as $row) {
            $collection->push(new Name($row));
        }

        return $collection;
    }
}
