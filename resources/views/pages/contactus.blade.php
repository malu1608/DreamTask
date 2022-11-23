@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<main id="content" role="main">
    <div class="container space-top-2 space-bottom-2">
      <div class="text-center" id=contactos>
          <h1>Os nossos contactos</h1>
          <p>Estamos sempre interessados em esclarecer qualquer situação que necessites.</p>
      

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <span class="d-block h5 mb-1">Email geral</span>
                <span class="d-block text-body font-size-1">geral@dreamtask.pt</span>
              </div>

              <div class="mb-3">
                <span class="d-block h5 mb-1">Outros contactos</span>
                <span class="d-block text-body font-size-1">bruno.mota@dreamtask.pt</span>
                <span class="d-block text-body font-size-1">weslley.vieira@dreamtask.pt</span>
              </div>
            
              <div class="mb-3">
                <span class="d-block h5 mb-1">Localização</span>
                <span class="d-block text-body font-size-1">Faculdade de Engenharia da Universidade do Porto, FEUP, R. Dr. Roberto Frias, 4200-465 Porto, Portugal</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="ml-lg-5">
            <h2 class="mb-4">Razões para nos contactares</h2>
                            <div class="media mb-4">
                              <span class="icon icon-xs icon-soft-primary icon-circle mr-3">
                                <i class="fas fa-check"></i>
                              </span>
                              <div class="media-body text-dark">
                                Dificuldades técnicas
                              </div>
                            </div>
                            <div class="media mb-4">
                              <span class="icon icon-xs icon-soft-primary icon-circle mr-3">
                                <i class="fas fa-check"></i>
                              </span>
                              <div class="media-body text-dark">
                                Bugs e erros
                              </div>
                            </div>
                            <div class="media mb-4">
                              <span class="icon icon-xs icon-soft-primary icon-circle mr-3">
                                <i class="fas fa-check"></i>
                              </span>
                              <div class="media-body text-dark">
                                Informações incorretas ou desatualizadas na plataforma
                              </div>
                            </div>
                            <div class="media mb-4">
                              <span class="icon icon-xs icon-soft-primary icon-circle mr-3">
                                <i class="fas fa-check"></i>
                              </span>
                              <div class="media-body text-dark">
                                Mais informações sobre o projeto
                              </div>
                            </div>
          </div>
        </div>
      </div>
</div>
  </main>
@endsection