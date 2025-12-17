<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
    {{-- @vite('resources/css/app.css') --}} {{-- Commented out Vite to avoid manifest error --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Appointments</h1>

        <div id="appointments-container">
            Loading appointments...
        </div>

        <h2 class="text-xl font-bold mt-8 mb-4">Services</h2>
        <div id="services-container">
            Loading services...
        </div>
    </div>

    <script>
        async function loadAppointments() {
            try {
                const response = await axios.get('/api/appointments');
                const appointments = response.data.data;

                const container = document.getElementById('appointments-container');
                container.innerHTML = appointments.map(app => `
                    <div class="bg-white shadow rounded p-4 mb-2">
                        <strong>${app.reference_no}</strong> - ${app.appointment_date}
                        <br>Status: ${app.status?.status_name || app.status_id} | Time: ${app.appointment_time.substring(0, 5)}
                        <br>Service: ${app.service?.service_name || app.service_id}
                        <br>Resident: ${app.resident?.full_name || 'Resident #' + app.resident_id}
                        ${app.purpose_notes ? `<br>Notes: ${app.purpose_notes}` : ''}
                    </div>
                `).join('');

            } catch (error) {
                console.error('Error loading appointments:', error);
                document.getElementById('appointments-container').innerHTML =
                    '<div class="text-red-500 p-3 border border-red-300 rounded">Error loading appointments: ' + error.message + '</div>';
            }
        }

        async function loadServices() {
            try {
                const response = await axios.get('/api/services');
                const services = response.data.data;

                const container = document.getElementById('services-container');
                container.innerHTML = services.map(service => `
                    <div class="bg-gray-100 rounded p-3 mb-2 hover:bg-gray-200 transition">
                        <strong>${service.service_name}</strong>
                        <span class="text-sm text-gray-600 ml-2">(${service.category?.category_name || 'Uncategorized'})</span>
                        ${service.appointments?.length > 0 ?
                            `<div class="text-xs text-blue-600 mt-1">${service.appointments.length} appointment(s)</div>` :
                            ''
                        }
                    </div>
                `).join('');

            } catch (error) {
                console.error('Error loading services:', error);
                document.getElementById('services-container').innerHTML =
                    '<div class="text-red-500">Error loading services</div>';
            }
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadAppointments();
            loadServices();
        });
    </script>
</body>
</html>

<style>
/* Basic styles */
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    margin: 0;
    padding: 20px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 30px;
}
.bg-white {
    background: white;
    border-left: 4px solid #3b82f6;
}
.shadow {
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.rounded {
    border-radius: 8px;
}
.p-4 {
    padding: 1rem;
}
.mb-2 {
    margin-bottom: 0.75rem;
}
.mb-4 {
    margin-bottom: 1.5rem;
    color: #1e293b;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 10px;
}
.mt-8 {
    margin-top: 2.5rem;
}
.text-2xl {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
}
.text-xl {
    font-size: 1.4rem;
    font-weight: 600;
    color: #334155;
}
.text-red-500 {
    color: #dc2626;
    background: #fef2f2;
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #fecaca;
}
.text-gray-600 {
    color: #4b5563;
}
.text-sm {
    font-size: 0.875rem;
}
.text-xs {
    font-size: 0.75rem;
}
.bg-gray-100 {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}
.hover\:bg-gray-200:hover {
    background: #f1f5f9;
    transform: translateY(-2px);
    transition: all 0.2s ease;
}
.transition {
    transition: all 0.2s ease;
}
.ml-2 {
    margin-left: 0.5rem;
}
.mt-1 {
    margin-top: 0.25rem;
}
.text-blue-600 {
    color: #2563eb;
}
</style>
