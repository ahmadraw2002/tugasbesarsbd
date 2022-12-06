<?php
    
namespace App\Http\Controllers;
    
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobilController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:mobil-list|mobil-create|mobil-edit|mobil-delete', ['only' => ['index','show']]);
         $this->middleware('permission:mobil-create', ['only' => ['create','store']]);
         $this->middleware('permission:mobil-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:mobil-delete', ['only' => ['destroy','deletelist']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $mobils = DB::table('mobils')
                    ->where('merk','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(6);
        return view('mobils.index',compact('mobils'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobils.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mobil' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'harga' => 'required',
            'ktp_pembeli' =>'required',
            'ktp_pemilik' =>'required',

        ]);
    
        DB::insert('INSERT INTO mobils(id_mobil,merk,tahun,harga,ktp_pembeli,ktp_pemilik) VALUES (:id_mobil, :merk,:tahun ,:harga, :ktp_pembeli, :ktp_pemilik)',
        [
            'id_mobil' => $request->id_mobil,
            'merk' => $request->merk,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
            'ktp_pembeli' => $request->ktp_pembeli,
            'ktp_pemilik' => $request->ktp_pemilik,
        ]
        );
    
        return redirect()->route('mobils.index')
                        ->with('Berhasil','Menambahkan Data Mobil');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show(Mobil $mobil)
    {
        return view('mobils.show',compact('mobil'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mobil  $mobill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mobil = DB::table('mobils')->where('id_mobil', $id)->first();
        return view('mobils.edit',compact('mobil'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_mobil' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'harga' => 'required',
            'ktp_pembeli' =>'required',
            'ktp_pemilik' =>'required',
        ]);
       //$game->update($request->all());
        DB::update('UPDATE mobils SET id_mobil = :id_mobil, merk = :merk,tahun = :tahun ,harga = :harga, ktp_pembeli = :ktp_pembeli, ktp_pemilik = :ktp_pemilik WHERE id_mobil = :id',
        [
            'id' => $id,
            'id_mobil' => $request->id_mobil,
            'merk' => $request->merk,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
            'ktp_pembeli' => $request->ktp_pembeli,
            'ktp_pemilik' => $request->ktp_pemilik,
        
        ]
        );
        return redirect()->route('mobils.index')
                        ->with('Berhasil','Mengubah Data Mobil');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE mobils SET deleted_at = NOW() WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobils.index')
                        ->with('Berhasil','Menghapus Data Mobil');
    }
    
    public function deletelist()
    {
        $mobils = DB::table('mobils')
                    ->whereNotNull('deleted_at')
                    ->paginate(6);
        return view('/mobils/trash',compact('mobils'))
            ->with('i', (request()->input('page', 1) - 1) * 6);

    }
    
    public function restore($id)
    {
        DB::update('UPDATE mobils SET deleted_at = NULL WHERE id_mobil = :id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobils.index')
                        ->with('Behasil','Memulihkan Data Mobil');
    }

    public function deleteforce($id)
    {
        DB::delete('DELETE FROM mobils WHERE id_mobil=:id_mobil', ['id_mobil' => $id]);
        return redirect()->route('mobils.index')
                        ->with('Berhasil','Menghapus Permanen Data Mobil');
    }
}