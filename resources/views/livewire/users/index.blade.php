<div>
    <x-card>
        <div class="mb-2 mt-4">
            <livewire:users.create @created="$refresh" />
        </div>
        <div class="hidden md:block">
            <x-table :$headers :$sort :rows="$this->rows" paginate filter loading :quantity="[2, 5, 15, 25]">
                @interact('column_role', $row)
                    @foreach($row->roles as $role)
                        <x-badge :text="$role->name" color="primary" />
                    @endforeach
                @endinteract

                @interact('column_created_at', $row)
                {{ $row->created_at->diffForHumans() }}
                @endinteract

                @interact('column_action', $row)
                <div class="flex gap-1">
                    <x-button.circle icon="pencil" wire:click="$dispatch('load::user', { 'user' : '{{ $row->id }}'})" />
                    <livewire:users.delete :user="$row" :key="uniqid('', true)" @deleted="$refresh" />
                </div>
                @endinteract
            </x-table>
        </div>

        <div class="block md:hidden space-y-4">
            @foreach($this->rows as $row)
                <x-card>
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="font-bold text-lg">{{ $row->name }}</div>
                            <div class="text-gray-500 text-sm">{{ $row->email }}</div>
                            <div class="mt-2">
                                @foreach($row->roles as $role)
                                    <x-badge :text="$role->name" color="primary" sm />
                                @endforeach
                            </div>
                        </div>
                        <div class="flex gap-1">
                            <x-button.circle icon="pencil" wire:click="$dispatch('load::user', { 'user' : '{{ $row->id }}'})" sm />
                            <livewire:users.delete :user="$row" :key="uniqid('mobile', true)" @deleted="$refresh" />
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-400 text-right">
                        {{ $row->created_at->diffForHumans() }}
                    </div>
                </x-card>
            @endforeach
            <div class="mt-4">
                {{ $this->rows->links('pagination::mobile-numbers', data: ['scrollTo' => false]) }}
            </div>
        </div>
    </x-card>

    <livewire:users.update @updated="$refresh" />
</div>
