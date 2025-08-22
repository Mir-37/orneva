<?php

namespace App\Filament\Customer\Pages;

use App\Models\Customer;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Auth\Pages\Register;
use Filament\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Customer\Pages\CustomerRegisterResponse;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class CustomerRegistration extends Register
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                FileUpload::make('photo')
                    ->image()
                    ->imageEditor()
                    ->getUploadedFileNameForStorageUsing(function ($file) {
                        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        return $name . '-' . uniqid() . '.' . $extension;
                    })
                    ->disk('user_images'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255)
                    ->unique(),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->unique(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function (): Model {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        event(new Registered($user));

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        session()->regenerate();

        return app(CustomerRegisterResponse::class);
    }
}
