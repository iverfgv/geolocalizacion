@include('includes.header')

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <!-- Page-Title -->
                        <div class="row">
                         @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                          {{Session::get('message')}}
                        </div>
                        @endif
                            <div class="col-sm-12">
                                <h4 class="page-title">Dashboard </h4>
                                <ol class="breadcrumb">
                                    <li>
                                      Catalogos
                                  </li>
                                  <li>
                                      Perfiles
                                  </li>

                              </ol>
                          </div>
                      </div> 


                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA PERFILES</button>

                      <p class="text-muted m-b-30 font-13"></p>







                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">



                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Pesaje</th>
                                            <th>Supervisor</th>
                                            <th>Embarques</th>
                                            <th>Administracion</th>
                                            <th>Reportes</th>
                                            <th>Activo</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                               
                                    <tbody>
                                     @foreach($perfiles as $perfil)
                                    <tr id='{{ $perfil->id }}' data-perfil='{{ $perfil->perfil }}' data-pesaje='{{ $perfil->pesaje }}' data-supervisor='{{ $perfil->supervisor }}' data-embarques='{{ $perfil->embarques }}' data-administracion='{{ $perfil->administracion }}' data-reportes='{{ $perfil->reportes }}' data-activo='{{ $perfil->activo }}' >
                            
                                            <td>{{$perfil->perfil}}</td>
                                            @if($perfil->pesaje==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif                                          

                                             @if($perfil->supervisor==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif

                                             @if($perfil->embarques==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif

                                             @if($perfil->administracion==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif

                                             @if($perfil->reportes==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif

                                            @if($perfil->activo==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif
                                          

                                            <td class="editbtn">
                                             <span data-toggle="modal" data-target="#detalle-category">
                                                <i class="fa fa-file-text-o" data-toggle="tooltip" data-placement="top" title="Detalles " data-original-title="Tooltip on top"></i>
                                                </span>

                                                <span data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                </i>
                                                </span> 

                                                {!!link_to('perfiles/perfildel/'.$perfil->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
                                            </td>
                                        </tr>
                                       

                                    </tbody>
                                @endforeach
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- Termina Tabla -->
















                  </div>
              </div>
          </div>


      </div> <!-- container -->

  </div> <!-- content -->

</div><!-- content-page -->




<!-- Modal Alta --> 
{!!Form::open(['route'=>'perfil.store','method','POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> perfiles</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-12">
                    <label class="control-label">Perfil</label>
                    {!!Form::text('perfil','',['class'=>'form-control form-white','placeholder'=>'Nombre','required'])!!}
                        </div>
                        <div class="col-md-12">

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="pesaje">     
                                <label for="inlineCheckbox1"> Pesaje </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="supervisor">             
                                <label for="inlineCheckbox2"> Supervisor </label>
                            </div>


                            <div class="checkbox chkbx">
                                <input type="checkbox" name="embarques">            
                                <label for="inlineCheckbox3"> Embarques </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="administracion">                
                                <label for="inlineCheckbox4"> Administracion </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="reportes">              
                                <label for="inlineCheckbox5"> Reportes </label>
                            </div>

                        </div>




                        <div class="col-md-6">
                            <label class="control-label">Activo</label>
                           {!! Form::select('activo',array('si' => 'Si', 'no' => 'No'), null,['class'=>'form-control form-white']) !!}
                        </div>
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
               {!!Form::submit('guardar',['class'=>'btn btn-default'])!!}
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
<!-- /Modal Alta -->

<?php $id=1;?>
<!-- Modal Editar -->
{!!Form::open(['route'=>['perfil.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> perfiles</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                    {!!Form::hidden('id','',['id'=>'idtag','class'=>'form-control form-white','required'])!!}
                        <div class="col-md-12">
                            <label class="control-label">Perfil</label>
                            {!!Form::text('perfil','',['id'=>'perfiltag','class'=>'form-control form-white','required'])!!}
                            
                        </div>
                        <div class="col-md-12">

                            <div class="checkbox chkbx">
                                <input type="checkbox" id="idpesaje" name="pesaje" value="1">
                                <label for="inlineCheckbox1"> Pesaje </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="supervisor" id="idsupervisor" value="1">
                                <label for="inlineCheckbox2"> Supervisor </label>
                            </div>


                            <div class="checkbox chkbx">
                                <input type="checkbox" name="embarques" id="idembarques" value="1">
                                <label for="inlineCheckbox3"> Embarques </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="administracion" id="idadministracion" value="1">
                                <label for="inlineCheckbox4"> Administracion </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="reportes" id="idreportes" value="1">
                                <label for="inlineCheckbox5"> Reportes </label>
                            </div>

                        </div>




                        <div class="col-md-6">
                            <label class="control-label">Activo</label>
                            {!!Form::select('activo',array('1' => 'Si', '0' => 'No'),null,['id'=>'activotag','class'=>'form-control form-white','required'] )!!}                            
                        </div>
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
               {!!Form::submit('Guardar',['class'=>'btn btn-default'])!!}
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!} 
<!-- /Modal Editar -->

<!-- Modal Detalle -->
<div class="modal fade none-border" id="detalle-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Detalle</strong> perfil</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">ID: </label>
                            {!!Form::label('','',['id'=>'idlavel','class'=>'control-label']);!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Perfil: </label>
                            <label class="control-label" id="perfillavel"></label>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Pesaje: </label>
                            <label class="control-label" id="pesajelavel"></label>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Supervisor: </label>
                            <label class="control-label" id="supervisorlavel"></label>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Embarque: </label>
                            <label class="control-label" id="embarqueslavel"></label>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Administracion: </label>
                            <label class="control-label" id="administracionlavel"></label>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Reportes: </label>
                            <label class="control-label" id="reporteslavel"></label>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Activo: </label>
                            <label class="control-label" id="activolavel"></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Detalle -->

<script type="text/javascript">
         $("tr").click(function() {
                var id = $(this).attr("id");
                var perfil = $(this).attr("data-perfil");
                var pesaje= $(this).attr('data-pesaje'); 
                var supervisor=$(this).attr('data-supervisor');
                var embarques=$(this).attr('data-embarques');
                var administracion=$(this).attr('data-administracion');
                var reportes=$(this).attr('data-reportes');
                var activo=$(this).attr('data-activo');
            
                $('#idtag').val(id);              
                $('#perfiltag').val(perfil);
                $('#pesajetag').val(pesaje);
                $('#supervisortag').val(supervisor);
                $('#embarquestag').val(embarques);
                $('#administraciontag').val(administracion);
                $('#reportestag').val(reportes);
                $('#activotag').val(activo);

                 ///lavels
                $('#idlavel').text(id); 
                $('#perfillavel').text(perfil);
                if(pesaje==1){vpesaje="Activado";}else{vpesaje="No activado";}
                $('#pesajelavel').text(vpesaje);
                 if(supervisor==1){vsupervisor="Activado";}else{vsupervisor="No activado";}
                $('#supervisorlavel').text(vsupervisor);
                if(embarques==1){vembarques="Activado";}else{vembarques="No activado";}
                $('#embarqueslavel').text(vembarques);
                if(administracion==1){vadministracion="Activado";}else{vadministracion="No activado";}
                $('#administracionlavel').text(vadministracion);
                if(reportes==1){vreportes="Activado";}else{vreportes="No activado";}
                $('#reporteslavel').text(vreportes);
                if(activo==1){vactivo="Activado";}else{vactivo="No activado";}
                $('#activolavel').text(vactivo);


                if(pesaje==1){
                 document.getElementById('idpesaje').checked = true;
                }else{document.getElementById('idpesaje').checked = false;}

                if(supervisor==1){
                 document.getElementById('idsupervisor').checked = true;
                }else{document.getElementById('idsupervisor').checked = false;}

                if(embarques==1){
                 document.getElementById('idembarques').checked = true;
                }else{document.getElementById('idembarques').checked = false;}

                if(administracion==1){
                 document.getElementById('idadministracion').checked = true;
                }else{document.getElementById('idadministracion').checked = false;}

                if(reportes==1){
                 document.getElementById('idreportes').checked = true;
                }else{document.getElementById('idreportes').checked = false;}

                if(activo==1){
                 document.getElementById('idactivo').checked = true;
                }else{document.getElementById('idactivo').checked = false;}

        });
</script>

@include('includes.footer')