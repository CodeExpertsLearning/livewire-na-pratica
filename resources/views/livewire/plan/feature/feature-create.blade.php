<div>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: outline/exclamation -->
                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                </svg>
            </div>
            <div class="mt-3 w-full text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                    Cadastrar Nova Feature
                </h3>
                <form action="">
                    <div class="mt-2">
                        <label>Feature</label>
                        <input wire:model="feature.name" type="text" placeholder="Nome da Feature" class="placeholder-black block appearance-none w-full bg-gray-200 border @error('feature.name') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        @error('feature.name')
                        <div class="w-full text-red-600 font-bold">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label>Tipo</label>
                        <select wire:model="feature.type" class="block appearance-none w-full bg-gray-200 border @error('feature.type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Selecione o Tipo da Feature</option>
                            <option value="amount">Quantidade de Registros</option>
                            <option value="view">Área de Tela</option>
                        </select>

                        @error('feature.type')
                        <div class="w-full text-red-600 font-bold">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label>Regra da Feature</label>
                        <textarea wire:model="feature.rule" placeholder="Regra da Feature"  class="placeholder-black block appearance-none w-full bg-gray-200 border @error('feature.rule') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>

                        @error('feature.rule')
                        <div class="w-full text-red-600 font-bold">{{$message}}</div>
                        @enderror
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button wire:click.prevent="addFeature" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
            Cadastrar
        </button>
        <button wire:click.prevent="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Cancel
        </button>
    </div>
</div>
