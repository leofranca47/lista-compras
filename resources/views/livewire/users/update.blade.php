<div>
    <x-modal :title="__('Atualizar Usuário: #:id', ['id' => $user?->id])" wire center>
        <form id="user-update-{{ $user?->id }}" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Nome') }} *" wire:model="user.name" required />
            </div>

            <div>
                <x-input label="{{ __('E-mail') }} *" wire:model="user.email" required />
            </div>

            <div>
                <x-password :label="__('Senha')"
                            hint="A senha só será atualizada se você preencher este campo"
                            wire:model="password"
                            rules
                            generator
                            x-on:generate="$wire.set('password_confirmation', $event.detail.password)" />
            </div>

            <div>
                <x-password :label="__('Confirmar Senha')" wire:model="password_confirmation" rules />
            </div>

            <div>
                <x-select.styled :label="__('Perfil')"
                                 :options="['admin', 'user']"
                                 wire:model="role"
                                 required
                />
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="user-update-{{ $user?->id }}" loading="save">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
