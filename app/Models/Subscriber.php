<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToUser;

class Subscriber extends Model
{
    use HasFactory, BelongsToUser;

    protected $appends = [
        'data'
    ];

    protected $hidden = [
        'fieldvalues',
        'user_id'
    ];

    public function fieldvalues(){
        return $this->hasMany('App\Models\FieldValue');
    }

    public function attachValues(){
        foreach($this->fieldvalues as $fieldValue){
            $this->{'field_'.$fieldValue->field_id} = $fieldValue->value;
        }
    }

    public function getDataAttribute(){
        $data = [];
        foreach($this->fieldvalues as $fieldValue){
            $data[] = [
                'title' => $fieldValue->field->title,
                'value' => $fieldValue->value
            ];
        }

        return $data;
    }

    public function getStateClassAttribute(){
        $cls = 'info';
        switch($this->state){
            case 'active':
                $cls = 'success';
                break;
            case 'unsubscribed':
                $cls = 'danger';
                break;
            case 'junk':
                $cls = 'secondary';
                break;
            case 'bounced':
                $cls = 'warning';
                break;
            case 'unconfirmed':
                $cls = 'primary';
                break;
        }

        return $cls;
    }
}
