<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class SocialAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'platform',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setSettingsAttribute($settings)
    {
        $encrypted = collect($settings)->map(function ($item) {
            return [
                'key' => $item['key'],
                'value' => Crypt::encryptString($item['value']),
            ];
        });

        $this->attributes['settings'] = json_encode($encrypted);
    }

    public function getSettingsAttribute($settings)
    {
        $decoded = json_decode($settings, true);

        if (!is_array($decoded)) return [];

        return collect($decoded)->map(function ($item) {
            return [
                'key' => $item['key'] ?? '',
                'value' => $this->canDecrypt() ? Crypt::decryptString($item['value']) : '******',
            ];
        })->toArray();
    }

    protected function canDecrypt(): bool
    {
        return auth()->check() && Gate::allows('decrypt', $this);
    }

    public function postPlatforms (): HasMany
    {
         return $this->hasMany(PostPlatform::class);
    }


    public function getDecryptedSettings(): array
    {
        $decoded = json_decode($this->attributes['settings'], true);

        if (!is_array($decoded)) return [];

        return collect($decoded)->mapWithKeys(function ($item) {
            return [$item['key'] => Crypt::decryptString($item['value'])];
        })->toArray();
    }
}
