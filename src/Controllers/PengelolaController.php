<?php
namespace Leazycms\Domain\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Leazycms\Domain\Models\Pengelola;

class PengelolaController extends Controller  implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),

        ];
    }
public function index(Request $request){
    $data = $request->user()->isAdmin() ? Pengelola::get() : Pengelola::whereBelongsTo($request->user())->get();
    return view('domain::admin.pengelola.index',compact('data'));
}
public function edit(Request $request, Pengelola $pengelola){
    $data = $request->user()->isAdmin() ? $pengelola : ($pengelola->user_id == $request->user()->id ? $pengelola : abort('403'));
    return view('domain::admin.pengelola.form',compact('data'));
}
public function create(Request $request){
    $data = null;
    return view('domain::admin.pengelola.form',compact('data'));
}
public function update(Request $request, Pengelola $pengelola){
    $pengelola->update([
        'nip'=>$request->nip,
        'nama'=>$request->nama,
        'jabatan'=>$request->jabatan,
        'nohp'=>$request->nohp,
        'jenis_pengelola'=>$request->jenis_pengelola,
    ]);

    if($request->hasFile('surat_keterangan')){
        $fname = $pengelola->addFile([
            'file'=>$request->file('surat_keterangan'),
            'purpose'=>'surat-keterangan',
            'mime_type'=>['application/pdf']
        ]);

        $pengelola->update([
            'surat_keterangan'=>$fname
        ]);

    }
    if($request->hasFile('surat_kuasa')){
        $fname = $pengelola->addFile([
            'file'=>$request->file('surat_kuasa'),
            'purpose'=>'surat-kuasa',
            'mime_type'=>['application/pdf']
        ]);

        $pengelola->update([
            'surat_kuasa'=>$fname
        ]);

    }

    return back()->with('success','Perubahan tersimpan');
}
public function store(Request $request, Pengelola $pengelola){

    $pengelola = $pengelola->create([
        'nip'=>$request->nip,
        'nama'=>$request->nama,
        'jabatan'=>$request->jabatan,
        'nohp'=>$request->nohp,
        'jenis_pengelola'=>$request->jenis_pengelola,
    ]);

    if($request->hasFile('surat_keterangan')){
        $fname = $pengelola->addFile([
            'file'=>$request->file('surat_keterangan'),
            'purpose'=>'surat_keterangan',
            'mime_type'=>['application/pdf']
        ]);

        $pengelola->update([
            'surat_keterangan'=>$fname
        ]);

    }
    if($request->hasFile('surat_kuasa')){
        $fname = $pengelola->addFile([
            'file'=>$request->file('surat_kuasa'),
            'purpose'=>'surat_kuasa',
            'mime_type'=>['application/pdf']
        ]);

        $pengelola->update([
            'surat_kuasa'=>$fname
        ]);

    }
    return back()->with('success','Perubahan tersimpan');
}
}
