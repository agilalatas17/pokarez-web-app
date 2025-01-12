<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index() {
        return view('konsultasi-page');
    }

    public function sendWhatsapp(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer',
            'pesan' => 'required|string',
        ]);

        $nama = $validated['nama'];
        $usia = $validated['usia'];
        $pesan = $validated['pesan'];

        // Nomor WhatsApp tujuan
        $nomor = '+6282319586539';

        // Format pesan WhatsApp
        $message = urlencode("Halo, Pokarez :\n\nNama: $nama\nUsia: $usia\nPesan: $pesan");

        // URL API WhatsApp atau aplikasi WhatsApp Web
        $whatsappUrl = "https://wa.me/$nomor?text=$message";

        // Redirect ke URL WhatsApp
        return redirect($whatsappUrl);
    }
}