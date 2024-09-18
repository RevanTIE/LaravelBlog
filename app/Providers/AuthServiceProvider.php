<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\EntradaPolicy;
use App\Models\Entrada;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //se asocia el modelo con la política
        Entrada::class => EntradaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->deleteAction();
        // VerifyEmail::toMailUsing(function (object $notifiable, string $url){
        //     return (new MailMessage)
        //     ->subject('New subject')
        //     ->line('New text')
        //     ->action('New button text', $url);
        // });
    }
    public function deleteAction(){
        Gate::define('deleteEntrada', function($user, $entrada){
            return $user->id==$entrada->user_id;
        });
    }
}
