<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Faq extends Model
{
	use Cachable;
    public $table = 'faqs';
    protected $fillable = ['status', 'description'];

    public function faqAssign() {
        return $this->hasMany('App\FaqAssign', 'faq_id', 'id');
    }
    

}
