<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $customer_type = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $type = request()->query('customer_type', request()->query('tipo'));

        $this->customer_type = match ($type) {
            'pf', 'personal' => 'personal',
            'pj', 'business' => 'business',
            default => '',
        };
    }

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'customer_type' => ['nullable', 'in:personal,business'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'Informe seu nome.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'phone.max' => 'Informe um telefone com até 30 caracteres.',
            'customer_type.in' => 'Selecione um tipo de cliente válido.',
            'password.required' => 'Informe uma senha.',
            'password.confirmed' => 'A confirmação de senha não confere.',
        ]);

        $validated['phone'] = filled($validated['phone'] ?? null) ? $validated['phone'] : null;
        $validated['customer_type'] = filled($validated['customer_type'] ?? null) ? $validated['customer_type'] : null;

        $user = User::create($validated);

        Auth::login($user);

        return $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->title('Criar conta SophData');
    }
}
