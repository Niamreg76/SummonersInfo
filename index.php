<?php
ini_set('display_errors', 0);

require('LeagueApi.php');

// summoner api v4
$summonerApi = new SummonerApi();

// Page par défaut sur le profil de RomanGermain
$name = $_GET['name'] ?? 'RomanGermain'; 

//summoner api v4
$summoner = $summonerApi->getSummonerByName($name);

// si le joueur existe
if(isset($summoner)){

    $summonerId = $summoner['id'];
    $accountId = $summoner['accountId'];
    $puuid = $summoner['puuid'];
    $summonerName = $summoner['name'];
    $summonerProfileIconId = $summoner['profileIconId'];
    $summonerLevel = $summoner['summonerLevel'];
    $revisionDate = $summoner['revisionDate'];

    //league api v4
    $league = $summonerApi->getLeagueById($summonerId);

    if(isset($league[0]['tier'])){

        // league api v4
        $summonerTier = $league[0]['tier'];
        $summonerRank = $league[0]['rank'];
        $summonerLP = $league[0]['leaguePoints'];
        $summonerWins = $league[0]['wins'];
        $summonerLosses = $league[0]['losses'];
    
        $total = $summonerWins + $summonerLosses;
        $summonerWR = round(($summonerWins / $total) * 100, 1);

        // match history api
        $matchHistory = $summonerApi->getMatchHistoryById($puuid);

        // match v5 api

        $match = $summonerApi->getMatchByMatchId($matchHistory[0]);
        $match2 = $summonerApi->getMatchByMatchId($matchHistory[1]);
        $match3 = $summonerApi->getMatchByMatchId($matchHistory[2]);
        $match4 = $summonerApi->getMatchByMatchId($matchHistory[3]);
        $match5 = $summonerApi->getMatchByMatchId($matchHistory[4]);

        // game stats
        foreach($match['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $championPlayed = $participant['championName'];
                $kills = $participant['kills'];
                $deaths = $participant['deaths'];
                $assists = $participant['assists'];
                $summonerSpell11 = $participant['summoner1Id'];
                $summonerSpell12 = $participant['summoner2Id'];
                $farm = $participant['totalMinionsKilled'];
                $visionScore = $participant['visionScore'];
                $gold = $participant['goldEarned'];
                $damageDealt = $participant['totalDamageDealtToChampions'];
                $damageTaken = $participant['totalDamageTaken'];
                $wardsPlaced = $participant['wardsPlaced'];
                $winorlose = $participant['win'];
                $winorlose = ($winorlose == true) ? 'victoire' : 'defaite';
            }
        }

        foreach($match2['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $championPlayed2 = $participant['championName'];
                $kills2 = $participant['kills'];
                $deaths2 = $participant['deaths'];
                $assists2 = $participant['assists'];
                $farm2 = $participant['totalMinionsKilled'];
                $visionScore2 = $participant['visionScore'];
                $gold2 = $participant['goldEarned'];
                $damageDealt2 = $participant['totalDamageDealtToChampions'];
                $damageTaken2 = $participant['totalDamageTaken'];
                $wardsPlaced2 = $participant['wardsPlaced'];
                $winorlose2 = $participant['win'];
                $winorlose2 = ($winorlose2 == true) ? 'victoire' : 'defaite';
            }
        }

        foreach($match3['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $championPlayed3 = $participant['championName'];
                $kills3 = $participant['kills'];
                $deaths3 = $participant['deaths'];
                $assists3 = $participant['assists'];
                $farm3 = $participant['totalMinionsKilled'];
                $visionScore3 = $participant['visionScore'];
                $gold3 = $participant['goldEarned'];
                $damageDealt3 = $participant['totalDamageDealtToChampions'];
                $damageTaken3 = $participant['totalDamageTaken'];
                $wardsPlaced3 = $participant['wardsPlaced'];
                $winorlose3 = $participant['win'];
                $winorlose3 = ($winorlose3 == true) ? 'victoire' : 'defaite';
            }
        }

        foreach($match4['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $championPlayed4 = $participant['championName'];
                $kills4 = $participant['kills'];
                $deaths4 = $participant['deaths'];
                $assists4 = $participant['assists'];
                $farm4 = $participant['totalMinionsKilled'];
                $visionScore4 = $participant['visionScore'];
                $gold4 = $participant['goldEarned'];
                $damageDealt4 = $participant['totalDamageDealtToChampions'];
                $damageTaken4 = $participant['totalDamageTaken'];
                $wardsPlaced4 = $participant['wardsPlaced'];
                $winorlose4 = $participant['win'];
                $winorlose4 = ($winorlose4 == true) ? 'victoire' : 'defaite';
            }
        }

        foreach($match5['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $championPlayed5 = $participant['championName'];
                $kills5 = $participant['kills'];
                $deaths5 = $participant['deaths'];
                $assists5 = $participant['assists'];
                $farm5 = $participant['totalMinionsKilled'];
                $visionScore5 = $participant['visionScore'];
                $gold5 = $participant['goldEarned'];
                $damageDealt5 = $participant['totalDamageDealtToChampions'];
                $damageTaken5 = $participant['totalDamageTaken'];
                $wardsPlaced5 = $participant['wardsPlaced'];
                $winorlose5 = $participant['win'];
                $winorlose5 = ($winorlose5 == true) ? 'victoire' : 'defaite';
            }
        }



        // summoner spells
        // mastery api
        $mastery = $summonerApi->getMasteryById($summonerId);
        $championId = $mastery[0]['championId'];
        $championPoints = number_format($mastery[0]['championPoints']);

        // champion api
        $allChampions = $summonerApi->getChampion();
        $champion = $allChampions['data'];

        $championName = "";

        foreach ($champion as $name => $informations) {
            if($informations['key'] == $championId){
                $championName = $name;
            }
        }

        // summoner spells

        $summonerSpell11 = "";
        $summonerSpell12 = "";

        foreach($match['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $summonerSpell11 = $participant['summoner1Id'];
                $summonerSpell12 = $participant['summoner2Id'];
            }
        }

        foreach($match2['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $summonerSpell21 = $participant['summoner1Id'];
                $summonerSpell22 = $participant['summoner2Id'];
            }
        }

        foreach($match3['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $summonerSpell31 = $participant['summoner1Id'];
                $summonerSpell32 = $participant['summoner2Id'];
            }
        }

        foreach($match4['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $summonerSpell41 = $participant['summoner1Id'];
                $summonerSpell42 = $participant['summoner2Id'];
            }
        }

        foreach($match5['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $summonerSpell51 = $participant['summoner1Id'];
                $summonerSpell52 = $participant['summoner2Id'];
            }
        }

        $allSummonerSpells = $summonerApi->getSummonerSpells();
        $summonerSpell = $allSummonerSpells['data'];

        foreach ($summonerSpell as $name => $informations) {
            if($informations['key'] == $summonerSpell11){
                $summonerSpell11 = $name;
            }
            if($informations['key'] == $summonerSpell12){
                $summonerSpell12 = $name;
            }
            if($informations['key'] == $summonerSpell21){
                $summonerSpell21 = $name;
            }
            if($informations['key'] == $summonerSpell22){
                $summonerSpell22 = $name;
            }
            if($informations['key'] == $summonerSpell31){
                $summonerSpell31 = $name;
            }
            if($informations['key'] == $summonerSpell32){
                $summonerSpell32 = $name;
            }
            if($informations['key'] == $summonerSpell41){
                $summonerSpell41 = $name;
            }
            if($informations['key'] == $summonerSpell42){
                $summonerSpell42 = $name;
            }
            if($informations['key'] == $summonerSpell51){
                $summonerSpell51 = $name;
            }
            if($informations['key'] == $summonerSpell52){
                $summonerSpell52 = $name;
            }
        }

        // items

        $allItems = $summonerApi->getItems();
        $items = $allItems['data'];

        foreach($match['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $item0 = $participant['item0'];
                $item1 = $participant['item1'];
                $item2 = $participant['item2'];
                $item3 = $participant['item3'];
                $item4 = $participant['item4'];
                $item5 = $participant['item5'];
                $item6 = $participant['item6'];
            }
        }

        foreach($match2['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $item20 = $participant['item0'];
                $item21 = $participant['item1'];
                $item22 = $participant['item2'];
                $item23 = $participant['item3'];
                $item24 = $participant['item4'];
                $item25 = $participant['item5'];
                $item26 = $participant['item6'];
            }
        }

        foreach($match3['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $item30 = $participant['item0'];
                $item31 = $participant['item1'];
                $item32 = $participant['item2'];
                $item33 = $participant['item3'];
                $item34 = $participant['item4'];
                $item35 = $participant['item5'];
                $item36 = $participant['item6'];
            }
        }

        foreach($match4['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $item40 = $participant['item0'];
                $item41 = $participant['item1'];
                $item42 = $participant['item2'];
                $item43 = $participant['item3'];
                $item44 = $participant['item4'];
                $item45 = $participant['item5'];
                $item46 = $participant['item6'];
            }
        }

        foreach($match5['info']['participants'] as $participant){
            if($participant['summonerName'] == $summonerName){
                $item50 = $participant['item0'];
                $item51 = $participant['item1'];
                $item52 = $participant['item2'];
                $item53 = $participant['item3'];
                $item54 = $participant['item4'];
                $item55 = $participant['item5'];
                $item56 = $participant['item6'];
            }
        }


        // informations sur le joueur
        $msg = "
    
            <div class='row'>
                    <div class='col-12 d-flex flex-column justify-content-center text-center'>
                        <div class='nickname text-white my-2'>
                            <span class='summonerName pink'>{$summonerName}</span><br><br>
                            <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/profileicon/{$summonerProfileIconId}.png' alt='' style='width: 124px;'>
                            <br>
                            <p><span class='text-dark'><strong>{$summonerLevel}</strong></span></p>
                        </div>
                    
                        <div>
                            <span class='important_text'; style='color: #ccc;'>Solo/Duo</span>
                            <div class='tier'>
                                <img src='assets/img/emblem/$summonerTier.png' style='width: 100px; height: 114px;' alt='tier icon'>
                            </div>
                            <span class='text-white important_text'>{$summonerTier} {$summonerRank}</span><br>
                            <br>
                            <div class='win-lose text-white important_text2'><p> {$summonerLP} LP / <span style='color: rgb(38, 224, 38)'>$summonerWins</span>W <span style='color: rgb(250, 37, 37);'>{$summonerLosses}</span>L</p></div>
                            <div class='winratio text-white important_text2'><span>Win Ratio {$summonerWR}%</span></div>
                        </div>
                    </div>
                </div>
                <div class='row d-flex flex-column justify-content-center text-center'>
                    <div class='col-12 '>
                        <p class='text-white most important_text2'>most played champion:</p>
                        <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/{$championName}.png' class='mb-2'>
                        <p class='text-white important_text2'><span class='pink'>{$championName}</span> - {$championPoints} mastery points</p>
                    </div>
                </div>
            </div>
        ";


        // Historique des matchs
        $msghistory = "
            <div class='match_history' style='margin: 10px 20% 10px 22%;'>
                <p class='text-white' style='margin-left: 40%; padding-top: 10px;'>Match History</p>
                <div class='{$winorlose}'>
                    <p class='text-white'>{$championPlayed}</p>
                    <div class='ligne'>
                        <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/{$championPlayed}.png' class='mb-2 mini_image'>
                        <div class='vertical'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell11}.png'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell12}.png'>
                        </div>
                        <div class='statistiques'>
                            <p class='text-white textostat' style='padding-top: 35px;'>{$kills} / <span class='pink'>{$deaths}</span> / {$assists}    </p>
                            <div class='sous_Stat'>
                                <p class='text-white'> CS {$farm} </p>
                                <p class='text-white'> <span class='text-info'>{$visionScore}</span> Vision Score</p>
                                <p class='text-white'> <span class='text-warning'>{$gold}</span> Gold </p>
                                <p class='text-white'> <span class='text-success'>{$damageDealt}</span> Damage dealt</p>
                                <p class='text-white'> <span class='pink'>{$damageTaken}</span> Damage taken</p>
                            </div>
                        </div>
                        <div class='itemlist'>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item0}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item1}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item2}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item6}.png'>
                            </div>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item3}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item4}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item5}.png'>
                            </div>
                        </div>             
                    </div>
                </div>
                <div class='{$winorlose2}'>
                    <p class='text-white'>{$championPlayed2}</p>
                    <div class='ligne'>
                        <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/{$championPlayed2}.png' class='mb-2 mini_image'>
                        <div class='vertical'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell21}.png'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell22}.png'>
                        </div>
                        <div class='statistiques'>
                            <p class='text-white textostat' style='padding-top: 35px;'>{$kills2} / <span class='pink'>{$deaths2}</span> / {$assists2}    </p>
                            <div class='sous_Stat'>
                                <p class='text-white'> CS {$farm2} </p>
                                <p class='text-white'> <span class='text-info'>{$visionScore2}</span> Vision Score</p>
                                <p class='text-white'> <span class='text-warning'>{$gold2}</span> Gold </p>
                                <p class='text-white'> <span class='text-success'>{$damageDealt2}</span> Damage dealt</p>
                                <p class='text-white'> <span class='pink'>{$damageTaken2}</span> Damage taken</p>
                            </div>
                        </div>   
                        <div class='itemlist'>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item20}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item21}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item22}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item26}.png'>
                            </div>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item23}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item24}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item25}.png'>
                            </div>
                        </div>             
                    </div>
                </div>
                <div class='{$winorlose3}'>
                    <p class='text-white'>{$championPlayed3}</p>
                    <div class='ligne'>
                        <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/{$championPlayed3}.png' class='mb-2 mini_image'>
                        <div class='vertical'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell31}.png'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell32}.png'>
                        </div>
                        <div class='statistiques'>
                            <p class='text-white textostat' style='padding-top: 35px;'>{$kills3} / <span class='pink'>{$deaths3}</span> / {$assists3}    </p>
                            <div class='sous_Stat'>
                                <p class='text-white'> CS {$farm3} </p>
                                <p class='text-white'> <span class='text-info'>{$visionScore3}</span> Vision Score</p>
                                <p class='text-white'> <span class='text-warning'>{$gold3}</span> Gold </p>
                                <p class='text-white'> <span class='text-success'>{$damageDealt3}</span> Damage dealt</p>
                                <p class='text-white'> <span class='pink'>{$damageTaken3}</span> Damage taken</p>
                            </div>
                        </div>
                        <div class='itemlist'>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item30}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item31}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item32}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item36}.png'>
                            </div>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item33}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item34}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item35}.png'>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class='{$winorlose4}'>
                    <p class='text-white'>{$championPlayed4}</p>
                    <div class='ligne'>
                        <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/{$championPlayed4}.png' class='mb-2 mini_image'>
                        <div class='vertical'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell41}.png'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell42}.png'>
                        </div>
                        <div class='statistiques'>
                            <p class='text-white textostat' style='padding-top: 35px;'>{$kills4} / <span class='pink'>{$deaths4}</span> / {$assists4}    </p>
                            <div class='sous_Stat'>
                                <p class='text-white'> CS {$farm4} </p>
                                <p class='text-white'> <span class='text-info'>{$visionScore4}</span> Vision Score</p>
                                <p class='text-white'> <span class='text-warning'>{$gold4}</span> Gold </p>
                                <p class='text-white'> <span class='text-success'>{$damageDealt4}</span> Damage dealt</p>
                                <p class='text-white'> <span class='pink'>{$damageTaken4}</span> Damage taken</p>
                            </div>
                        </div>
                        <div class='itemlist'>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item40}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item41}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item42}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item46}.png'>
                            </div>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item43}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item44}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item45}.png'>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class='{$winorlose5}'>
                    <p class='text-white'>{$championPlayed5}</p>
                        <div class='ligne'>
                        <img src='http://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/{$championPlayed5}.png' class='mb-2 mini_image'>
                        <div class='vertical'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell51}.png'>
                            <img class='square_img' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$summonerSpell52}.png'>
                        </div>
                        <div class='statistiques'>
                            <p class='text-white textostat' style='padding-top: 35px;'>{$kills5} / <span class='pink'>{$deaths5}</span> / {$assists5}    </p>
                            <div class='sous_Stat'>    
                                <p class='text-white'> CS {$farm5} </p>
                                <p class='text-white'> <span class='text-info'>{$visionScore5}</span> Vision Score</p>
                                <p class='text-white'> <span class='text-warning'>{$gold5}</span> Gold </p>
                                <p class='text-white'> <span class='text-success'>{$damageDealt5}</span> Damage dealt</p>
                                <p class='text-white'> <span class='pink'>{$damageTaken5}</span> Damage taken</p>
                            </div>
                        </div>
                        <div class='itemlist'>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item50}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item51}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item52}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item56}.png'>
                            </div>
                            <div class='item'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item53}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item54}.png'>
                                <img style='width: 40px; height:40px; border: 1px solid white;' src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/item/{$item55}.png'>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        ";

    }else { // si le joueur n'a pas de ranked ou normal match
        
        $msg = "
        
        <div class='row'>

            <div class='col-12 d-flex flex-column justify-content-center text-center'>
                <h2 class='text-white'>this summoner has no ranked or normal <span class='pink'>matches!!</span></h2>
            </div>

        </div>
    
        ";

        $msghistory = "";
        $msgError = "
        <style>.banner{
            background-color: black;

        }</style>
        
        ";


    }



}else { // si le joueur n'existe pas

    $msg = "
    
         <div class='row'>

                <div class='col-12 d-flex flex-column justify-content-center text-center'>
                    <h2 class='text-white'>404 - Summoner not found</h2>
                </div>

        </div>

    ";

    $msghistory = "";

}


    $msgStyle = "<style>.banner{
        background: url('https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$championName}_1.jpg');
        min-height: calc(100vh - 56px);
        background-size: cover;
        background-repeat: no-repeat;
    }</style>";
    
