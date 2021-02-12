<div class="w-full px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Categorias</label>

    <select id="categories" wire:model="categories"
            class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" multiple>

        @foreach(\App\Models\Category::all(['id', 'name']) as $category)
            <option wire:key="{{$loop->index}}" value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>
