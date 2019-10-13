 <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">E-Doctor</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?echo base_url('index.php/Events')?>">Agenda</a></li>
              <li><a href="#">Soporte</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administración <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Configurar Centro</a></li>
                  <li><a href="#">Agregar profesional</a></li>
                </ul>
              </li>
            </ul>
          
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" id="autocomplete" type="search" placeholder="Buscar apellido paciente" aria-label="Search">
            </form>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <?php
        if(!($this->session->userdata('user') == true)){
             echo "Sesion expirada";
             redirect(base_url(),'refresh');
          }
      ?>

  <div style="width: max;">
    <div style="width: 150px;float:right;">
      <a href="<?php echo base_url('index.php/Home/logout'); ?>" class="logout">Cerrar sesión <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    </div>

      <div style="width: 300px;float:right;">
      <p class="fuente"><?php echo $this->session->userdata('user'); ?></p>
    </div>
  </div>