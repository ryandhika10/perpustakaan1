<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Rak;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Buku as ModelsBuku;

class Buku extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $create, $show, $edit, $delete;
    public $kategori, $rak, $penerbit;
    public $kategori_id, $rak_id, $penerbit_id, $buku_id;
    public $judul, $stok, $penulis, $sampul, $baris;
    public $search;

    protected $rules = [
        'judul' => 'required',
        'penulis' => 'required',
        'stok' => 'required|numeric|min:1',
        'sampul' => 'required|image|max:3072',
        'kategori_id' => 'required|numeric|min:1',
        'rak_id' => 'required|numeric|min:1',
        'penerbit_id' => 'required|numeric|min:1',
    ];

    protected $validationAttributes = [
        'kategori_id' => 'kategori',
        'rak_id' => 'rak',
        'penerbit_id' => 'penerbit',
    ];

    public function pilihKategori()
    {
        $this->rak = Rak::where('kategori_id', $this->kategori_id)->get();
    }

    public function create()
    {
        $this->format();
        $this->create = true;
        $this->kategori = Kategori::all();
        $this->penerbit = Penerbit::all();
    }

    public function store()
    {
        $this->validate();

        $this->sampul = $this->sampul->store('buku', 'public');

        ModelsBuku::create([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'stok' => $this->stok,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'penerbit_id' => $this->penerbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');

        $this->format();
    }

    public function show(ModelsBuku $buku)
    {
        $this->format();
        $this->show = true;
        $this->judul = $buku->judul;
        $this->sampul = $buku->sampul;
        $this->penulis = $buku->penulis;
        $this->stok = $buku->stok;
        $this->kategori = $buku->kategori->nama;
        $this->penerbit = $buku->penerbit->nama;
        $this->rak = $buku->rak->rak;
        $this->baris = $buku->rak->baris;
    }

    public function edit(ModelsBuku $buku)
    {
        $this->format();

        $this->edit = true;
        $this->buku_id = $buku->id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->stok = $buku->stok;
        $this->kategori_id = $buku->kategori_id;
        $this->rak_id = $buku->rak_id;
        $this->penerbit_id = $buku->penerbit_id;
        $this->kategori = Kategori::all();
        $this->rak = Rak::where('kategori_id', $buku->kategori_id)->get();
        $this->penerbit = Penerbit::all();
    }

    public function update(ModelsBuku $buku)
    {
        $validasi = [
            'judul' => 'required',
            'penulis' => 'required',
            'stok' => 'required|numeric|min:1',
            'kategori_id' => 'required|numeric|min:1',
            'rak_id' => 'required|numeric|min:1',
            'penerbit_id' => 'required|numeric|min:1',
        ];

        if ($this->sampul) {
            $validasi['sampul'] = 'required|image|max:3072';
        }

        $this->validate($validasi);

        if ($this->sampul) {
            Storage::disk('public')->delete($buku->sampul);
            $this->sampul = $this->sampul->store('buku', 'public');
        } else {
            $this->sampul = $buku->sampul;
        }

        $buku->update([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'stok' => $this->stok,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'penerbit_id' => $this->penerbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        session()->flash('sukses', 'Data berhasil diubah.');

        $this->format();
    }

    public function delete(ModelsBuku $buku)
    {
        $this->format();

        Storage::disk('public')->delete($buku->sampul);
        $this->buku_id = $buku->id;
        $this->delete = true;
    }

    public function destroy(ModelsBuku $buku)
    {

        $buku->delete();

        session()->flash('sukses', 'Data berhasil dihapus.');

        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $buku = ModelsBuku::latest()->where('judul', 'like', '%' . $this->search . '%')->paginate(5);
        } else {
            $buku = ModelsBuku::latest()->paginate(5);
        }

        return view('livewire.petugas.buku', compact('buku'));
    }
    public function format()
    {
        unset($this->create);
        unset($this->show);
        unset($this->edit);
        unset($this->delete);
        unset($this->kategori);
        unset($this->rak);
        unset($this->penerbit);
        unset($this->kategori_id);
        unset($this->rak_id);
        unset($this->penerbit_id);
        unset($this->buku_id);
        unset($this->judul);
        unset($this->stok);
        unset($this->penulis);
        unset($this->sampul);
        unset($this->baris);
    }
}
