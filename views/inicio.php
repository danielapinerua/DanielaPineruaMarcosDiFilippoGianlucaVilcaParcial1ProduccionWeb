<?php include_once('componentes/header.php'); ?>
<link rel="stylesheet" href="assets/css/inicio.css">
<main>

    <section class="hero-section">
        <div class="hero-eyebrow">Agencia Da-Vinci</div>

        <h2>La mejor agencia<br>de <span>vehículos</span></h2>

        <p>Explorá nuestra amplia gama de vehículos y encontrá el que mejor se adapte a tus necesidades y presupuesto. El más confiable del mercado, con los mejores precios y calidad.</p>

        <div class="hero-btns">
            <a href="vehiculos.php" class="btn-primary">Ver vehículos</a>
            <?php if (!isset($_SESSION["usuario_id"])): ?>
            <a href="login.php" class="btn-secondary">Iniciar sesión</a>
            <?php endif ?>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-number">+50</span>
                <span class="stat-label">Vehículos disponibles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">+200</span>
                <span class="stat-label">Clientes satisfechos</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">5★</span>
                <span class="stat-label">Calificación promedio</span>
            </div>
        </div>
    </section>

    <div class="destacados-wrapper">
        <div class="destacados-section">

            <div class="destacados-header">
                <p class="destacados-eyebrow">⭐ Top 3</p>
                <h3>Autos destacados</h3>
                <p class="destacados-sub">Los más icónicos de todos los tiempos</p>
            </div>

            <div class="destacados-grid">

                <div class="car-card">
                    <div class="car-rank rank-gold">1</div>
                    <img src="assets/img/picapiedras.jpg" alt="Auto de los Picapiedras" class="car-image">
                    <div class="car-body">
                        <h4>El auto de los Picapiedras</h4>
                        <p class="car-origin">Los Picapiedras · Bedrock, Edad de Piedra</p>
                        <p class="car-desc">Sin motor, sin nafta, sin frenos. Propulsado 100% por los pies descalzos de Fred Picapiedra. Chasis de madera tallada y carrocería de granito puro.</p>
                        <div class="car-tags">
                            <span class="tag">Motor: pies × 2</span>
                            <span class="tag">Combustible: fuerza de voluntad</span>
                            <span class="tag">Frenos: también los pies</span>
                        </div>
                    </div>
                </div>

                <div class="car-card">
                    <div class="car-rank rank-silver">2</div>
                    <img src="assets/img/homero.jpg" alt="Auto de Homero Simpson" class="car-image">
                    <div class="car-body">
                        <h4>El auto de Homero Simpson</h4>
                        <p class="car-origin">Los Simpson · Springfield, USA</p>
                        <p class="car-desc">El mítico Pink Sedan. Sobrevivió choques, incendios y caídas a barrancos. Homero lo manejó dormido, comiendo donas y gritando "¡D'oh!" en cada semáforo.</p>
                        <div class="car-tags">
                            <span class="tag">Color: rosa Springfield</span>
                            <span class="tag">Estado: milagrosamente funcional</span>
                            <span class="tag">Pasajeros: 5 + Santa's Little Helper</span>
                        </div>
                    </div>
                </div>

                <div class="car-card">
                    <div class="car-rank rank-bronze">3</div>
                    <img src="assets/img/bumblebee.jpg" alt="Bumblebee Camaro" class="car-image">
                    <div class="car-body">
                        <h4>Bumblebee — Camaro Amarillo</h4>
                        <p class="car-origin">Transformers · Planeta Cybertron / Tierra</p>
                        <p class="car-desc">Chevrolet Camaro amarillo que es, en realidad, un robot Autobot de 4 metros. Se transforma en segundos y ha salvado a la humanidad más veces de las que cualquier taller podría cobrar.</p>
                        <div class="car-tags">
                            <span class="tag">Color: amarillo Cybertron</span>
                            <span class="tag">Potencia: robot de guerra</span>
                            <span class="tag">Extra: se transforma solo</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
<?php include_once('componentes/footer.php'); ?>