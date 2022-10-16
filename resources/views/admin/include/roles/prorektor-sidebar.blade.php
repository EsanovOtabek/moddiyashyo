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
<li class="nav-item border-top border-primary">
    <a href="{{ route(auth()->user()->role . '.buildings.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Binolar
        </p>
    </a>
</li>

{{--Foydalanuvchilar--}}
<li class="nav-item">
    <a href="{{ route(auth()->user()->role . '.users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Foydalanuvchilar
        </p>
    </a>
</li>

{{--Jihozlar--}}
<li class="nav-item">
    <a href="{{ route(auth()->user()->role . '.items.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Jihozlar
        </p>
    </a>
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
