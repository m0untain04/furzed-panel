<?php require_once("header.php");
$u_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$u_id)
{
    header("Location: index.php");
}

$car_types = array
(
			400 => "Landstalker", 401 => "Bravura", 402 => "Buffalo", 403 => "Linerunner", 404 => "Perrenial", 405 => "Sentinel", 406 => "Dumper", 407 => "Firetruck",
			408 => "Trashmaster", 409 => "Stretch", 410 => "Manana", 411 => "Infernus", 412 => "Voodoo", 413 => "Pony", 414 => "Mule", 415 => "Cheetah", 
			416 => "Ambulance", 417 => "Leviathan", 418 => "Moonbeam", 419 => "Esperanto", 420 => "Taxi", 421 => "Washington", 422 => "Bobcat", 423 => "Whoopee",
			424 => "BFInjection", 425 => "Hunter", 426 => "Premier", 427 => "Enforcer", 428 => "Securicar", 429 => "Banshee", 430 => "Predator", 431 => "Bus", 
			432 => "Rhino", 433 => "Barracks", 434 => "Hotknife", 435 => "Trailer", 436 => "Previon", 437 => "Coach", 438 => "Cabbie", 439 => "Stallion", 
			440 => "Rumpo", 441 => "RCBandit", 442 => "Romero", 443 => "Packer", 444 => "Monster", 445 => "Admiral", 446 => "Squalo", 447 => "Seasparrow",
			448 => "Pizzaboy", 449 => "Tram", 450 => "Trailer", 451 => "Turismo", 452 => "Speeder", 453 => "Reefer", 454 => "Tropic", 455 => "Flatbed", 456 => "Yankee",
			457 => "Caddy", 458 => "Solair", 459 => "Berkley\'sRCVan", 460 => "Skimmer", 461 => "PCJ-600", 462 => "Faggio", 463 => "Freeway", 464 => "RCBaron", 
			465 => "RCRaider", 466 => "Glendale", 467 => "Oceanic", 468 => "Sanchez", 469 => "Sparrow", 470 => "Patriot", 471 => "Quad", 472 => "Coastguard", 
			473 => "Dinghy", 474 => "Hermes", 475 => "Sabre", 476 => "Rustler", 477 => "ZR-350", 478 => "Walton", 479 => "Regina", 480 => "Comet", 481 => "BMX",
			482 => "Burrito", 483 => "Camper", 484 => "Marquis", 485 => "Baggage", 486 => "Dozer", 487 => "Maverick", 488 => "NewsChopper", 489 => "Rancher",
			490 => "FBIRancher", 491 => "Virgo", 492 => "Greenwood", 493 => "Jetmax", 494 => "Hotring", 495 => "Sandking", 496 => "BlistaCompact", 
			497 => "PoliceMaverick", 498 => "Boxville", 499 => "Benson", 500 => "Mesa", 501 => "RCGoblin", 502 => "HotringRacerA", 503 => "HotringRacerB", 
			504 => "BloodringBanger", 505 => "Rancher", 506 => "SuperGT", 507 => "Elegant", 508 => "Journey", 509 => "Bike", 510 => "MountainBike",	511 => "Beagle",
			512 => "Cropduster", 513 => "Stunt", 514 => "Tanker", 515 => "Roadtrain", 516 => "Nebula", 517 => "Majestic", 518 => "Buccaneer", 519 => "Shamal",
			520 => "Hydra", 521 => "FCR-900", 522 => "NRG-500", 523 => "HPV1000", 524 => "CementTruck", 525 => "TowTruck", 526 => "Fortune", 527 => "Cadrona", 
			528 => "FBITruck",529 => "Willard", 530 => "Forklift", 531 => "Tractor", 532 => "Combine", 533 => "Feltzer", 534 => "Remington", 535 => "Slamvan", 
			536 => "Blade", 537 => "Freight",538 => "Streak", 539 => "Vortex", 540 => "Vincent", 541 => "Bullet", 542 => "Clover", 543 => "Sadler", 544 => "Firetruck",
			545 => "Hustler", 546 => "Intruder", 547 => "Primo", 548 => "Cargobob", 549 => "Tampa", 550 => "Sunrise", 551 => "Merit", 552 => "Utility", 553 => "Nevada",
			554 => "Yosemite", 555 => "Windsor", 556 => "Monster", 557 => "Monster", 558 => "Uranus", 559 => "Jester", 560 => "Sultan", 561 => "Stratium", 
			562 => "Elegy", 563 => "Raindance", 564 => "RCTiger", 565 => "Flash", 566 => "Tahoma", 567 => "Savanna", 568 => "Bandito", 569 => "FreightFlat", 
			570 => "StreakCarriage", 571 => "Kart", 572 => "Mower", 573 => "Dune", 574 => "Sweeper", 575 => "Broadway", 576 => "Tornado", 577 => "AT-400", 
			578 => "DFT-30", 579 => "Huntley", 580 => "Stafford", 581 => "BF-400", 582 => "NewsVan", 583 => "Tug", 584 => "Trailer", 585 => "Emperor", 586 => "Wayfarer",
			587 => "Euros", 588 => "Hotdog", 589 => "Club", 590 => "FreightBox", 591 => "Trailer", 592 => "Andromada", 593 => "Dodo", 594 => "RCCam", 595 => "Launch", 
			596 => "PoliceCar", 597 => "PoliceCar", 598 => "PoliceCar", 599 => "PoliceRanger", 600 => "Picador", 601 => "S.W.A.T", 602 => "Alpha", 603 => "Phoenix",
			604 => "Glendale", 605 => "Sadler", 606 => "Luggage", 607 => "Luggage", 608 => "Stairs", 609 => "Boxville", 610 => "Tiller", 611 => "UtilityTrailer"
			
);

