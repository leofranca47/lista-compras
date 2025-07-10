<div class="flex flex-col gap-2">
    <x-card>
        <form wire:submit="save" class="flex flex-col justify-center gap-2">
            <div class="w-full">
                <x-input class="w-full uppercase" wire:model="item"/>
            </div>
            <div class="w-full">
                <x-number class="w-full" wire:model="quantity"/>
            </div>
            <x-button type="submit">
                Adicionar
            </x-button>
            <x-button wire:click="clear" color="red">
                <x-icon name="trash" class="h-5 w-5"/>
            </x-button>
        </form>

    </x-card>
    @if(isset($items))
        <ul class="flex flex-col gap-2">
            @foreach($items as $product)
                <x-card class="flex justify-between">
                    <li
                        class="{{ data_get($product, 'finish') ? 'line-through text-gray-400' : '' }} cursor-pointer"
                        wire:click="toogle({{ data_get($product, 'id') }})"
                        wire:key="{{ data_get($product, 'id') }}"
                    >
                        {{ data_get($product, 'item') }}
                    </li>
                    <div class="flex gap-4">
                        <x-icon
                            wire:click="edit({{ data_get($product, 'id') }})"
                            color="#60A5FA"
                            name="pencil"
                            class="h-5 w-5 cursor-pointer"
                        />
                        <x-icon
                            wire:click="delete({{ data_get($product, 'id') }})"
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
