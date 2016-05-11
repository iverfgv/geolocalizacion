@include('includes.header')
<?php $date = date('Y-m-d'); ?>
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
                                      Tipos de empresas
                                  </li>

                              </ol>
                          </div>
                      </div>
                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA TIPO EMPRESAS</button>

                      <p class="text-muted m-b-30 font-13"></p>

                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipo empresa</th>
                                            <th>Cliente</th>
                                            <th>Proveedor</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($tipoempresa as $tipo)
                                     
                                           <tr id='{{ $tipo->id }}' data-tipo='{{ $tipo->tipoempresa }}' data-cliente='{{ $tipo->cliente }}' data-provedor='{{ $tipo->proveedor }}'>

                                            <td>{{ $tipo->id }}</td>
                                            <td>{{ $tipo->tipoempresa }}</td>
                                            @if($tipo->cliente==1)
                                            <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                            <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif
                                            @if($tipo->proveedor==1)
                                            <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                            <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif
                                          
                                          

                                            <td class="editbtn">

                                                <span data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                    </i>
                                                </span> 

                                               {!!link_to('tipoempresa/tipoempresadel/'.$tipo->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                   <div style="text-align: right;">{{$tipoempresa->render()}}</div>
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
{!!Form::open(['route'=>'tipoempresa.store','method'=>'POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> Tipo empresas</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                         <div class="col-md-12">
                            <label class="control-label">Tipo de empresa</label>
                           {!!Form::text('tipoemp','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox chkbx">
                                <input type="checkbox" name="cliente">     
                                <label for="inlineCheckbox1"> Cliente </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="proveedor">             
                                <label for="inlineCheckbox2"> Proveedor </label>
                            </div>
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
<!-- /Modal Alta -->

<?php $id=1;?>
<!-- Modal editar -->
{!!Form::open(['route'=>['tipoempresa.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> Tipo de empresa </h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                    <div class="col-md-6">
                            <label class="control-label">Id</label>
                           {!!Form::text('id','',['id'=>'idtag','class'=>'form-control form-white','disabled'])!!}
                           <input type="hidden" name="id" id="idtag2">
                        </div>
                         <div class="col-md-12">
                            <label class="control-label">Tipo de empresa</label>
                           {!!Form::text('tipoempresa','',['id'=>'tipotag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox chkbx">
                                <input type="checkbox" name="cliente" id="clientetag" value="1">     
                                <label for="inlineCheckbox1" > Cliente </label>
                            </div>

                            <div class="checkbox chkbx">
                                <input type="checkbox" name="proveedor" id="provetag" value="1">          
                                <label for="inlineCheckbox2" > Proveedor </label>
                        </div>                          
               
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



@include('includes.footer')

<script type="text/javascript">
         $("tr").click(function() {
                var ID = $(this).attr("id");
                var tipo= $(this).attr('data-tipo'); 
                var provedor=$(this).attr('data-provedor');
                var cliente=$(this).attr('data-cliente');
                
                $('#idtag').val(ID);
                $('#idtag2').val(ID);
                $('#tipotag').val(tipo);
               
                if(provedor==1)
                {document.getElementById('provetag').checked = true;
                }else{document.getElementById('provetag').checked = false;
                    }
                if(cliente==1)
                {document.getElementById('clientetag').checked = true;
                }else{document.getElementById('clientetag').checked = false;}

               
        });
</script>