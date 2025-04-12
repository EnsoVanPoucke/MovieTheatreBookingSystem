<?php

namespace App\Livewire;

use Livewire\Component;

class TicketBooking extends Component {
	public $movieScreeningData;
	public $selectedTickets = [];

	protected $listeners = ['ticketUpdated'];

	public function ticketUpdated($data) {
		$this->selectedTickets[$data['index']] = $data;
	}

	public function render() {
		return view('livewire.book-tickets', [
			'selectedTickets' => $this->selectedTickets
		]);
	}
}
