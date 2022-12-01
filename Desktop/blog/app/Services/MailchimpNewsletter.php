<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements iNewsletter
{
    public function __construct(protected ApiClient $client) // we started this example with two dependancies (the second being $foo) hence the explanations in AppServiceProvider and NLcontroller
    {

    }

    public function subscribe (string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
// what ??= does is basically saying if what you gaves us on the left is null then pass what you find on the right

        return $this->client->lists->addListMember($list, [
                "email_address" => $email,
                "status" => "subscribed"
        ]);
    }
}
