<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Penerbit as ModelsPenerbit;

class Penerbit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create, $edit, $delete;
    public $nama, $penerbit_id;
    public $search;

    protected $rules = [
        'nama' => 'required',
    ];

    public function create()
    {
        $this->create = true;
    }
    public function store()
    {
        $this->validate();

        ModelsPenerbit::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');

        $this->format();
    }

    public function edit(ModelsPenerbit $penerbit)
    {
        $this->format();

        $this->nama = $penerbit->nama;
        $this->penerbit_id = $penerbit->id;
        $this->edit = true;
    }

    public function update(ModelsPenerbit $penerbit)
    {
        $this->validate();

        $penerbit->update([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil dihapus.');

        $this->format();
    }

    public function delete(ModelsPenerbit $penerbit)
    {
        $this->penerbit_id = $penerbit->id;
        $this->delete = true;
    }

    public function destroy(ModelsPenerbit $penerbit)
    {
        $buku = Buku::where('penerbit_id', $penerbit->id)->get();
        foreach ($buku as $key => $value) {
            $value->update([
                'penerbit_id' => 1
            ]);
        }
        $penerbit->delete();

        session()->flash('sukses', 'Data berhasil diubah.');

        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $penerbit = ModelsPenerbit::latest()->where('nama', 'like', '%' . $this->search . '%')->paginate(5);
        } else {
            $penerbit = ModelsPenerbit::latest()->paginate(5);
        }

        return view('livewire.petugas.penerbit', compact('penerbit'));
    }

    public function format()
    {
        unset($this->create);
        unset($this->edit);
        unset($this->delete);
        unset($this->nama);
        unset($this->penerbit_id);
    }
}
