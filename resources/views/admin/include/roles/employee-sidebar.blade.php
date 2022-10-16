<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Buyurtmalar
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.orders.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buyurtmalar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route(auth()->user()->role . '.orders.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buyurtma berish</p>
            </a>
        </li>
    </ul>
</li>

{{-- Bo'lim va Fakultetlar --}}
<li class="nav-item">
    <a href="{{ route(auth()->user()->role . '.sections.index') }}" class="nav-link">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <p>
            Bo'lim va Fakultetlar
        </p>
    </a>
</li>

