*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{

    --sidebar-width:260px;

    --bg:#f1f5f9;

    --sidebar:#020617;

    --card:#ffffffee;

    --primary:#2563eb;

    --secondary:#7c3aed;

    --accent:#06b6d4;

    --success:#10b981;

    --warning:#f59e0b;

    --danger:#ef4444;

    --text:#0f172a;

    --muted:#64748b;

    --border:#e2e8f0;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:
    'Inter',
    sans-serif;

    background:
    linear-gradient(
        135deg,
        #eef2ff 0%,
        #f8fafc 40%,
        #e0f2fe 100%
    );

    color:var(--text);

    overflow-x:hidden;
}

/*
|--------------------------------------------------------------------------
| SIDEBAR
|--------------------------------------------------------------------------
*/

.sidebar{

    position:fixed;

    top:0;
    left:0;

    width:var(--sidebar-width);

    height:100vh;

    background:
    linear-gradient(
        180deg,
        #020617,
        #0f172a
    );

    padding:2rem 1rem;

    z-index:999;

    box-shadow:
    10px 0 40px rgba(2,6,23,.35);

    display:flex;

    flex-direction:column;
}

.logo{

    color:white;

    font-size:2.4rem;

    font-weight:900;

    margin-bottom:3rem;

    letter-spacing:-1px;
}

.nav-links{

    display:flex;

    flex-direction:column;

    gap:.7rem;
}

.nav-links a{

    display:flex;

    align-items:center;

    gap:1rem;

    text-decoration:none;

    color:#cbd5e1;

    padding:1rem 1.2rem;

    border-radius:18px;

    transition:.3s ease;

    font-weight:600;
}

.nav-links a:hover{

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #7c3aed
    );

    color:white;

    transform:translateX(6px);

    box-shadow:
    0 10px 25px rgba(37,99,235,.35);
}

.nav-links a.active{

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #7c3aed
    );

    color:white;

    box-shadow:
    0 10px 30px rgba(124,58,237,.4);
}

.nav-links i{

    font-size:1.2rem;
}

/*
|--------------------------------------------------------------------------
| MAIN
|--------------------------------------------------------------------------
*/

.main{

    margin-left:var(--sidebar-width);

    min-height:100vh;

    padding:2rem;
}

/*
|--------------------------------------------------------------------------
| TOPBAR
|--------------------------------------------------------------------------
*/

.topbar{

    background:rgba(255,255,255,.7);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.4);

    padding:1rem 1.5rem;

    border-radius:24px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:2rem;

    box-shadow:
    0 10px 40px rgba(15,23,42,.06);
}

.search-box{

    background:white;

    border-radius:14px;

    padding:.9rem 1rem;

    width:340px;

    display:flex;

    align-items:center;

    gap:.8rem;

    border:1px solid var(--border);
}

.search-box input{

    border:none;

    outline:none;

    width:100%;

    font-size:1rem;

    background:transparent;
}

.profile{

    display:flex;

    align-items:center;

    gap:1rem;
}

.avatar{

    width:50px;
    height:50px;

    border-radius:50%;

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #7c3aed
    );

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

    font-weight:800;

    font-size:1.2rem;

    box-shadow:
    0 10px 25px rgba(124,58,237,.35);
}

/*
|--------------------------------------------------------------------------
| HERO
|--------------------------------------------------------------------------
*/

.hero{

    position:relative;

    overflow:hidden;

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #9333ea
    );

    border-radius:36px;

    padding:4rem;

    color:white;

    margin-bottom:2rem;

    box-shadow:
    0 30px 70px rgba(37,99,235,.25);
}

.hero::before{

    content:'';

    position:absolute;

    width:400px;
    height:400px;

    background:
    rgba(255,255,255,.08);

    border-radius:50%;

    top:-120px;
    right:-100px;
}

.hero h1{

    font-size:4rem;

    font-weight:900;

    line-height:1.05;

    margin-bottom:1rem;

    letter-spacing:-2px;

    position:relative;

    z-index:2;
}

.hero p{

    max-width:760px;

    font-size:1.35rem;

    line-height:1.7;

    opacity:.95;

    position:relative;

    z-index:2;
}

/*
|--------------------------------------------------------------------------
| KPI CARDS
|--------------------------------------------------------------------------
*/

.cards{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:1.5rem;

    margin-bottom:2rem;
}

.card{

    background:rgba(255,255,255,.75);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.5);

    border-radius:30px;

    padding:2rem;

    transition:.35s ease;

    box-shadow:
    0 20px 50px rgba(15,23,42,.06);
}

