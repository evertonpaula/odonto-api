<?php

namespace App\Services\User;

use App\Repositories\Eloquent\UserRepository;
use App\Mail\User\ActivatedAccount;
use App\Mail\User\ForgetPassword;
use App\Mail\User\UpdateAccount;
use App\Mail\User\SingUp;
use App\Services\Service;
use App\Mail\Dispacher;
use Carbon\Carbon;
use Exception;
use DB;

class UserService extends Service {

    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function createUser(array $args = []) {
        DB::beginTransaction();
            try {
                $user = $this->repository->getModel()->fill($args);
                $user->save();
                Dispacher::send( new SingUp($user), $user->email );
            } catch (Exception $e) {
                DB::rollBack();
                return $this->throw($e);
            }
        DB::commit();

        return $user;
    }

    public function forgetPassword(array $args = []) {
        DB::beginTransaction();
            try {
                $user = $this->repository
                            ->getModel()
                            ->where('email', $args['email'])
                            ->whereNotNull('activated')
                            ->where('locked', false)
                            ->first();

                if (! $user ) throw new Exception('Conta não ativa ou bloqueada');

                if (! $recover = $user->recoverPassword()->where('email', $args['email'])->whereDate('expire_at','>=',Carbon::now()->toDateTimeString())->first() ) {
                    $recover = $user->recoverPassword()->create($args);
                }

                Dispacher::send( new ForgetPassword($recover), $recover->email );
            } catch (Exception $e) {
                DB::rollBack();
                return $this->throw($e);
            }
        DB::commit();

        return $recover;
    }

    public function activatedAccount(array $args = []) {
        DB::beginTransaction();
            try {
                $user = $this->repository->getModel()->where('uuid', $args['token'])->first();
                if ( $user->activated ) throw new Exception('Conta já ativada anteriormente');
                $user->activated = Carbon::now()->toDateTimeString();
                $user->save();
                Dispacher::send( new ActivatedAccount($user), $user->email );
            } catch (Exception $e) {
                DB::rollBack();
                return $this->throw($e);
            }
        DB::commit();

        return $user;
    }

    public function recoverPassword(array $args = []) {
        DB::beginTransaction();
            try {
                $user = $this->repository->getModel()->where('email', $args['email'])->first();

                if (! $user->activated ) throw new Exception('Conta não ativa');

                if ( $user->locked ) throw new Exception('Conta bloqueada pelo administrador');

                if ( $recovers = $user->recoverPassword()->whereDate('expire_at','>=', Carbon::now()->toDateTimeString())->pluck('id') ) {
                    $user->password = $args['password'];
                    $user->save();
                    $user->recoverPassword()->whereIn('id', $recovers)->delete();
                    Dispacher::send( new UpdateAccount($user), $user->email );
                } else {
                    throw new Exception('Token expirado ou não valído');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return $this->throw($e);
            }
        DB::commit();

        return $user;
    }

    public function getUserFromRecoverToken($token) {
        $recover = $this->repository
                        ->getRecoverModel()
                        ->where('token', $token)
                        ->whereDate('expire_at', '>=', Carbon::now()->toDateTimeString())
                        ->first();
        if ( $recover )  {
            return $recover->user;
        }
        return false;
    }

    public function getUser($id) {
        $user = $this->repository
                     ->getModel()
                     ->with(['perfil.address.country', 'perfil.address.type', 'perfil.image.file'])
                     ->find( (int) $id);

        return $user;
    }
}
