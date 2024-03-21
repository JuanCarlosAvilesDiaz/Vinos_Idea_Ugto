
const arrayslon = ["0","-101.336911", "-101.8575609", "-100.8065524", "-100.852343", "-100.8918976", "-100.9280032", "-100.8021407", "-100.8008309", "-100.6724489", "-100.816321", "-100.879691", "-100.75015", "-100.938159", "-100.662921", "-100.787401", "-100.804544", "-100.865292"];
const arrayslat = ["0","21.0534413", "20.866303", "20.7984793", "21.208149", "21.307121", "21.0832194", "20.7945385", "21.0849491", "20.9089953", "20.941974", "20.193324", "20.951986", "21.690686", "20.913957", "21.014815", "20.788194", "21.138691"];
const viñedo = ["Seleccionar Viñedo", "Camino De Vinos", "Viñedo El Lobo", "Viñedo San Miguel", "Viñedo Cuna De Tierra","Viñedo Los Arcángeles", "Bernat Vinicola", "Bodega Viñedo San Miguel", "Tres Raíces", "Vinícola Toyan","Hacienda San José Lavista", "Viñedo Dos Jacales", "Puente Josefa Viñedo", "Viñedos Pájaro Azul", "Viñedos San Lucas","Viña del Cielo", "Los Remedios Rancho Y Viñedo", "Santísima Trinidad"];

var lat = 0;
var long = 0;
var fecha = 0;
let arr = 0;


// document.getElementById("consulta").onclick = function(){
//         var i=document.getElementById("viñedo").value
//         lat = document.getElementById('viñedo').getElementsByTagName('option')[i].getAttribute('data-latitude');
//         long = document.getElementById('viñedo').getElementsByTagName('option')[i].getAttribute('data-longitude');
//         fecha = document.getElementById('sample-date').value;
//         arr = fecha.split('-');
//         detectChange(i);
//     };

function detectChange(i){
    
    const api2 = "https://api.weatherbit.io/v2.0/normals?lat="+arrayslat[i]+"&lon="+arrayslon[i]+"&start_day="+arr[1]+"-"+arr[2]+"&end_day="+arr[1]+"-"+arr[2]+"&series_year="+arr[0]+"&tp=daily&key=c90655123f154f98ba1d85d53c088503";
    const xhr = new XMLHttpRequest();

    xhr.addEventListener("load", onRequestHandler);
    xhr.open("GET", api2);
    xhr.send();
    
};

function onRequestHandler(){
    if(this.readyState === 4 && this.status === 200){
        console.log(this.response);
        //var hora = document.getElementById("hora").value
        let datos = JSON.parse(this.response);
        var muestra=document.getElementById("muestra").value
        //console.log(datos.data[0]);
        //document.getElementById("id").innerHTML = "lat: "+datos.lat +" lon: " +datos.lon ;
        document.getElementById('info').innerHTML = '<h2>'+viñedo[document.getElementById("viñedo").value]+'</h2>'+
        '<h3>Dia: '+datos.data[0].day+' Mes: '+datos.data[0].month+'</h3><p>'+"lat: "+datos.lat +" lon: " +datos.lon+'</p>'+'<p>Temperatura maxima: '+datos.data[0].max_temp+' Temperatura minima: '+datos.data[0].min_temp+' Temperatura: '+datos.data[0].temp+'</p>'+
        '<p>Velocidad del viento maxima: '+datos.data[0].max_wind_spd+' Velocidad del viento minima: '+datos.data[0].min_wind_spd+' Velocidad del viento: '+datos.data[0].wind_spd+' Direccion del viento: '+datos.data[0].wind_dir+'</p>'+
        '<p>Precipitacion: '+datos.data[0].precip+'  Punto de rocio: '+datos.data[0].dewpt+'</p>'+
        '<p>Muestra: '+muestra+'</p>';
        // '<p>Hora '+hora+'</p>';
        
    }
}