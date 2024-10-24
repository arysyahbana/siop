<?php

namespace App\Helpers;

class GlobalFunction
{
    public static function formatMoney($money)
    {
        return number_format($money, 0, ',', '.');
    }
    public static function saveImage($image, $name, $path = '')
    {
        if ($image == null) {
            return null;
        }
        $extension = $image->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        $path = public_path('dist/assets/img/' . $path);
        $image->move($path, $filename);
        return $filename;
    }

    public static function deleteImage($filename, $path = '')
    {
        $path = public_path('dist/assets/img/' . $path);
        if (file_exists($path . $filename)) {
            unlink($path . $filename);
        } else {
            // return false;
        }
    }

    public static function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = str_replace(' ', '', $phoneNumber);
        $phoneNumber = str_replace('-', '', $phoneNumber);
        $phoneNumber = preg_replace('/^0/', '62', $phoneNumber);
        return $phoneNumber;
    }

    public static function urlPemesanan($nomorHp, $pemesanan, $id)
    {
        $pesanKamar = urlencode('Halo, Saya Mau Memesan Kamar ' . $pemesanan . '. Terima Kasih.' . "\n\n" . 'Kamar ini ada di link berikut: ' . url('/detail-penginapan/' . $id));
        $pesanPaket = urlencode('Halo, Saya Mau Memesan Paket Tour ' . $pemesanan . '. Terima Kasih.' . "\n\n" . 'Paket Tour ini ada di link berikut: ' . url('/detail-paket/' . $id));
        if (url()->current() == url('/detail-penginapan/' . $id)) {
            return 'https://wa.me/' . $nomorHp . '?text=' . $pesanKamar;
        } elseif (url()->current() == url('/detail-paket/' . $id)) {
            return 'https://wa.me/' . $nomorHp . '?text=' . $pesanPaket;
        }
    }
}
