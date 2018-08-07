
eventListeners_();

function eventListeners_(){
    if(document.querySelector('.nuevo-txt') !== null ) {
        document.querySelector('.nuevo-txt').addEventListener('click', enviarTXT);
    }

    if(document.querySelector('.nuevo-txtc') !== null ) {
        document.querySelector('.nuevo-txtc').addEventListener('click', enviarTXTC);
    }

    if(document.querySelector('.nuevo-vacaciones') !== null ) {
        document.querySelector('.nuevo-vacaciones').addEventListener('click', enviarVACACIONES);
    }
}

function enviarVACACIONES(e){
    e.preventDefault();
    document.querySelector('.nuevo-vacaciones').removeEventListener('click', enviarVACACIONES);
    var fechaINI = document.querySelector('#fechaINI').value,
        fechaFIN = document.querySelector('#fechaFIN').value,
        razon = document.querySelector('#txtRazonv').value,
        employeeID = document.querySelector('#employeeIDv').value,
        tipo = document.querySelector('#typev').value;

    console.log(fechaINI+' '+fechaFIN+' '+razon+' '+employeeID+' '+tipo);

    if (razon === '') {
        swal({
          type: 'error',
          title: 'Error!',
          text: 'Todos los campos son obligatorios!'
        })
    }
    else{
        var datosVAC = new FormData();
        datosVAC.append('fechaINI', fechaINI);
        datosVAC.append('fechaFIN', fechaFIN);
        datosVAC.append('razon', razon);
        datosVAC.append('employeeID', employeeID);
        datosVAC.append('accion', tipo);
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'inc/model/control.php', true);
        xhr.onload = function(){
        if (this.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitoso!',
                            type: 'success'
                        })
                        .then(resultado => {
                                if(resultado.value) {
                                   location.reload();
                                }
                            })
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xhr.send(datosVAC);
    }

}

function enviarTXT(e){
    e.preventDefault();
    document.querySelector('.nuevo-txt').removeEventListener('click', enviarTXT);
    var fecha = document.querySelector('#txtFecha').value,
        horas = document.querySelector('#txtHoras').value,
        razon = document.querySelector('#txtRazon').value,
        employeeID = document.querySelector('#employeeID').value,
        tipo = document.querySelector('#type').value;

    if (fecha === '' || horas === '' || razon === '') {
        swal({
          type: 'error',
          title: 'Error!',
          text: 'Todos los campos son obligatorios!'
        })
    }else{
        var datosTXT = new FormData();
        datosTXT.append('fecha', fecha);
        datosTXT.append('horas', horas);
        datosTXT.append('razon', razon);
        datosTXT.append('employeeID', employeeID);
        datosTXT.append('accion', tipo);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();

        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitoso!',
                            type: 'success'
                        })
                        .then(resultado => {
                                if(resultado.value) {
                                   location.reload();
                                }
                            })
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosTXT);
    }
}

function enviarTXTC(e){
    e.preventDefault();
    document.querySelector('.nuevo-txtc').removeEventListener('click', enviarTXTC);
    var fecha = document.querySelector('#txtFechac').value,
        horas = document.querySelector('#txtHorasc').value,
        razon = document.querySelector('#txtRazonc').value,
        employeeID = document.querySelector('#employeeIDc').value,
        tipo = document.querySelector('#typec').value;
        console.log(tipo);

    if (fecha === '' || horas === '' || razon === '') {
        swal({
          type: 'error',
          title: 'Error!',
          text: 'Todos los campos son obligatorios!'
        })
    }else{
        var datosTXT = new FormData();
        datosTXT.append('fecha', fecha);
        datosTXT.append('horas', horas);
        datosTXT.append('razon', razon);
        datosTXT.append('employeeID', employeeID);
        datosTXT.append('accion', tipo);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();

        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitoso!',
                            type: 'success'
                        })
                        .then(resultado => {
                                if(resultado.value) {
                                   location.reload();
                                }
                            })
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosTXT);
    }
}

