<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Google Maps - encontrando o endereço mais próximo</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAM3tYiYBfOKmhuRiSYzXlxRSolT9dJHhqkNrIgFq9Znypr0iOlhQeBdhVvDQuPJy4hxdG187GklHLbA" type="text/javascript"></script>


<script type="text/javascript">
    var geocoder = new GClientGeocoder();
    var map;
    var directionsPanel;
    var directions;
    var gdir = new GDirections();
    var addr = new Array(3);
    var distances = new Array(3);
    
    window.onload = function() {
        //seta o país que será usado pela API
        geocoder.setBaseCountryCode("pt_BR");

        map = new GMap2(document.getElementById(´map´), { size: new GSize(710,480) })
        map.addControl(new GLargeMapControl());
        map.setCenter(new GLatLng(-23.547779, -46.639366), 12); //centro da cidade de São Paulo
        
        //mostra o endereço de 3 Sescs no mapa
        showAddress("Sesc Paulista - São Paulo/SP", 1);
        showAddress("Rua Amador Bueno, 505 - São Paulo/SP", 2); //Sesc Santo Amaro
        showAddress("Rua Clélia, 93 - São Paulo/SP", 3); //Sesc Pompéia
        //ao clicar no botão do formulário, faz a busca
        document.getElementById("trace-route").onclick = function() {
            //tenta encontrar o endereço digitado pelo usuário
            geocoder.getLocations(
                document.getElementById("from").value,
                    function(point) {
                        //marca no mapa o endereço citado
                        add_marker(point);
                        //se existir o endereço que o usuário digitou...
                        if(point.Placemark) {
                            //cria objeto GLatLng e grava a latitude/longitude do endereço digitado pelo usuário, para uso futuro
                            var b = new GLatLng(point.Placemark[0].Point.coordinates[1], point.Placemark[0].Point.coordinates[0]);
                            /*
                            variáveis que serão usadas para comparar distâncias entre coordenadas
                            de latitude e longitude
                            */
                            var smallestDist;
                            var smallestDistId;
                            //percorre lista dos 3 endereços do SESCs
                            for(var i=0; i<3; i++) {
                                var a = new GLatLng(addr[i][1], addr[i][0]);
                                /*
                                usa método da classe GLatLng() que retorna a distância, em metros, entre
                                duas coordenadas de latitude/longitude
                                */
                                var x = a.distanceFrom(b);
                                //lógica para marcar qual a menor distância entre o endereço digitado e os 3 endereços dados
                                if(x<smallestDist || i==0) {
                                    smallestDist = x;
                                    smallestDistId = i;
                                }
                            }
                            /*
                            cria um array de dois objetos GLatLng, com as coordenadas do endereço digitado pelo
                            usuário e o endereço do ponto mais próximo a esse endereço
                            */
                            var pointsArray = [new GLatLng(addr[smallestDistId][1], addr[smallestDistId][0]), b]
                            directions = new GDirections(map); //instancia objetos
                            //usa o array de pontos para traçar a rota entre os dois endereços (ou melhor, entre as duas coordenadas)
                            directions.loadFromWaypoints(pointsArray, {"locale":"pt_BR"});
                        }
                    }
              );
        }
        
    }
    
    
    function showAddress(address, k) {
      geocoder.getLocations(
        address,
        function(point) {
            add_marker(point, k);
        }
      );
    }
    
    
    
    function add_marker(response, k) {
        if(!response.Placemark) {
            return;
        }
        place = response.Placemark[0];
        if(k) {
            //grava a latitude/longitude do endereço
            addr[k-1] = place.Point.coordinates;
        }
        point = new GLatLng(place.Point.coordinates[1],
                            place.Point.coordinates[0]);
        var marker = createMarker(point, place.address, k);
        map.addOverlay(marker);
    }
    
    function createMarker(point,html, k) {
        var marker = new GMarker(point, false);
        return marker;
    }

    
</script>
</head>

<body>

<div id="map"></div>
<form action="#" method="POST">
    <fieldset>
        <label for="from">ponto de partida:</label>
        <input type="text" name="from" id="from" />
    </fieldset>
    <input type="button" class="button" id="trace-route" value="achar SESC mais próximo" />
</form>
</body>
</html>