<?php

// namespace App\Filament\Pages;
namespace App\Filament\Tenant\Pages;

// use Filament\Pages\Page;
use App\Models\Company;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant as BaseRegisterTenant;

class RegisterCompany extends BaseRegisterTenant
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.tenant.pages.register-company';

    public static function getLabel(): string
    {
        return 'Register Your Company';
    }

     /**
     * Define the form schema
     */
    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Company Name')
                ->required()
                ->maxLength(255),
        ]);
    }

    /**
     * Handle tenant (company) registration and attach to user
     */
    protected function handleRegistration(array $data): Company
    {
        // Create the company using default behavior
        $company = Company::create($data);

        // Attach the company to the authenticated user
        /** @var User $user */
        $user = auth()->user();
        $user->companies()->attach($company->id);

        return $company;
    }
}
