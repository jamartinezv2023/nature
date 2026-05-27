<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURESaaS - Crear HPI Única</title>
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

    <div class="mb-6">
        <a href="//dashboard" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-all">
            <i class="fa-solid fa-arrow-left"></i> Volver al Dashboard
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
        <div class="bg-slate-900 p-8 text-white">
            <span class="bg-emerald-500/10 text-emerald-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-emerald-500/20">Fase 1: Interoperabilidad Core</span>
            <h1 class="heading-font text-2xl font-extrabold mt-3">Registro de Historia Pedagógica Interoperable (HPI)</h1>
            <p class="text-slate-400 text-sm mt-1">Alta única de estudiantes con persistencia de hoja de vida transferible.</p>
        </div>

        <form id="hpiForm" class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Tipo de Documento</label>
                    <select name="tipo_documento" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required>
                        <option value="TI">Tarjeta de Identidad (TI)</option>
                        <option value="CC">Cédula de Ciudadanía (CC)</option>
                        <option value="RC">Registro Civil (RC)</option>
                        <option value="NES">Número de Identificación Establecido (NES)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Número de Documento</label>
                    <input type="text" name="numero_documento" placeholder="Ej. 1045XXXXXX" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Nombre Completo del Estudiante</label>
                <input type="text" name="nombre_completo" placeholder="Ej. Juan Carlos Pérez Martínez" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all" required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Alertas Pedagógicas o Médicas Iniciales (JSON Meta)</label>
                <textarea name="alertas_iniciales" rows="3" placeholder="Indique si el alumno presenta discapacidades o condiciones de atención prioritaria para activar el módulo PIAR automáticamente..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-emerald-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-500/20 hover:bg-emerald-600 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-id-card"></i> Generar Registro HPI Único
                </button>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.getElementById('hpiForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('hpi-procesar.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Toastify({
                        text: "🎉 " + data.message + " UUID: " + data.uuid_generado.substring(0,8) + "...",
                        duration: 5000,
                        style: { background: "linear-gradient(to right, #10b981, #059669)", borderRadius: "12px" }
                    }).showToast();
                    document.getElementById('hpiForm').reset();
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
                    text: "💥 Error crítico de comunicación con el servidor.",
                    duration: 4000,
                    style: { background: "linear-gradient(to right, #f43f5e, #e11d48)", borderRadius: "12px" }
                }).showToast();
            });
        });
    </script>
</body>
</html>