?>
<style>
div { border: 1px }
</style>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <?php
            $sql = $con->query("SELECT * FROM `users` WHERE id = '$u_id'");
            if($sql->num_rows != 0) {
                $row = $sql->fetch_assoc();
                $ACTUALskin_id = explode("|", $row['Skin']);
            ?>
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img" src="dist/img/avatars/bigskins/<?=$ACTUAL_skin_id[0]?>.png" alt="User skin">
                </div>

                <h3 class="profile-username text-center"><?=$row['name']?></h3>

                <p class="text-center"><?=GetUserBadges($u_id)?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <?php
            }
            ?>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#main" data-toggle="tab">Main</a></li>
                  <li class="nav-item"><a class="nav-link" href="#veh" data-toggle="tab">Vehicles</a></li>
                  <li class="nav-item"><a class="nav-link" href="#prop" data-toggle="tab">Properties</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content no-padding">
                  <div class="active tab-pane fade show" id="main">
                    <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td></td>
                            <td>Faction:</td>
                            <td></td>
                            <td></td>
                            <td><?=GetGroupNameByID($row['Member'])?></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td>Hours played:</td>
                            <td></td>
                            <td></td>
                            <td><?=$row['ConnectedTime']?></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td>Level:</td>
                            <td></td>
                            <td></td>
                            <td><?=$row['Level']?></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td>Faction warns:</td>
                            <td></td>
                            <td></td>
                            <td><?=$row['FWarn']?>/3</td>
                            </tr>
                            <tr>
                            <td></td>
                            <td>Phone number:</td>
                            <td></td>
                            <td></td>
                            <td><?=$row['PhoneNr']?></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td>Last online:</td>
                            <td></td>
                            <td></td>
                            <td><?=$row['lastOn']?></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
              </div>
                <div class="col-md-5 column fade" id="veh">
                    
                    <?php
                        $carss_username = GetUserNameByID($u_id);
                        $sql = $con->query("SELECT * FROM cars WHERE Owner = '$carss_username'");
                        if($sql->num_rows != 0) {
                            while($row = $sql->fetch_assoc()) 
                            {
                                $Check_For_VIP = "";
                                $veh_Days = $current_timestamp - $row['BuyTime'];
                                if($row['VIP'] == 1) $Check_For_VIP = "yes";
                                else if($row['VIP'] == 0) $Check_For_VIP = "no";
                    ?>
                    <div class="card bg-gray">
                    <div class="card-header text-muted border-bottom-0">

                    </div>
                    <div class="card-body" style="display: inline">
                    <div class="row">
                        <div class="col-7">
                        <h2 class="lead"><b><?=$car_types[$row['Model']]?> (ID: <?=$row['ID']?>)</b></h2>
                        <p class="text-sm"><b>Odometer: <?=$row['KM']?> KM</b></p>
                        <p class="text-sm"><b>VIP: <?=$Check_For_VIP?></b></p>
                        <p class="text-sm"><b>Purchased: <?=howDaysAgo($veh_Days)?></b></p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">

                        </ul>
                        </div>
                        <div class="col-5 text-center">
                        <img src="dist/img/avatars/vehicles/Vehicle_<?=$row['Model']?>.jpg" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-sm btn-primary bg-danger">
                        <i class="fas fa-map"></i> View location
                        </a>
                    </div>
                    </div>
                    <br class="clearBoth">
                    <?php
                            }
                    }
                ?>
                </div>    
            </div>
            </div>
            </div>
            <!-- /.card -->
          </div>
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<?php require_once("footer.php");

?>