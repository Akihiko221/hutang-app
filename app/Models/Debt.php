<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'creditor',
        'nama_barang', 
        'amount',
        'due_date',
        'status' // Tipe boolean untuk status lunas atau belum lunas
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke pembayaran
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Cek apakah hutang sudah lunas
    public function isPaidOff()
    {
        return $this->status; // Mengembalikan true jika hutang lunas
    }
}
