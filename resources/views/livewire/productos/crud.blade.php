<section class="p-6">
    <h1 class="text-3xl font-bold mb-6">Gestión de Productos</h1>
    <button class="mb-4 rounded bg-green-600 px-4 py-2  hover:bg-green-500 border rounded-lg" wire:click="openModal"> Agregar Producto</button>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6 ">
        @foreach ($products as $product)
        {{-- Tarjeta para mostrar los productos  --}}
        <div class="bg-blue-50 border rounded-lg shadow-md p-5 hover:shadow-lg transition">
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                {{ $product->name }}
            </h2>
            <p class="text-gray-600 mb-2">
                {{ $product->description }}
            </p>
            <p class="text-gray-700 font-semibold mb-1">
                Precio: 
                <span class="text-green-600 font-bold">${{ $product->price }}</span>
            </p>
            <p class="text-gray-700 font-semibold mb-4">
                Stock: 
                <span class="text-blue-600 font-bold">{{ $product->stock_quantity }}</span>
            </p>
            <div class="w-full flex justify-center mb-4">
                <img src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-32 h-32 object-cover rounded-lg shadow">
            </div>
            <div class="flex gap-3">
                <button class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-lg transition" wire:click="openEditModal({{ $product->id }})">Editar </button>
                <button class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg transition" wire:click="deleteProduct({{ $product->id }})" onclick="confirm('¿Seguro que deseas eliminar este producto?') || event.stopImmediatePropagation()">Eliminar </button>
            </div>
        </div>
        @endforeach

    </section>





    {{-- MODAL AGREGAR --}}

    @if ($modal)
    <div class="fixed inset-0 flex items-center justify-center bg-blue bg-opacity-40">

        <div class="w-full max-w-lg bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Crear Producto</h2>

            <div class="space-y-3">

                <div>
                    <label class="block text-gray-700 font-semibold">Nombre</label>
                    <input type="text" wire:model="name" class="w-full border p-2 rounded">
                    @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Descripción</label>
                    <input type="text" wire:model="description" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Existencia</label>
                    <input type="number" wire:model="stock_quantity" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Precio</label>
                    <input type="number" wire:model="price" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Imagen</label>
                    <input type="file" wire:model="image" class="w-full border p-2 rounded">
                </div>

            </div>

            <div class="mt-6 flex justify-between">
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    wire:click="addProduct">
                    Guardar
                </button>

                <button
                    class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400"
                    wire:click="closeModal">
                    Cancelar
                </button>
            </div>

        </div>

    </div>
    @endif


    {{-- MODAL EDITAR --}}

    @if ($modalEdit)
    <div class="fixed inset-0 flex items-center justify-center bg-blue bg-opacity-40">

        <div class="w-full max-w-lg bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Editar Producto</h2>

            <div class="space-y-3">

                <div>
                    <label class="block text-gray-700 font-semibold">Nombre</label>
                    <input type="text" wire:model="name" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Descripción</label>
                    <input type="text" wire:model="description" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Existencia</label>
                    <input type="number" wire:model="stock_quantity" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Precio</label>
                    <input type="number" wire:model="price" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Nueva imagen (opcional)</label>
                    <input type="file" wire:model="image" class="w-full border p-2 rounded">

                    @if ($image)
                        <p class="text-sm text-green-600 mt-1">Nueva imagen cargada</p>
                    @endif
                </div>

            </div>

            <div class="mt-6 flex justify-between">

                <button
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                    wire:click="updateProduct">
                    Actualizar
                </button>

                <button
                    class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400"
                    wire:click="closeModal">
                    Cancelar
                </button>

            </div>

        </div>

    </div>
    @endif


</section>
