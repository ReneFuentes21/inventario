<?php

namespace App\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Crud extends Component
{
    use WithFileUploads;

    public $products = [];
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock_quantity;
    public $image;
    public $modal = false;
    public $modalEdit = false;



    public function render()
    {
        return view('livewire.productos.crud');
    }

    public function getProducts()
    {
        return  Product::where('id', '>', 0)->get();
    }

    public function mount()
    {
        $this->products = $this->getProducts();
    }


    //Reseteamos los campos del formulario
    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->stock_quantity = '';
        $this->image ;
    }

    //Abrimos el modal de agregar producto
    public function openModal()
    {
        $this->resetInputFields();
        $this->modal = true;

    }

    //Cerramos los modales
    public function closeModal()
    {
        $this->modal = false;
        $this->modalEdit = false;
    }

    //Abrimos el modal de editar producto
    public function openEditModal($id)
    {
        $product = Product::findOrFail($id);
        $this->id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->image = null;
        $this->modalEdit = true;
    }

    //En esta funcion agregamos un nuevo producto
    public function addProduct(){
        $newPoduct = new Product();
        $newPoduct->name = $this->name;
        $newPoduct->description = $this->description;
        $newPoduct->price = $this->price;
        $newPoduct->stock_quantity = $this->stock_quantity;
        //Aca guardamos la imagen si es que se subio una
        if($this->image){
            $imagePath = $this->image->store('products', 'public');
            $newPoduct->image = $imagePath;
        }
        $newPoduct->save();
        $this->resetInputFields();
        $this->modal = false;
        $this->products = $this->getProducts();

    }

    //Aca en esta funcion actualizamos el producto
    public function updateProduct()
    {
        $product = Product::findOrFail($this->id);

        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->stock_quantity = $this->stock_quantity;
        //Aca actualizamos la imagen si es que se subio una nueva
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        $this->resetInputFields();
        $this->modalEdit = false;
        $this->products = $this->getProducts();
    }

    //Funcion para eliminar un producto
    public function deleteProduct(Product $product){
        
        $product->delete();
        $this->products = $this->getProducts();
    }

    



}
