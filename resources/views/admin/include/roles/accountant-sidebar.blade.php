{{--   buyurtmalar--}}
<li class="nav-item">
    <a href="{{ route('accountant.orders.index') }}" class="nav-link">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Buyurtmalar
        </p>
    </a>
</li>
{{--Binolar--}}
<li class="nav-item border-top border-primary">
    <a href="{{ route('accountant.buildings.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Binolar
        </p>
    </a>
</li>

{{--Foydalanuvchilar--}}
<li class="nav-item">
    <a href="{{ route('accountant.users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Foydalanuvchilar
        </p>
    </a>
</li>

{{--Jihozlar--}}
<li class="nav-item">
    <a href="{{ route('accountant.items.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Jihozlar
        </p>
    </a>
</li>

