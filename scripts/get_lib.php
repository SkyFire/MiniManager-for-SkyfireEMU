<?php

//#############################################################################
/**
 * calculate creature health, mana and armor
 * 
 * kinda crappy way, but works
 * 
 * if $type is used:
 * 1 -> returns health
 * 2 -> returns mana
 * 3 -> returns armor
 * 0 -> returns array(health,mana,armor)      
 **/  
function get_additional_data($entryid, $type = 0)
{
    global $world_db, $realm_id;
    
    if (!is_numeric($entryid))
        return array(0,0,0);

    $sql = new SQL;
    $sql->connect($world_db[$realm_id]['addr'], $world_db[$realm_id]['user'], $world_db[$realm_id]['pass'], $world_db[$realm_id]['name']);

    $q = $sql->query("SELECT (SELECT unit_class FROM creature_template WHERE entry = ".$entryid.") AS class, (SELECT FLOOR(minlevel + (RAND() * (maxlevel - minlevel + 1))) FROM creature_template WHERE entry = ".$entryid.") AS level, (SELECT exp FROM creature_template WHERE entry = ".$entryid.") AS exp;");
    $data = $sql->fetch_assoc($q);
    
    if ($sql->num_rows($q) == 0)
      return array(0,0,0);
      
    $q = "SELECT ((SELECT Health_Mod FROM creature_template WHERE entry = ".$entryid.")*(SELECT basehp".$data['exp']." FROM creature_classlevelstats WHERE level = ".$data['level']." AND class = ".$data['class'].")+0.5), ((SELECT Mana_Mod FROM creature_template WHERE entry = ".$entryid.")*(SELECT basemana FROM creature_classlevelstats WHERE level = ".$data['level']." AND class = ".$data['class'].")+0.5),((SELECT Armor_Mod FROM creature_template WHERE entry = ".$entryid.")*(SELECT basearmor FROM creature_classlevelstats WHERE level = ".$data['level']." AND class = ".$data['class'].")+0.5);";          
    if ($type == 1)
        $q = "SELECT ((SELECT Health_Mod FROM creature_template WHERE entry = ".$entryid.")*(SELECT basehp".$data['exp']." FROM creature_classlevelstats WHERE level = ".$data['level']." AND class = ".$data['class'].")+0.5);";
    if ($type == 2)
        $q = "SELECT ((SELECT Mana_Mod FROM creature_template WHERE entry = ".$entryid.")*(SELECT basemana FROM creature_classlevelstats WHERE level = ".$data['level']." AND class = ".$data['class'].")+0.5);";
    if ($type == 3)
        $q = "SELECT ((SELECT Armor_Mod FROM creature_template WHERE entry = ".$entryid.")*(SELECT basearmor FROM creature_classlevelstats WHERE level = ".$data['level']." AND class = ".$data['class'].")+0.5);";
    
    $query = $sql->query($q);         
    $result = $sql->fetch_row($query);
    $sql->close();
    unset($sql);
    
    if ($type == 2 && $result[0] == 0.5)
        return 0;
    
    if ($type == 0 && $result[1] == 0.5)
        return array($result[0],0,$result[2]);
        
    
    return (($type > 0) ? $result[0] : $result);
}


//#############################################################################
//get name from realmlist.name

function get_realm_name($realm_id)
{
    global $realm_db;

    $sqlr = new SQL;
    $sqlr->connect($realm_db['addr'], $realm_db['user'], $realm_db['pass'], $realm_db['name']);

    $result = $sqlr->query("SELECT name FROM `realmlist` WHERE id = '$realm_id'");
    $realm_name = $sqlr->result($result, 0);

    return $realm_name;
}


//#############################################################################
//get WOW Expansion by id

function id_get_exp_lvl()
{
    $exp_lvl_arr =
    array
    (
        0 => array(0, "Classic",                ""     ),
        1 => array(1, "The Burning Crusade",    "TBC"  ),
        2 => array(2, "Wrath of the Lich King", "WotLK"),
        3 => array(3, "Cataclysm",              "Cata" )
    );
    return $exp_lvl_arr;
}


//#############################################################################
//get GM level by ID

function id_get_gm_level($id)
{
    global $lang_id_tab, $gm_level_arr;
    if(isset($gm_level_arr[$id]))
        return $gm_level_arr[$id][1];
    else
        return($lang_id_tab['unknown']);
}


//#############################################################################
//set color per Level range

function get_days_with_color($how_long)
{
    $days = count_days($how_long, time());

    if($days < 1)
        $lastlogin = '<font color="#009900">'.$days.'</font>';
    else if($days < 8)
        $lastlogin = '<font color="#0000CC">'.$days.'</font>';
    else if($days < 15)
        $lastlogin = '<font color="#FFFF00">'.$days.'</font>';
    else if($days < 22)
        $lastlogin = '<font color="#FF8000">'.$days.'</font>';
    else if($days < 29)
        $lastlogin = '<font color="#FF0000">'.$days.'</font>';
    else if($days < 61)
        $lastlogin = '<font color="#FF00FF">'.$days.'</font>';
    else
        $lastlogin = '<font color="#FF0000">'.$days.'</font>';

    return $lastlogin;
}


//#############################################################################
//get DBC Language from config

function get_lang_id()
{
    /* # DBC Language Settings
       #  0 = English
       #  1 = Korean
       #  2 = French
       #  3 = German
       #  4 = Chinese
       #  5 = Taiwanese
       #  6 = Spanish
       #  7 = Spanish Mexico
       #  8 = Russian
       #  9 = Unknown
       # 10 = Unknown
       # 11 = Unknown
       # 12 = Unknown
       # 13 = Unknown
       # 14 = Unknown
       # 15 = Unknown */

    global $language;
    if (isset($_COOKIE["lang"]))
        $language=$_COOKIE["lang"];

    // 0 = English/Default; 1 = Korean; 2 = French; 4 = German; 8 = Chinese; 16 = Taiwanese; 32 = Spanish; 64 = Russian
    switch ($language)
    {
        case 'korean':
            return 1;
            break;
        case 'french':
            return 2;
            break;
        case 'german':
            return 3;
            break;
        case 'chinese':
            return 4;
            break;
        case 'taiwanese':
            return 5;
            break;
        case 'spanish':
            return 6;
            break;
        case 'mexican':
            return 7;
            break;
        case 'russian':
            return 8;
            break;
        default:
            return 0;
            break;
    }
}


?>
