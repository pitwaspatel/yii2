<?php

/* @var $this yii\web\View */

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;

// edofre objects instead of dosamigos
use edofre\markerclusterer\Map;
use edofre\markerclusterer\Marker;

$this->title = 'Maps Clusterer';
?>
<div class="maps-index">
    <?php
    $map = new Map([
        'center' => new LatLng(['lat' => 0.0236, 'lng' => 37.9062]), // Center of keneya
        'zoom' => 12,
    ]);


    $query = (new \yii\db\Query());
    $query->select(['locoordinates', 'Name_optional'])->from('mytable')->indexBy('Name_optional');
    $results = $query->all();

    $cities = [];
    foreach ($results as $city => $value) {
        $lat_lang = explode(";",$value['locoordinates'])[0];
        $lat = explode(" ",$lat_lang)[0];
        $lang = explode(" ",$lat_lang)[1];
        $cities[$city] = new LatLng(['lat' => $lat, 'lng' =>$lang]);
    }

    foreach ($cities as $city => $lat_lng) {
        $marker = new Marker([
            'position' => $lat_lng,
            'title' => $city,
            'clickable' => true,
        ]);

        $marker->attachInfoWindow(new InfoWindow(['content' => "<strong>{$city}</strong>"]));
        $map->addOverlay($marker);
    }

    $map->center = $map->getMarkersCenterCoordinates();
    $map->zoom = $map->getMarkersFittingZoom() - 1;
    ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $map->display(); ?>
        </div>
    </div>
</div>