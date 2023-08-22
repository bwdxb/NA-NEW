<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenuVersion extends Model
{
    protected $table = 'sub_menu_version';

    protected $fillable=[
        'sub_menu_id',
        'main_id',
        'parent_id',
        'title',
        'title_ar',
        'slug',
        'image',
        'sequence_number',
        'description',
        'description_ar',
        'reverted',
        'status',
        'created_by'
    ];

    public function user()
    {
        return User::find($this->created_by);
    }
    public function parentMenu()
    {
        return SubMenu::find($this->parent_id);
    }
    public function mainMenu()
    {
        return Menu::find($this->main_id);
    }
}
