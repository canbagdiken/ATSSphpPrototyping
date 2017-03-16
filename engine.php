<?php
header("Content-type: application/json; charset=utf-8");



class car{
    public $curPos = 0;
}
class road{
    public $road;
}
class traffic{


}

function getRandomNextRoad($from){
    $data = mysql_fetch_assoc(mysql_query('SELECT wayto FROM connections WHERE wayfrom='.intval($from).' order by rand() limit 1'));
    return $data["wayto"];
}

function getNextCar($id,$fromBegin = false){
    $data = mysql_fetch_assoc(mysql_query('select * from car where id='.intval($id)));
    $tmp = mysql_fetch_assoc(mysql_query("select * from car
    where
    activeroad=".intval($data["activeroad"]).' and
    id!='.intval($id).' and
    curpos>'.intval($data["curpos"]).' order by curpos asc limit 1'));

    return $tmp;
}


function checkEndOfWay(){
    $query = mysql_query('SELECT c.id, r.nextroad FROM roads r left join car c on c.activeroad=r.id where c.curpos > 75+r.length');
    while($row = mysql_fetch_assoc($query)){
        if(!isBusyNextRoad($row["nextroad"])){
            mysql_query('update car set curpos=0,activeroad='.$row["nextroad"].' where id='.intval($row["id"]));
        }
    }
}

function isBusyNextRoad($id){
	 $roadInfo = mysql_fetch_assoc(mysql_query('select count(id) as say from car where curpos<75 and activeroad='.intval($id)));
	 return $roadInfo["say"] == 0 ? false:true;
}

function getNextRoad($id){

}



function car($data){
    $carLength = 75;
        $nextCar = getNextCar($data["id"]);
        if(intval($nextCar["id"]) != 0){
              $nextCarDistance = ($nextCar["curpos"] - $data["curpos"])-$carLength;
              $nextDistance = ($nextCarDistance-$data["curspeed"] > 0) ? $data["curspeed"]:0;//($data["curspeed"]/2);
        }else{
          $roadInfo = mysql_fetch_assoc(mysql_query('select * from roads where id='.intval($data["activeroad"])));
          $nextCarDistance = ($roadInfo["length"]-$data["curpos"])-$carLength;

            if($nextCarDistance > $data["curspeed"]){
              $nextCarDistance = 99999;
              $nextDistance = $data["curspeed"];

            }else{
              if(!isBusyNextRoad($data["nextroad"])){
                  $nextDistance = 0;
                  $nextRoad = getRandomNextRoad($data["nextroad"]);
                  mysql_query('update car set curpos=0,nextroad='.intval($nextRoad).',activeroad='.$data["nextroad"].' where id='.intval($data["id"]));
              }else{
                  $nextDistance = 0;
              }

            }
        }
        // go one pixel
        mysql_query('update car set curpos=curpos+'.$nextDistance.' where id='.intval($data["id"]));


}


function road($data){
          $query = mysql_query("select * from car where activeroad=".$data["id"]);
          while($row = mysql_fetch_assoc($query)){
              car($row);
          }

}


mysql_connect("localhost","","");
mysql_select_db("");



// update positions


$query = mysql_query("select * from roads");
while($row = mysql_fetch_assoc($query)){
    road($row);
}




// output

switch($_GET["a"]){

  case "initMap":
$traffic = array();
$traffic["junctions"] = array();
$traffic["roads"] = array();

$junctions = mysql_query("select * from junctions");
while($junction = mysql_fetch_assoc($junctions)){
  $traffic["junctions"][] = $junction;
}
$roads = mysql_query("select * from roads");
while($road = mysql_fetch_assoc($roads)){
  $tmp = $road;
  $tmp["cars"] =array();


  $cars = mysql_query("select * from car where activeroad=".$road["id"]);
  while($car = mysql_fetch_assoc($cars)){
      $tmp["cars"][] = $car;
  }
  $traffic["roads"][] = $tmp;
}
$traffic = json_encode($traffic);


echo ($traffic);

break;
case 'cars':
  $result = array();
  $cars = mysql_query("select * from car");
  while($car = mysql_fetch_assoc($cars)){
      $result[] = $car;
  }
  $result = json_encode($result);
  echo ($result);
}

///checkEndOfWay();
