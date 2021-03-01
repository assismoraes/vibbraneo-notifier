<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Application;

class ApplicationUsageRule implements Rule
{

    private $usage;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($usage)
    {
        $this->usage = $usage;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return Application::find($value)[$this->usage];
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Application has not the specified channel usage enabled.' ;
    }
}
