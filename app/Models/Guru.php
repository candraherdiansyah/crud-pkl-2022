<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Guru extends Model
{
    use HasFactory;
    public $fillable = ['nama', 'nip', 'foto'];
    public $timestamps = true;

    // membuat relasi one to many
    public function siswa()
    {
        // data dari model 'Guru' bisa memiliki banyak data
        // dari model 'Siswa' melalui id_guru
        return $this->hasMany(Siswa::class, 'id_guru');
    }

    // method menampilkan image(foto)
    public function image()
    {
        if ($this->foto && file_exists(public_path('images/guru/' . $this->foto))) {
            return asset('images/guru/' . $this->foto);
        } else {
            return asset('images/no_image.jpg');
        }
    }
    // mengahupus image(foto) di storage(penyimpanan) public
    public function deleteImage()
    {
        if ($this->foto && file_exists(public_path('images/guru/' . $this->foto))) {
            return unlink(public_path('images/guru/' . $this->foto));
        }
    }

    // model event
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($parameter) {
            // mengecek apakah article masih punya category
            if ($parameter->siswa->count() > 0) {
                $html = 'Guru tidak bisa dihapus karena masih memiliki siswa : ';
                $html .= '<ul>';
                foreach ($parameter->siswa as $data) {
                    $html .= "<li>$data->nama</li>";
                }
                $html .= '</ul>';

                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html,
                ]);

                return false;
            }
        });
    }
}
