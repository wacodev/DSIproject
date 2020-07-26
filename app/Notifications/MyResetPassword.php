<?php

namespace DSIproject\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->greeting('Hola')
            ->line('Estás recibiendo este correo porque hiciste una solicitud para restablecer la contraseña de tu cuenta.')
            ->action('Restablecer contraseña', route('password.reset', $this->token))
            ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.')
            ->salutation(config('app.name'));
    }
}