<?php

namespace App\Services;

class ConvertKitNewsletter implements iNewsletter
{

    public function subscribe(string $email, string $list = null)
    {
        // subscribe the user with ConvertKit->specific
        // API request
    }
}
