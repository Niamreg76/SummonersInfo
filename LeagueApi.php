<?php


class SummonerApi {

    // url de base de l'api
    private $baseUrl = 'https://euw1.api.riotgames.com/lol/';
    // clé d'api
    private $apiKey = 'YOUR API KEY';
    

    public function getSummonerByName($summonerName) { // SUMMONER-V4 api

        // remplace les espaces par des %20
        $summonerName = str_replace(' ', '%20', $summonerName);
        // url de l'api
        $url = $this->baseUrl.'summoner/v4/summoners/by-name/'.$summonerName.'?api_key='.$this->apiKey;

        // initialisation de curl
        $ch = curl_init($url);
        // retourne le résultat de la requête
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // ne vérifie pas le certificat ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // exécute la requête
        $response = curl_exec($ch);
        // ferme la connexion
        curl_close($ch);
        // décode le json
        $data = json_decode($response, true);
        // retourne le résultat
        return $data;

    }

    public function getLeagueById($summonerId){ // LEAGUE-V4 apí | retourne les infos de la ligue du joueur

        $url = $this->baseUrl.'league/v4/entries/by-summoner/'.$summonerId.'?api_key='.$this->apiKey;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getMasteryById($summonerId) { // CHAMPION-MASTERY-V4 api | retourne les infos sur la maitrise du joueur
        
        $url = $this->baseUrl.'champion-mastery/v4/champion-masteries/by-summoner/'.$summonerId.'?api_key='.$this->apiKey;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getChampion(){ // retourne les infos sur les champions

        $url = 'http://ddragon.leagueoflegends.com/cdn/13.6.1/data/en_US/champion.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getMatchHistoryById($puuid){ // retourne les 20 dernières parties du joueur

        $url = 'https://europe.api.riotgames.com/lol/match/v5/matches/by-puuid/'.$puuid.'/ids?start=0&count=20&api_key='.$this->apiKey;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;
  
    }

    public function getMatchByMatchId($matchId){ // retourne les infos sur une partie

        $url = 'https://europe.api.riotgames.com/lol/match/v5/matches/'.$matchId.'?api_key='.$this->apiKey;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;
    }

    public function getSummonerSpells(){ // retourne les infos sur les sorts d'invocateurs

        $url = 'https://ddragon.leagueoflegends.com/cdn/13.6.1/data/en_US/summoner.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getItems(){ // retourne les infos sur les items
            
            $url = 'https://ddragon.leagueoflegends.com/cdn/13.6.1/data/en_US/item.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response, true);
    
            return $data;
    
    }
    
}
?>
