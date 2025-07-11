<div @updated="$dispatch('name-updated', { name: $event.detail.name })">
    <x-card>
        <x-slot:header>
            @lang('Edit Your Profile')
        </x-slot:header>
        <form id="update-profile" wire:submit="save">
            <div class="space-y-6">
                <div>
                    <x-input label="{{ __('Nome') }} *" wire:model="user.name" required />
                </div>
                <div>
                    <x-input label="{{ __('Email') }} *" value="{{ $user->email }}" disabled />
                </div>
                <div>
                    <x-password :label="__('Senha')"
                                :hint="__('A senha será atualizada se você preencher este campo')"
                                wire:model="password"
                                rules
                                generator
                                x-on:generate="$wire.set('password_confirmation', $event.detail.password)" />
                </div>
                <div>
                    <x-password :label="__('Confirmar Senha')" wire:model="password_confirmation" rules />
                </div>
            </div>
            <x-slot:footer>
                <x-button type="submit">
                    @lang('Salvar')
                </x-button>
            </x-slot:footer>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="update-profile">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-card>
</div>
