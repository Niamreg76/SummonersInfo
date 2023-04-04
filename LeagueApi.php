<?php


class SummonerApi {

    // API URL
    private $baseUrl = 'https://euw1.api.riotgames.com/lol/';
    // API KEY
    private $apiKey = 'YOUR API KEY';
    

    public function getSummonerByName($summonerName) { // SUMMONER-V4 api

        // replace spaces in the summoner name by %20
        $summonerName = str_replace(' ', '%20', $summonerName);
        // API URL
        $url = $this->baseUrl.'summoner/v4/summoners/by-name/'.$summonerName.'?api_key='.$this->apiKey;

        // init Curl
        $ch = curl_init($url);
        // return curl request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // don't verify the SSL certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // execute the request
        $response = curl_exec($ch);
        // close the connection
        curl_close($ch);
        // decode the JSON
        $data = json_decode($response, true);
        // return the result
        return $data;

    }

    public function getLeagueById($summonerId){ // LEAGUE-V4 apí | return player informations

        $url = $this->baseUrl.'league/v4/entries/by-summoner/'.$summonerId.'?api_key='.$this->apiKey;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getMasteryById($summonerId) { // CHAMPION-MASTERY-V4 api | return mastery informations
        
        $url = $this->baseUrl.'champion-mastery/v4/champion-masteries/by-summoner/'.$summonerId.'?api_key='.$this->apiKey;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getChampion(){ // return champions informations

        $url = 'http://ddragon.leagueoflegends.com/cdn/13.6.1/data/en_US/champion.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getMatchHistoryById($puuid){ // return the last 20 matchs

        $url = 'https://europe.api.riotgames.com/lol/match/v5/matches/by-puuid/'.$puuid.'/ids?start=0&count=20&api_key='.$this->apiKey;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;
  
    }

    public function getMatchByMatchId($matchId){ // return the informations of a match

        $url = 'https://europe.api.riotgames.com/lol/match/v5/matches/'.$matchId.'?api_key='.$this->apiKey;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;
    }

    public function getSummonerSpells(){ // return information on the sumonner spells

        $url = 'https://ddragon.leagueoflegends.com/cdn/13.6.1/data/en_US/summoner.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data;

    }

    public function getItems(){ // return informations on the items
            
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
