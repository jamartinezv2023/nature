Característica: Gestión de Planes Individuales de Ajustes Razonables (PIAR)
  Como Docente de Apoyo Pedagógico
  Quiero registrar y actualizar el PIAR de un estudiante de manera local
  Para asegurar la continuidad del servicio educativo en condiciones de baja conectividad.

  Escenario: Registro exitoso de un PIAR en almacenamiento local durante estado offline
    Dado que el sistema detecta un estado de red "Sin Conectividad"
    Y la Docente de Apoyo Pedagógico ha autenticado su sesión en el Tenant institucional
    Cuando la Docente de Apoyo Pedagógico guarda el formulario del PIAR del estudiante con los ajustes curriculares obligatorios
    Entonces el sistema debe almacenar el registro en la base de datos local del dispositivo
    Y el sistema debe asignar al registro el estado "Pendiente de Sincronización"
    Y el sistema debe presentar un aviso de guardado local exitoso.

  Escenario: Sincronización automática de datos al recuperar acceso a la red
    Dado que el sistema registra un PIAR con el estado "Pendiente de Sincronización"
    Cuando el sistema detecta un estado de red "Con Conectividad"
    Entonces el sistema debe transmitir el PIAR al servidor centralizado del SaaS
    Y el sistema debe actualizar el estado del registro local a "Sincronizado"
    Y el sistema debe añadir la traza del documento a la Historia Pedagógica Interoperable (HPI).
