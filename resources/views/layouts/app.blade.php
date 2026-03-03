<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMS – Canteen Inventory</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #1b211a;
            --surface:  #222b20;
            --surface2: #2a3527;
            --border:   #3a4a35;
            --accent:   #8bae66;
            --accent2:  #62813b;
            --text:     #ebd5ab;
            --muted:    #7a9060;
            --danger:   #c0604a;
            --success:  #8bae66;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--accent);
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .nav-brand span { color: var(--text); }

        .nav-links { display: flex; gap: 0.25rem; }

        .nav-links a {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--text);
            background: var(--surface2);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .page-title span { color: var(--accent); }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary { background: var(--accent); color: #1b211a; }
        .btn-primary:hover { background: #9dc275; }

        .btn-secondary {
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover { border-color: var(--muted); }

        .btn-danger {
            background: transparent;
            color: var(--danger);
            border: 1px solid var(--danger);
        }
        .btn-danger:hover { background: var(--danger); color: var(--text); }

        .btn-sm { padding: 0.4rem 0.85rem; font-size: 0.8rem; }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--surface2); }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-green  { background: rgba(139,174,102,0.2); color: #8bae66; }
        .badge-yellow { background: rgba(235,213,171,0.15); color: #ebd5ab; }
        .badge-red    { background: rgba(192,96,74,0.2); color: #c0604a; }

        .alert {
            padding: 0.875rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .alert-success { background: rgba(139,174,102,0.15); border: 1px solid rgba(139,174,102,0.4); color: #8bae66; }
        .alert-error   { background: rgba(192,96,74,0.15); border: 1px solid rgba(192,96,74,0.4); color: #c0604a; }

        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        input, select {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            transition: border-color 0.2s;
            outline: none;
        }

        input:focus, select:focus { border-color: var(--accent); }
        select option { background: var(--surface2); color: var(--text); }

        .invalid-feedback { color: var(--danger); font-size: 0.8rem; margin-top: 0.35rem; }
        .is-invalid { border-color: var(--danger) !important; }

        .actions { display: flex; gap: 0.5rem; }

        .empty-state { text-align: center; padding: 4rem 2rem; color: var(--muted); }
        .empty-state h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
        }

        .stat-label { font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
        .stat-value { font-family: 'Syne', sans-serif; font-size: 1.75rem; font-weight: 800; color: var(--accent); }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--text); }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin-bottom: 1rem;
            color: var(--muted);
            text-transform: uppercase;
        }

        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            max-width: 600px;
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('products.index') }}" class="nav-brand">CIMS<span>.</span></a>
        <div class="nav-links">
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a>
            <a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">Suppliers</a>
            <a href="{{ route('stock_entries.create') }}" class="{{ request()->routeIs('stock_entries.*') ? 'active' : '' }}">Stock Entry</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">&#10003; {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">&#10007; {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
