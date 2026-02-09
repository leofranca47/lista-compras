<div>
    <x-button :text="__('Criar Novo Usuário')" wire:click="$toggle('modal')" sm />

    <x-modal :title="__('Criar Novo Usuário')" wire center x-on:open="setTimeout(() => $refs.name.focus(), 250)">
        <form id="user-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Nome') }} *" x-ref="name" wire:model="user.name" required />
            </div>

            <div>
                <x-input label="{{ __('E-mail') }} *" wire:model="user.email" required />
            </div>

            <div>
                <x-password label="{{ __('Senha') }} *"
                            wire:model="password"
                            rules
                            generator
                            x-on:generate="$wire.set('password_confirmation', $event.detail.password)"
                            required />
            </div>

            <div>
                <x-password :label="__('Confirmar Senha')" wire:model="password_confirmation" rules required />
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
            <x-button type="submit" form="user-create">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
