<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Display KML Tracks and Points on OpenStreetMap</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> <!-- Update Bootstrap CSS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script> <!-- Update Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Update Bootstrap JS -->
  <style>
    #map {
      height: 700px;
      width: 100%;
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <div id="popup" style="display:none;"></div> <!-- Add this line -->
  <script>
    var vectorSources = [
      new ol.source.Vector({
        url: 'kmlfile.kml',
        format: new ol.format.KML({
          extractStyles: false,
          extractAttributes: true
        }),
        strategy: ol.loadingstrategy.bbox // Only load visible features
      }),
      new ol.source.Vector({
        url: 'kmlwwk.kml',
        format: new ol.format.KML({
          extractStyles: false,
          extractAttributes: true
        }),
        strategy: ol.loadingstrategy.bbox // Only load visible features
      }),
      new ol.source.Vector({
        url: 'kmlwwkto.kml',
        format: new ol.format.KML({
          extractStyles: false,
          extractAttributes: true
        }),
        strategy: ol.loadingstrategy.bbox // Only load visible features
      }),
      new ol.source.Vector({
        url: 'kmlsda.kml',
        format: new ol.format.KML({
          extractStyles: false,
          extractAttributes: true
        }),
        strategy: ol.loadingstrategy.bbox // Only load visible features
      }),
      // add more VectorSource objects as needed
    ];
    var vectorLayers = [];
    for (var i = 0; i < vectorSources.length; i++) {
      var layer = new ol.layer.Vector({
        source: vectorSources[i],
        style: function(feature) {
          // Only display tracks
          if (feature.getGeometry().getType() === 'LineString') {
            return new ol.style.Style({
              stroke: new ol.style.Stroke({
                color: 'red',
                width: 2
              })
            });
          }
        }
      });
      vectorLayers.push(layer);
    }
    var marker1 = new ol.Feature({
      geometry: new ol.geom.Point(ol.proj.fromLonLat([143.576287, -3.553425])),
      name: 'Marker 1',
      description: 'This is the first marker',
      url: 'https://govhrm.wanspeen.com',
      link:'View'
    });
    var marker2 = new ol.Feature({
      geometry: new ol.geom.Point(ol.proj.fromLonLat([143.695600, -3.563359])),
      name: 'Marker 2',
      description: 'This is the second marker',
      url: 'https://example.com',
      link:'More...'
    });
    var marker3 = new ol.Feature({
      geometry: new ol.geom.Point(ol.proj.fromLonLat([143.634997, -3.604654])),
      name: 'Marker 3',
      description: 'This is the third marker',
      url: 'https://www.dakoiims.com',
      link: 'View'
    });
    var marker4 = new ol.Feature({
      geometry: new ol.geom.Point(ol.proj.fromLonLat([143.625109, -3.582473])),
      name: 'Marker 3',
      description: 'This is the third marker',
      url: 'https://www.dakoiims.com',
      link: 'View'
    });
    var marker5 = new ol.Feature({
      geometry: new ol.geom.Point(ol.proj.fromLonLat([143.448534,-3.753086])),
      name: 'Marker 3',
      description: 'This is the third marker',
      url: 'https://www.dakoiims.com',
      link: 'View'
    });
    var vectorPoints = new ol.source.Vector({
      features: [marker1, marker2, marker3,marker4,marker5]
    });
    var vectorPointsLayer = new ol.layer.Vector({
      source: vectorPoints,
      style: new ol.style.Style({
        image: new ol.style.Icon({
          src: 'marker-map.png',
         // size:[20,20]
        })
      })
    });
    var map = new ol.Map({
      layers: [
        new ol.layer.Tile({
          source: new ol.source.OSM()
        }),
        // add all VectorLayer objects to the layers array
        ...vectorLayers,
        vectorPointsLayer
      ],
      target: 'map',
      view: new ol.View({
        center: ol.proj.fromLonLat([143.627099, -3.551542]),
        zoom: 9
      })
    });
    var element = document.getElementById('popup');
    var popup = new ol.Overlay({
      element: element,
      positioning: 'bottom-center',
      stopEvent: false,
      offset: [0, -20]
    });
    map.addOverlay(popup);
    // display popup on click
    map.on('click', function(evt) {
      var feature = map.forEachFeatureAtPixel(evt.pixel,
        function(feature) {
          return feature;
        });
      if (feature) {
        var coordinates = feature.getGeometry().getCoordinates();
        popup.setPosition(coordinates);
        $(element).show(); // Move this line up
        $(element).popover({
          placement: 'top',
          html: true,
          content: feature.get('name') + '<br>' + feature.get('description') + '<br><a href="'+ feature.get('url')+'">' + feature.get('link')+'</a>'
        });
        $(element).popover('show');
      } else {
        $(element).popover('dispose');
        $(element).hide(); // Add this line
      }
    });
    // change mouse cursor when over marker
    map.on('pointermove', function(e) {
      if (e.dragging) {
        $(element).popover('dispose');
        $(element).hide(); // Add this line
        return;
      }
      var pixel = map.getEventPixel(e.originalEvent);
      var hit = map.hasFeatureAtPixel(pixel);
      document.getElementById('map').style.cursor = hit ? 'pointer' : '';
    });
  </script>
</body>

</html>