<?php

namespace App\Livewire\List;

use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    public string $item;
    public Collection $items;
    public int $quantity = 1;

    public function mount(): void
    {
        $this->items = collect();
    }

    public function render()
    {
        return view('livewire.list.index');
    }

    public function save(): void
    {
        $this->validate();
        $this->items->push(sprintf('%s - %s', $this->item, $this->quantity));
        $this->reset('item');
        $this->quantity = 1;
    }

    public function showList(): bool
    {
        return !empty($this->items);
    }

    public function clear(): void
    {
        $this->reset();
        $this->items = collect();
    }

    protected function rules(): array
    {
        return [
            'item' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ];
    }
}
