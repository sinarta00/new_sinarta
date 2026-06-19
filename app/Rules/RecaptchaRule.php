<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class RecaptchaRule implements Rule
{
    public function passes($attribute, $value)
    {
        $secret = config('services.recaptcha.secret_key');
        
        $recaptcha = new ReCaptcha($secret);
        $response = $recaptcha
            ->setExpectedAction('contact')
            ->setScoreThreshold(0.5)
            ->verify($value, request()->ip());
        
        // Temporary logging untuk debug
        \Log::info('reCAPTCHA debug', [
            'success'    => $response->isSuccess(),
            'score'      => $response->getScore(),
            'action'     => $response->getAction(),
            'errors'     => $response->getErrorCodes(),
            'token_value' => substr($value, 0, 20) . '...', // sebagian saja
            'secret_set' => !empty($secret),
        ]);
        
        return $response->isSuccess();
    }

    public function message()
    {
        return 'reCAPTCHA verification failed. Please try again.';
    }
}