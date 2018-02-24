var map,
    marker,
    uluru = {lat: 51.508207, lng: -0.106769},
    results = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: uluru
    });

    marker = new google.maps.Marker({
        position: uluru,
        map: map
    });

    map.addListener('click', function(e) {
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: e.latLng,
            map: map
        });

        map.panTo(marker.getPosition());
    });
}

$(document).ready(function() {
    $("#scanAllRestaurants").click(function() {
        var LatLng = marker.getPosition(),
            data = {
                lat : LatLng.lat(),
                lng : LatLng.lng()
            };
        data.raidus = window.prompt("Radius");
        if (data.raidus) {
            spiner(true);
            $.ajax({
                data : data,
                url : "/finder.php",
                method : "post",
                success : function(res) {
                    spiner(false);

                    results = JSON.parse(res);
                    
                    $("#founded").text(results.length + " found");
                    $("#founded").show();
                    $("#download").removeClass("disabled");
                    $("#download").removeAttr('disabled');
                }
            });
            return ;
        }
        alert('Fail radius');
    });

    $("#download").click(function() {
        var csv = "";
        csv += "id, name, rating, types, phone\n";

        for(var i in results) {
            csv += results[i].id + ", " + results[i].name + ", " + results[i].rating + ", " + results[i].types.join(' ') + ", " + results[i].formatted_phone_number  + "\n";
        }

        var blob = new Blob(["\ufeff", csv]);
        var link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = marker.getPosition().lat() + "_" + marker.getPosition().lng() + ".csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});

function spiner(mode) {
    if (mode) {
        $('.loading').show();
        return ;
    }
    $('.loading').hide();
}