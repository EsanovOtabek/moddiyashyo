<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Binolar
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.buildings.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Binolar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.room.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Xona qo'shish</p>
            </a>
        </li>
    </ul>
</li>

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
            <a href="{{ route('komendant.orders.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buyurtmalar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('komendant.orders.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buyurtma berish</p>
            </a>
        </li>
    </ul>
</li>
