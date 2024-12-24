<div class="general">
    
    <div class="wrapper wp-user">

        <span class="rotate-bg"></span>
        <span class="rotate-bg2"></span>

        <div class="form-box login">

            <h2 class="title animation" style="--i:0; --j:21">Login</h2>

            <form action="#">

                <div class="input-box animation" style="--i:1; --j:22">
                    <input type="email" id="email" name="email" required>
                    <label for="">Correo</label>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box animation" style="--i:2; --j:23">
                    <input type="password" id="password" name="password" required>
                    <label for="">Password</label>
                    <i class='bx bxs-lock-alt' ></i>
                </div>

                <button type="submit" class="btn animation btn-f" style="--i:3; --j:24">Login</button>

                <div class="linkTxt animation" style="--i:5; --j:25">
                    <p>¿No tienes cuenta? <a href="#" class="register-link">Registrarse</a></p>
                </div>
                
            </form>
        </div>

        <div class="info-text login">
            <h2 class="animation" style="--i:0; --j:20">Bienvenido de nuevo!</h2>
            <p class="animation" style="--i:1; --j:21">Inicia sesion para poder empezar a disfrutar de tus ventajas.</p>
        </div>





        <div class="form-box register">

            <h2 class="title animation" style="--i:17; --j:0">Registrarse</h2>

            <form action="?controller=usuarios&action=doRegister" method="POST">
                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" id="nombre_apellidos" name="nombre_apellidos" required>
                    <label for="nombre_apellidos">Nombre y apellidos</label>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box animation" style="--i:20; --j:3">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Correo Electrónico</label>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box animation" style="--i:23; --j:6">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Contraseña</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn animation btn-f" style="--i:21;--j:4">Registrarse</button>

                <div class="linkTxt animation" style="--i:22; --j:5">
                    <p>¿Ya tienes cuenta? <a href="#" class="login-link">Iniciar session</a></p>
                </div>
                
            </form>
        </div>


        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0;">Bienvenido</h2>
            <p class="animation" style="--i:18; --j:1;">Al registrarte podras acceder a ofertas exclusivas.</p>
        </div>

    </div>

</div>

<script>
    const wrapper = document.querySelector('.wrapper');
    const registerLink = document.querySelector('.register-link');
    const loginLink = document.querySelector('.login-link');

    registerLink.onclick = () => {
        wrapper.classList.add('active');
    }

    loginLink.onclick = () => {
        wrapper.classList.remove('active');
    }
</script>
