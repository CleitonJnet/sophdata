<section class="rounded-lg border border-slate-200 bg-white p-8 shadow-sm">
    <p class="text-sm font-bold uppercase tracking-wide text-brand-700">Perfil</p>
    <h1 class="mt-3 text-3xl font-black tracking-tight text-brand-950">Editar perfil</h1>
    <p class="mt-4 max-w-2xl text-slate-700">
        Essas informações ajudam a SophData a direcionar melhor seus futuros atendimentos.
    </p>

    @if (session('status'))
        <div class="mt-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="save" class="mt-8 max-w-2xl space-y-5">
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700">Nome</label>
            <input wire:model="name" id="name" type="text" autocomplete="name"
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
            <label for="phone" class="block text-sm font-semibold text-slate-700">Telefone</label>
            <input wire:model="phone" id="phone" type="tel" autocomplete="tel"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
            @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_type" class="block text-sm font-semibold text-slate-700">Tipo de cliente</label>
            <select wire:model="customer_type" id="customer_type"
                class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-slate-900 shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                <option value="">Selecione, se desejar</option>
                <option value="personal">Pessoa Física</option>
                <option value="business">Pessoa Jurídica</option>
            </select>
            <p class="mt-2 text-sm text-slate-600">
                Se você atende por uma empresa, os dados empresariais serão solicitados em etapa futura.
            </p>
            @error('customer_type')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
            <button type="submit" class="rounded-md bg-brand-950 px-5 py-3 text-sm font-bold text-white hover:bg-brand-800">
                Salvar perfil
            </button>
            <a href="{{ route('dashboard') }}" class="rounded-md border border-slate-300 px-5 py-3 text-sm font-bold text-slate-700 hover:border-brand-300 hover:text-brand-800">
                Voltar ao painel
            </a>
        </div>
    </form>
</section>
