<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                Modulos
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Catalogos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Productos</a>
                    </li>
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Colores</a>
                    </li>
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Estampados</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Series</a>
                    </li>
                    <li @click="menu=6" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>UnidadMedidas</a>
                    </li>
                </ul>
            </li>

            <li @click="menu=4" class="nav-item">
                <a class="nav-link active" href="#"><i class="fa fa-archive fa-lg"></i> Inventario</a>
            </li>
            <li @click="menu=8" class="nav-item">
                <a class="nav-link active" href="#"><i class="fa fa-shopping-basket fa-lg"></i> Facturacion</a>
            </li>
            <li @click="menu=9" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-rocket"></i> Delivery</a>
            </li>
            <li @click="menu=10" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-plane"></i> Compras</a>
            </li>
            <li @click="menu=11" class="nav-item">
                <a class="nav-link active" href="#"><i class="fa fa-money fa-lg"></i> Contabilidad</a>
            </li>
            <li @click="menu=12" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-rocket"></i> Cuentas por cobrar</a>
            </li>
            <li @click="menu=13" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-rocket"></i> Tesoreria</a>
            </li>
            <li @click="menu=14" class="nav-item">
                <a class="nav-link active" href="#"><i class="fa fa-user-md fa-lg"></i> Recursos Humanos</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=15" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Ventas</a>
                    </li>
                    <li @click="menu=16" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i> Clientes</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=17" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                    </li>
                    <li @click="menu=18" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                    </li>
                </ul>
            </li>
            <li @click="menu=19" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte</a>
            </li>

            <li @click="menu=20" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li @click="menu=21" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>