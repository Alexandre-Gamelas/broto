<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-tools"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Página Administrador</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tree"></i>
                <span>Geral</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
Base de Dados
</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-database"></i>
                <span>Tabelas</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="tabela_utilizadores.php">Utilizador</a>

                    <a class="collapse-item" href="tables3.php">Eventos</a>
                    <a class="collapse-item" href="tables_categorias.php">Categorias</a>
                    <a class="collapse-item" href="tabela_users_events.php">Utilizadores e Eventos</a>
                    <a class="collapse-item" href="tabela_users_categorias.php">Utilizadores e Categorias</a>
                    <a class="collapse-item" href="tables_galeria.php">Galeria de Fotos</a>
                    <a class="collapse-item" href="tables_cong.php">Extras</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link pt-0" href="eventos_sync.php"">
                <i class="fas fa-fw fa-sync"></i>
                <span>Sincronizar Eventos</span></a>
        </li>

    <li class="nav-item">
        <a class="nav-link pt-0" href="fotos_galeria_add.php">
        <i class="fas fa-fw fa-plus"></i>
        <span>Adicionar Fotos Galeria</span></a>
    </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>