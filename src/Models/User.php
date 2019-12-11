<?php

namespace Facilitador\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Model;
// use Illuminate\Contracts\Auth\Access\Authorizable;
// use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as UserAuthenticatable;
use Population\Traits\AsHuman;
use Laravel\Passport\HasApiTokens;
use SiObjects\Manipule\Builders\UserBuilder;
// use Siravel\Support\Traits\Models\HasRoutine;
// use Siravel\Support\Traits\Models\HasTask;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable, HasApiTokens;
    use AsHuman;

    // use HasRoutine, HasTask;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password',
        'remember_token',
        'name',
        'cpf',
        'username',
        'email',
        'role_id',
        'token',
        'token_public',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @inheritdoc
     */
    protected $with = [
        'role',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        // 'cpf' => [
        //     'type' => 'string',
        //     "analyzer" => "standard",
        // ],
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'role_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    );

    /**
     * @inheritdoc
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $user) {
            optional($user->photos)->each(function (Photo $photo) {
                $photo->delete();
            });
        });
    }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): UserBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class, 'created_by_user_id');
    }

    /**
     * @return UserEntity
     */
    public function toEntity(): UserEntity
    {
        return new UserEntity([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password_hash' => $this->password,
            'role' => optional($this->role)->name,
            'created_at' => $this->created_at->toAtomString(),
            'updated_at' => $this->updated_at->toAtomString(),
        ]);
    }
    

    /**
     * Referentes a Business
     * 
     * Retorna 3 Caso seja Deus
     * Retorna 2 Caso seja Admin
     * Retorna 1 Caso seja Inscrito
     * Retorna 0 Caso não seja Inscrito no Business
     */
    public function getLevelForAcessInBusiness()
    {
        if ($this->admin == 2) {
            return 2;
        }

        if ($this->admin == 1) {
            return 1;
        }

        return 0;
    }

    /**
     * Mostra o tipo de usuário para o cliente
     */
    public function getUserType()
    {
        if ($this->isAdmin()){
            return 'Admin';
        }
        return 'Business';
    }

    public function fullName()
    {
        return $this->name;
    }

    public function firstName()
    {
        $name = explode(' ', $this->name);
        return $name[0];
    }

    public function lastName()
    {
        $name = explode(' ', $this->name);
        return $name[strlen($name)-1];
    }

    /**
     * @todo VErificar esse aqui pq agora usa o role do voyager
     */
    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }

        return false;
    }

    /**
     * @todo VErificar esse aqui pq agora usa o role do voyager
     */
    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    /**
     * @todo VErificar esse aqui pq agora usa o role do voyager
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Verifica se é admin para exibir informações dos outros usuários ou não
     */
    public function isAdmin()
    {
        return $this->role_id === Role::$GOOD || $this->role_id === Role::$ADMIN;
    }

    public function homeUrl()
    {
        if ($this->hasRole('user')) {
            $url = route('user.home');
        } else {
            $url = route('admin.home');
        }

        return $url;
    }

}
