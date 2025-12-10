<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\InventoryMovement;

class InventoryMovementForm extends Component
{
    // Propiedades para el formulario
    public $product_id;
    public $type = 'entrada';
    public $quantity;
    public $note;

    // Método para guardar el movimiento
    public function save()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entrada,salida',
            'note' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($this->product_id);

        // Registrar el movimiento
        InventoryMovement::create([
            'product_id' => $this->product_id,
            'type'       => $this->type,
            'note'       => $this->note,
            'quantity'   => $this->quantity,
        ]);

        // Actualizar el stock según el tipo
        $product->applyMovement($this->type, $this->quantity);

        session()->flash('message', 'Movimiento registrado correctamente.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.inventory-movement-form', [
            'products' => Product::all(),
        ]);
    }
}

