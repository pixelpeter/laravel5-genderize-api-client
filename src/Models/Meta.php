<?php

namespace Pixelpeter\Genderize\Models;

use Carbon\Carbon;

class Meta extends BaseModel
{
    protected $code;

    protected $limit;

    protected $remaining;

    protected $reset;

    /**
     * Create new instance of Meta model
     */
    public function __construct($data)
    {
        $this->code = (int) $data->code;
        $this->limit = (int) $data->headers['X-Rate-Limit-Limit'];
        $this->remaining = (int) $data->headers['X-Rate-Limit-Remaining'];
        $this->reset = $this->setDate($data);
    }

    /**
     * Set remaining seconds till reset as Carbon instance
     */
    protected function setDate($data)
    {
        $date = Carbon::now();

        return $date->addSeconds($data->headers['X-Rate-Reset']);
    }
}
