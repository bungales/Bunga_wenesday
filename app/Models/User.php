<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'role', // ← TAMBAHAN BARU
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    //   FILTER & SEARCH

    public function scopeFilter($query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }

   
    //   HELPER METHOD ROLE

    public function isSuperAdmin()
    {
        return $this->role === 'Super Admin';
    }

    public function isPelanggan()
    {
        return $this->role === 'Pelanggan';
    }

    public function isMitra()
    {
        return $this->role === 'Mitra';
    }

    public function getRoleBadgeClass()
    {
        switch ($this->role) {
            case 'Super Admin':
                return 'badge bg-danger';
            case 'Pelanggan':
                return 'badge bg-primary';
            case 'Mitra':
                return 'badge bg-success';
            default:
                return 'badge bg-secondary';
        }
    }
}
