<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        $map=['Ação'=>'Jogo PlayStation','Aventura'=>'Jogo PC','Desporto'=>'Jogo Xbox'];
        foreach($map as $old=>$new){ $from=DB::table('categories')->where('name',$old)->first(); if(!$from) continue; $to=DB::table('categories')->where('name',$new)->first(); if($to){ DB::table('games')->where('category_id',$from->id)->update(['category_id'=>$to->id]); DB::table('categories')->where('id',$from->id)->delete(); } else { DB::table('categories')->where('id',$from->id)->update(['name'=>$new]); } }
        foreach ([['Jogo PlayStation','Jogos para consolas PlayStation.'],['Jogo Xbox','Jogos para consolas Xbox.'],['Jogo Nintendo','Jogos para consolas Nintendo.'],['Jogo PC','Jogos para computador.']] as [$name,$description]) { if(!DB::table('categories')->where('name',$name)->exists()) DB::table('categories')->insert(['name'=>$name,'description'=>$description,'created_at'=>now(),'updated_at'=>now()]); }
    }
    public function down(): void {}
};
