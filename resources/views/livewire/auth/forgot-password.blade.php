<div>
    <h1 class="text-2xl font-black tracking-tight text-brand-950">Esqueci minha senha</h1>
    <p class="mt-2 text-sm text-slate-600">Informe seu e-mail para receber o link de redefinição de senha.</p>

    @if ($status)
        <div class="mt-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ __($status) }}
        </div>
    @endif

    <form wire:submit="sendResetLink" class="mt-6 space-y-5">
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">E-mail</label>
            <input wire:model="email" id="email" type="email" autocomplete="email" autofocus
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full rounded-md bg-brand-950 px-4 py-3 text-sm font-bold text-white hover:bg-brand-800">
            Enviar link de recuperação
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Lembrou a senha?
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-brand-700 hover:text-brand-900">Entrar</a>
    </p>
</div>
