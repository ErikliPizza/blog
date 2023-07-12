<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Image;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'bio',
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
    ];

    public function setAvatarAttribute($avatar)
    {
        $image = request()->file('avatar');
        $input['avatar'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/storage/avatars');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->fit(720, 720, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->resizeCanvas(700, 720)
            ->save($destinationPath.'/'.$input['avatar']);


        $this->attributes['avatar'] = 'avatars/'.$input['avatar'];
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

}
