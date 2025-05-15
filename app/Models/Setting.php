<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $casts = [
        "id"=>"integer",
        'payment_activated' => 'integer',
        'must_update_user' => 'integer',
        'must_update_user_ios' => 'integer',
        'must_update_service_provider' => 'integer',
        'must_update_service_provider_ios' => 'integer',
        'must_update_market' => 'integer',
        'must_update_market_ios' => 'integer',
        'market_version' => 'integer',
        'market_version_ios' => 'integer',
        'user_version' => 'integer',
        'user_ios_version' => 'integer',
        'service_provider_version' => 'integer',
        'service_provider_ios_version' => 'integer',
        'open_otp' => 'integer',
    ];
    protected  $appends = ['terms','privacy','about','terms_link','privacy_link','about_link','return','return_link'];
    protected $hidden = ['terms_ar','terms_en','privacy_en','privacy_ar','about_ar','about_en','return','return_ar','return_en','market_code'];

    public function getTermsAttribute(){
        $terms = $this->attributes['terms_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["terms_$lang"])) {
            $terms = $this->attributes["terms_$lang"];
        }
        return $terms;
    }
    public function getPrivacyAttribute(){
        $privacy = $this->attributes['privacy_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["privacy_$lang"])) {
            $privacy = $this->attributes["privacy_$lang"];
        }
        return $privacy;
    }
    public function getAboutAttribute(){
        $about = $this->attributes['about_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["about_$lang"])) {
            $about = $this->attributes["about_$lang"];
        }
        return $about;
    }
    public function getReturnAttribute(){
        $about = $this->attributes['return_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["return_$lang"])) {
            $about = $this->attributes["return_$lang"];
        }
        return $about;
    }
    public function getTermsLinkAttribute(){
        return route('terms_link');
    }
    public function getPrivacyLinkAttribute(){
        return route('privacy_link');
    }
    public function getAboutLinkAttribute(){
        return route('about_link');
    }
    public function getReturnLinkAttribute(){
        return route('return_link');
    }
}
