<div class="flex-1">
    <x-modal title="Escolha o que deseja apagar" id="modal-trash" center>
        <div class="flex flex-col gap-4">
            <x-button color="red" x-on:click="$modalClose('modal-trash')"  wire:click="confirmClearSelected">
                <x-icon name="trash" class="h-5 w-5"/>DELETAR SOMENTE OS ITENS SELECIONADOS
            </x-button>
            <x-button color="red" x-on:click="$modalClose('modal-trash')"  wire:click="confirmClearAll">
                <x-icon name="trash" class="h-5 w-5"/> DELETAR TODOS OS ITENS
            </x-button>
        </div>
    </x-modal>

    <x-button x-on:click="$modalOpen('modal-trash')" color="red" class="w-full h-full" >
        <x-icon name="trash" class="h-5 w-5"/>
    </x-button>
</div>
