var  tbl_grado;
function listar_grado(){
    tbl_grado = $("#tabla_grado").DataTable({
        "ordering":false,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax":{
            "url":"../controller/grado/controlador_listar_grado.php",
            type:'POST'
        },
        "columns":[
    {"defaultContent":""},
    {"data":"nombre_grado"},

 {"defaultContent": "<center>"+"<span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class= 'fa fa-edit'></i></span> <span class=' eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span>"+"</center>"}

      
      
      ],

  
        "language":idioma_espanol,
        select: true
    });
    tbl_grado.on('draw.td',function(){
      var PageInfo = $("#tabla_grado").DataTable().page.info();
      tbl_grado.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
}

$('#tabla_grado').on('click','.editar',function(){
    var data = tbl_grado.row($(this).parents('tr')).data();//En tamaño escritorio
    if(tbl_grado.row(this).child.isShown()){
        var data = tbl_grado.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_editar").modal('show');
    document.getElementById('txt_grado_editar').value = data.nombre_grado;  
    document.getElementById('txt_idgrado').value=data.id_grado; 
    
});

function AbrirRegistro(){
  $("#modal_registro").modal({backdrop:'static',keyboard:false})
  $("#modal_registro").modal('show');
}

function Registrar_Grado() {
    let nombre_grado = document.getElementById('nombre_grado').value;
 
    if (nombre_grado.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/grado/controlador_registrar_grado.php",
        type: 'POST',
        data: {
            nombre_grado: nombre_grado 
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Nueva Grado Registrado", "success").then((value) => {
                    document.getElementById('nombre_grado').value = "";
                    tbl_grado.ajax.reload();
                    $("#modal_registro").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El grado ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó el registro", "error");
        }
    });
}


/********************************************************************
               MODIFICAR AGENCIA
********************************************************************/
function Modificar_Grado() {
   
    let id_grado = document.getElementById('txt_idgrado').value; 
    let nombre_grado = document.getElementById('txt_grado_editar').value; 

    if (nombre_grado.length === 0 || id_grado.length === 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/grado/controlador_modificar_grado.php", 
        type: 'POST',
        data: {
            id_grado: id_grado, 
            nombre_grado: nombre_grado
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Datos Actualizados", "success").then((value) => {
                    tbl_grado.ajax.reload();
                    $("#modal_editar").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El grado ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó la modificación", "error");
        }
    });
}



/**********************************************************************
 				MENSAJE ELIMINAR AGENCIA
 ***********************************************************************/
                 $('#tabla_grado').on('click', '.eliminar', function() {//campo activar tiene que ir en el boton
                    var data = tbl_grado.row($(this).parents('tr')).data();//tamaño de escritorio
                    if (tbl_grado.row(this).child.isShown()) {
                        var data = tbl_grado.row(this).data();//para celular y usas el responsive datatable
                    }
                    Swal.fire({
                      title: 'Desea Eliminar el Grado?',
                      text: "Se borrara el registro de la base de datos",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, confirmar'
                    }).then((result) => {
                      if (result.isConfirmed) {
                       Eliminar_Grado(data.id_grado);//campo id de la marca luego llamamos al metodo
                      }
                    })
                 });
                
                
                
                 /********************************************************************
                             METODO   ELIMINAR LA GRADO
                 ********************************************************************/
                 function Eliminar_Grado(id){
                    $.ajax({
                         url:'../controller/grado/controlador_eliminar_grado.php',
                         type: 'POST',
                         data:{
                             id: id//le enviamos los campos al controlador
                
                
                         }
                     }).done(function(resp){
                         if (resp>0) {
                                     Swal.fire("Mensaje de Confirmacion","Grado Eliminado","success").then((value)=>{
                                         tbl_grado.ajax.reload();//recargar dataTable
                                         //TraerNotificaciones();
                                     });	 			
                             }else{
                                 Swal.fire("Mensaje de Error","No se puede eliminar el Grado","error");
                             }
                     })
                 }
                




