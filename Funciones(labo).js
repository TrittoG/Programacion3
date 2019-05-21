window.addEventListener("load",function(){
      traerListado();
});
    
var xml=new XMLHttpRequest();
    
    
function traerListado(){
    
    xml.open("get","http://localhost:3000/materias",true);
    xml.onreadystatechange=callback;
    xml.send();
    
    }
    
    function callback(){
        if (xml.status===200 && xml.readyState===4) {
            var materias= xml.responseText;            
            var materiasJson= new Array();
            materiasJson = JSON.parse(materias);        
            armarTabla(materiasJson);
        }
    
    }
    
    
    function Editar(event){
        
        var auxArray=event.target.parentNode.children;        
        console.log(auxArray[1].innerHTML);
        document.getElementById("nombreText").value=auxArray[1].innerHTML;    
        document.getElementById("cuatrimestreText").value=auxArray[2].innerHTML;
        document.getElementById("fechaFinalText").value=auxArray[3].innerHTML;
        document.getElementById("turnoText").value=auxArray[4].innerHTML;
        var menuCambios=document.getElementById("menufix");
        menuCambios.hidden=false;

    }

//Funcion que me arma una tabla en el Bodytable 
function armarTabla(materias){    
    
 var bodyTable=document.getElementById("cuerpo");

    for(var x=0; x<materias.length ;x++){
            
        //creo elemento tipo tr y se lo asigno al bodytable como hijo
        var tr=document.createElement("tr"); 
        bodyTable.appendChild(tr);

         //creo los elementos tipo td
         var tdid=document.createElement("td");             
         var tdNombre=document.createElement("td");        
         var tdcuatrimestre=document.createElement("td");  
         var tdfechaFinal=document.createElement("td");      
         var tdTurno=document.createElement("td");

         //asigno los elementos tipo td como hijos de tr
        tr.appendChild(tdid)
        tr.appendChild(tdNombre);
        tr.appendChild(tdcuatrimestre);
        tr.appendChild(tdfechaFinal);
        tr.appendChild(tdTurno);

        //creo los elementos tipo texto y asigno su valor
        var id=document.createTextNode(materias[x]["id"]);
        var nombre =document.createTextNode(materias[x]["nombre"]);     
        var cuatrimestre=document.createTextNode(materias[x]["cuatrimestre"]);          
        var fechaFinal=document.createTextNode(materias[x]["fechaFinal"]);     
        var turno=document.createTextNode(materias[x]["turno"]);     
        
        //asigno el elemento tipo texto con su valor a cada td correspondiente como hijo
        tdid.appendChild(id);
        tdNombre.appendChild(nombre);
        tdcuatrimestre.appendChild(cuatrimestre);
        tdfechaFinal.appendChild(fechaFinal);
        tdTurno.appendChild(turno);
        
        //creo los eventos
        tr.addEventListener("dblclick",Editar);
    }
      
}