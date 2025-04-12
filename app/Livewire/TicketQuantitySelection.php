<?php

namespace App\Livewire;

use Livewire\Component;

class TicketQuantitySelection extends Component {
	public $quantity = 0;
	public $price;
	public $index;
	public $movieId;


	public function updatedQuantity() {
		$this->dispatch('ticketUpdated', [
			'index' => $this->index,
			'movieId' => $this->movieId,
			'quantity' => $this->quantity,
			'price' => $this->price
		]);
	}

	public function render() {
		return view('livewire.ticket-quantity-selection');
	}
}

// public function updateTotal() {
// 	$this->dispatch('update-total', [
// 		'index' => $this->index,
// 		'total' => $this->quantity * $this->price
// 	]);
// }

// public function mount($price, $index) {
// 	$this->price = $price;
// 	$this->index = $index;
// }


// public function updateTotal() {
// 	$this->dispatch('update-total', [
// 		'index' => $this->index,
// 		'total' => $this->quantity * $this->price
// 	]);
// }

// public function render() {
// 	return view('livewire.ticket-quantity-selection');
// }