<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMS – Canteen Inventory</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%2384934a'/>
    <text x='50' y='72' font-size='55' font-family='sans-serif' font-weight='900' text-anchor='middle' fill='white'>C</text></svg>">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #2e1a1a;
            --surface:  #3a2222;
            --surface2: #492828;
            --border:   #5e3535;
            --accent:   #84934a;
            --accent2:  #656d3f;
            --text:     #ececec;
            --muted:    #a89880;
            --danger:   #c0504a;
            --success:  #84934a;
        }

        body {
            font-family: 'Montserrat', sans-serif;
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
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: 1.3rem;
            color: var(--accent);
            letter-spacing: 3px;
            text-decoration: none;
            text-transform: uppercase;
        }

        .nav-brand span { color: var(--text); }

        .nav-links { display: flex; gap: 0.25rem; }

        .nav-links a {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s;
            letter-spacing: 1px;
            text-transform: uppercase;
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
            font-family: 'Montserrat', sans-serif;
            font-size: 1.85rem;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .page-title span { color: var(--accent); }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .btn-primary { background: var(--accent); color: #fff;  }
        .btn-primary:hover { background: var(--accent2); }

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
        .btn-danger:hover { background: var(--danger); color: #fff; }

        .btn-sm { padding: 0.4rem 0.85rem; font-size: 0.72rem; }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--surface2); }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .badge-green  { background: rgba(132,147,74,0.2);  color: #84934a; }
        .badge-yellow { background: rgba(101,109,63,0.25); color: #b5c278; }
        .badge-red    { background: rgba(192,80,74,0.2);   color: #c0504a; }

        .alert {
            padding: 0.875rem 1.25rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .alert-success { background: rgba(132,147,74,0.15); border: 1px solid rgba(132,147,74,0.4); color: #84934a; }
        .alert-error   { background: rgba(192,80,74,0.15);  border: 1px solid rgba(192,80,74,0.4);  color: #c0504a; }

        .form-group { margin-bottom: 1.75rem; }

        label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        input, select {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            color: var(--text);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.875rem;
            transition: border-color 0.2s;
            outline: none;
            height: 48px;
        }

        input:focus, select:focus { border-color: var(--accent); }
        select option { background: var(--surface2); color: var(--text); }

        .invalid-feedback { color: var(--danger); font-size: 0.78rem; margin-top: 0.35rem; font-weight: 600; }
        .is-invalid { border-color: var(--danger) !important; }

        .actions { display: flex; gap: 0.5rem; }

        .empty-state { text-align: center; padding: 4rem 2rem; color: var(--muted); }
        .empty-state h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 1px;
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
            border-radius: 10px;
            padding: 1.25rem;
            border-left: 4px solid var(--accent);
        }

        .stat-label {
            font-size: 0.65rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--accent);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.78rem;
            margin-bottom: 1.5rem;
            transition: color 0.2s;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .back-link:hover { color: var(--text); }

        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 2.5px;
            margin-bottom: 1rem;
            color: var(--muted);
            text-transform: uppercase;
        }

        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 2rem;
            max-width: 600px;
            margin: 0 auto;
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
        <a href="{{ route('products.index') }}" class="nav-brand">CIMS</a>
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
