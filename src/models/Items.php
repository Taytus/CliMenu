<?php
namespace taytus\climenu\src\models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'taytus_climenu';

    protected static $ids=[];

    public static function top_menu(){

       return self::display_menu(0);

    }

    public static function display_list_of_results($records){

        //I need to know if I have to use a paginator or not
        $total_records=count($records);
        
        if($total_records<9){

            $j=1;
            foreach ($records as $item){
                echo $j ."- ".$item->label. "\n";
                self::$ids[]=$item->id;
                $j++;
            }

            
        }
    }
    //display all the child menues of the item_ID passed
    public static function display_menu($item_ID){

        $records= self::where('parent_id','=',$item_ID)->orderBy('created_at','asc')->get();

        self::display_list_of_results($records);

        return self::$ids;
    }
}