<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\employee as Modelemployee;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama;
    public $email;
    public $alamat;

    public $updatedata = false;

    public $update_id;

    public $searchData;

    public function render()
    {

        if ($this->searchData != null) {
            $data = Modelemployee::WHERE('nama', 'like', '%' . $this->searchData . '%')->orderBy('nama', 'asc')->paginate(2);
        } else {
            $data = Modelemployee::orderBy('nama', 'asc')->paginate(2);
        }
        return view('livewire.employee', ['dataemployee' => $data]);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email:dns',
            'alamat' => 'required'
        ];

        $message = [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Format Email Salah',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
        ];

        $validated = $this->validate($rules, $message);

        Modelemployee::create($validated);
        session()->flash('message', 'Data berhasil ditambahkan');
        $this->clear();
    }

    public function update($id)
    {
        $data = Modelemployee::find($id);

        $this->nama = $data->nama;
        $this->email = $data->email;
        $this->alamat = $data->alamat;

        $this->updatedata = true;
        $this->update_id = $id;
    }

    public function updates()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email:dns',
            'alamat' => 'required'
        ];

        $message = [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Format Email Salah',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
        ];

        $validated = $this->validate($rules, $message);
        $data = Modelemployee::find($this->update_id);
        $data->update($validated);
        session()->flash('message', 'Data berhasil diupdate');

        $this->clear();
    }

    public function clear()
    {
        $this->nama = '';
        $this->email = '';
        $this->alamat = '';

        $this->updatedata = false;
        $this->update_id = '';
    }


    public function delete($id)
    {
        $data = Modelemployee::find($id);
        $data->delete();
        $this->clear();
        session()->flash('message', 'Data berhasil dihapus');
    }
}
