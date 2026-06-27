<?php 



namespace app\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    public function create(array $data)
    {   
        $errors = [];
        try{

           
            $password = Hash::make($data['password']);
            return User::updateOrCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => $password
            ]);
        }

        catch(Exception $e)
        {
            

            return User::where('name', $data['name'])->first();
        }

    

    }


    public function update($data, $path)
    {
       
    }

    
}