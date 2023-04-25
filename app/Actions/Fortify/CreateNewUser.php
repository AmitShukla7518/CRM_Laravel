<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Mail;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        #Genrate EmployeeID
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= 8; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        $Storedata = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'EmployeeID' => "CE" . $result
        ]);
        #send Employee ID to Email Address
        $employeeID = "CE" . $result;
        if ($Storedata) {
            $user['to'] = $input['email'];
            Mail::send('mail', compact('employeeID'), function ($message) use ($user) {
                $message->to($user['to']);
                $message->subject('EMS:Cogent Employee ID');
            });
        }
        return $Storedata;
    }
}
