<?php

namespace App\Livewire\Profile;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EditProfile extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $customer_type = '';

    public function mount(): void
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = (string) $user->phone;
        $this->customer_type = (string) $user->customer_type;
    }

    public function save(): void
    {
        $user = auth()->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'customer_type' => ['nullable', 'in:personal,business'],
        ], [
            'name.required' => 'Informe seu nome.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'phone.max' => 'Informe um telefone com até 30 caracteres.',
            'customer_type.in' => 'Selecione um tipo de cliente válido.',
        ]);

        $validated['phone'] = filled($validated['phone'] ?? null) ? $validated['phone'] : null;
        $validated['customer_type'] = filled($validated['customer_type'] ?? null) ? $validated['customer_type'] : null;

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        session()->flash('status', 'Perfil atualizado com sucesso.');
    }

    public function render()
    {
        return view('livewire.profile.edit-profile')
            ->title('Editar perfil | SophData');
    }
}