?> <!--END PHP -->


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SummonersInfo</title>
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/style2.css">
        <link rel="icon" href="assets/img/5679.png" type="image/x-icon">
    </head>
    <body style="background-color: rgb(28,28,31);">

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
                <a class="navbar-brand" href="#">Summoners<span class="pink">Info</span></a>
                <form class="form-inline my-2 my-lg-0" method="GET">
                    <input class="form-control mr-sm-2" type="text" name="name" placeholder="Summoner Name..." aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </nav>
        </header>
        
        <div class="container-fluid banner">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center m-4">Summoners<span class="pink">Info</span></h1>
                </div>
            </div>
            

            <?php
                echo $msg;
                echo $msghistory;
                //print_r($matchHistory);
                //print_r($match);
                //print_r($champion);
                //print_r($championName);
                //print_r($summonerSpell11);
                //print_r($summonerSpellName1);
                //print_r($summonerSpell21);        
                //print_r($informations2);
                //print_r($informations1);
                //print_r($allSummonerSpells);
                //print_r($summonerSpell);
                //print_r($fullSummoner);
                //print_r($tableauprecis);
                echo $winorlose;
            ?>
            
          
        </div>


        <div class="copyrightText">
            <p>Copyright 2021 <a href="#">Roman Germain</a>. All right Reserved</p>
        </div>

    </body>
</html>
<?php

    echo $msgStyle;
    echo $msgError;
?>
<!-- http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Aatrox_1.jpg link to champion img -->
<!-- http://ddragon.leagueoflegends.com/cdn/13.6.1/img/profileicon/685.png link to icons img -->
<!--                         <img src='https://ddragon.leagueoflegends.com/cdn/13.6.1/img/spell/{$fullSummoner}' class='mb-2 '> -->

