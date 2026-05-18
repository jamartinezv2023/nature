<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

// Simulación de planes curriculares existentes del docente (Fase 1)
$planes_docente_mock = [
    ['id' => 101, 'asignatura' => 'Ciencias Naturales - Grado 7º', 'tema' => 'Ecosistemas Locales'],
    ['id' => 102, 'asignatura' => 'Química - Grado 10º', 'tema' => 'Reacciones y Contaminación'],
    ['id' => 103, 'asignatura' => 'Sociales - Grado 9º', 'tema' => 'Desarrollo Sostenible y Comunidad']
];
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURESaaS - Gestión Ambiental Transversal</title>
    <script src="https://cdn.tailwindcss.com/3.4.15"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .heading-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="p-8 max-w-3xl mx-auto">

    <div class="mb-6 flex justify-between items-center">
        <a href="/dashboard.php" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-all">
            <i class="fa-solid fa-arrow-left"></i> Panel Principal
        </a>
        <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">
            <i class="fa-solid fa-leaf"></i> Componente Transversal PRAE
        </span>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
        
        <div class="bg-gradient-to-r from-slate-900 to-emerald-950 p-8 text-white">
            <span class="bg-emerald-500/20 text-emerald-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-emerald-500/30">Fase 3: Evidencias Ecológicas</span>
            <h1 class="heading-font text-2xl font-extrabold mt-3">Repositorio Transversal de Evidencias Ambientales</h1>
            <p class="text-slate-400 text-sm mt-1">Indexación institucional y carga documental integrada a las asignaturas obligatorias.</p>
        </div>

        <form id="ambientalForm" class="p-8 space-y-6" enctype="multipart/form-data">
            
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Asociar a Plan de Aula / Asignatura</label>
                <select name="plan_id" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required>
                    <option value="">Seleccione el espacio curricular donde se generó la evidencia...</option>
                    <?php foreach ($planes_docente_mock as $plan): ?>
                        <option value="<?= $plan['id']; ?>"><?= $plan['asignatura'] . " (" . $plan['tema'] . ")"; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Eje Temático Ambiental</label>
                    <select name="eje_tematico" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required>
                        <option value="BIODIVERSIDAD">Biodiversidad y Conservación</option>
                        <option value="RESIDUOS">Gestión Integral de Residuos (Reciclaje)</option>
                        <option value="AGUA_ENERGIA">Uso Eficiente del Agua y Energía</option>
                        <option value="CAMBIO_CLIMATICO">Mitigación del Cambio Climático</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Documento / Evidencia Digital</label>
                    <input type="file" name="evidencia_archivo" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-slate-200 rounded-xl p-1.5 bg-slate-50 transition-all" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Descripción Pedagógica del Impacto Logrado</label>
                <textarea name="descripcion_actividad" rows="4" placeholder="Ej: Los estudiantes diseñaron prototipos de compostaje doméstico aplicando conceptos de descomposición orgánica evaluados en el periodo..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required></textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Custodiar Evidencia Transversal
                </button>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.getElementById('ambientalForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('ambiental-procesar.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Toastify({
                        text: "🍃 " + data.message,
                        duration: 5000,
                        style: { background: "linear-gradient(to right, #059669, #10b981)", borderRadius: "12px" }
                    }).showToast();
                    document.getElementById('ambientalForm').reset();
                } else {
                    Toastify({
                        text: "❌ Error: " + data.message,
                        duration: 4000,
                        style: { background: "linear-gradient(to right, #f43f5e, #e11d48)", borderRadius: "12px" }
                    }).showToast();
                }
            })
            .catch(() => {
                Toastify({
                    text: "💥 Falla en el servidor de archivos o almacenamiento.",
                    duration: 4000,
                    style: { background: "linear-gradient(to right, #f43f5e, #e11d48)", borderRadius: "12px" }
                }).showToast();
            });
        });
    </script>
</body>
</html>
