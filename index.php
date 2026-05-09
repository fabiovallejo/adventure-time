<?php include("includes/header.php"); ?>

<header class="hero-section">
    <div class="container text-center py-5">
        <h1 class="display-3 mb-3">Alquiler seguro de equipos de aventura</h1>
        <p class="lead mb-5 mx-auto" style="max-width: 700px;">
            Consulta disponibilidad, reserva equipos y revisa el estado de tus solicitudes desde una plataforma digital
            diseñada para la aventura.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="equipos.php" class="btn btn-primary btn-lg d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="pointer-events: none;">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                Explorar Equipos
            </a>
            <a href="reservar.php" class="btn btn-outline-light btn-lg d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-plus" viewBox="0 0 16 16" style="pointer-events: none;">
                    <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                </svg>
                Realizar Reserva
            </a>
        </div>
    </div>
</header>

<section class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="display-5">¿Qué problema resuelve AdventureTime?</h2>
        <p class="text-muted">Optimizamos tu experiencia en la montaña, el río o el bosque.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <div class="mb-3 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path
                                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.238zm-7.5 10.522V6.838L1 4.238v7.922l6.5 2.6zM7.5 14.74l-6.5-2.6L7.5 9.54l6.5 2.6-6.5 2.6z" />
                        </svg>
                    </div>
                    <h4>Control de inventario</h4>
                    <p class="text-muted">
                        Visualiza equipos en tiempo real, stock actualizado y estado operativo, eliminando errores de
                        gestión manual.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <div class="mb-3 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>
                    </div>
                    <h4>Reserva digital</h4>
                    <p class="text-muted">
                        Solicita tus equipos desde cualquier lugar, agilizando el proceso y garantizando que tu equipo
                        esté listo cuando tú lo estés.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <div class="mb-3 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-shield-check" viewBox="0 0 16 16">
                            <path
                                d="M8 0c-.69 0-1.843.265-2.928.56-1.11.303-2.259.67-3.232.997C1.144 1.782 0 2.454 0 3.5v7c0 3.333 2.222 6.111 8 8 5.778-1.889 8-4.667 8-8v-7c0-1.046-1.144-1.718-1.84-1.943-.973-.327-2.122-.694-3.232-.997C9.843.265 8.69 0 8 0zm0 1.251c.596 0 1.709.23 2.78.522 1.05.285 2.146.64 3.091.95.539.177.879.406.879.777v7c0 2.667-1.778 4.889-6.75 6.444C3.028 15.389 1.25 13.167 1.25 10.5v-7c0-.371.34-.6.879-.777.945-.31 2.04-.665 3.091-.95 1.071-.292 2.184-.522 2.78-.522z" />
                            <path
                                d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <h4>Trazabilidad</h4>
                    <p class="text-muted">
                        Seguimiento riguroso del mantenimiento y ciclo de vida de cada equipo para garantizar tu
                        seguridad en cada aventura.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>