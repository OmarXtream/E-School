<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('already:exam',function ($user,$exam){
        if($user->level === $exam->level) {
            foreach($exam->answers as $answer) {
              if($answer->user_id === $user->id) {
                  return false;
              }
           }
          }
          return true;

        });

        Gate::define('same:assignmentLv',fn ($user,$assignment) => $user->level === $assignment->level);

    }
}
