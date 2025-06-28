<?php

namespace App\Http\Controllers;

use App\Models\LokasiPresensi;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function presensiMasukCam()
    {
        try {
            // Ambil lokasi presensi berdasarkan nama lokasi dari karyawan yang sedang login
            $lokasi = LokasiPresensi::where(
                'nama_lokasi',
                Auth::user()->karyawan->lokasi_presensi
            )->firstOrFail();

            // Kembalikan view dengan data lokasi
            return view(
                'karyawan.presensi.presensi-masuk-cam',
                compact('lokasi')
            );
        } catch (\Throwable $th) {
            // Tangani error jika lokasi tidak ditemukan atau terjadi kesalahan lain
            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $th->getMessage()
            );
        }
    }

    public function presensiMasuk(Request $request)
    {
        try {
            $karyawan = Auth::user()->karyawan;
            $lokasi = LokasiPresensi::where(
                'nama_lokasi',
                $karyawan->lokasi_presensi
            )->firstOrFail();

            $tanggal = $request->tanggal;
            $jam = $request->jam;
            // Ambil NIP karyawan
            $nip = $karyawan->nip;

            // Cek jarak
            $jarak = $this->distance(
                $lokasi->latitude,
                $lokasi->longitude,
                $request->latitude,
                $request->longitude
            );

            // Validasi jarak dengan radius lokasi
            if (round($jarak) > $lokasi->radius) {
                // Jika berada di luar radius, kembalikan response error
                return response()->json(
                    [
                        'message' => 'Maaf, Anda berada di luar radius Kantor. Jarak Anda: ' . round($jarak) . ' meter dari Kantor.'
                    ],
                    403
                );
            }

            // Cek apakah sudah presensi masuk
            if (Presensi::where('karyawan_id', $karyawan->id)
                ->whereDate('tanggal_masuk', $tanggal)
                ->exists()
            ) {

                // Jika sudah ada, kembalikan response error
                return response()->json(
                    [
                        'message' => 'Maaf, Anda sudah melakukan presensi masuk hari ini.'
                    ],
                    409
                ); // 409 Conflict
            }

            // Simpan data
            $fileName = "presensi/foto_masuk/{$nip}-{$tanggal}.png";
            $image_base64 = $this->decodeBase64Image($request->photo);

            // Siapkan data untuk disimpan
            $data = [
                'tanggal_masuk' => $tanggal,
                'jam_masuk' => $jam,
                'foto_masuk' => $fileName,
                'karyawan_id' => $karyawan->id,
                'lokasi_presensi_id' => $lokasi->id,
            ];

            // Simpan data presensi masuk
            if (Presensi::create($data)) {
                // Simpan foto ke storage
                $this->simpanFoto($fileName, $image_base64);

                // Kembalikan response sukses
                return response()->json(
                    [
                        'message' => 'Presensi masuk Anda berhasil dicatat. Selamat bekerja!'
                    ],
                    201
                ); // 201 Created
            }

            // Jika gagal menyimpan data, kembalikan response error
            return response()->json(
                [
                    'message' => 'Terjadi kesalahan saat mencatat presensi masuk.'
                ],
                500
            ); // 500 Internal Server Error
        } catch (\Throwable $th) {
            // Tangani error jika terjadi kesalahan lain
            return response()->json(
                [
                    'message' => 'Terjadi kesalahan sistem.',
                    'error' => $th->getMessage()
                ],
                500
            );
        }
    }

    public function presensiKeluarCam()
    {
        try {
            // Ambil lokasi presensi berdasarkan nama lokasi dari karyawan yang sedang login
            $lokasi = LokasiPresensi::where(
                'nama_lokasi',
                Auth::user()->karyawan->lokasi_presensi
            )->firstOrFail();

            // Kembalikan view dengan data lokasi
            return view(
                'karyawan.presensi.presensi-keluar-cam',
                compact('lokasi')
            );
        } catch (\Throwable $th) {
            // Tangani error jika lokasi tidak ditemukan atau terjadi kesalahan lain
            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $th->getMessage()
            );
        }
    }

    public function presensiKeluar(Request $request)
    {
        try {
            $karyawan = Auth::user()->karyawan;
            $lokasi = LokasiPresensi::where(
                'nama_lokasi',
                $karyawan->lokasi_presensi
            )->firstOrFail();

            $tanggal = $request->tanggal;
            $jam = $request->jam;
            // Ambil NIP karyawan
            $nip = $karyawan->nip;

            // cek jarak
            $jarak = $this->distance(
                $lokasi->latitude,
                $lokasi->longitude,
                $request->latitude,
                $request->longitude
            );

            // Validasi jarak dengan radius lokasi
            if (round($jarak) > $lokasi->radius) {
                // Jika berada di luar radius, kembalikan response error
                return response()->json(
                    [
                        'message' => 'Maaf, Anda berada di luar radius Kantor. Jarak Anda: ' . round($jarak) . ' meter dari Kantor.'
                    ],
                    403
                );
            }

            // Ambil data presensi hari ini
            $presensi = Presensi::where(
                'karyawan_id',
                $karyawan->id
            )->whereDate('tanggal_masuk', $tanggal)->first();

            // Cek apakah sudah presensi masuk
            if (!$presensi) {
                // Jika tidak ada data presensi masuk, kembalikan response error
                return response()->json(
                    [
                        'message' => 'Presensi masuk belum ditemukan.'
                    ],
                    404
                );
            }

            // Cek apakah sudah presensi keluar
            if ($presensi->tanggal_keluar) {
                // Jika sudah ada, kembalikan response error
                return response()->json(
                    [
                        'message' => 'Maaf, Anda sudah melakukan presensi keluar hari ini.'
                    ],
                    409
                ); // 409 Conflict
            }

            // Simpan data presensi keluar
            $fileName = "presensi/foto_keluar/{$nip}-{$tanggal}.png";
            $image_base64 = $this->decodeBase64Image($request->photo);

            // Update data presensi keluar
            $presensi->update(
                [
                    'tanggal_keluar' => $tanggal,
                    'jam_keluar' => $jam,
                    'foto_keluar' => $fileName,
                ]
            );

            // Simpan foto ke storage
            $this->simpanFoto($fileName, $image_base64);

            // Kembalikan response sukses
            return response()->json(
                [
                    'message' => 'Presensi keluar Anda berhasil dicatat. Hati-hati di jalan!'
                ],
                200
            ); // Sukses
        } catch (\Throwable $th) {
            // Tangani error jika terjadi kesalahan lain
            return response()->json(
                [
                    'message' => 'Terjadi kesalahan sistem.',
                    'error' => $th->getMessage()
                ],
                500
            );
        }
    }

    /**
     * Menghitung jarak menggunakan rumus Haversine.
     */
    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        // Menghitung jarak antara dua koordinat geografis
        $theta = $lon1 - $lon2;
        $miles = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        return $miles * 1.609344 * 1000; // Meter
    }

    /**
     * Simpan file foto ke storage.
     */
    private function simpanFoto($path, $base64)
    {
        // Decode base64 string and save to storage
        Storage::disk('public')->put($path, $base64);
    }

    /**
     * Decode base64 photo.
     */
    private function decodeBase64Image($base64)
    {
        // Memisahkan base64 string menjadi bagian header dan data
        $image_parts = explode(";base64", $base64);

        return base64_decode($image_parts[1]);
    }
}
