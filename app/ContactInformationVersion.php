<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformationVersion extends Model
{
    protected $table = 'contact_information_version';

    protected $fillable=[
        'contact_information_id',
        'description',
        'description_ar',
        'reverted',
        'created_by'
    ];
    public function user()
    {
        return User::find($this->created_by);
    }
}
