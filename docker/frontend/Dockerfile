FROM nginx:1.25-alpine

# Copiar archivos estáticos de la aplicación al contenedor
COPY ./public /usr/share/nginx/html

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
