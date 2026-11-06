<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Crear usuario | APCH</title>

<style>

    :root {
        --apch-50: #fff5f5;
        --apch-100: #fee2e2;
        --apch-200: #fecaca;
        --apch-300: #fca5a5;
        --apch-400: #f87171;
        --apch-500: #ef4444;
        --apch-600: #dc2626;
        --apch-700: #b30000;
        --apch-800: #8f0000;
        --apch-900: #650000;

        --slate-50: #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --slate-900: #0f172a;

        --green-50: #f0fdf4;
        --green-100: #dcfce7;
        --green-200: #bbf7d0;
        --green-400: #4ade80;
        --green-500: #22c55e;
        --green-700: #15803d;

        --red-50: #fef2f2;
        --red-100: #fee2e2;
        --red-200: #fecaca;
        --red-700: #b91c1c;
        --red-800: #991b1b;
    }

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        min-height: 100vh;
        background: var(--slate-100);
        color: var(--slate-800);
        font-family: "Segoe UI", Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    button,
    input,
    select {
        font-family: inherit;
    }

    button,
    a {
        -webkit-tap-highlight-color: transparent;
    }

    /* =========================================================
       ANIMACIONES
       ========================================================= */

    @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(18px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes pulseSoft {
        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.55;
        }
    }

    @keyframes ping {
        75%,
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .animate-fade-up {
        animation: fadeUp 0.6s ease-out forwards;
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .pulse-soft {
        animation: pulseSoft 2.5s ease-in-out infinite;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .site-header {
        position: relative;
        margin: 16px 16px 0;
        border: 1px solid var(--slate-200);
        border-radius: 22px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }

    .site-header::before {
        position: absolute;
        top: 20px;
        bottom: 20px;
        left: 0;
        width: 5px;
        border-radius: 0 5px 5px 0;
        background: #bd5a5a;
        content: "";
    }

    .site-header::after {
        position: absolute;
        right: 24px;
        bottom: 0;
        left: 24px;
        height: 2px;
        background: #bd5a5a;
        content: "";
    }

    .header-inner {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 20px 24px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .brand-logo {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--slate-200);
    }

    .brand-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .brand-text {
        min-width: 0;
    }

    .brand-title {
        margin: 0;
        color: var(--slate-900);
        font-size: 20px;
        line-height: 1.25;
        font-weight: 700;
        letter-spacing: -0.025em;
    }

    .brand-subtitle {
        margin: 4px 0 0;
        color: var(--slate-500);
        font-size: 14px;
        line-height: 1.5;
        font-weight: 500;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .session-status {
        display: none;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid var(--green-200);
        border-radius: 999px;
        background: var(--green-50);
        color: var(--green-700);
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-indicator {
        position: relative;
        display: flex;
        width: 10px;
        height: 10px;
    }

    .status-indicator-ping {
        position: absolute;
        display: inline-flex;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: var(--green-400);
        opacity: 0.6;
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .status-indicator-dot {
        position: relative;
        display: inline-flex;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--green-500);
    }

    .logout-form {
        margin: 0;
    }

    .logout-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 2px solid var(--slate-200);
        border-radius: 12px;
        background: #fff;
        color: var(--slate-700);
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition:
            border-color 0.3s ease,
            background-color 0.3s ease,
            color 0.3s ease;
    }

    .logout-button svg {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }

    .logout-button:hover {
        border-color: var(--apch-700);
        background: var(--apch-700);
        color: #fff;
    }

    .logout-button:hover svg {
        transform: translateX(2px);
    }

    /* =========================================================
       CONTENIDO PRINCIPAL
       ========================================================= */

    .main-container {
        width: 100%;
        max-width: 1024px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    /* =========================================================
       TÍTULO
       ========================================================= */

    .page-heading {
        position: relative;
        margin-bottom: 32px;
        padding: 24px 26px 26px;
        overflow: hidden;
        border: 1px solid var(--slate-200);
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
    }

    .page-heading::before {
        position: absolute;
        top: 18px;
        bottom: 18px;
        left: 0;
        width: 4px;
        border-radius: 0 4px 4px 0;
        background: #bd5a5a;
        content: "";
    }

    .page-heading::after {
        position: absolute;
        right: 22px;
        bottom: 0;
        left: 22px;
        height: 2px;
        background: #e6b4b4;
        content: "";
    }

    .heading-row {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .heading-content {
        min-width: 0;
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .section-label-dot {
        width: 10px;
        height: 10px;
        flex-shrink: 0;
        border-radius: 50%;
        background: var(--apch-700);
    }

    .section-label-text {
        margin: 0;
        color: var(--apch-700);
        font-size: 14px;
        line-height: 1.5;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }

    .page-title {
        margin: 0;
        color: var(--slate-900);
        font-size: 40px;
        line-height: 1.1;
        font-weight: 700;
        letter-spacing: -0.025em;
    }

    .page-description {
        max-width: 672px;
        margin: 12px 0 0;
        color: var(--slate-500);
        font-size: 16px;
        line-height: 1.75;
    }

    .new-account-indicator {
        display: none;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid var(--red-200);
        border-radius: 999px;
        background: var(--red-50);
        color: var(--apch-700);
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }

    .new-account-indicator svg {
        width: 20px;
        height: 20px;
    }

    /* =========================================================
       MENSAJE DE ERRORES
       ========================================================= */

    .error-alert {
        margin-bottom: 32px;
        padding: 20px 24px;
        border: 2px solid var(--red-200);
        border-radius: 16px;
        background: var(--red-50);
    }

    .error-alert-inner {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .error-icon {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--red-100);
        color: var(--apch-700);
    }

    .error-icon svg {
        width: 24px;
        height: 24px;
    }

    .error-content {
        min-width: 0;
    }

    .error-title {
        margin: 0;
        color: var(--red-800);
        font-size: 16px;
        line-height: 1.5;
        font-weight: 700;
    }

    .error-list {
        margin: 8px 0 0;
        padding-left: 20px;
        color: var(--red-700);
        font-size: 14px;
        line-height: 1.5;
    }

    .error-list li {
        margin-bottom: 4px;
    }

    .error-list li:last-child {
        margin-bottom: 0;
    }

    /* =========================================================
       TARJETA DEL FORMULARIO
       ========================================================= */

    .form-card {
        overflow: hidden;
        border: 2px solid var(--slate-200);
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.05);
    }

    .form-header {
        padding: 24px;
        border-bottom: 2px solid var(--red-100);
        background: var(--red-50);
    }

    .form-header-inner {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .form-header-icon {
        width: 56px;
        height: 56px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: var(--apch-700);
        color: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
    }

    .form-header-icon svg {
        width: 28px;
        height: 28px;
    }

    .form-header-title {
        margin: 0;
        color: var(--slate-900);
        font-size: 20px;
        line-height: 1.4;
        font-weight: 700;
    }

    .form-header-description {
        margin: 4px 0 0;
        color: var(--slate-500);
        font-size: 14px;
        line-height: 1.5;
    }

    /* =========================================================
       FORMULARIO
       ========================================================= */

    .user-form {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 28px;
    }

    .form-group:last-of-type {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        color: var(--slate-800);
        font-size: 16px;
        line-height: 1.5;
        font-weight: 700;
    }

    .input-wrapper {
        position: relative;
        width: 100%;
    }

    .input-icon {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        padding-left: 16px;
        color: var(--slate-400);
        pointer-events: none;
    }

    .input-icon svg {
        width: 20px;
        height: 20px;
    }

    .form-input,
    .form-select {
        width: 100%;
        height: 56px;
        border: 2px solid var(--slate-200);
        border-radius: 12px;
        outline: none;
        background: #fff;
        color: var(--slate-900);
        font-size: 16px;
        line-height: 1.5;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .form-input {
        padding: 0 16px 0 48px;
    }

    .form-select {
        padding: 0 48px 0 48px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    .form-input::placeholder {
        color: var(--slate-400);
        opacity: 1;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--apch-700);
        box-shadow: 0 0 0 4px rgba(185, 28, 28, 0.1);
    }

    .select-arrow {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        padding-right: 16px;
        color: var(--slate-400);
        pointer-events: none;
    }

    .select-arrow svg {
        width: 20px;
        height: 20px;
    }

    .field-help {
        margin: 8px 0 0;
        color: var(--slate-400);
        font-size: 14px;
        line-height: 1.5;
    }

    /* =========================================================
       ACCIONES
       ========================================================= */

    .form-actions {
        display: flex;
        flex-direction: column-reverse;
        gap: 12px;
        margin-top: 40px;
        padding-top: 28px;
        border-top: 2px solid var(--slate-100);
    }

    .back-button,
    .create-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 52px;
        padding: 14px 24px;
        border-radius: 12px;
        font-size: 16px;
        line-height: 1.5;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition:
            transform 0.2s ease,
            border-color 0.2s ease,
            background-color 0.2s ease,
            color 0.2s ease,
            box-shadow 0.3s ease;
    }

    .back-button {
        border: 2px solid var(--slate-200);
        background: #fff;
        color: var(--slate-600);
    }

    .back-button:hover {
        border-color: var(--slate-400);
        background: var(--slate-50);
        color: var(--slate-900);
    }

    .back-button svg {
        width: 20px;
        height: 20px;
    }

    .create-button {
        border: 2px solid var(--apch-700);
        background: var(--apch-700);
        color: #fff;
        box-shadow: 0 10px 20px rgba(101, 0, 0, 0.1);
    }

    .create-button:hover {
        transform: translateY(-2px);
        border-color: var(--apch-800);
        background: var(--apch-800);
        box-shadow: 0 14px 28px rgba(101, 0, 0, 0.14);
    }

    .create-button svg {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }

    .create-button:hover svg {
        transform: rotate(90deg);
    }

    /* =========================================================
       FOOTER
       ========================================================= */

    .site-footer {
        margin-top: 40px;
        background: #000;
        color: #fff;
    }

    .footer-inner {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 28px 24px;
        text-align: center;
    }

    .footer-block {
        min-width: 0;
    }

    .footer-title {
        margin: 0;
        color: #fff;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 700;
    }

    .footer-subtitle {
        margin: 4px 0 0;
        color: rgba(255, 255, 255, 0.6);
        font-size: 12px;
        line-height: 1.5;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (min-width: 640px) {

        .header-inner {
            padding-left: 24px;
            padding-right: 24px;
        }

        .brand-title {
            font-size: 24px;
        }

        .brand-subtitle {
            font-size: 16px;
        }

        .session-status {
            display: flex;
        }

        .heading-row {
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
        }

        .page-title {
            font-size: 48px;
        }

        .new-account-indicator {
            display: flex;
        }

        .form-header {
            padding-left: 32px;
            padding-right: 32px;
        }

        .user-form {
            padding: 32px;
        }

        .form-actions {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .footer-inner {
            flex-direction: row;
            align-items: center;
            text-align: left;
        }
    }

    @media (min-width: 1024px) {

        .header-inner {
            padding-left: 40px;
            padding-right: 40px;
        }

        .main-container {
            padding-left: 40px;
            padding-right: 40px;
        }

        .user-form {
            padding: 40px;
        }
    }

    @media (max-width: 639px) {

        .header-inner {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .site-header::after {
            right: 18px;
            left: 18px;
        }

        .header-actions {
            width: 100%;
            justify-content: flex-end;
        }

        .brand {
            width: 100%;
        }

        .logout-button {
            width: 100%;
            justify-content: center;
        }

        .main-container {
            padding-top: 32px;
            padding-bottom: 32px;
        }

        .page-heading {
            padding: 20px 20px 22px;
        }

        .page-heading::after {
            right: 16px;
            left: 16px;
        }

        .page-title {
            font-size: 36px;
        }

        .page-description {
            font-size: 15px;
        }

        .error-alert {
            padding: 18px;
        }

        .error-alert-inner {
            gap: 12px;
        }

        .form-header-inner {
            align-items: flex-start;
        }

        .form-header-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
        }

        .form-header-icon svg {
            width: 25px;
            height: 25px;
        }

        .form-header-title {
            font-size: 18px;
        }

        .back-button,
        .create-button {
            width: 100%;
        }

        .footer-inner {
            padding-left: 24px;
            padding-right: 24px;
        }
    }

</style>
</head>

<body>
    <!-- =========================================================
     CABECERA
     ========================================================= -->

<header class="site-header">

    <div class="header-inner">

        <!-- IDENTIDAD -->

        <div class="brand">

            <div class="brand-logo">

                <img
                    src="{{ asset('images/logo-apch.png') }}"
                    alt="Logo APCH"
                >

            </div>

            <div class="brand-text">

                <h1 class="brand-title">
                    Sistema de Formularios Digitales
                </h1>

                <p class="brand-subtitle">
                    UNIDAD EDUCATIVA "ÁNGEL POLIBIO CHAVES"
                </p>

            </div>

        </div>

        <!-- SESIÓN -->

        <div class="header-actions">

            <div class="session-status">

                <span class="status-indicator">

                    <span class="status-indicator-ping"></span>

                    <span class="status-indicator-dot"></span>

                </span>

                Sesión activa

            </div>

            <form
                method="POST"
                action="{{ route('logout') }}"
                class="logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"
                        />

                    </svg>

                    Cerrar sesión

                </button>

            </form>

        </div>

    </div>

</header>


<!-- =========================================================
     CONTENIDO PRINCIPAL
     ========================================================= -->

<main class="main-container">

    <!-- =====================================================
         TÍTULO
         ===================================================== -->

    <section class="page-heading animate-fade-up">

        <div class="heading-row">

            <div class="heading-content">

                <div class="section-label">

                    <span class="section-label-dot"></span>

                    <p class="section-label-text">
                        Administración
                    </p>

                </div>

                <h2 class="page-title">
                    Crear usuario
                </h2>

                <p class="page-description">
                    Registre una nueva cuenta para permitir el acceso
                    al sistema institucional de formularios digitales.
                </p>

            </div>


            <!-- INDICADOR -->

            <div class="new-account-indicator">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM4 20a8 8 0 0116 0"
                    />

                </svg>

                Nueva cuenta

            </div>

        </div>

    </section>


    <!-- =====================================================
         ERRORES
         ===================================================== -->

    @if ($errors->any())

        <div class="error-alert animate-fade-in">

            <div class="error-alert-inner">

                <div class="error-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />

                    </svg>

                </div>

                <div class="error-content">

                    <p class="error-title">
                        No se pudo crear el usuario
                    </p>

                    <ul class="error-list">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <!-- =====================================================
         FORMULARIO
         ===================================================== -->

    <section class="form-card animate-fade-up">


        <!-- CABECERA DEL FORMULARIO -->

        <div class="form-header">

            <div class="form-header-inner">

                <div class="form-header-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm10 5v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                        />

                    </svg>

                </div>

                <div>

                    <h3 class="form-header-title">
                        Información de la cuenta
                    </h3>

                    <p class="form-header-description">
                        Complete los datos del nuevo usuario.
                    </p>

                </div>

            </div>

        </div>


        <!-- FORM -->

        <form
            method="POST"
            action="{{ route('usuarios.store') }}"
            class="user-form"
        >

            @csrf


            <!-- NOMBRE -->

            <div class="form-group">

                <label
                    for="name"
                    class="form-label"
                >
                    Nombre completo
                </label>

                <div class="input-wrapper">

                    <div class="input-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />

                        </svg>

                    </div>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input"
                        placeholder="Ingrese el nombre completo"
                        value="{{ old('name') }}"
                        required
                    >

                </div>

            </div>


            <!-- USUARIO -->

            <div class="form-group">

                <label
                    for="username"
                    class="form-label"
                >
                    Nombre de usuario
                </label>

                <div class="input-wrapper">

                    <div class="input-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 7a2 2 0 11-4 0 2 2 0 014 0zm6 2a2 2 0 11-4 0 2 2 0 014 0zM7 9a2 2 0 11-4 0 2 2 0 014 0zm8 4a5 5 0 00-10 0v1h10v-1zm5 5a5 5 0 00-10 0v1h10v-1z"
                            />

                        </svg>

                    </div>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-input"
                        placeholder="Ingrese el nombre de usuario"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        required
                    >

                </div>

                <p class="field-help">
                    El nombre de usuario debe ser único.
                </p>

            </div>


            <!-- CONTRASEÑA -->

            <div class="form-group">

                <label
                    for="password"
                    class="form-label"
                >
                    Contraseña
                </label>

                <div class="input-wrapper">

                    <div class="input-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V8a4 4 0 10-8 0v4h8z"
                            />

                        </svg>

                    </div>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="Ingrese la contraseña"
                        autocomplete="new-password"
                        required
                    >

                </div>

                <p class="field-help">
                    La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un carácter especial.
                </p>

            </div>


            <!-- ROL -->

            <div class="form-group">

                <label
                    for="role"
                    class="form-label"
                >
                    Rol
                </label>

                <div class="input-wrapper">

                    <div class="input-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                            />

                        </svg>

                    </div>

                    <select
                        id="role"
                        name="role"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione un rol
                        <option
    value="coordinador"
    {{ old('role') === 'coordinador' ? 'selected' : '' }}
>
    Coordinador/a
</option>

<option
    value="analista"
    {{ old('role') === 'analista' ? 'selected' : '' }}
>
    Analista
</option>

                    </select>

                    <div class="select-arrow">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 9l-7 7-7-7"
                            />

                        </svg>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 ACCIONES
                 ================================================= -->

            <div class="form-actions">

                <!-- VOLVER -->

                <a
                    href="{{ route('usuarios.index') }}"
                    class="back-button"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />

                    </svg>

                    Volver

                </a>


                <!-- CREAR -->

                <button
                    type="submit"
                    class="create-button"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                        />

                    </svg>

                    Crear usuario

                </button>

            </div>

        </form>

    </section>

</main>


<!-- =========================================================
     FOOTER
     ========================================================= -->

<footer class="site-footer">

    <div class="footer-inner">

        <div class="footer-block">

            <p class="footer-title">
                Sistema de Formularios Digitales APCH
            </p>

            <p class="footer-subtitle">
                Unidad Educativa "Ángel Polibio Chaves"
            </p>

        </div>

        <div class="footer-block">

            <p class="footer-title">
                Desarrollado por Stalyn Alvarado
            </p>

            <p class="footer-subtitle">
                tu-correo@ejemplo.com
            </p>

        </div>

    </div>

</footer>
</body>

</html>
