<?php

namespace App\Traits;

trait SaveToUpper
{
    /*
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
        {
            $this->attributes[$key] = trim(strtoupper($value));
        }
    }*/
    /**
     * Default params that will be saved on lowercase
     * @var array No Uppercase keys
     */
    /*protected $no_uppercase = [
        'password',
        'username',
        'email',
        'remember_token',
        'slug',
    ];*/

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($value)) {
            if ($this->is_upper !== null) {
                //if (!in_array($key, $this->no_uppercase)) {
                    if (in_array($key, $this->is_upper)) {
                        $this->attributes[$key] = trim(strtoupper($value));
                    }
                //}
            }/* else {
                if (!in_array($key, $this->no_uppercase)) {
                    $this->attributes[$key] = trim(strtoupper($value));
                }
            }*/
        }
    }
}