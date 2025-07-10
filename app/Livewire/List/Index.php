<?php

namespace App\Livewire\List;

use App\Models\Item;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    public string $item;
    public Collection $items;
    public int $quantity = 1;
    public User $user;

    public function mount(#[CurrentUser]User $user): void
    {
        $this->user = $user;
        $items = Item::whereUserId($user->id)->get();

        if ($items->isEmpty()) {
            $this->items = collect();
            return;
        }

        $this->items = $items->map(fn ($item) => sprintf('%s - %s', $item->product, $item->quantity));
    }

    public function render()
    {
        return view('livewire.list.index');
    }

    public function save(): void
    {
        $this->validate();
        Item::create([
            'product' => $this->item,
            'quantity' => $this->quantity,
            'user_id' => $this->user->id,
        ]);
        $this->items->push(sprintf('%s - %s', $this->item, $this->quantity));
        $this->reset('item');
        $this->quantity = 1;
    }

    public function clear(): void
    {
        $this->reset();
        Item::whereUserId($this->user->id)->get()->each(fn ($item) => $item->delete());
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
