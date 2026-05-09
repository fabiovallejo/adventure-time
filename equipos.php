<?php
require_once "app/equipos_service.php";
$equipos = obtenerEquiposDisponibles();

include("includes/header.php");
?>

<div class="container mt-5">
    <h2 class="mb-4">Catálogo de equipos</h2>
    <p class="text-muted">
        Visualiza disponibilidad, estado, precio y categoría de los equipos para actividades de aventura.
    </p>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($equipos)): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card equipment-card h-100 shadow-sm">
                    <div class="equipment-img-wrapper">
                        <?php 
                        $img_path = str_replace("assets/img/", "css/img/", $row["imagen_url"]);
                        ?>
                        <img src="<?php echo htmlspecialchars($img_path); ?>" class="equipment-img" alt="<?php echo htmlspecialchars($row["nombre"]); ?>">
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-primary border">
                                <?php echo htmlspecialchars($row["categoria"]); ?>
                            </span>
                            <?php if ($row["estado"] === "disponible" && $row["stock"] > 0): ?>
                                <span class="badge bg-success-subtle text-success">Disponible</span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger">Agotado</span>
                            <?php endif; ?>
                        </div>

                        <h5 class="card-title mb-1"><?php echo htmlspecialchars($row["nombre"]); ?></h5>
                        <p class="small text-muted mb-3 text-truncate-2" style="height: 3rem; overflow: hidden;"><?php echo htmlspecialchars($row["descripcion"]); ?></p>

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-muted">Precio:</span>
                            <span class="fw-bold text-primary">S/ <?php echo number_format($row["precio_alquiler_dia"], 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small text-muted">Stock:</span>
                            <span class="badge bg-dark"><?php echo $row["stock"]; ?> und.</span>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="reservar.php?id_equipo=<?php echo $row["id_equipo"]; ?>" class="btn btn-primary w-100 <?php echo ($row["stock"] <= 0) ? 'disabled' : ''; ?>">
                            Reservar Ahora
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>