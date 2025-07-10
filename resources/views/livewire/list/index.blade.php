<div class="flex flex-col gap-2">
    <x-card>
        <form wire:submit="save" class="flex flex-col justify-center gap-2">
            <div class="w-full">
                <x-input class="w-full" wire:model="item"/>
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
                <x-card>
                    <li>{{ $product }}</li>
                </x-card>
            @endforeach
        </ul>
    @endif
</div>
