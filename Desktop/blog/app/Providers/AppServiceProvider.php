<?php

namespace App\Providers;

use App\Models\User;
use App\Services\iNewsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() // we're putting things that don't exist yet into the container/toychest
    {

        app()->bind(iNewsletter::class, function() {
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'), // 'YOUR_API_KEY',
                'server' => 'us21'
            ]);

            return new MailchimpNewsletter($client);
        });
    }
// now thanks to this registration, it's only here where we see Mailchimp (apart from the implementation itself)
// this meaning that if were to want to use another newsletter site such as ConverKit
// we would just need to swap MailchimpNewsletter($client) for ConvertKitNewsletter()


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
        // this disables all mass assignable restrictions.
        // never use this method if we're not explicit when requesting in our controllers.
        // in those cases in which we request all the columns is best to stick to protected $guarded = []; in each model.
        // E.g.: NEVER DO in the controllers:
        // Post:create(create(request()->all();
        // as long as we're explicit like in the following we wont have any issues:
        // explicit like:
        // $post->comment()->create([
        // 'user_id' => auth()->user()->id,
        // 'body' => request('body')
        //  ]);
        Gate::define('admin', function (User $user) {
            return $user->username === 'manu.253';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }

}
