/**
 * Servidor de Almacenamiento Local - Ecosistema Nature (Offline-First)
 * Inicialización de IndexedDB para persistencia local de Tenants y PIAR.
 */
const DB_NAME = 'NatureOfflineDB';
const DB_VERSION = 1;
let db;

function initLocalDatabase() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(DB_NAME, DB_VERSION);

        request.onerror = (event) => {
            console.error("Error abriendo IndexedDB:", event.target.error);
            reject(event.target.error);
        };

        request.onsuccess = (event) => {
            db = event.target.result;
            console.log("IndexedDB inicializada con éxito.");
            resolve(db);
        };

        request.onupgradeneeded = (event) => {
            const localDb = event.target.result;

            // Almacenamiento para sesión local y datos del Tenant
            if (!localDb.objectStoreNames.contains('tenant_session')) {
                localDb.createObjectStore('tenant_session', { keyPath: 'id' });
            }

            // Almacenamiento para la cola de PIAR pendientes por sincronizar al SaaS
            if (!localDb.objectStoreNames.contains('piar_outbox')) {
                localDb.createObjectStore('piar_outbox', { keyPath: 'id', autoIncrement: true });
            }
        };
    });
}

// Inicializar al cargar el script de forma autónoma
initLocalDatabase().catch(err => console.error("Fallo crítico en almacenamiento local"));
