<?php

namespace App\Livewire;

use Livewire\Component;

class TicketQuantityContinue extends Component {
	public $date;
	public $time;
	public $screen_number;
	public $movie_id;
	public $movie_title;
	public $selectedTickets;

	public function continueToScreen() {
		// if (empty($this->selectedTickets)) {
		// 	session()->flash('error', 'Je moet minstens één ticket selecteren.');
		// 	return;
		// }

		// Process the selected tickets, e.g., redirecting to checkout
		return redirect()->route('checkout', [
			'date' => $this->date,
			'time' => $this->time,
			'screen_number' => $this->screen_number,
			'movie_id' => $this->movie_id,
			'movie_title' => $this->movie_title,
			'selectedTickets' => $this->selectedTickets
		]);

		dd('ok');
	}

	public function render() {
		return view('livewire.ticket-quantity-continue');
	}
}
