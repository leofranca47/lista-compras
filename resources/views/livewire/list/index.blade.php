<div class="flex flex-col gap-2">
    <x-card>
        <form wire:submit="save" class="flex flex-col justify-center gap-2">
            <div class="flex flex-col gap-2">
                <div class="flex-1">
                    <x-input
                        label="Descrição"
                        class="uppercase"
                        wire:model="item"
                    />
                </div>
                <div class="flex-1">
                    <x-number label="Quantidade" wire:model="quantity"/>
                </div>
            </div>
            <div class="flex gap-2">
                <x-button type="submit" class="flex-2">
                    Adicionar
                </x-button>
                <x-button wire:click="confirmClear" color="red" class="flex-1">
                    <x-icon name="trash" class="h-5 w-5"/>
                </x-button>
            </div>
        </form>

    </x-card>
    @if(isset($items))
        <ul class="flex flex-col gap-2">
            @foreach($items as $product)
                <x-card class="flex justify-between">
                    <li
                        class="{{ data_get($product, 'finish') ? 'line-through text-gray-400' : '' }} cursor-pointer"
                        wire:key="{{ data_get($product, 'id') }}"
                    >
                        {{ data_get($product, 'item') }}
                    </li>
                    <div class="flex gap-4">
                        @if(data_get($product, 'finish'))
                            <x-toggle
                                wire:key="{{ data_get($product, 'id') }}"
                                wire:click="toggle({{ data_get($product, 'id') }})"
                                checked
                            />
                        @else
                            <x-toggle wire:click="toggle({{ data_get($product, 'id') }})" />
                        @endif
                        <x-icon
                            wire:click="edit({{ data_get($product, 'id') }})"
                            color="#60A5FA"
                            name="pencil"
                            class="h-5 w-5 cursor-pointer"
                        />
                        <x-icon
                            wire:click="confirmDelete({{ data_get($product, 'id') }})"
                            color="#F87171"
                            name="trash"
                            class="h-5 w-5 cursor-pointer"
                        />
                    </div>
                </x-card>
            @endforeach
        </ul>
    @endif
</div>
