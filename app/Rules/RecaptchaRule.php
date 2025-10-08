<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class RecaptchaRule implements Rule
{
    public function passes($attribute, $value)
    {
        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
        $response = $recaptcha
            ->setExpectedAction('contact')
            ->setScoreThreshold(0.5)
            ->verify($value, request()->ip());
        
        return $response->isSuccess();
    }

    public function message()
    {
        return 'reCAPTCHA verification failed. Please try again.';
    }
}