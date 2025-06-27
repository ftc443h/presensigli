<?php

namespace App\Http\Controllers;

use App\Models\LokasiPresensi;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiCopyController extends Controller
{
    public function presensiMasukCam()
    {
        try {

            $lks = Auth::user()->karyawan->lokasi_presensi;
            $lokasi = LokasiPresensi::where('nama_lokasi', $lks)
                ->firstOrFail();

            // Cek apakah lokasi ditemukan
            if (!$lokasi) {
                return redirect()->back()->with(
                    'error',
                    'Lokasi tidak ditemukan.'
                );
            }

            return view(
                'karyawan.presensi.presensi-masuk-cam',
                compact(
                    'lokasi'
                )
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan: ' . $th->getMessage()
            );
        }
    }

    public function presensiMasuk(Request $request)
    {

        $idKaryawan = Auth::user()->karyawan->id;
        $nip = Auth::user()->karyawan->nip;
        $lokasi = LokasiPresensi::where('nama_lokasi', Auth::user()->karyawan->lokasi_presensi)
            ->firstOrFail();
        $radKantor = $lokasi->radius;

        if (!$lokasi) {
            return redirect()->back()->with(
                'error',
                'Lokasi tidak ditemukan.'
            );
        }

        $tgl_presensi = now()->format('Y-m-d');
        $jam = now()->format('H:i:s');

        // photo
        $photo = $request->photo;
        $folderPath = "presensi/foto_masuk/";
        $formatName = $nip . "-" . $tgl_presensi;
        $image_parts = explode(";base64", $photo);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        // Cek apakah karyawan sudah melakukan presensi masuk hari ini
        $cek = Presensi::where('karyawan_id', $idKaryawan)
            ->where('tanggal_masuk', $tgl_presensi)
            ->count();

        $jarak = $this->distance(
            $lokasi->latitude,
            $lokasi->longitude,
            $request->latitude,
            $request->longitude,
        );
        $radius = round($jarak);
        // dd($radius);

        if ($radius > $radKantor) {
            return redirect()->back()->with(
                'error',
                'Maaf, Anda berada di luar radius kantor.'
            );
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'tanggal_keluar' => $tgl_presensi,
                    'jam_keluar' => $jam,
                    'foto_keluar' => $file,
                ];
                $update = Presensi::where('karyawan_id', $idKaryawan)
                    ->where('tanggal_masuk', today())
                    ->update($data_pulang);
                if ($update) {
                    Storage::disk('public')->put($file, $image_base64);
                    return redirect()->route('karyawan.dashboard')->with(
                        'success',
                        'Presensi pulang berhasil dicatat.'
                    );
                } else {
                    return redirect()->back()->with(
                        'error',
                        'Terjadi kesalahan saat mencatat presensi pulang.'
                    );
                }
            } else {
                $data = [
                    'tanggal_masuk' => $tgl_presensi,
                    'jam_masuk' => $jam,
                    'foto_masuk' => $file,
                    'karyawan_id' => $idKaryawan,
                    'lokasi_presensi_id' => $lokasi->id,
                ];


                $simpan = Presensi::create($data);

                // Simpan foto presensi
                if ($simpan) {
                    Storage::disk('public')->put($file, $image_base64);
                    return redirect()->route('karyawan.dashboard')->with(
                        'success',
                        'Presensi masuk berhasil dicatat.'
                    );
                } else {
                    return redirect()->back()->with(
                        'error',
                        'Terjadi kesalahan saat mencatat presensi masuk.'
                    );
                }
            }
        }
    }

    public function presensiKeluarCam()
    {
        try {
            $lokasi = LokasiPresensi::where('nama_lokasi', Auth::user()->karyawan->lokasi_presensi)->firstOrFail();
            return view('karyawan.presensi.presensi-keluar-cam', compact('lokasi'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function presensiKeluar(Request $request)
    {
        $karyawan = Auth::user()->karyawan;
        $lokasi = LokasiPresensi::where('nama_lokasi', $karyawan->lokasi_presensi)->firstOrFail();
        $tanggal = now()->format('Y-m-d');
        $jam = now()->format('H:i:s');
        $nip = $karyawan->nip;

        $jarak = $this->distance(
            $lokasi->latitude,
            $lokasi->longitude,
            $request->latitude,
            $request->longitude
        );

        if (round($jarak) > $lokasi->radius) {
            return back()->with('error', 'Anda berada di luar radius kantor.');
        }

        $fileName = "presensi/foto_keluar/{$nip}-{$tanggal}.png";
        $image_parts = explode(";base64", $request->photo);

        if (count($image_parts) !== 2) {
            return back()->with('error', 'Foto tidak valid.');
        }

        $image_base64 = base64_decode($image_parts[1]);

        $presensi = Presensi::where('karyawan_id', $karyawan->id)
            ->where('tanggal_masuk', $tanggal)
            ->first();

        if (!$presensi) {
            return back()->with('error', 'Data presensi masuk belum ditemukan.');
        }

        $presensi->tanggal_keluar = $tanggal;
        $presensi->jam_keluar = $jam;
        $presensi->foto_keluar = $fileName;

        if ($presensi->save()) {
            Storage::disk('public')->put($fileName, $image_base64);
            return redirect()->route('karyawan.dashboard')->with('success', 'Presensi keluar berhasil dicatat.');
        }

        return back()->with('error', 'Terjadi kesalahan saat mencatat presensi keluar.');
    }



    /**
     * Hitung jarak antara dua koordinat menggunakan rumus Haversine.
     *
     * @param float $lat1 Latitude titik pertama
     * @param float $lon1 Longitude titik pertama
     * @param float $lat2 Latitude titik kedua
     * @param float $lon2 Longitude titik kedua
     * @return float Jarak dalam meter
     */
    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) +
            (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yeards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;

        return $meters;
    }
}
