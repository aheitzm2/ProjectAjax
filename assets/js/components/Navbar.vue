<template>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color">

        <!-- Navbar brand -->
        <router-link to="/" class="navbar-brand">City Locate</router-link>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link to="/" class="nav-link">Home
                        <span class="sr-only">(current)</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Material dropdown</a>


                    <!--Menu-->
                    <div class="dropdown-menu dropdown-primary">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="http://127.0.0.1:8000/connexion" class="nav-link"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                </li>
                <li class="nav-item">
                    <a href="http://127.0.0.1:8000/déconnexion" class="nav-link"><i class="fas fa-sign-out-alt"></i> Deconnexion</a>
                </li>
                <li class="nav-item">
                    <a href="http://127.0.0.1:8000/inscription" class="nav-link"><i class="fas fa-user"></i> Inscription</a>
                </li>
            </ul>
        </div>
        <!-- Collapsible content -->

    </nav>
</template>
<script>
    export default {
        name: "Navbar"
    }
</script>