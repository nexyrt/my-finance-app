<?php

use Livewire\Component;

new class extends Component {
    public int $currency = 0;

    public $date = '';

    public function save()
    {
        // Save the currency value to the database or perform any necessary actions
        $this->validate([
            'currency' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        dd($this->currency);
    }
};
?>

<div>
    {{-- He who is contented is rich. - Laozi --}}
    <x-currency wire:model="currency" locale="id-ID" :decimals="0" :precision="0" symbol="Rp" />
    <x-date label="Date Range" range />

    <x-button text="Save" wire:click="save" />
</div>
