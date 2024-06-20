<div>
    <h1>Create a element</h1>
    <form wire:submit="save">
        <label for="libelleElement">
            Libelle :
            <input id="libelleElement" type="text" wire:model="elementForm.libelle">
            <input id="card_id_element" type="text" value="{{$cardId}}" wire:model="elementForm.card_id" hidden>
        </label>
        <div>
            @error('elementForm.libelle') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit">Create</button>
    </form>
</div>
