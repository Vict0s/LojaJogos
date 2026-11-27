<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Game::where('slug','aventura-demo')->delete();
        $admin=User::updateOrCreate(['email'=>env('ADMIN_EMAIL','admin@lojajogos.test')], ['name'=>env('ADMIN_NAME','123'),'password'=>env('ADMIN_PASSWORD','123'),'is_admin'=>true]);
        foreach ([['Jogo PlayStation','Jogos para consolas PlayStation.'],['Jogo Xbox','Jogos para consolas Xbox.'],['Jogo Nintendo','Jogos para consolas Nintendo.'],['Jogo PC','Jogos para computador.'],['Cartões de recarga e Gift Cards','Cartões digitais para adicionar saldo às tuas plataformas favoritas.']] as [$name,$description]) Category::firstOrCreate(['name'=>$name],['description'=>$description]);
        foreach (['switch2-split-fiction'=>'switch-mario-3d-world','xbox-street-fighter-6'=>'xbox-star-wars-galactic-racer','pc-the-sims-4'=>'pc-ea-sports-fc-27'] as $oldSlug => $newSlug) {
            Game::where('slug', $oldSlug)->update(['slug'=>$newSlug]);
        }
        $products = [
            ['switch-mario-kart-8','Mario Kart 8 Deluxe','Jogo Nintendo','Nintendo Switch','fisico',49.99,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['switch-mario-wonder','Super Mario Bros. Wonder','Jogo Nintendo','Nintendo Switch','fisico',45.49,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['switch-pokemon-legends-arceus','Pokémon Legends: Arceus','Jogo Nintendo','Nintendo Switch','fisico',47.49,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['switch-animal-crossing','Animal Crossing: New Horizons','Jogo Nintendo','Nintendo Switch','fisico',49.49,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['switch-smash-bros-ultimate','Super Smash Bros. Ultimate','Jogo Nintendo','Nintendo Switch','fisico',59.99,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['switch-fortnite-anime-legends','Fortnite Anime Legends','Jogo Nintendo','Nintendo Switch','digital',19.99,'https://www.worten.pt/produtos/jogo-nintendo-switch-fortnite-anime-legends-formato-digital-7636076'],
            ['switch-mario-3d-world',"Super Mario 3D World + Bowser's Fury",'Jogo Nintendo','Nintendo Switch','fisico',59.99,'https://www.worten.pt/produtos/jogo-nintendo-switch-super-mario-3d-world-bowsers-fury-7251760'],
            ['switch-sports','Nintendo Switch Sports','Jogo Nintendo','Nintendo Switch','fisico',38.49,'https://www.worten.pt/produtos/jogo-nintendo-switch-switch-sports-7537014'],
            ['switch-zelda-breath-of-the-wild','The Legend of Zelda: Breath of the Wild','Jogo Nintendo','Nintendo Switch','fisico',49.99,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['switch-super-mario-odyssey','Super Mario Odyssey','Jogo Nintendo','Nintendo Switch','fisico',49.99,'https://www.worten.pt/campanha/consolas-jogos-nintendo/produtos'],
            ['ps5-momento','Momento','Jogo PlayStation','PlayStation 5','fisico',29.99,'https://www.worten.pt/produtos/jogo-ps5-momento-8857964'],
            ['ps5-xiii','XIII','Jogo PlayStation','PlayStation 5','fisico',19.99,'https://www.worten.pt/produtos/jogo-ps5-xiii-7643815'],
            ['ps5-deliver-at-all-costs','Deliver At All Costs','Jogo PlayStation','PlayStation 5','fisico',29.99,'https://www.worten.pt/produtos/jogo-ps5-deliver-at-all-costs-8199405'],
            ['ps5-prodeus','Prodeus','Jogo PlayStation','PlayStation 5','fisico',29.99,'https://www.worten.pt/produtos/jogo-ps5-prodeus-7709810'],
            ['ps5-rugby-25','Rugby 25','Jogo PlayStation','PlayStation 5','fisico',25.97,'https://www.worten.pt/produtos/jogo-ps5-rugby-25-8371221'],
            ['ps5-lego-party','LEGO Party!','Jogo PlayStation','PlayStation 5','fisico',24.97,'https://www.worten.pt/produtos/jogo-ps5-lego-party-8598192'],
            ['ps5-gta-vi-digital','Grand Theft Auto VI (código de descarga na caixa)','Jogo PlayStation','PlayStation 5','digital',79.99,'https://www.worten.pt/produtos/jogo-ps5-grand-theft-auto-vi-codigo-de-descarga-na-caixa-8916646'],
            ['ps5-f1-23-outlet','F1 23 (caixa aberta)','Jogo PlayStation','PlayStation 5','fisico',4.17,'https://www.worten.pt/produtos/jogo-ps5-f1-23-outlet-caixa-aberta-8505588'],
            ['ps5-lets-sing-abba','Lets Sing ABBA + 1 Microfone','Jogo PlayStation','PlayStation 5','fisico',59.99,'https://www.worten.pt/produtos/jogo-ps5-lets-sing-abba-1-microfone-7630844'],
            ['ps5-gris','Gris','Jogo PlayStation','PlayStation 5','fisico',26.81,'https://www.worten.pt/produtos/jogo-ps5-gris-8414748'],
            ['xbox-xiii','XIII','Jogo Xbox','Xbox Series X','fisico',16.94,'https://www.worten.pt/produtos/jogo-xbox-series-x-xiii-7643816'],
            ['xbox-skull-and-bones','Skull and Bones','Jogo Xbox','Xbox Series X','fisico',5.87,'https://www.worten.pt/produtos/jogo-xbox-series-x-skull-and-bones-7626651'],
            ['xbox-star-wars-galactic-racer','Star Wars: Galactic Racer','Jogo Xbox','Xbox Series X','fisico',59.99,'https://www.worten.pt/produtos/jogo-xbox-series-x-star-wars-galactic-racer-8928170'],
            ['xbox-pentiment-digital','Pentiment','Jogo Xbox','Xbox Series X','digital',19.99,'https://www.worten.pt/produtos/jogo-xbox-series-x-pentiment-formato-digital-7677035'],
            ['xbox-nhl-24-digital','NHL 24 X Factor','Jogo Xbox','Xbox Series X','digital',109.99,'https://www.worten.pt/produtos/jogo-xbox-series-x-nhl-24-x-factor-pt-formato-digital-7890712'],
            ['xbox-stray','Stray','Jogo Xbox','Xbox Series X','fisico',29.99,'https://www.worten.pt/produtos/jogo-xbox-series-x-stray-7917429'],
            ['xbox-ea-sports-fc-26','EA Sports FC 26','Jogo Xbox','Xbox Series X','fisico',29.99,'https://www.worten.pt/produtos/jogo-xbox-serie-x-ea-sports-fc26-8521072'],
            ['xbox-gta-v','Grand Theft Auto V','Jogo Xbox','Xbox Series X','fisico',7.87,'https://www.worten.pt/produtos/jogo-xbox-series-x-grand-theft-auto-v-7573583'],
            ['xbox-forza-horizon-6','Forza Horizon 6 Standard','Jogo Xbox','Xbox Series X','fisico',69.49,'https://www.worten.pt/produtos/jogo-xbox-series-x-forza-horizon-6-standard-8845185'],
            ['xbox-lords-of-the-fallen','Lords of the Fallen','Jogo Xbox','Xbox Series X','fisico',69.99,'https://www.worten.pt/produtos/jogo-xbox-series-x-lords-of-the-fallen-7859131'],
            ['pc-gta-v','Grand Theft Auto V','Jogo PC','PC','fisico',29.99,'https://www.worten.pt/produtos/jogo-pc-grand-theft-auto-v-5475640'],
            ['pc-street-fighter-v','Street Fighter V','Jogo PC','PC','fisico',29.99,'https://www.worten.pt/produtos/jogo-pc-street-fighter-v-5743967'],
            ['pc-farming-simulator-25','Farming Simulator 25','Jogo PC','PC','fisico',49.99,'https://www.worten.pt/produtos/jogo-pc-farming-simulator-25-8155616'],
            ['pc-ea-sports-fc-24','EA Sports FC 24','Jogo PC','PC','fisico',6.97,'https://www.worten.pt/produtos/jogo-pc-ea-sports-fc-24-7820153'],
            ['pc-flight-simulator-digital','Microsoft Flight Simulator','Jogo PC','PC','digital',69.99,'https://www.worten.pt/produtos/jogo-pc-flight-simulator-formato-digital-7416314'],
            ['pc-ea-sports-fc-27','EA Sports FC 27','Jogo PC','PC','fisico',69.99,'https://www.worten.pt/produtos/jogo-pc-ea-sports-fc27-8957367'],
            ['pc-outbound','Outbound','Jogo PC','PC','fisico',29.99,'https://www.worten.pt/produtos/jogo-pc-outbound-8786015'],
            ['pc-star-wars-battlefront-ii','Star Wars Battlefront II (código de descarga)','Jogo PC','PC','digital',19.99,'https://www.worten.pt/produtos/jogo-pc-star-wars-battlefront-ii-codigo-descarga-6399996'],
            ['pc-football-manager-26','Football Manager 26 (Código de descarga na caixa)','Jogo PC','PC','digital',44.97,'https://www.worten.pt/produtos/jogo-pc-football-manager-26-codigo-de-descarga-na-caixa-8605860'],
            ['pc-flight-simulator-physical','Microsoft Flight Simulator','Jogo PC','PC','fisico',69.99,'https://www.worten.pt/produtos/jogo-pc-microsoft-flight-simulator-7227578'],
        ];
        // Atualiza as denominações para as opções anunciadas pela Worten.
        foreach (['xbox-20'=>'xbox-25','eshop-10'=>'eshop-15','eshop-20'=>'eshop-25','steam-10'=>'steam-5'] as $oldSlug=>$newSlug) {
            Game::where('slug',$oldSlug)->update(['slug'=>$newSlug]);
        }
        $giftCards = [
            ['psn-10','Cartão PlayStation Store 10 €','PlayStation Store','/images/gift-cards/psn-10.jpg',10.00,'https://www.worten.pt/produtos/cartao-sony-playstation-10eu-formato-digital-8604901'],
            ['psn-20','Cartão PlayStation Store 20 €','PlayStation Store','/images/gift-cards/psn-20.jpg',20.00,'https://www.worten.pt/produtos/cartao-sony-playstation-20eu-formato-digital-8604907'],
            ['psn-50','Cartão PlayStation Store 50 €','PlayStation Store','/images/gift-cards/psn-50.jpg',50.00,'https://www.worten.pt/produtos/cartao-de-carregamento-playstation-50eu-formato-digital-8604902'],
            ['xbox-10','Cartão Presente Xbox Live 10 €','Xbox','/images/gift-cards/xbox-10.jpg',10.00,'https://www.worten.pt/produtos/cartao-presente-xbox-live-10-euros-formato-digital-7139868'],
            ['xbox-25','Cartão Presente Xbox Live 25 €','Xbox','/images/gift-cards/xbox-25.jpg',25.00,'https://www.worten.pt/produtos/cartao-presente-xbox-live-25-euros-formato-digital-7139870'],
            ['xbox-50','Cartão Presente Xbox Live 50 €','Xbox','/images/gift-cards/xbox-50.jpg',50.00,'https://www.worten.pt/produtos/cartao-presente-xbox-live-50-euros-formato-digital-7139871'],
            ['eshop-15','Código digital Nintendo eShop 15 €','Nintendo eShop','/images/gift-cards/eshop-15.jpg',15.00,'https://www.worten.pt/produtos/codigo-digital-para-fundos-da-nintendo-eshop-15-euros-7139878'],
            ['eshop-25','Código digital Nintendo eShop 25 €','Nintendo eShop','/images/gift-cards/eshop-25.jpg',25.00,'https://www.worten.pt/produtos/codigo-digital-para-fundos-da-nintendo-eshop-25-euros-7139879'],
            ['eshop-50','Código digital Nintendo eShop 50 €','Nintendo eShop','/images/gift-cards/eshop-50.jpg',50.00,'https://www.worten.pt/produtos/codigo-digital-para-fundos-da-nintendo-eshop-50-euros-7139880'],
            ['steam-5','Cartão Steam 5 €','Steam','/images/gift-cards/steam-5.png',5.00,'https://www.worten.pt/cartoes-presente-e-gift-cards/cartoes-pc-e-steam'],
            ['steam-20','Cartão Steam 20 €','Steam','/images/gift-cards/steam-20.png',20.00,'https://www.worten.pt/cartoes-presente-e-gift-cards/cartoes-pc-e-steam'],
            ['steam-50','Cartão Steam 50 €','Steam','/images/gift-cards/steam-50.png',50.00,'https://www.worten.pt/cartoes-presente-e-gift-cards/cartoes-pc-e-steam'],
            ['steam-100','Cartão Steam 100 €','Steam','/images/gift-cards/steam-100.png',100.00,'https://www.worten.pt/cartoes-presente-e-gift-cards/cartoes-pc-e-steam'],
        ];
        $giftCategory = Category::where('name', 'Cartões de recarga e Gift Cards')->first();
        foreach ($giftCards as [$slug,$title,$platform,$image,$price,$sourceUrl]) {
            Game::updateOrCreate(['slug'=>$slug], [
                'category_id'=>$giftCategory->id,
                'title'=>$title,
                'description'=>'Cartão digital de demonstração para '.$platform.'. Imagem de referência da Worten; este projeto não fornece código de ativação.',
                'platform'=>$platform,
                'format'=>'digital',
                'price'=>$price,
                'image_url'=>$image,
                'source_url'=>$sourceUrl,
            ]);
        }

        foreach ($products as [$slug,$title,$categoryName,$platform,$format,$price,$sourceUrl]) {
            $category=Category::where('name',$categoryName)->first();
            if(!$category) continue;
            $imageUrl = file_exists(public_path('images/games/'.$slug.'.jpg')) ? '/images/games/'.$slug.'.jpg' : '/images/games/placeholder-'.$slug.'.svg';
            Game::updateOrCreate(['slug'=>$slug],['category_id'=>$category->id,'title'=>$title,'description'=>$title.' para '.$platform.'. Preço de referência consultado na Worten em 20/11/2026; confirma disponibilidade e valor atual no site de origem.','platform'=>$platform,'format'=>$format,'price'=>$price,'image_url'=>$imageUrl,'source_url'=>$sourceUrl]);
        }
    }
}

