# 💰 Integración con Khipu en Laravel

Este proyecto fue desarrollado como parte del proceso de selección para el cargo de **Customer Success** en **Khipu**. Consiste en una integración básica con la API de pagos de Khipu utilizando Laravel.

> 🔗 Repositorio: [danielalejandrobg/khipu-test](https://github.com/danielalejandrobg/khipu-test)

---

## 🚀 ¿Qué hace esta aplicación?

- ✅ Muestra la lista de bancos disponibles desde la API de Khipu (`GET /banks`)
- ✅ Permite crear un cobro de prueba y redirige al usuario al pago (`POST /payments`)
- ✅ Consulta el estado de un pago por su ID (`GET /payments/{id}`)
- ✅ Permite eliminar pagos por su ID, solo en caso que aun no se haya concretado. (`DELETE /payments/{id}`)

---

## 🧰 Tecnologías usadas

- Laravel 10
- PHP 8+
- Blade (motor de vistas)
- Laravel HTTP Client (para consumo de API)
- API REST de Khipu

---

## 📁 Estructura del proyecto

Si no estás familiarizado con Laravel, estos son los archivos clave:

- **Controlador principal:**  
  [`app/Http/Controllers/KhipuController.php`](app/Http/Controllers/KhipuController.php)

- **Vista principal (web):**  
  [`resources/views/khipu.blade.php`](resources/views/khipu.blade.php)

- **Rutas de la app:**  
  [`routes/web.php`](routes/web.php)

---

## 🔐 Variables de entorno

Para hacer funcionar la integración, debés crear un archivo `.env` con estas claves:

```env
KHIPU_API_KEY=tu_api_key_de_khipu
KHIPU_RECEIVER_ID=tu_receiver_id
⚠️ Estas variables están ignoradas en el repositorio por seguridad (.gitignore lo evita).

👤 Autor
Daniel Alejandro
GitHub: @danielalejandrobg