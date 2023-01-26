<?php

namespace App\Models;

use Illuminate\support\str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_id', 'client_name', 'slug', 'summary', 'cover_image', 'img_original_name'];
    
    public function type(){
        return $this->BelongsTo(Type::class); //richiamo il ONE
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public static function generateSlug($string){
        $slug = Str::slug($string, '-');
        $original_slug = $slug;
        $c = 1;
        $item_exists = Project::where('slug',$slug)->first();
        while($item_exists){
            $slug = $original_slug . '-' . $c;
            $item_exists = Project::where('slug',$slug)->first();
            $c++;
        }
        return $slug;
    }

}
