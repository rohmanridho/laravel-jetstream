<?php

namespace App\Http\Livewire;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $name, $kind, $food, $file_name, $old_file_name, $modal = false, $animal_id;
    
    public function render()
    {
        $animals = Animal::latest()->simplePaginate(10);
        return view('dashboard', [
            'animals' => $animals
        ]);
    }

    public function openModal() {
        $this->modal = true;
    }

    public function closeModal() {
        $this->modal = false;
        $this->resetField();
    }

    public function resetField() {
        $this->name = '';
        $this->kind = '';
        $this->food = '';
        $this->file_name = null;
    }

    public function store() {
        // dd($this->file_name);
        $imageValidation = '';
        if($this->file_name != $this->old_file_name) {
            $imageValidation = 'required|image|mimes:png,jpg,jpeg|max:1024';
        }
        
        $this->validate([
            'name' => 'required', 
            'kind' => 'required',
            'food' => 'required',
            'file_name' => $imageValidation
        ]);

        if($this->file_name != $this->old_file_name){
            $fileName = $this->file_name->store('animal');
        } else {
            $fileName = $this->file_name;
        }

        $result = Animal::updateOrCreate(['id' => $this->animal_id], [
            'name' => $this->name,
            'kind' => $this->kind,
            'food' => $this->food,
            'file_name' => $fileName
        ]);
        if ($result != "0") {
            session()->flash('message', 'Update succesfuly');
        } else {
            session()->flash('errMessage', 'Update failed');
        }
        $this->closeModal();
        $this->resetField();
    }

    public function edit($id) {
        $animal = Animal::find($id);
        $this->name = $animal->name;
        $this->kind = $animal->kind;
        $this->food = $animal->food;
        $this->file_name = $animal->file_name;
        $this->old_file_name = $animal->file_name;
        $this->animal_id = $id;
        $this->openModal();
    }
}