function getComboA(selectObject) {
    var value = selectObject.value;
    if (value == 'txt' ) {
        $('#txtDIV').show();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        console.log('VALOR TXT SELECCIONADO');
    }
    else if (value == 'txtc' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').show();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        console.log('VALOR TXTC SELECCIONADO');
    }
    else if (value == 'vacaciones' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').show();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        console.log('VALOR VACACIONES SELECCIONADO');
    }else if (value == 'panel-usuario' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').show();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').hide();
        var voboJefe = $('#vobojefe').text(),
            rowLine = $('td').text();

        var $rows = $('#example tr #vobo');
        $rows.each(function(i, item) {
            $this = $(item);
            if ( $this.text().trim() == 'Pendiente' ) {
                $this.addClass('bg-warning');
            }else if ( $this.text().trim() == 'Autorizado' ){
                $this.addClass('bg-success text-white');
            }else if ( $this.text().trim() == 'No Autorizado' ){
                $this.addClass('bg-danger text-white');
            }
        });

        // Activar POPOVER
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
        //EDITAR REGISTRO
        $(".btnEditar").click(function(){
          editarRegistros($(this));
        });

        // Borrar Registros
        $(".btnEliminar").click(function(){
          eliminarRegistros($(this));
        });



        console.log('VALOR PANEL SELECCIONADO');
    } else if (value == 'panel-personal' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').show();
        $('#defaultDIV').hide();

        // Activar POPOVER
        $(function () {
          $('[data-toggle="popover"]').popover()
        })

        $(".btnAutorizar, .btnNA").click(async function(){
            // console.log('Click');
            var tipo = 'voboJefe';
            if ($(this).hasClass('btnAutorizar')) {
                var idMovimiento = $(this).val(),
                    idempleado = $(this).data('idemp'),
                    observaciones_default = 'Autorizado',
                    status = 1;
                    $(".btnNA").addClass('btn-outline-danger')
                    $(".btnNA").removeClass('btn-danger')
                    $(this).addClass('btn-success');

            } else if($(this).hasClass('btnNA')) {
                var idMovimiento = $(this).val(),
                    idempleado = $(this).data('idemp'),
                    observaciones_default = 'No Autorizado',
                    status = 2;
                    $(".btnAutorizar").addClass('btn-outline-success')
                    $(".btnAutorizar").removeClass('btn-success')
                    $(this).addClass('btn-danger');
            }
            const {value: observaciones_jefe} = await swal({
              input: 'textarea',
              inputPlaceholder: 'Type your message here',
              inputValue: observaciones_default,
              showCancelButton: true
            })

            //OBSERVACIONES DEL JEFE
            if (observaciones_jefe) {
            swal(observaciones_jefe)
            var datosAutorizado = new FormData();
            datosAutorizado.append('id', idMovimiento);
            datosAutorizado.append('status', status);
            datosAutorizado.append('accion', tipo);
            datosAutorizado.append('idempleado', idempleado);
            datosAutorizado.append('observaciones_default', observaciones_jefe);

            // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
            var xmlhr = new XMLHttpRequest();
            //ABRIR LA CONEXION
            xmlhr.open('POST', 'inc/model/control.php', true);
            // VERIFICAR LA RESPUESTA DEL SERVICIO
            xmlhr.onload = function(){
                if (this.status === 200) {
                    var respuesta = JSON.parse(xmlhr.responseText);
                    // console.log(respuesta);
                    if (respuesta.estado === 'correcto') {
                        console.log(respuesta);
                    } else {
                        // Hubo un error
                        swal({
                            title: 'Error!',
                            text: 'Hubo un error',
                            type: 'error'
                        })
                    }
                }
            }
            // Enviar la petición
            xmlhr.send(datosAutorizado);
          }
        });


        console.log('VALOR PANEL PERSONAL SELECCIONADO');
    } else if (value == 'non' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').show();
        console.log('VALOR VACACIONES SELECCIONADO');
    }
}
//FUNCION EDITAR REGISTROS DEL EMPLEADO
async function editarRegistros(btnEditar){
  var idempleado = btnEditar.data('idemp'),
      idmov = btnEditar.data('mov'),
      horas_bd = btnEditar.data('horas'),
      accion = 'editar_incidencia';
      const {value: horas} = await swal({
      title: 'Modificar Horas',
      input: 'text',
      inputPlaceholder: 'Ingrese horas ej: 1.5 ',
      inputValue: horas_bd
      })

      if ( horas ) {
        var editar_registro = new FormData();
        editar_registro.append('horas',horas);
        editar_registro.append('idempleado',idempleado);
        editar_registro.append('idmov',idmov);
        editar_registro.append('accion',accion);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                if (respuesta.estado === 'correcto') {
                    var informacion = respuesta.informacion;
                    swal(
                      'Registro Actualizado!',
                      informacion,
                      'success'
                    )
                  //ACTUALIZAR LA HORAS EN LA TABLA
                  btnEditar.parent().parent().find(".row_hours b").text(horas);
                } else if (respuesta.estado === 'incorrecto') {
                  var informacion = respuesta.informacion;
                  swal(
                    'Registro no editado!',
                    informacion,
                    'info'
                  )
                } else {
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(editar_registro);

      } else{
        swal(
              'Error!',
              'Las horas no pueden ir vacias',
              'error'
            )
      }

}



//FUNCION ELIMINAR REGISTROS DE LA TABLA EMPLEADO
function eliminarRegistros(btnEliminar){
  var idempleado = btnEliminar.data('idemp'),
      idmov = btnEliminar.data('mov'),
      accion = 'eliminar_incidencia';
  swal({
  title: 'Eliminar incidencia',
  text: "El registro sera eliminado pa' siempre",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Simon!',
  cancelButtonText: 'Nel, mejor no!'
  }).then((result) => {
    if (result.value) {
      var eliminar_registro = new FormData();
      eliminar_registro.append('id_mov', idmov);
      eliminar_registro.append('accion', accion);
      // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
      var xmlhr = new XMLHttpRequest();
      //ABRIR LA CONEXION
      xmlhr.open('POST', 'inc/model/control.php', true);
      // VERIFICAR LA RESPUESTA DEL SERVICIO
      xmlhr.onload = function(){
          if (this.status === 200) {
              var respuesta = JSON.parse(xmlhr.responseText);
              // console.log(respuesta);
              if (respuesta.estado === 'correcto') {
                  var informacion = respuesta.informacion;
                  swal(
                    'Registro Eliminado!',
                    informacion,
                    'success'
                  )
                  btnEliminar.parents("tr").remove();
                  console.log(respuesta);
              } else if (respuesta.estado === 'incorrecto') {
                var informacion = respuesta.informacion;
                swal(
                  'Registro no eliminado!',
                  informacion,
                  'info'
                )
                console.log(respuesta);
              } else {
                  swal({
                      title: 'Error!',
                      text: 'Hubo un error',
                      type: 'error'
                  })
              }
          }
      }
      // Enviar la petición
      xmlhr.send(eliminar_registro);
    }
  })
}
