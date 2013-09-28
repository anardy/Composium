@layout('template.administrador')

@section('title')
- Usuários
@endsection

@section('otherscss')
{{ HTML::style('css/galery.css') }}
@endsection

@section('conteudo')

<div class="span12">
    <h3>Galeria de Fotos</h3>
    <div class="row-fluid">  
<div class="gallery">
<div class="gallery-wrapper">
                <div class="row gallery-row">
                    <!-- single image -->
                    <div class="span3 img-container">
                        <div class="img-box">
                                                        <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="icon-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="icon-trash"></i>
                            </span>
                            <img src="../../../../fotos/DSC05229.jpg" class="img-responsive" />
                        </div>
                    </div>
                    <!-- single image -->
                    <div class="span3 img-container">
                        <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="icon-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="icon-trash"></i>
                            </span>
                            <img src="../../../../fotos/DSC05230.jpg" class="img-responsive" />
                        </div>
                    </div>
                                    <div class="col-md-3 new-img">
                        <a data-toggle="modal" href="#myModal">
                            <img src="../../../../img/new-gallery.png" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
</div>
</div>
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){        
    $('#dashboard-menu>li').removeClass('active');
    $("#1D").toggleClass('active');
});
</script>
@endsection