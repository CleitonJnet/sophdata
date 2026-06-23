<div>
    <h1 class="text-2xl font-black tracking-tight text-brand-950">Entrar</h1>
    <p class="mt-2 text-sm text-slate-600">Acesse sua conta para acompanhar seus atendimentos SophData.</p>

    @if (session('status'))
        <div class="mt-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="login" class="mt-6 space-y-5">
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">E-mail</label>
            <input wire:model="email" id="email" type="email" autocomplete="email" autofocus
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">Senha</label>
            <input wire:model="password" id="password" type="password" autocomplete="current-password"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between gap-4">
            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input wire:model="remember" type="checkbox" class="rounded border-slate-300 text-brand-700 focus:ring-brand-500">
                Lembrar-me
            </label>

            <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-semibold text-brand-700 hover:text-brand-900">
                Esqueci minha senha
            </a>
        </div>

        <button type="submit" class="w-full rounded-md bg-brand-950 px-4 py-3 text-sm font-bold text-white hover:bg-brand-800">
            Entrar
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Ainda não tem conta?
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-brand-700 hover:text-brand-900">Criar conta</a>
    </p>
</div>
