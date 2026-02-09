<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $sort = [
        'column'    => 'created_at',
        'direction' => 'desc',
    ];

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'name', 'label' => 'Nome'],
        ['index' => 'email', 'label' => 'E-mail'],
        ['index' => 'role', 'label' => 'Perfil', 'sortable' => false],
        ['index' => 'created_at', 'label' => 'Criado em'],
        ['index' => 'action', 'sortable' => false],
    ];

    public function render(): View
    {
        return view('livewire.users.index');
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        return User::query()
            ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn (Builder $query) => $query->whereAny(['name', 'email'], 'like', '%'.trim($this->search).'%'))
            ->orderBy(...array_values($this->sort))
            ->with('roles')
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
