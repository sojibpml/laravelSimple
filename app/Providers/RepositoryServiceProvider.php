<?php 
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\AdminRepository;
class RepositoryServiceProvider  extends ServiceProvider
{
    public function register()
    {

    }
}