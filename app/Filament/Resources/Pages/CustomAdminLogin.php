<?php

namespace App\Filament\Resources\Pages;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Validation\ValidationException;

class CustomAdminLogin extends Login
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('login_id')
            ->label(__('Phone or Email'))
            ->required()
            ->autofocus()
            ->autocomplete('username')
            ->columnSpanFull()
            ->validationAttribute('phone or email');
    }


    protected function getCredentialsFromFormData(array $data): array
    {
        $loginId = $data['login_id'];
        $field = filter_var($loginId, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        return [
            $field => $loginId,
            'password' => $data['password'],
        ];
    }

    // ✅ Optional if you ever want to override username field name
    public function username(): string
    {
        return 'login_id'; // Used by Livewire/Filament for autofill/autofocus
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login_id' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
