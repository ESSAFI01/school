<?php

/**
 * User Model
 */
class User extends Model
{

	protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'rank',
        'date',
        'CNE',
    ];

    protected $beforeInsert = [
        'hash_password'
    ];


    public function validate($DATA)
    {
        $this->errors = array();

        //check for first name
        if(empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname']))
        {
            $this->errors['firstname'] = "Only letters allowed in first name";
        }

        //check for last name
        if(empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname']))
        {
            $this->errors['lastname'] = "Only letters allowed in last name";
        }

        //check for email
        if(empty($DATA['email']) || !filter_var($DATA['email'],FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }
        
        //check if email exists
        if($this->where('email',$DATA['email']))
        {
            $this->errors['email'] = "That email is already in use";
        }

        //check for password
        if(empty($DATA['password']) || $DATA['password'] !== $DATA['password2'])
        {
            $this->errors['password'] = "Passwords do not match";
        }

        //check for password length
        if(strlen($DATA['password']) < 8)
        {
            $this->errors['password'] = "Password must be at least 8 characters long";
        }

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }


    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

}