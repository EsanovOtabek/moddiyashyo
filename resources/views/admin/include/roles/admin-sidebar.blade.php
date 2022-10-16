{{--   buyurtmalar--}}
<li class="nav-item">
    <a href="{{ route(auth()->user()->role . '.orders.index') }}" class="nav-link">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Buyurtmalar
        </p>
    </a>
</li>

{{--Binolar--}}
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
            <a href="{{ route(auth()->user()->role . '.buildings.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bino qo'shish</p>
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

{{--Foydalanuvchilar--}}
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Foydalanuvchilar
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Foydalanuvchilar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.users.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Foydalanuvchi qo'shish</p>
            </a>
        </li>
    </ul>
</li>

{{--Jihozlar--}}
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Jihozlar
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.items.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jihozlar</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(auth()->user()->role . '.item.add') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jihoz qo'shish</p>
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

{{--Kategoriyalar--}}
<li class="nav-item">
    <a href="{{ route(auth()->user()->role . '.categories.index') }}" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>
            Kategoriyalar
        </p>
    </a>
</li>

{{--Foydalanuvchi rollari--}}
<li class="nav-item">
    <a href="{{ route(auth()->user()->role . '.roles.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user-circle"></i>
        <p>
            Foydalanuvchi rollari
        </p>
    </a>
</li>
