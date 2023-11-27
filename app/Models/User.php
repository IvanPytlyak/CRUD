<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name_of_city',
        'surname',
        'city_id',
        'img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getCity()
    {
        return City::where('id', $this->city_id)->first();
    }

    public function getAllCities()
    {
        return City::get();
    }

    public function getUser($id)
    {
        $findOfUser = User::where('id', $id)->first();
        return Storage::url($findOfUser->img);
    }


    public function applyFilterUsers(Request $request)
    {
        $sortField = $request->input('sort_user', 'sort_id'); // Поле сортировки по умолчанию
        $sortOrder = $request->input('sort_order_by_sort_user', 'sort_asc'); // Направление сортировки по умолчанию


        // dd($sortField, $sortOrder);

        $query = $this->newQuery();

        if ($sortField === 'sort_id') {
            $query->orderBy('id', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        } elseif ($sortField === 'sort_name') {
            $query->orderBy('name', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        } elseif ($sortField === 'sort_surname') {
            $query->orderBy('surname', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        } elseif ($sortField === 'sort_city') {
            $query->orderBy('name_of_city', $sortOrder === 'sort_asc' ? 'asc' : 'desc');
        }


        // dd($query->toSql());


        return $query->get();
    }
}
