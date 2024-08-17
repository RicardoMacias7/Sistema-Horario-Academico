<?php include '../html/barra.php' ?>
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary ">
  <div class="h-screen flex-grow-1 overflow-y-lg-auto ">

    <header class="bg-surface-primary border-bottom pt-6">
      <div class="container-fluid">
        <div class="mb-npx">
          <div class="row align-items-center">
            <div class="col-sm-6 col-12 mb-4 mb-sm-4">
              <h1 class="h2 mb-0 ls-tight">Configuracion de la cuenta</h1>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main class="py-6 bg-surface-secondary rounded border border-primary p-3 ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-7 mx-auto">
            <div class="card shadow border-0 mt-4 mb-10">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <div class="d-flex align-items-center">
                      <a href="#" class="avatar avatar-lg bg-warning rounded-circle text-white">
                        <img alt="..."
                          src="https://images.unsplash.com/photo-1579463148228-138296ac3b98?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80">
                      </a>
                      <div class="ms-4">
                        <span class="h4 d-block mb-0">
                          <?php echo $nombreUsuario . " " . $apellidoUsuario; ?>
                        </span>
                        <a href="#" class="text-sm font-semibold text-muted">View Profile</a>
                      </div>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <button type="button" class="btn btn-sm btn-neutral">Upload</button>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'actualizado') {
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Excelente!</strong> Datos actulizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
            }
            ?>
            <?php
            if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'ErrorAlActualizado') {
              ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Datos no actulizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
            }
            ?>

            <?php
            if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'ErrorOtros') {
              ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Datos no actulizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
            }
            ?>
            <form class="mb-6" method="post" id="perfilForm">
              <div class="row mb-5">
                <div class="col-md-6">
                  <div class="">
                    <label class="form-label" for="first_name">Nombre</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                      value="<?php echo $nombreUsuario; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <label class="form-label" for="last_name">Apellido</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                      value="<?php echo $apellidoUsuario; ?>">
                  </div>
                </div>
              </div>
              <div class="row g-5">
                <div class="col-md-6">
                  <div class="">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                      value="<?php echo $emailUsuario; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <label class="form-label" for="phone_number">Telefono</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number"
                      value="<?php echo $telefonoUsuario; ?>">
                  </div>
                </div>
                <div class="col-6">
                  <div class="">
                    <label class="form-label" for="address">Direccion</label>
                    <input type="text" class="form-control" id="address" name="address"
                      value="<?php echo $direccionUsuario; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <label class="form-label" for="city">Ciudad</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $ciudadUsuario; ?>">
                  </div>
                </div>
                <div class="col-12">
                  <div class="text-end">
                    <button type="button" class="btn btn-sm btn-neutral me-2">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<?php include '../html/fin.php' ?>
