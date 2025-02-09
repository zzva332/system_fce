<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCE - @yield('title')</title>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/sidebar.css" />
</head>

<body>
    <div class="d-flex">
        <nav id="sidebar" class="expand">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <img src="/images/logo-white.png"  width="32px" />
                </button>
                <div class="sidebar-logo">
                    <a href="{{ route('dashboard') }}">System FCE</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-house-door"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#facturacion" aria-expanded="false" aria-controls="facturacion">
                        <i class="bi bi-calculator-fill"></i>
                        <span>Facturacion</span>
                    </a>
                    <ul id="facturacion" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('invoices.index') }}" class="sidebar-link"><i class="bi bi-list"></i> Todos</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('invoices.create') }}" class="sidebar-link"><i class="bi bi-plus-square"></i> Crear</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#inventario" aria-expanded="false" aria-controls="inventario">
                        <i class="bi bi-box"></i>
                        <span>Inventarios</span>
                    </a>
                    <ul id="inventario" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('inventories.index') }}" class="sidebar-link"><i class="bi bi-list"></i> Todos</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('inventories.create') }}" class="sidebar-link"><i class="bi bi-plus-square"></i> Crear</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#productos" aria-expanded="false" aria-controls="productos">
                        <i class="bi bi-box2"></i>
                        <span>productos</span>
                    </a>
                    <ul id="productos" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('products.index') }}" class="sidebar-link"><i class="bi bi-list"></i> Todos</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('products.create') }}" class="sidebar-link"><i class="bi bi-plus-square"></i> Crear</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('clients.index') }}" class="sidebar-link">
                        <i class="bi bi-people"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('users.index') }}" class="sidebar-link">
                        <i class="bi bi-person-fill"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="{{ route('logout') }}" class="sidebar-link">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>
        <main>
            <header class="d-block text-end">
                <img src="https://www.fdd.cl/wp-content/uploads/2017/09/Test.jpg" width="45px" />
            </header>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>