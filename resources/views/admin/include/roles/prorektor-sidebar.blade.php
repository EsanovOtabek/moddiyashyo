{{--   buyurtmalar--}}
<li class="nav-item">
    <a href="{{ route('prorektor.orders.index') }}" class="nav-link">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Buyurtmalar
        </p>
    </a>
</li>
{{--Binolar--}}
<li class="nav-item border-top border-primary">
    <a href="{{ route('prorektor.buildings.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Binolar
        </p>
    </a>
</li>

{{--Foydalanuvchilar--}}
<li class="nav-item">
    <a href="{{ route('prorektor.users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Foydalanuvchilar
        </p>
    </a>
</li>

{{--Jihozlar--}}
<li class="nav-item">
    <a href="{{ route('prorektor.items.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Jihozlar
        </p>
    </a>
</li>

{{--Kategoriyalar--}}
<li class="nav-item">
    <a href="{{ route('prorektor.categories.index') }}" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>
            Kategoriyalar
        </p>
    </a>
</li>
