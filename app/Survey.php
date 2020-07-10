<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = ['name', 'slug'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $appends = ['votes_count', 'f_created_at'];
  
  public function choices(){
    return $this->hasMany('App\Choice');
  }
  
  public function votes(){
    return $this->hasMany('App\Vote');
  }
  
  public function getVotesCountAttribute(){
    return $this->votes()->count();
  }
  
  public function regenerateSlugs(){
    $surveys = self::all();
    $surveys->each( function($s){ 
      $s->slug = Str::slug( $s->name);
      $s-save(); 
    });
  }
  
  public function getFCreatedAtAttribute(){
    return \Carbon\Carbon::parse( $this->created_at )->format('F d Y');
  }
  
  public function scopeEnabled($query){
    return $query->has('choices', '>=', 2);
  }
  
  public function scopeByName($query, $name){
    if( !$name ){ return $query; }
    return $query->where('name', 'LIKE', '%' . $name . '%');
  }
  
  public function scopeDateRange($query, $from, $to){
    if( !$from || !$to ){
      return $query;
    }
    return $query->where('');
  }
  
}
