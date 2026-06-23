<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Dokumentasi;

class AdminDokumentasiController extends Controller
{
    /**
     * Display a listing of the documentation gallery.
     */
    public function index()
    {
        // Get all photos paginated (12 per page for responsive grid)
        $photos = Dokumentasi::orderBy('tanggal_upload', 'desc')
            ->orderBy('id_foto', 'desc')
            ->paginate(12);

        // Count total photos
        $totalPhotos = Dokumentasi::count();

        return view('dokumentasi.index', compact('photos', 'totalPhotos'));
    }

    /**
     * Store a newly created documentation photo in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_foto' => ['required', 'array'],
            'file_foto.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ], [
            'file_foto.required' => 'File foto wajib dipilih.',
            'file_foto.array' => 'Format file foto harus berupa array.',
            'file_foto.*.image' => 'Setiap file harus berupa gambar.',
            'file_foto.*.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'file_foto.*.max' => 'Ukuran setiap gambar maksimal adalah 5MB.',
        ]);

        if ($request->hasFile('file_foto')) {
            $keterangan = $request->input('keterangan');
            $destinationPath = public_path('img/dokumentasi');

            // Ensure destination directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            foreach ($request->file('file_foto') as $image) {
                $filename = 'dokumentasi_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $filename);

                Dokumentasi::create([
                    'file_foto' => $filename,
                    'keterangan' => $keterangan,
                    'tanggal_upload' => now(),
                ]);
            }

            return redirect()->route('admin.dokumentasi.index')->with('success', 'Foto galeri berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah foto.');
    }

    /**
     * Remove the specified documentation photo from storage.
     */
    public function destroy($id)
    {
        $photo = Dokumentasi::findOrFail($id);
        $filePath = public_path('img/dokumentasi/' . $photo->file_foto);

        // Delete file from storage
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Delete from database
        $photo->delete();

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Foto galeri berhasil dihapus.');
    }
}
