<?php

namespace App\Livewire\List;

use App\Models\Item;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Collection;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use Interactions;

    public string $item;
    public Collection $items;
    public int $quantity = 1;
    public User $user;
    public ?int $itemId = null;

    public function mount(#[CurrentUser]User $user): void
    {
        $this->user = $user;
        $items = Item::whereUserId($user->id)->get();

        if ($items->isEmpty()) {
            $this->items = collect();
            return;
        }

        $this->items = $items->map(fn ($item) => $this->setItem(
            $item->id,
            $item->product,
            $item->quantity,
            $item->finish
        ));
    }

    public function render()
    {
        return view('livewire.list.index');
    }

    public function save(): void
    {
        $this->validate();

        if ($this->itemId !== null) {
            $item = Item::find($this->itemId);
            $item->update([
                'product' => mb_strtoupper($this->item),
                'quantity' => $this->quantity,
                'finish' => false,
            ]);
            $this->items = $this->items->map(function ($product) use ($item) {
                if ($product['id'] === $item->id) {
                    $product['quantity'] = $item->quantity;
                    $product['item'] = sprintf('%s - %s', $item->product, $product['quantity']);
                    $product['finish'] = false;
                }
                return $product;
            });
            $this->reset('item', 'itemId');
            $this->quantity = 1;
            return;
        }

        $item = Item::whereProduct(mb_strtoupper($this->item))
            ->whereUserId(auth()->user()->id)
            ->first();

        if (empty($item)) {
            Item::create([
                    'product' => mb_strtoupper($this->item),
                    'quantity' => $this->quantity,
                    'user_id' => $this->user->id,
            ]);
        } else {
            $item->update([
                'quantity' => $item->quantity + $this->quantity
            ]);
        }

        $item = Item::whereProduct(mb_strtoupper($this->item))
            ->whereUserId(auth()->user()->id)
            ->first();

        $existsItem = array_filter($this->items->toArray(), function ($product) use ($item) {
            if ($product['id'] === $item->id) {
                return $product;
            }
        });
        if (empty($existsItem)) {
            $this->items->push($this->setItem(
                $item->id,
                $item->product,
                $item->quantity,
                (bool) $item->finish
            ));
        } else {
            $this->items = $this->items->map(function ($product) use ($item) {
                if ($product['id'] === $item->id) {
                    $product['quantity'] = $item->quantity;
                    $product['item'] = sprintf('%s - %s', $item->product, $product['quantity']);
                    $product['finish'] = false;
                }
                return $product;
            });
        }

        $this->reset('item');
        $this->quantity = 1;
    }

    public function confirmClear(): void
    {
        $this->dialog()
            ->question('Aviso!', 'Tem certeza que deseja limpar a lista?')
            ->confirm('OK', 'clear')
            ->cancel('Cancelar')
            ->send();
    }

    public function clear(): void
    {
        Item::whereUserId($this->user->id)->get()->each(fn ($item) => $item->delete());
        $this->resetExcept('user');
        $this->items = collect();
    }

    public function toggle(Item $item): void
    {
        $item->update([
            'finish' => !$item->finish,
        ]);

        $this->items = $this->items->map(function ($product) use ($item) {
            if ($product['id'] === $item->id) {
                $product['finish'] = !$product['finish'];
            }
            return $product;
        });
    }

    public function confirmDelete(Item $item): void
    {
        $this->dialog()
            ->question('Aviso!', sprintf('Tem certeza que deseja excluir %s?', $item->product))
            ->confirm('OK', 'delete', $item->id)
            ->cancel('Cancelar')
            ->send();
    }
    public function delete(Item $item): void
    {
        $item->delete();
        $this->items = $this->items->filter(fn ($product) => $product['id'] !== $item->id);
    }

    public function edit(Item $item): void
    {
        $this->item = $item->product;
        $this->quantity = $item->quantity;
        $this->itemId = $item->id;
    }

    protected function rules(): array
    {
        return [
            'item' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ];
    }

    protected function messages(): array
    {
        return [
            'item.required' => 'O campo Descrição é obrigatório!',
            'quantity.required' => 'O campo Quantidade é obrigatório!',
            'quantity.min' => 'A quantidade minima é 1!',
        ];
    }

    private function setItem(int $id, string $item, int $quantity, bool $finish): array
    {
        return [
            'id' => $id,
            'item' => sprintf('%s - %s', $item, $quantity),
            'quantity' => $quantity,
            'finish' => $finish,
        ];
    }
}
