<?php

namespace App\Livewire\List;

use App\Models\Item;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Trash extends Component
{
    use Interactions;
    public function render()
    {
        return view('livewire.list.trash');
    }

    public function confirmClearAll(): void
    {
        $this->dialog()
            ->question('Aviso!', 'Tem certeza que deseja limpar a lista?')
            ->confirm('OK', 'clearAll')
            ->cancel('Cancelar')
            ->send();
    }

    public function clearAll(): void
    {
        Item::whereUserId(auth()->user()->id)->get()->each(fn ($item) => $item->delete());
        $this->dispatch('CLEAR::ALL');
    }

    public function confirmClearSelected(): void
    {
        $this->dialog()
            ->question('Aviso!', 'Tem certeza que deseja limpar os itens selecionados da lista?')
            ->confirm('OK', 'clearSelected')
            ->cancel('Cancelar')
            ->send();
    }

    public function clearSelected(): void
    {
        Item::whereUserId(auth()->user()->id)
            ->where('finish', true)
            ->get()
            ->each(fn ($item) => $item->delete());
        $this->dispatch('CLEAR::SELECTED');
    }
}
