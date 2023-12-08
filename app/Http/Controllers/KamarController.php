<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Kamar;
use App\Models\DetailKamar;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreKamarRequest;
use App\Http\Requests\UpdateKamarRequest;
use App\Models\KamarGambar;
use App\Models\TipeKamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Kamar/Index', [
            'kamar' => Kamar::with(['details', 'tipe'])->filter(Request::only('search', 'tipe'))->orderBy('id', 'desc')->paginate(10),
            'search' => Request::input('search'),
            'tipe' => Request::input('tipe'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Kamar/Form', [
            'kamar' => Kamar::with(['details', 'tipe'])->orderBy('id', 'desc')->paginate(10),
            'tipe_kamar' => TipeKamar::all(),
        ]);
    }
    private function createCode()
    {
        $alternatif = Kamar::max('kode');
        if ($alternatif == null) {
            $kode = "KA-01";
        } else {
            $parse_kode = substr($alternatif, 3, 2);
            $parse_kode++;
            $huruf = "KA-";
            $kode = sprintf($huruf . "%02s",  $parse_kode);
        }
        return $kode;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKamarRequest $request)
    {
        $file = $request->file('foto');
        $nama = md5($file->getClientOriginalName());
        $file->storeAs('public', 'kamar/' . $nama);

        $kamar = Kamar::create([
            'tipe_kamar' => $request->tipe_kamar,
            'kode' => $this->createCode(),
            'ket' => $request->ket,
            'ruangan' => $request->ruangan,
            'status' => '1',
        ]);
        KamarGambar::create([
            'kamar_id' => $kamar->id,
            'ket' => 'gambar',
            'name' => $nama,
            'default' => true,
        ]);
        $fasilitas = $request->fasilitas;
        for ($i = 0; $i < count($fasilitas); $i++) {
            if ($fasilitas[$i] !== null) {
                DetailKamar::create([
                    'kamar_id' => $kamar->id,
                    'jenis' => 'fasilitas',
                    'detail' => $fasilitas[$i],
                ]);
            }
        }
        return redirect()->route('Kamar.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        $kamar = $kamar->with(['details', 'tipe',])->find(Request::input('slug'));
        return Inertia::render('Admin/Kamar/Show', [
            'kamar' => $kamar->with(['details', 'tipe'])->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        $kamar = $kamar->with(['details', 'tipe',])->find(Request::input('slug'));
        // dd($kamar);
        return Inertia::render('Admin/Kamar/Edit', [
            'kamar' => Kamar::with(['details', 'tipe'])->find(Request::input('slug')),
            'tipe_kamar' => TipeKamar::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKamarRequest $request, Kamar $kamar)
    {
        $kamar = Kamar::find(Request::input('slug'));
        $kamar->update([
            'ket' => $request->ket,
            'ruangan' => $request->ruangan,
        ]);
        if ($request->file('foto') !== null) {
            // Ambil Data Foto
            $path = Storage::disk('public')->exists('kamar/' . $kamar->gambar);

            // Hapus Jika Foto Ada Dalam Folder Public
            if ($path) {
                Storage::disk('public')->delete('kamar/' . $kamar->gambar);
            }
            // Ambil path Gmabar
            $file = $request->file('foto');
            $nama = md5($file->getClientOriginalName());
            $file->storeAs('public', 'kamar/' . $nama);
            // Update Data Gambar Pada Detail Kamar
            $detail = DetailKamar::where('kamar_id', $kamar->id)->where('jenis', '=', 'gambar')->first();
            $detail->update([
                'detail' => $nama,
            ]);
        }
        // request fasilitas
        $fasilitas = $request->fasilitas;
        //  Update data detail kamar;
        for ($i = 0; $i < count($fasilitas); $i++) {
            if ($fasilitas[$i] !== null) {
                $detail = DetailKamar::where('kamar_id', $kamar->id)->where('jenis', '=', 'fasilitas')->where('detail', 'like', '%' . $fasilitas[$i] . '%')->get();
                if ($detail->count() > 0) {
                    DetailKamar::where('kamar_id', $kamar->id)->where('jenis', '=', 'fasilitas')->where('detail', 'like', '%' . $fasilitas[$i] . '%')->update([
                        'detail' => $fasilitas[$i],
                    ]);
                } else {
                    DetailKamar::create([
                        'kamar_id' => $kamar->id,
                        'jenis' => 'fasilitas',
                        'detail' => $fasilitas[$i],
                    ]);
                }
            }
        }
        return redirect()->route('Kamar.index')->with('success', 'Berhasil Di Edit');
    }

    public function updateKamar($id)
    {
        // dd(Request::input('status'));

        Request::validate([
            'status' => 'required',
        ]);
        Kamar::find($id)->update(['status' => Request::input('status')]);


        return redirect()->route('Kamar.index')->with('success', 'Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar = Kamar::find(Request::input('slug'));
        // Ambil Data Foto
        $path = Storage::disk('public')->exists('kamar/' . $kamar->gambar);

        // Hapus Jika Foto Ada Dalam Folder Public
        if ($path) {
            Storage::disk('public')->delete('kamar/' . $kamar->gambar);
        }
        $kamar->delete();
        return redirect()->route('Kamar.index')->with('success', 'Berhasil Di Hapus');
    }


    // Tipe Kamar Controller
    /**
     * Display a listing of the resource.
     */
    public function getId()
    {
        return TipeKamar::find(Request::input('slug'));
    }
    public function indexTipe()
    {
        return Inertia::render('Admin/Kamar/TipeKamar', [
            'kamar' => TipeKamar::orderBy('id','desc')->paginate(10),
            'tipekamar' => TipeKamar::find(Request::input('slug')),
            'search' => Request::input('search'),
            'tipe' => Request::input('tipe'),
        ]);
    }
    public function storeTipe()
    {
        Request::validate([
            'tipe' => 'required',
            'harga' => 'required|numeric',

        ]);

        $tipe = TipeKamar::create([
            'tipe' => Request::input('tipe'),
            'harga' => Request::input('harga'),
        ]);

        return redirect()->route('Kamar.tipekamar.index')->with('success', 'Berhasil Di Tambah Tipe Kamar');
    }
    public function updateTipe()
    {
        Request::validate([
            'slug' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',

        ]);

        $tipe = TipeKamar::find(Request::input('slug'))->update([
            'tipe' => Request::input('tipe'),
            'harga' => Request::input('harga'),
        ]);

        return redirect()->route('Kamar.tipekamar.index')->with('success', 'Berhasil Di Edit Tipe Kamar');
    }

    public function deleteTipe(Kamar $kamar)
    {
        $tipe = TipeKamar::find(Request::input('slug'))->delete();

        return redirect()->route('Kamar.tipekamar.index')->with('success', 'Tipe Kamar. Berhasil Di Hapus');
    }
}
