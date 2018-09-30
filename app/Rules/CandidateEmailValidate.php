<?php

/**
 * @author Saurabh Mishra <saurabh.mishrr@gmail.com>
 * @version 1
 *
 */


namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Candidate;
use App\Repositories\Candidates;

class CandidateEmailValidate implements Rule
{

    private $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
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
        if (!empty($this->id)) {
            $candidatesData = (new Candidates)->getAllCandidates(array('where' => array('email' => array('eq' => $value))));
            if (empty($candidatesData[0])) {
                return true;
            } elseif (!empty($candidatesData[0]) && $candidatesData[0]->id == $this->id) {
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter valid email.';
    }

}
