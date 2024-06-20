<div class="h-screen w-screen">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="inline-grid grid-cols-6 gap-2 items-center space-x-3 space-y-3">
        <div class="items-center border-2 border-slate-500">
            <h1>Create a card</h1>
            <form wire:submit="save">
                <label for="libelle">
                    Libelle :
                    <input id="libelle" type="text" wire:model="form.libelle">
                </label>
                <div>
                    @error('form.libelle') <span class="error">{{ $message }}</span> @enderror
                </div>
             
                <label for="description">
                    Description :
                    <input id="description" type="text" wire:model="form.description">
                </label>
                <div>
                    @error('form.description') <span class="error">{{ $message }}</span> @enderror
                </div>
             
                <button type="submit">Create</button>
            </form>
        </div>
        @foreach ($cards as $card)
            <div class="border-2 border-slate-500">
                <h1>{{ $card->libelle }}</h1>
                <p>{{ $card->description }}</p>
                <p>
                    <button class="bg-red-500 py-2 px-2 text-gray-100 border border-gray-500" wire:click='delete({{ $card->id }})'>Delete</button>
                    @can('update',$card)
                        <button class="bg-green-500 py-2 px-2 text-gray-100 border border-gray-500" wire:click='showFormUpdate({{$card->id}})'>Edit</button>
                    @endcan
                </p>

                @if ($isShowFormUpdate == true && $card->id == $cardForUpdate->id)
                    <form class="my-3 space-y-1" wire:submit='submitUpdate({{ $cardForUpdate->id }})'>
                        <label for="libelle">Choisissez un nouveau libelle</label>
                        <input id="libelle" type="text" wire:model='updateLibelle'>
                        <label for="description">Choisissez une nouvelle description</label>
                        <input id="description" type="text" wire:model='updateDescription'>
                        <p><button type="submit" class="border border-gray-500 p-2">Changer la card</button></p>
                    </form>
                @endif

                <h1>List of Element(s)</h1>
                <div class="items-center border-2 border-slate-500">
                    @livewire('CreateElement', ['cardId' => $card->id])
                </div>
                @foreach ($card->element as $element)
                    <div>
                        <p>{{ $element->libelle }}</p>
                    </div>
                @endforeach
            </div>
            {{-- @can('delete', $card) --}}
                
            {{-- @endcan --}}
        @endforeach
    </div>
</div>
