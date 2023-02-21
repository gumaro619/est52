@extends('modTutor.plantillaTutor')

@section('title', 'FAQs')

@section('content')
    <div class="d-flex justify-content-center">
        <p class="fs-1">Preguntas y respuestas frecuentes</p>
    </div>
    
    <p class="fs-4"></p>
    <div class="alert alert-info" role="alert">
        Preguntas sólo visibles para tutores registrados
    </div>
    <br>
    
    <section id="acordeon">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            No es correcta alguna parte de mi información ¿Es posible cambiarla?
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Si bien usted puede actualizar información de contacto  solamente, Si existe un error en alguno de otros datos debe acudir personalmente a la institución a solicitar una correción de sus datos</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            No aparece  mi tutorado(a)
                        </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Si no aparece en la lista principal y sus datos están correctos debe acudir a  la institución a solicitar una revisión de sus datos</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            No aparecen las calificaciones de mi tutorado(a)
                        </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Las calificaciones parciales no pueden visualizarse hasta no terminar con el período ordinario de evaluación docente. Sin embargo en alumnos con status distintos a "activo" por razones justificadas al docente no le sea posible  reportar  dicha calificación</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('jscript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection