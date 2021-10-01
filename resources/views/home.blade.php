@extends('layouts.nav')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide base-height-carousel" data-bs-ride="carousel" >
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/images/reunion.png" class="d-block w-100" alt="Not found" height="500">
    </div>
    <div class="carousel-item">
      <img src="/images/tecnologia.png" class="d-block w-100" alt="Not found" height="500">
    </div>
    <div class="carousel-item">
      <img src="/images/instalaciones.png" class="d-block w-100" alt="Not found" height="500">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>
<div class="container">
    <h4 style="text-align: center">
        Somos un sitio web que busca facilitar la accesibilidad a empresas y clientes de todo el mundo, 
        contamos con un amplio repertorio de empresas en diferentes lugares del mundo, permítenos 
        formar parte de ti en la busqueda de un mejor futuro.
    </h4>
</div>

@endsection
