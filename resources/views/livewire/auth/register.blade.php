<div>
    <h1 class="text-2xl font-black tracking-tight text-brand-950">Criar conta SophData</h1>
    <p class="mt-2 text-sm text-slate-600">Crie sua conta para futuramente abrir e acompanhar atendimentos.</p>

    <form wire:submit="register" class="mt-6 space-y-5">
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700">Nome</label>
            <input wire:model="name" id="name" type="text" autocomplete="name" autofocus
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">E-mail</label>
            <input wire:model="email" id="email" type="email" autocomplete="email"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-semibold text-slate-700">Telefone <span class="font-normal text-slate-500">(opcional)</span></label>
            <input wire:model="phone" id="phone" type="tel" autocomplete="tel"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_type" class="block text-sm font-semibold text-slate-700">Tipo de cliente <span class="font-normal text-slate-500">(opcional)</span></label>
            <select wire:model="customer_type" id="customer_type"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                <option value="">Selecione, se desejar</option>
                <option value="personal">Pessoa Física</option>
                <option value="business">Pessoa Jurídica</option>
            </select>
            <p class="mt-2 text-sm text-slate-600">
                Você poderá informar os dados da empresa ao abrir um atendimento empresarial.
            </p>
            @error('customer_type')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">Senha</label>
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
            Criar conta
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Já tem conta?
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-brand-700 hover:text-brand-900">Entrar</a>
    </p>
</div>
