<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'verification_code'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'verification_code'];
	
	// user has many news
	public function news()
	{
		return $this->hasMany('App\News','author_id');
	}
	
	public function can_post()
	{
		/*$role = $this->role;
		if($role == 'author' || $role == 'admin')
		{
			return true;
		}
		return false;*/
		return true;
	}

	public function verifyUser($userEmail, $verificationCode) 
	{
		$verified = false;
		$user = User::where('email', $userEmail)
		->where('verification_code', $verificationCode)
		->where('active', 0)->first();

		if (!is_null($user)) {			
			//Update record in DB for verification done
			$user->active = '1';
			$user->verification_code = null;
			$verified = $user->update();
		}

		return $verified;
	}	
}