.card:hover{

    transform:
    translateY(-10px);

    box-shadow:
    0 30px 60px rgba(15,23,42,.12);
}

.card i{

    font-size:2.4rem;

    margin-bottom:1rem;

    color:#4f46e5;
}

.card h2{

    font-size:3rem;

    margin-bottom:.6rem;

    font-weight:900;
}

.card p{

    color:var(--muted);

    font-size:1rem;
}

/*
|--------------------------------------------------------------------------
| CHARTS
|--------------------------------------------------------------------------
*/

.charts{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(420px,1fr));

    gap:1.5rem;

    margin-bottom:2rem;
}

.chart-card{

    background:rgba(255,255,255,.8);

    backdrop-filter:blur(20px);

    border-radius:32px;

    padding:2rem;

    box-shadow:
    0 20px 50px rgba(15,23,42,.06);

    min-height:420px;
}

.chart-card h3{

    margin-bottom:1.5rem;

    font-size:1.5rem;
}

.chart-container{

    position:relative;

    width:100%;

    height:320px;
}

/*
|--------------------------------------------------------------------------
| TABLE
|--------------------------------------------------------------------------
*/

.table-card{

    background:rgba(255,255,255,.8);

    backdrop-filter:blur(20px);

    border-radius:32px;

    padding:2rem;

    box-shadow:
    0 20px 50px rgba(15,23,42,.06);
}

.table-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:1.5rem;
}

.btn-primary{

    border:none;

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #7c3aed
    );

    color:white;

    padding:.9rem 1.5rem;

    border-radius:14px;

    font-weight:700;

    cursor:pointer;

    transition:.3s;
}

.btn-primary:hover{

    transform:translateY(-2px);

    box-shadow:
    0 10px 25px rgba(124,58,237,.3);
}

table{

    width:100%;

    border-collapse:collapse;
}

table thead{

    background:#f8fafc;
}

table th{

    text-align:left;

    padding:1rem;

    color:#334155;
}

table td{

    padding:1rem;

    border-top:1px solid #eef2f7;
}

.status{

    padding:.4rem .8rem;

    border-radius:999px;

    font-size:.8rem;

    font-weight:700;

    color:white;
}

.active-status{

    background:#16a34a;
}

.pending-status{

    background:#eab308;

    color:#111827;
}

/*
|--------------------------------------------------------------------------
| FOOTER
|--------------------------------------------------------------------------
*/

.footer{

    text-align:center;

    margin-top:2rem;

    color:#64748b;

    padding:2rem 0;
}

/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media(max-width:1100px){

    .charts{

        grid-template-columns:1fr;
    }

    .hero h1{

        font-size:3rem;
    }
}

@media(max-width:900px){

    .sidebar{

        width:90px;
    }

    .sidebar .logo{

        font-size:1.5rem;
    }

    .sidebar a span{

        display:none;
    }

    .main{

        margin-left:90px;
    }

    .hero{

        padding:2rem;
    }

    .hero h1{

        font-size:2.5rem;
    }
}

@media(max-width:700px){

    .topbar{

        flex-direction:column;

        gap:1rem;
    }

    .search-box{

        width:100%;
    }

    .charts{

        grid-template-columns:1fr;
    }
}

| /*                                                                         |
| -------------------------------------------------------------------------- |
| GLASS EFFECT                                                               |
| -------------------------------------------------------------------------- |
| */                                                                         |

.glass{
background:rgba(255,255,255,.7);
backdrop-filter:blur(18px);
-webkit-backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,.25);
}

| /*                                                                         |
| -------------------------------------------------------------------------- |
| PREMIUM SHADOWS                                                            |
| -------------------------------------------------------------------------- |
| */                                                                         |

.shadow-premium{
box-shadow:
0 10px 30px rgba(15,23,42,.08),
0 20px 60px rgba(15,23,42,.05);
}

| /*                                                                         |
| -------------------------------------------------------------------------- |
| HOVER EFFECTS                                                              |
| -------------------------------------------------------------------------- |
| */                                                                         |

.hover-lift{
transition:.35s ease;
}

.hover-lift:hover{
transform:translateY(-8px);
box-shadow:
0 20px 40px rgba(37,99,235,.12);
}

| /*                                                                         |
| -------------------------------------------------------------------------- |
| ANIMATIONS                                                                 |
| -------------------------------------------------------------------------- |
| */                                                                         |

.fade-up{
animation:fadeUp .7s ease;
}

@keyframes fadeUp{

```
from{
    opacity:0;
    transform:translateY(20px);
}

to{
    opacity:1;
    transform:translateY(0);
}
```

}

