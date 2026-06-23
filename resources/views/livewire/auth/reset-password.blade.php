<div>
    <h1 class="text-2xl font-black tracking-tight text-brand-950">Redefinir senha</h1>
    <p class="mt-2 text-sm text-slate-600">Crie uma nova senha para acessar sua conta SophData.</p>

    <form wire:submit="resetPassword" class="mt-6 space-y-5">
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">E-mail</label>
            <input wire:model="email" id="email" type="email" autocomplete="email" autofocus
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">Nova senha</label>
            <input wire:model="password" id="password" type="password" autocomplete="new-password"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirmar senha</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" autocomplete="new-password"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
        </div>

        <button type="submit" class="w-full rounded-md bg-brand-950 px-4 py-3 text-sm font-bold text-white hover:bg-brand-800">
            Redefinir senha
        </button>
    </form>
</div>
