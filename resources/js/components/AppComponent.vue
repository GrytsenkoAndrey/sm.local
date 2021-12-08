<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bt-white shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand">Laravel & Vue</a>
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>
