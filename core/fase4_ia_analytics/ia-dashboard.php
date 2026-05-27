<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURESaaS - Inteligencia de Datos</title>
    <script src="https://cdn.tailwindcss.com/3.4.15"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="p-8 max-w-4xl mx-auto">

    <div class="mb-6 flex justify-between items-center">
        <a href="//dashboard" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-all">
            <i class="fa-solid fa-arrow-left"></i> Volver al Core Principal
        </a>
        <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full border border-purple-200">
            <i class="fa-solid fa-brain"></i> Motor IA Activo
        </span>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-slate-900 to-purple-950 p-8 text-white">
            <span class="bg-purple-500/20 text-purple-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-purple-500/30">Fase 4: Modelos Predictivos</span>
            <h1 class="heading-font text-2xl font-extrabold mt-3">Módulo de Analítica Avanzada y Alertas Tempranas</h1>
            <p class="text-slate-400 text-sm mt-1">Evaluación de riesgos institucionales cruzando datos históricos de HPI, PIAR y Asignaturas.</p>
        </div>

        <div class="p-8 space-y-6">
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-200/60">
                <div>
                    <h3 class="font-bold text-slate-900 text-base">Análisis de Deserción Escolar</h3>
                    <p class="text-slate-500 text-xs mt-0.5">Estudiante Consultando: <strong>Juan Carlos Pérez Martínez (ID: 42)</strong></p>
                </div>
                <button id="btnAnalizar" class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs uppercase tracking-wide px-5 py-3 rounded-xl shadow-md shadow-purple-600/10 transition-all">
                    <i class="fa-solid fa-wand-magic-sparkles mr-1"></i> Ejecutar Inferencia
                </button>
            </div>

            <div id="resultadoIA" class="hidden space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl border border-rose-100 bg-rose-50/30 flex flex-col justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Probabilidad de Deserción</span>
                        <div class="mt-4">
                            <h4 id="txtPorcentaje" class="text-4xl font-extrabold text-rose-600 tracking-tight">0%</h4>
                            <p id="txtNivel" class="text-xs font-semibold text-rose-700 bg-rose-100/60 px-2 py-0.5 rounded-md inline-block mt-2">Nivel</p>
                        </div>
                    </div>
                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50 flex flex-col justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Engine Status</span>
                        <div class="mt-4">
                            <h4 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span> 
                                Microservicio Conectado
                            </h4>
                            <p id="txtVersion" class="text-[11px] font-mono text-slate-400 mt-2">v0.0.0</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-2xl border border-purple-100 bg-purple-50/20">
                    <h4 class="heading-font font-bold text-purple-900 text-sm flex items-center gap-2 mb-3">
                        <i class="fa-solid fa-lightbulb text-amber-500"></i> Recomendaciones sugeridas por el Core de IA
                    </h4>
                    <ul id="listaRecomendaciones" class="space-y-2 text-sm text-slate-600 font-medium list-disc pl-5">
                        </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btnAnalizar').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-1"></i> Calculando...';
            
            fetch('ia-conector.php?estudiante_id=42')
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        document.getElementById('txtPorcentaje').innerText = data.analisis.probabilidad_desercion_porcentaje + "%";
                        document.getElementById('txtNivel').innerText = data.analisis.alerta_temprana_nivel;
                        document.getElementById('txtVersion').innerText = "Engine: " + data.modelo_version;
                        
                        const lista = document.getElementById('listaRecomendaciones');
                        lista.innerHTML = "";
                        data.recomendaciones_ia.forEach(rec => {
                            let li = document.createElement('li');
                            li.innerText = rec;
                            lista.appendChild(li);
                        });
                        
                        document.getElementById('resultadoIA').classList.remove('hidden');
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles mr-1"></i> Re-ejecutar Inferencia';
                });
        });
    </script>
</body>
</html>
