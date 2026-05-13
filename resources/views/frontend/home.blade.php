<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eymen Optik | Premium Gözlük E-Ticaret</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg: #f4f6fb;
            --dark: #07111f;
            --dark-2: #111c2f;
            --text: #1a2435;
            --muted: #717b8d;
            --white: #ffffff;
            --soft: #eef2f8;
            --line: rgba(7, 17, 31, .09);
            --gold: #c79a3a;
            --gold-soft: rgba(199, 154, 58, .16);
            --blue: #2854d9;
            --cyan: #50c9ef;
            --green: #16a36b;
            --red: #e23b3b;
            --shadow: 0 28px 90px rgba(7, 17, 31, .13);
            --radius: 30px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: "Inter", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 5% 0%, rgba(40, 84, 217, .16), transparent 34%),
                radial-gradient(circle at 94% 8%, rgba(199, 154, 58, .22), transparent 30%),
                linear-gradient(180deg, #f9fbff 0%, var(--bg) 48%, #f8fafc 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(7, 17, 31, .025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(7, 17, 31, .025) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: linear-gradient(to bottom, black, transparent 78%);
            z-index: -1;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            width: 100%;
            display: block;
        }

        button,
        input,
        select {
            font-family: inherit;
        }

        .container {
            width: min(1240px, calc(100% - 40px));
            margin: auto;
        }

        .top-bar {
            background: var(--dark);
            color: rgba(255, 255, 255, .78);
            font-size: 13px;
        }

        .top-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 10px 0;
        }

        .top-inner div {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        .top-inner b {
            color: white;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 60;
            background: rgba(255, 255, 255, .78);
            backdrop-filter: blur(28px);
            border-bottom: 1px solid var(--line);
        }

        .nav-inner {
            height: 82px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border-radius: 18px;
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, .22), transparent 35%),
                linear-gradient(135deg, var(--dark), #223f67);
            color: white;
            display: grid;
            place-items: center;
            font-weight: 950;
            box-shadow: 0 18px 34px rgba(7, 17, 31, .2);
        }

        .brand-title {
            font-weight: 950;
            color: var(--dark);
            font-size: 22px;
            letter-spacing: -.8px;
            line-height: 1;
        }

        .brand-title small {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: 2.5px;
            font-weight: 900;
        }

        .search-box {
            width: min(480px, 100%);
            justify-self: center;
            background: white;
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 9px 12px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 10px;
            box-shadow: 0 14px 35px rgba(7, 17, 31, .05);
        }

        .search-box input {
            border: 0;
            outline: 0;
            font-size: 14px;
            color: var(--dark);
            min-width: 0;
        }

        .search-box span,
        .search-box button {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            display: grid;
            place-items: center;
        }

        .search-box button {
            border: 0;
            background: var(--dark);
            color: white;
            cursor: pointer;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-btn,
        .mobile-btn {
            width: 46px;
            height: 46px;
            border: 1px solid var(--line);
            background: white;
            border-radius: 17px;
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: .28s ease;
            position: relative;
            color: var(--dark);
            font-weight: 900;
        }

        .icon-btn:hover,
        .mobile-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 34px rgba(7, 17, 31, .1);
        }

        .cart-count {
            position: absolute;
            top: -7px;
            right: -7px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--gold);
            color: white;
            font-size: 11px;
            border: 2px solid white;
        }

        .mobile-btn {
            display: none;
        }

        .category-nav {
            border-bottom: 1px solid var(--line);
            background: rgba(255, 255, 255, .58);
            backdrop-filter: blur(20px);
        }

        .category-nav-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            overflow-x: auto;
            padding: 12px 0;
        }

        .category-nav a {
            flex: 0 0 auto;
            padding: 10px 14px;
            border-radius: 999px;
            color: #394456;
            font-size: 13px;
            font-weight: 850;
            transition: .25s ease;
        }

        .category-nav a:hover {
            background: var(--dark);
            color: white;
        }

        .hero {
            padding: 54px 0 42px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 38px;
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(255, 255, 255, .76);
            border: 1px solid var(--line);
            color: var(--dark);
            border-radius: 999px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 900;
            box-shadow: 0 14px 34px rgba(7, 17, 31, .06);
            margin-bottom: 18px;
        }

        .dot {
            width: 9px;
            height: 9px;
            background: var(--green);
            border-radius: 999px;
            box-shadow: 0 0 0 7px rgba(22, 163, 107, .12);
        }

        .hero h1 {
            color: var(--dark);
            font-size: clamp(44px, 6vw, 82px);
            line-height: .96;
            letter-spacing: -4.4px;
            margin-bottom: 20px;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--blue), var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            max-width: 610px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.82;
            margin-bottom: 26px;
        }

        .hero-actions {
            display: flex;
            gap: 13px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .btn {
            border: 0;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 15px 22px;
            border-radius: 18px;
            font-size: 14px;
            font-weight: 950;
            transition: .32s ease;
        }

        .btn-primary {
            background: var(--dark);
            color: white;
            box-shadow: 0 20px 48px rgba(7, 17, 31, .24);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 60px rgba(7, 17, 31, .28);
        }

        .btn-light {
            background: white;
            color: var(--dark);
            border: 1px solid var(--line);
        }

        .btn-gold {
            background: var(--gold);
            color: white;
        }

        .trust-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 13px;
            max-width: 610px;
        }

        .trust-item {
            background: rgba(255, 255, 255, .76);
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 16px;
        }

        .trust-item b {
            display: block;
            color: var(--dark);
            font-size: 22px;
            letter-spacing: -1px;
        }

        .trust-item span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
        }

        .hero-visual {
            min-height: 610px;
            position: relative;
        }

        .hero-card {
            position: absolute;
            inset: 0;
            border-radius: 48px;
            border: 1px solid rgba(255, 255, 255, .8);
            background:
                radial-gradient(circle at 80% 15%, rgba(199, 154, 58, .32), transparent 30%),
                radial-gradient(circle at 15% 80%, rgba(40, 84, 217, .16), transparent 34%),
                linear-gradient(150deg, rgba(255, 255, 255, .95), rgba(255, 255, 255, .45));
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            width: 680px;
            height: 680px;
            border: 1px solid rgba(7, 17, 31, .06);
            border-radius: 50%;
            left: -190px;
            top: -90px;
        }

        .hero-product {
            position: absolute;
            width: 86%;
            left: 7%;
            top: 18%;
            border-radius: 34px;
            filter: drop-shadow(0 42px 40px rgba(7, 17, 31, .2));
            animation: float 5.6s ease-in-out infinite;
        }

        .mini-product-card {
            position: absolute;
            left: 30px;
            bottom: 30px;
            right: 30px;
            z-index: 2;
            border-radius: 28px;
            background: rgba(255, 255, 255, .78);
            border: 1px solid var(--line);
            backdrop-filter: blur(18px);
            padding: 16px;
            display: grid;
            grid-template-columns: 76px 1fr auto;
            gap: 13px;
            align-items: center;
            box-shadow: 0 20px 52px rgba(7, 17, 31, .1);
        }

        .mini-img {
            height: 70px;
            border-radius: 20px;
            background: var(--soft);
            overflow: hidden;
        }

        .mini-product-card h3 {
            font-size: 16px;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .mini-product-card span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        .mini-product-card b {
            color: var(--dark);
            font-size: 22px;
        }

        .floating-pill {
            position: absolute;
            z-index: 3;
            background: rgba(255, 255, 255, .82);
            border: 1px solid var(--line);
            backdrop-filter: blur(18px);
            border-radius: 999px;
            padding: 13px 17px;
            box-shadow: 0 18px 44px rgba(7, 17, 31, .12);
            font-weight: 900;
            color: var(--dark);
            display: flex;
            gap: 9px;
            align-items: center;
        }

        .pill-1 {
            top: 52px;
            left: -10px;
        }

        .pill-2 {
            top: 106px;
            right: -8px;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(-1.8deg);
            }

            50% {
                transform: translateY(-18px) rotate(1.6deg);
            }
        }

        .section {
            padding: 58px 0;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 24px;
            margin-bottom: 28px;
        }

        .section-head h2 {
            color: var(--dark);
            font-size: clamp(31px, 4.4vw, 54px);
            letter-spacing: -2.5px;
            line-height: 1.02;
        }

        .section-head p {
            color: var(--muted);
            max-width: 560px;
            line-height: 1.75;
            font-weight: 550;
        }

        .category-showcase {
            display: grid;
            grid-template-columns: 1.2fr .8fr .8fr;
            gap: 18px;
        }

        .cat-feature,
        .cat-mini {
            position: relative;
            overflow: hidden;
            border-radius: 34px;
            border: 1px solid var(--line);
            background: white;
            min-height: 300px;
            box-shadow: 0 16px 44px rgba(7, 17, 31, .06);
            transition: .32s ease;
        }

        .cat-feature:hover,
        .cat-mini:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 70px rgba(7, 17, 31, .12);
        }

        .cat-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transform: scale(1.02);
            transition: .45s ease;
        }

        .cat-feature:hover .cat-bg,
        .cat-mini:hover .cat-bg {
            transform: scale(1.08);
        }

        .cat-bg::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(7, 17, 31, .08), rgba(7, 17, 31, .72));
        }

        .cat-content {
            position: absolute;
            inset: auto 22px 22px 22px;
            color: white;
            z-index: 2;
        }

        .cat-content .badge {
            display: inline-flex;
            padding: 8px 11px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .17);
            border: 1px solid rgba(255, 255, 255, .24);
            backdrop-filter: blur(10px);
            font-size: 12px;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .cat-content h3 {
            font-size: 30px;
            letter-spacing: -1.3px;
            margin-bottom: 8px;
        }

        .cat-content p {
            color: rgba(255, 255, 255, .76);
            line-height: 1.6;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .cat-feature {
            min-height: 420px;
        }

        .cat-feature .cat-content h3 {
            font-size: 42px;
        }

        .category-list {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 14px;
            margin-top: 18px;
        }

        .category-chip {
            background: rgba(255, 255, 255, .78);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 17px;
            transition: .28s ease;
        }

        .category-chip:hover {
            transform: translateY(-5px);
            background: var(--dark);
            color: white;
        }

        .category-chip span {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: var(--soft);
            margin-bottom: 14px;
            font-size: 21px;
        }

        .category-chip:hover span {
            background: rgba(255, 255, 255, .12);
        }

        .category-chip b {
            display: block;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .category-chip small {
            color: var(--muted);
            font-weight: 800;
        }

        .category-chip:hover small {
            color: rgba(255, 255, 255, .68);
        }

        .campaign {
            position: relative;
            overflow: hidden;
            border-radius: 42px;
            padding: 44px;
            background:
                radial-gradient(circle at 85% 0%, rgba(199, 154, 58, .38), transparent 30%),
                linear-gradient(135deg, var(--dark), #17375f);
            color: white;
            box-shadow: var(--shadow);
        }

        .campaign-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 30px;
            align-items: center;
        }

        .campaign h2 {
            font-size: clamp(32px, 4.4vw, 58px);
            letter-spacing: -2.5px;
            line-height: 1;
            margin-bottom: 14px;
        }

        .campaign p {
            color: rgba(255, 255, 255, .75);
            line-height: 1.75;
            max-width: 680px;
        }

        .campaign-cards {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .campaign-card {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 20px;
            padding: 14px 16px;
            min-width: 150px;
        }

        .campaign-card b {
            display: block;
            font-size: 20px;
        }

        .campaign-card span {
            color: rgba(255, 255, 255, .67);
            font-size: 12px;
            font-weight: 800;
        }

        .discount-circle {
            width: 174px;
            height: 174px;
            border-radius: 50%;
            background: white;
            color: var(--dark);
            display: grid;
            place-items: center;
            text-align: center;
            box-shadow: 0 30px 70px rgba(0, 0, 0, .22);
            transform: rotate(5deg);
        }

        .discount-circle b {
            display: block;
            font-size: 46px;
            letter-spacing: -2px;
        }

        .discount-circle span {
            color: var(--muted);
            font-weight: 900;
        }

        .shop-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 22px;
            align-items: start;
        }

        .sidebar {
            position: sticky;
            top: 116px;
            background: rgba(255, 255, 255, .82);
            border: 1px solid var(--line);
            border-radius: 30px;
            padding: 20px;
            box-shadow: 0 18px 44px rgba(7, 17, 31, .06);
        }

        .sidebar-block+.sidebar-block {
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid var(--line);
        }

        .sidebar h3 {
            color: var(--dark);
            font-size: 16px;
            margin-bottom: 14px;
        }

        .filter-list {
            display: grid;
            gap: 9px;
        }

        .filter-btn {
            border: 1px solid var(--line);
            background: white;
            border-radius: 16px;
            padding: 12px 13px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 850;
            color: #3d4859;
            transition: .25s ease;
            text-align: left;
        }

        .filter-btn span {
            color: var(--muted);
            font-size: 12px;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--dark);
            color: white;
            border-color: var(--dark);
        }

        .filter-btn.active span,
        .filter-btn:hover span {
            color: rgba(255, 255, 255, .68);
        }

        .check-row {
            display: flex;
            gap: 10px;
            align-items: center;
            padding: 8px 0;
            color: var(--muted);
            font-size: 14px;
            font-weight: 750;
        }

        .color-row {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
        }

        .color-dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 1px var(--line), 0 8px 16px rgba(7, 17, 31, .1);
        }

        .toolbar {
            background: rgba(255, 255, 255, .82);
            border: 1px solid var(--line);
            border-radius: 26px;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            box-shadow: 0 16px 42px rgba(7, 17, 31, .05);
        }

        .toolbar b {
            color: var(--dark);
        }

        .toolbar span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 750;
        }

        .toolbar select {
            border: 1px solid var(--line);
            background: white;
            border-radius: 15px;
            padding: 11px 13px;
            font-weight: 800;
            color: var(--dark);
            outline: 0;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .product-card {
            background: rgba(255, 255, 255, .86);
            border: 1px solid var(--line);
            border-radius: 32px;
            overflow: hidden;
            position: relative;
            transition: .35s ease;
            box-shadow: 0 16px 42px rgba(7, 17, 31, .05);
        }

        .product-card:hover {
            transform: translateY(-9px);
            box-shadow: 0 30px 76px rgba(7, 17, 31, .13);
        }

        .product-top-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 3;
            display: grid;
            gap: 8px;
        }

        .small-action {
            width: 37px;
            height: 37px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: rgba(255, 255, 255, .85);
            cursor: pointer;
            backdrop-filter: blur(12px);
            transition: .25s ease;
        }

        .small-action:hover {
            background: var(--dark);
            color: white;
        }

        .product-label {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 3;
            background: var(--dark);
            color: white;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 11px;
            font-weight: 950;
        }

        .product-media {
            height: 245px;
            display: grid;
            place-items: center;
            padding: 28px;
            background:
                radial-gradient(circle at 50% 45%, rgba(40, 84, 217, .1), transparent 50%),
                linear-gradient(180deg, #f8fafc, #edf2f8);
            overflow: hidden;
        }

        .product-media img {
            height: 100%;
            max-width: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 24px;
            filter: drop-shadow(0 20px 24px rgba(7, 17, 31, .15));
            transition: .35s ease;
        }

        .product-card:hover .product-media img {
            transform: scale(1.045) rotate(-1.5deg);
        }

        .product-body {
            padding: 19px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--muted);
            font-size: 12px;
            font-weight: 850;
            margin-bottom: 9px;
        }

        .rating {
            color: var(--gold);
            letter-spacing: 1px;
        }

        .product-body h3 {
            color: var(--dark);
            font-size: 18px;
            letter-spacing: -.6px;
            margin-bottom: 10px;
            line-height: 1.25;
        }

        .product-desc {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
            margin-bottom: 14px;
        }

        .specs {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .specs span {
            background: var(--soft);
            color: #425066;
            border-radius: 999px;
            padding: 7px 9px;
            font-size: 11px;
            font-weight: 900;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .price {
            color: var(--dark);
            font-size: 22px;
            font-weight: 950;
            letter-spacing: -1px;
        }

        .old-price {
            color: #a4adbb;
            text-decoration: line-through;
            font-size: 13px;
            font-weight: 800;
            margin-left: 6px;
        }

        .add-cart {
            width: 48px;
            height: 48px;
            border: 0;
            border-radius: 17px;
            color: white;
            background: var(--dark);
            cursor: pointer;
            font-size: 21px;
            transition: .28s ease;
        }

        .add-cart:hover {
            background: var(--gold);
            transform: rotate(8deg) scale(1.07);
        }

        .lookbook {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            gap: 20px;
        }

        .lookbook-card {
            border-radius: 38px;
            border: 1px solid var(--line);
            background: white;
            overflow: hidden;
            position: relative;
            min-height: 500px;
            box-shadow: var(--shadow);
        }

        .lookbook-card img {
            height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .lookbook-content {
            position: absolute;
            inset: auto 28px 28px 28px;
            background: rgba(255, 255, 255, .82);
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 28px;
            padding: 22px;
            backdrop-filter: blur(18px);
        }

        .lookbook-content h3 {
            font-size: 30px;
            color: var(--dark);
            letter-spacing: -1.5px;
            margin-bottom: 8px;
        }

        .lookbook-content p {
            color: var(--muted);
            line-height: 1.65;
            margin-bottom: 16px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .feature {
            background: rgba(255, 255, 255, .84);
            border: 1px solid var(--line);
            border-radius: 28px;
            padding: 22px;
            box-shadow: 0 16px 42px rgba(7, 17, 31, .05);
        }

        .feature-icon {
            width: 54px;
            height: 54px;
            background: var(--soft);
            border-radius: 19px;
            display: grid;
            place-items: center;
            font-size: 24px;
            margin-bottom: 14px;
        }

        .feature b {
            display: block;
            color: var(--dark);
            font-size: 17px;
            margin-bottom: 7px;
        }

        .feature span {
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
        }

        .newsletter {
            background:
                radial-gradient(circle at 8% 10%, rgba(199, 154, 58, .18), transparent 30%),
                rgba(255, 255, 255, .86);
            border: 1px solid var(--line);
            border-radius: 40px;
            padding: 36px;
            display: grid;
            grid-template-columns: 1fr .92fr;
            align-items: center;
            gap: 26px;
            box-shadow: 0 20px 60px rgba(7, 17, 31, .07);
        }

        .newsletter h2 {
            color: var(--dark);
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.05;
            letter-spacing: -2.3px;
            margin-bottom: 10px;
        }

        .newsletter p {
            color: var(--muted);
            line-height: 1.7;
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            background: white;
            border: 1px solid var(--line);
            padding: 8px;
            border-radius: 24px;
        }

        .newsletter-form input {
            flex: 1;
            border: 0;
            outline: 0;
            padding: 0 12px;
            min-width: 0;
            color: var(--dark);
        }

        .footer {
            margin-top: 58px;
            padding: 56px 0 26px;
            background: var(--dark);
            color: white;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr repeat(4, 1fr);
            gap: 32px;
            padding-bottom: 34px;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .footer h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .footer p,
        .footer a {
            display: block;
            color: rgba(255, 255, 255, .68);
            line-height: 1.9;
            font-size: 14px;
        }

        .copyright {
            padding-top: 22px;
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            color: rgba(255, 255, 255, .55);
            font-size: 13px;
        }

        .cart-drawer {
            position: fixed;
            top: 0;
            right: -430px;
            width: min(410px, 100%);
            height: 100vh;
            z-index: 120;
            background: white;
            box-shadow: -30px 0 90px rgba(0, 0, 0, .18);
            transition: .38s ease;
            padding: 24px;
            display: flex;
            flex-direction: column;
        }

        .cart-drawer.active {
            right: 0;
        }

        .cart-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .cart-head h3 {
            color: var(--dark);
            font-size: 25px;
            letter-spacing: -1px;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
        }

        .cart-empty {
            color: var(--muted);
            line-height: 1.7;
            background: var(--soft);
            border-radius: 22px;
            padding: 18px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 74px 1fr auto;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid var(--line);
        }

        .cart-thumb {
            height: 66px;
            border-radius: 18px;
            background: var(--soft);
            overflow: hidden;
        }

        .cart-thumb img {
            height: 100%;
            object-fit: cover;
        }

        .cart-item b {
            display: block;
            color: var(--dark);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .cart-item span {
            color: var(--muted);
            font-weight: 850;
            font-size: 13px;
        }

        .remove-item {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            background: #fff0f0;
            color: var(--red);
            font-weight: 950;
        }

        .cart-total {
            border-top: 1px solid var(--line);
            padding-top: 18px;
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            color: var(--dark);
            font-weight: 950;
            font-size: 20px;
        }

        .overlay {
            position: fixed;
            inset: 0;
            z-index: 110;
            background: rgba(7, 17, 31, .42);
            backdrop-filter: blur(6px);
            opacity: 0;
            visibility: hidden;
            transition: .32s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        main {
            flex: 1
        }

        .reveal {
            opacity: 0;
            transform: translateY(26px);
            transition: .72s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 1080px) {
            .search-box {
                display: none;
            }

            .nav-inner {
                grid-template-columns: auto auto;
                justify-content: space-between;
            }

            .mobile-btn {
                display: grid;
            }

            .category-nav {
                display: none;
            }

            .hero-grid,
            .shop-layout,
            .lookbook,
            .newsletter,
            .campaign-grid {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                min-height: 520px;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .filter-list {
                grid-template-columns: repeat(3, 1fr);
            }

            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .category-showcase {
                grid-template-columns: 1fr 1fr;
            }

            .cat-feature {
                grid-column: 1 / -1;
            }

            .category-list,
            .features,
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 680px) {
            .top-bar {
                display: none;
            }

            .container {
                width: min(100% - 26px, 1240px);
            }

            .nav-inner {
                height: 70px;
            }

            .brand-mark {
                width: 42px;
                height: 42px;
                border-radius: 15px;
            }

            .brand-title {
                font-size: 18px;
            }

            .brand-title small {
                font-size: 9px;
                letter-spacing: 1.7px;
            }

            .hero {
                padding-top: 36px;
            }

            .hero h1 {
                letter-spacing: -2.5px;
            }

            .trust-row,
            .filter-list,
            .product-grid,
            .category-showcase,
            .category-list,
            .features,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                min-height: 400px;
            }

            .floating-pill {
                display: none;
            }

            .mini-product-card {
                left: 14px;
                right: 14px;
                bottom: 14px;
                grid-template-columns: 60px 1fr;
            }

            .mini-product-card b {
                display: none;
            }

            .hero-card {
                border-radius: 34px;
            }

            .section {
                padding: 42px 0;
            }

            .section-head {
                display: block;
            }

            .section-head p {
                margin-top: 10px;
            }

            .cat-feature,
            .cat-mini {
                min-height: 310px;
            }

            .cat-feature .cat-content h3,
            .cat-content h3 {
                font-size: 30px;
            }

            .campaign,
            .newsletter {
                padding: 25px;
                border-radius: 30px;
            }

            .discount-circle {
                width: 132px;
                height: 132px;
            }

            .toolbar {
                display: block;
            }

            .toolbar select {
                width: 100%;
                margin-top: 12px;
            }

            .newsletter-form {
                display: block;
            }

            .newsletter-form input {
                width: 100%;
                padding: 14px 10px;
            }

            .newsletter-form .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <div class="container top-inner">
            <div>
                <span><b>Yeni Sezon:</b> Seçili ürünlerde %35 indirim</span>
                <span>Ücretsiz kargo fırsatı</span>
            </div>
            <div>
                <span>WhatsApp: 0555 000 00 00</span>
                <span>Sivas / Merkez</span>
            </div>
        </div>
    </div>

    <header class="navbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">EO</span>
                <span class="brand-title">Eymen Optik<small>PREMIUM EYEWEAR</small></span>
            </a>

            <form class="search-box" id="searchForm">
                <span>⌕</span>
                <input type="search" id="searchInput" placeholder="Güneş gözlüğü, optik çerçeve, spor gözlük ara...">
                <button type="submit">→</button>
            </form>

            <div class="nav-actions">
                @auth <a class="icon-btn" href="{{ route('account') }}" aria-label="Hesabım">👤</a> @else <a
                    class="icon-btn" href="{{ route('login') }}" aria-label="Giriş">👤</a> @endauth
                <button class="icon-btn" id="cartOpen" aria-label="Sepet">
                    🛒
                    <span class="cart-count" id="cartCount">0</span>
                </button>
                <button class="mobile-btn" id="mobileBtn" aria-label="Menü">☰</button>
            </div>
        </div>
    </header>

    <nav class="category-nav">
        <div class="container category-nav-inner">
            <a href="#categories">Güneş Gözlüğü</a>
            <a href="#categories">Optik Çerçeve</a>
            <a href="#categories">Kadın</a>
            <a href="#categories">Erkek</a>
            <a href="#categories">Çocuk</a>
            <a href="#categories">Spor</a>
            <a href="#categories">Luxury</a>
            <a href="#products">Çok Satanlar</a>
        </div>
    </nav>

    <main>
        <section class="hero" id="home">
            <div class="container hero-grid">
                <div class="hero-content reveal">
                    <div class="eyebrow"><span class="dot"></span> Premium Optik E-Ticaret Deneyimi</div>
                    <h1>Gözlüğü sadece satma, <span>marka deneyimi</span> olarak sun.</h1>
                    <p>
                        Eymen Optik için modern, güven veren, kategori ve ürün odaklı e-ticaret arayüzü. Güneş gözlüğü,
                        optik çerçeve, luxury seri ve spor modeller için şık vitrin yapısı hazır.
                    </p>
                    <div class="hero-actions">
                        <a href="#products" class="btn btn-primary">Alışverişe Başla →</a>
                        <a href="#categories" class="btn btn-light">Kategorileri Gör</a>
                    </div>
                    <div class="trust-row">
                        <div class="trust-item"><b>350+</b><span>Ürün seçeneği</span></div>
                        <div class="trust-item"><b>%100</b><span>Orijinal ürün</span></div>
                        <div class="trust-item"><b>4.9</b><span>Müşteri memnuniyeti</span></div>
                    </div>
                </div>

                <div class="hero-visual reveal">
                    <div class="hero-card">
                        <img class="hero-product"
                            src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=1100&q=85"
                            alt="Premium gözlük modeli">
                        <div class="mini-product-card">
                            <div class="mini-img"><img
                                    src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=300&q=80"
                                    alt="Ürün"></div>
                            <div>
                                <h3>Eymen Royal Smoke</h3>
                                <span>UV400 • Polarize • Luxury</span>
                            </div>
                            <b>₺2.899</b>
                        </div>
                    </div>
                    <div class="floating-pill pill-1">✨ Yeni sezon</div>
                    <div class="floating-pill pill-2">🚚 Hızlı kargo</div>
                </div>
            </div>
        </section>

        <section class="section" id="categories">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <div class="eyebrow"><span class="dot"></span> Detaylı Kategori Vitrini</div>
                        <h2>Müşteriyi doğru ürüne hızlı götür</h2>
                    </div>
                    <p>Kategoriler artık sadece kutu değil; kampanya, kullanım amacı, hedef kitle ve ürün tipiyle daha
                        detaylı bir alışveriş akışı sunuyor.</p>
                </div>

                <div class="category-showcase">
                    <a class="cat-feature reveal" href="#products" data-filter-link="sun">
                        <div class="cat-bg"
                            style="background-image:url('https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1100&q=85')">
                        </div>
                        <div class="cat-content">
                            <span class="badge">En Çok İncelenen</span>
                            <h3>Güneş Gözlüğü</h3>
                            <p>UV400 korumalı, polarize ve yeni sezon güneş gözlüğü modelleri.</p>
                            <span class="btn btn-light">Ürünleri Gör</span>
                        </div>
                    </a>

                    <a class="cat-mini reveal" href="#products" data-filter-link="optic">
                        <div class="cat-bg"
                            style="background-image:url('https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=900&q=85')">
                        </div>
                        <div class="cat-content">
                            <span class="badge">Günlük Kullanım</span>
                            <h3>Optik Çerçeve</h3>
                            <p>Hafif, rahat ve modern optik çerçeveler.</p>
                        </div>
                    </a>

                    <a class="cat-mini reveal" href="#products" data-filter-link="luxury">
                        <div class="cat-bg"
                            style="background-image:url('https://images.unsplash.com/photo-1556306535-38febf6782e7?auto=format&fit=crop&w=900&q=85')">
                        </div>
                        <div class="cat-content">
                            <span class="badge">Premium Seri</span>
                            <h3>Luxury</h3>
                            <p>Özel tasarım ve iddialı premium koleksiyon.</p>
                        </div>
                    </a>
                </div>

                <div class="category-list">
                    <a href="#products" class="category-chip reveal"
                        data-filter-link="women"><span>👩</span><b>Kadın</b><small>64 ürün</small></a>
                    <a href="#products" class="category-chip reveal"
                        data-filter-link="men"><span>👨</span><b>Erkek</b><small>72 ürün</small></a>
                    <a href="#products" class="category-chip reveal"
                        data-filter-link="kids"><span>🧒</span><b>Çocuk</b><small>28 ürün</small></a>
                    <a href="#products" class="category-chip reveal"
                        data-filter-link="sport"><span>🏃</span><b>Spor</b><small>36 ürün</small></a>
                    <a href="#products" class="category-chip reveal"
                        data-filter-link="polarized"><span>🛡️</span><b>Polarize</b><small>48 ürün</small></a>
                    <a href="#products" class="category-chip reveal" data-filter-link="new"><span>✨</span><b>Yeni
                            Sezon</b><small>42 ürün</small></a>
                </div>
            </div>
        </section>

        <section class="section" id="campaign">
            <div class="container">
                <div class="campaign reveal">
                    <div class="campaign-grid">
                        <div>
                            <h2>Yeni sezon optik koleksiyonunda özel fırsatlar</h2>
                            <p>Bu alanı kampanya duyuruları, marka lansmanı, ücretsiz kargo, taksit seçenekleri veya
                                mağazaya özel indirimler için kullanabilirsiniz.</p>
                            <div class="campaign-cards">
                                <div class="campaign-card"><b>UV400</b><span>Koruma özellikli modeller</span></div>
                                <div class="campaign-card"><b>Polarize</b><span>Seçili ürünlerde</span></div>
                                <div class="campaign-card"><b>2. Ürüne</b><span>Ek indirim alanı</span></div>
                            </div>
                        </div>
                        <div class="discount-circle"><span><b>%35</b> Sezon indirimi</span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="products">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <div class="eyebrow"><span class="dot"></span> Ürün Kataloğu</div>
                        <h2>Detaylı ürün listesi</h2>
                    </div>
                    <p>Sol filtre paneli, kategori kırılımları, ürün özellikleri, fiyat ve sepete ekleme sistemi örnek
                        olarak hazırlandı.</p>
                </div>

                <div class="shop-layout">
                    <aside class="sidebar reveal">
                        <div class="sidebar-block">
                            <h3>Kategoriler</h3>
                            <div class="filter-list">
                                <button class="filter-btn active" data-filter="all">Tüm Ürünler <span>12</span></button>
                                <button class="filter-btn" data-filter="sun">Güneş Gözlüğü <span>4</span></button>
                                <button class="filter-btn" data-filter="optic">Optik Çerçeve <span>3</span></button>
                                <button class="filter-btn" data-filter="luxury">Luxury Seri <span>2</span></button>
                                <button class="filter-btn" data-filter="sport">Spor Gözlük <span>2</span></button>
                                <button class="filter-btn" data-filter="kids">Çocuk Gözlük <span>1</span></button>
                            </div>
                        </div>

                        <div class="sidebar-block">
                            <h3>Özellikler</h3>
                            <label class="check-row"><input type="checkbox"> UV400 koruma</label>
                            <label class="check-row"><input type="checkbox"> Polarize cam</label>
                            <label class="check-row"><input type="checkbox"> Hafif çerçeve</label>
                            <label class="check-row"><input type="checkbox"> Yeni sezon</label>
                        </div>

                        <div class="sidebar-block">
                            <h3>Renkler</h3>
                            <div class="color-row">
                                <span class="color-dot" style="background:#111827"></span>
                                <span class="color-dot" style="background:#8b5a2b"></span>
                                <span class="color-dot" style="background:#d1b067"></span>
                                <span class="color-dot" style="background:#cbd5e1"></span>
                                <span class="color-dot" style="background:#234b8c"></span>
                            </div>
                        </div>
                    </aside>

                    <div>
                        <div class="toolbar reveal">
                            <div>
                                <b id="productResult">12 ürün listeleniyor</b><br>
                                <span>Arama ve kategori filtresine göre ürünler güncellenir.</span>
                            </div>
                            <select id="sortSelect">
                                <option value="default">Varsayılan sıralama</option>
                                <option value="priceAsc">Fiyat: Artan</option>
                                <option value="priceDesc">Fiyat: Azalan</option>
                                <option value="nameAsc">İsim: A-Z</option>
                            </select>
                        </div>

                        <div class="product-grid" id="productGrid">
                            <article class="product-card reveal" data-category="sun" data-name="Eymen Milano Black"
                                data-price="1249">
                                <span class="product-label">Yeni</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Milano Black"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Güneş Gözlüğü</span><span
                                            class="rating">★★★★★</span></div>
                                    <h3>Eymen Milano Black</h3>
                                    <p class="product-desc">Siyah premium çerçeve, UV400 koruma ve günlük kullanıma
                                        uygun modern form.</p>
                                    <div class="specs"><span>UV400</span><span>Polarize</span><span>Unisex</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.249</span><span class="old-price">₺1.649</span>
                                        </div><button class="add-cart" data-name="Eymen Milano Black" data-price="1249"
                                            data-img="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="optic" data-name="Eymen Classic Frame"
                                data-price="899">
                                <span class="product-label">Popüler</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Classic Frame"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Optik Çerçeve</span><span
                                            class="rating">★★★★★</span></div>
                                    <h3>Eymen Classic Frame</h3>
                                    <p class="product-desc">Hafif çerçeve yapısı ve sade çizgisiyle günlük kullanıma
                                        uygun optik model.</p>
                                    <div class="specs"><span>Hafif</span><span>Mat</span><span>Günlük</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺899</span><span class="old-price">₺1.199</span></div>
                                        <button class="add-cart" data-name="Eymen Classic Frame" data-price="899"
                                            data-img="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="luxury" data-name="Eymen Gold Edition"
                                data-price="2499">
                                <span class="product-label">Luxury</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1556306535-38febf6782e7?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Gold Edition"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Luxury Seri</span><span class="rating">★★★★★</span>
                                    </div>
                                    <h3>Eymen Gold Edition</h3>
                                    <p class="product-desc">Gold detaylı özel seri, şık kutu sunumu ve premium tasarım
                                        hissi.</p>
                                    <div class="specs"><span>Gold</span><span>Premium</span><span>Özel seri</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺2.499</span><span class="old-price">₺3.199</span>
                                        </div><button class="add-cart" data-name="Eymen Gold Edition" data-price="2499"
                                            data-img="https://images.unsplash.com/photo-1556306535-38febf6782e7?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="sport" data-name="Eymen Active Sport"
                                data-price="1599">
                                <span class="product-label">Spor</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Active Sport"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Spor Gözlük</span><span class="rating">★★★★☆</span>
                                    </div>
                                    <h3>Eymen Active Sport</h3>
                                    <p class="product-desc">Aktif kullanım için dayanıklı, konforlu ve hafif spor gözlük
                                        modeli.</p>
                                    <div class="specs"><span>Spor</span><span>Dayanıklı</span><span>Hafif</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.599</span><span class="old-price">₺1.999</span>
                                        </div><button class="add-cart" data-name="Eymen Active Sport" data-price="1599"
                                            data-img="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="sun" data-name="Eymen Retro Brown"
                                data-price="1349">
                                <span class="product-label">Trend</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1582142407894-ec85a1260a46?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Retro Brown"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Güneş Gözlüğü</span><span
                                            class="rating">★★★★★</span></div>
                                    <h3>Eymen Retro Brown</h3>
                                    <p class="product-desc">Kahverengi tonlarda retro form, şehir stiline uygun premium
                                        model.</p>
                                    <div class="specs"><span>Retro</span><span>UV400</span><span>Kahve</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.349</span><span class="old-price">₺1.749</span>
                                        </div><button class="add-cart" data-name="Eymen Retro Brown" data-price="1349"
                                            data-img="https://images.unsplash.com/photo-1582142407894-ec85a1260a46?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="optic" data-name="Eymen Clear Vision"
                                data-price="949">
                                <span class="product-label">Minimal</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1591076482161-42ce6da69f67?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Clear Vision"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Optik Çerçeve</span><span
                                            class="rating">★★★★☆</span></div>
                                    <h3>Eymen Clear Vision</h3>
                                    <p class="product-desc">Şeffaf çerçeve görünümü, minimal tarz ve rahat kullanım
                                        odaklı yapı.</p>
                                    <div class="specs"><span>Şeffaf</span><span>Minimal</span><span>Hafif</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺949</span><span class="old-price">₺1.249</span></div>
                                        <button class="add-cart" data-name="Eymen Clear Vision" data-price="949"
                                            data-img="https://images.unsplash.com/photo-1591076482161-42ce6da69f67?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="luxury" data-name="Eymen Royal Smoke"
                                data-price="2899">
                                <span class="product-label">Premium</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Royal Smoke"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Luxury Seri</span><span class="rating">★★★★★</span>
                                    </div>
                                    <h3>Eymen Royal Smoke</h3>
                                    <p class="product-desc">Duman camlı, güçlü karakterli ve premium vitrine uygun özel
                                        ürün.</p>
                                    <div class="specs"><span>Duman cam</span><span>Luxury</span><span>Unisex</span>
                                    </div>
                                    <div class="price-row">
                                        <div><span class="price">₺2.899</span><span class="old-price">₺3.499</span>
                                        </div><button class="add-cart" data-name="Eymen Royal Smoke" data-price="2899"
                                            data-img="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="sport" data-name="Eymen Runner Pro"
                                data-price="1799">
                                <span class="product-label">Aktif</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1608539733292-190446b22b83?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Runner Pro"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Spor Gözlük</span><span class="rating">★★★★☆</span>
                                    </div>
                                    <h3>Eymen Runner Pro</h3>
                                    <p class="product-desc">Koşu, bisiklet ve açık hava aktiviteleri için dinamik spor
                                        model.</p>
                                    <div class="specs"><span>Outdoor</span><span>Konfor</span><span>Esnek</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.799</span><span class="old-price">₺2.249</span>
                                        </div><button class="add-cart" data-name="Eymen Runner Pro" data-price="1799"
                                            data-img="https://images.unsplash.com/photo-1608539733292-190446b22b83?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="kids" data-name="Eymen Kids Soft"
                                data-price="699">
                                <span class="product-label">Çocuk</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1575428652377-a2d80e2277fc?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Kids Soft"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Çocuk Gözlük</span><span class="rating">★★★★★</span>
                                    </div>
                                    <h3>Eymen Kids Soft</h3>
                                    <p class="product-desc">Çocuklar için hafif, güvenli ve rahat kullanım sağlayan
                                        çerçeve.</p>
                                    <div class="specs"><span>Çocuk</span><span>Esnek</span><span>Hafif</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺699</span><span class="old-price">₺899</span></div>
                                        <button class="add-cart" data-name="Eymen Kids Soft" data-price="699"
                                            data-img="https://images.unsplash.com/photo-1575428652377-a2d80e2277fc?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="sun" data-name="Eymen Blue Ocean"
                                data-price="1499">
                                <span class="product-label">Polarize</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1556015048-4d3aa10df74c?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Blue Ocean"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Güneş Gözlüğü</span><span
                                            class="rating">★★★★☆</span></div>
                                    <h3>Eymen Blue Ocean</h3>
                                    <p class="product-desc">Mavi cam etkisiyle sportif ve şehirli kullanıma uygun
                                        polarize model.</p>
                                    <div class="specs"><span>Polarize</span><span>Mavi cam</span><span>UV400</span>
                                    </div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.499</span><span class="old-price">₺1.899</span>
                                        </div><button class="add-cart" data-name="Eymen Blue Ocean" data-price="1499"
                                            data-img="https://images.unsplash.com/photo-1556015048-4d3aa10df74c?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="optic" data-name="Eymen Office Line"
                                data-price="1099">
                                <span class="product-label">Ofis</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1556306535-abccb8ed9e5e?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Office Line"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Optik Çerçeve</span><span
                                            class="rating">★★★★★</span></div>
                                    <h3>Eymen Office Line</h3>
                                    <p class="product-desc">Ofis ve ekran kullanımı için sade, profesyonel ve konforlu
                                        çerçeve.</p>
                                    <div class="specs"><span>Ofis</span><span>Konfor</span><span>Modern</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.099</span><span class="old-price">₺1.399</span>
                                        </div><button class="add-cart" data-name="Eymen Office Line" data-price="1099"
                                            data-img="https://images.unsplash.com/photo-1556306535-abccb8ed9e5e?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>

                            <article class="product-card reveal" data-category="sun" data-name="Eymen Urban Silver"
                                data-price="1699">
                                <span class="product-label">Yeni</span>
                                <div class="product-top-actions"><button class="small-action">♡</button><button
                                        class="small-action">↗</button></div>
                                <div class="product-media"><img
                                        src="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80"
                                        alt="Eymen Urban Silver"></div>
                                <div class="product-body">
                                    <div class="product-meta"><span>Güneş Gözlüğü</span><span
                                            class="rating">★★★★☆</span></div>
                                    <h3>Eymen Urban Silver</h3>
                                    <p class="product-desc">Metalik detaylı şehir stili, güçlü duruş ve modern cam
                                        tasarımı.</p>
                                    <div class="specs"><span>Metalik</span><span>UV400</span><span>Şehir</span></div>
                                    <div class="price-row">
                                        <div><span class="price">₺1.699</span><span class="old-price">₺2.099</span>
                                        </div><button class="add-cart" data-name="Eymen Urban Silver" data-price="1699"
                                            data-img="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80">+</button>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container lookbook">
                <div class="lookbook-card reveal">
                    <img src="https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=900&q=85"
                        alt="Lookbook">
                    <div class="lookbook-content">
                        <h3>Sezon Lookbook</h3>
                        <p>Markaya daha premium hava katmak için editorial görsel alanı.</p>
                        <a href="#products" class="btn btn-primary">Koleksiyonu İncele</a>
                    </div>
                </div>
                <div class="lookbook-card reveal">
                    <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1100&q=85"
                        alt="Optik moda">
                    <div class="lookbook-content">
                        <h3>Tarzına Uygun Modeli Bul</h3>
                        <p>Yüz şekli, kullanım amacı ve stil tercihine göre doğru gözlük yönlendirmesi yapılabilir.</p>
                        <a href="#categories" class="btn btn-light">Kategori Seç</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container features">
                <div class="feature reveal">
                    <div class="feature-icon">🚚</div><b>Hızlı Kargo</b><span>Siparişlerinizi güvenli paketleme ve hızlı
                        teslimat mesajıyla sunun.</span>
                </div>
                <div class="feature reveal">
                    <div class="feature-icon">✅</div><b>Orijinal Ürün</b><span>Garanti, kalite ve güven algısını ürün
                        sayfasında destekleyin.</span>
                </div>
                <div class="feature reveal">
                    <div class="feature-icon">💬</div><b>WhatsApp Destek</b><span>Müşteri sorularını satışa dönüştürecek
                        hızlı iletişim alanı.</span>
                </div>
                <div class="feature reveal">
                    <div class="feature-icon">🔒</div><b>Güvenli Alışveriş</b><span>Ödeme, iade ve sipariş süreçlerinde
                        güven veren yapı.</span>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container newsletter reveal">
                <div>
                    <h2>Yeni koleksiyon ve kampanyalardan haberdar olun</h2>
                    <p>E-posta kayıt alanı ile müşterileri tekrar alışverişe yönlendirecek kampanya iletişimi
                        oluşturabilirsiniz.</p>
                </div>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" placeholder="E-posta adresiniz" required>
                    <button class="btn btn-primary" type="submit">Kayıt Ol</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3>Eymen Optik</h3>
                    <p>Premium gözlük satışı için modern, kategori odaklı ve dönüşüm hedefli e-ticaret arayüzü.</p>
                </div>
                <div>
                    <h3>Kategoriler</h3>
                    <a href="#products">Güneş Gözlüğü</a>
                    <a href="#products">Optik Çerçeve</a>
                    <a href="#products">Luxury Seri</a>
                </div>
                <div>
                    <h3>Mağaza</h3>
                    <a href="#campaign">Kampanyalar</a>
                    <a href="#products">Çok Satanlar</a>
                    <a href="#categories">Yeni Sezon</a>
                </div>
                <div>
                    <h3>Destek</h3>
                    <a href="#">Sipariş Takibi</a>
                    <a href="#">İade Politikası</a>
                    <a href="#">Sık Sorulanlar</a>
                </div>
                <div>
                    <h3>İletişim</h3>
                    <p>0555 000 00 00</p>
                    <p>info@eymenoptik.com</p>
                    <p>Sivas / Merkez</p>
                </div>
            </div>
            <div class="copyright">
                <span>© 2026 Eymen Optik. Tüm hakları saklıdır.</span>
                <span>Website Template by MK Digital</span>
            </div>
        </div>
    </footer>

    <div class="overlay" id="overlay"></div>

    <aside class="cart-drawer" id="cartDrawer">
        <div class="cart-head">
            <h3>Sepetim</h3>
            <button class="icon-btn" id="cartClose">×</button>
        </div>
        <div class="cart-items" id="cartItems">
            <p class="cart-empty">Sepetiniz şu an boş. Ürünlerden birini sepete ekleyebilirsiniz.</p>
        </div>
        <div class="cart-total">
            <div class="cart-total-row">
                <span>Toplam</span>
                <span id="cartTotal">₺0</span>
            </div>
            <button class="btn btn-primary" style="width:100%;">Ödemeye Geç</button>
        </div>
    </aside>

    <script>
        const mobileBtn = document.getElementById('mobileBtn');
        const cartOpen = document.getElementById('cartOpen');
        const cartClose = document.getElementById('cartClose');
        const cartDrawer = document.getElementById('cartDrawer');
        const overlay = document.getElementById('overlay');
        const cartCount = document.getElementById('cartCount');
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        const addCartButtons = document.querySelectorAll('.add-cart');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const productGrid = document.getElementById('productGrid');
        const productCards = Array.from(document.querySelectorAll('.product-card'));
        const productResult = document.getElementById('productResult');
        const sortSelect = document.getElementById('sortSelect');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const newsletterForm = document.getElementById('newsletterForm');
        const reveals = document.querySelectorAll('.reveal');

        let cart = [];
        let activeFilter = 'all';
        let activeSearch = '';

        mobileBtn.addEventListener('click', () => {
            const nav = document.querySelector('.category-nav');
            nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
        });

        function openCart() {
            cartDrawer.classList.add('active');
            overlay.classList.add('active');
        }

        function closeCart() {
            cartDrawer.classList.remove('active');
            overlay.classList.remove('active');
        }

        cartOpen.addEventListener('click', openCart);
        cartClose.addEventListener('click', closeCart);
        overlay.addEventListener('click', closeCart);

        addCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                cart.push({
                    name: button.dataset.name,
                    price: Number(button.dataset.price),
                    img: button.dataset.img
                });
                updateCart();
                openCart();
            });
        });

        function updateCart() {
            cartCount.textContent = cart.length;

            if (cart.length === 0) {
                cartItems.innerHTML =
                    '<p class="cart-empty">Sepetiniz şu an boş. Ürünlerden birini sepete ekleyebilirsiniz.</p>';
                cartTotal.textContent = '₺0';
                return;
            }

            cartItems.innerHTML = cart.map((item, index) => `
                <div class="cart-item">
                    <div class="cart-thumb"><img src="${item.img}" alt="${item.name}"></div>
                    <div>
                        <b>${item.name}</b>
                        <span>₺${item.price.toLocaleString('tr-TR')}</span>
                    </div>
                    <button class="remove-item" onclick="removeCartItem(${index})">×</button>
                </div>
            `).join('');

            const total = cart.reduce((sum, item) => sum + item.price, 0);
            cartTotal.textContent = '₺' + total.toLocaleString('tr-TR');
        }

        window.removeCartItem = function(index) {
            cart.splice(index, 1);
            updateCart();
        };

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                activeFilter = button.dataset.filter;
                applyProducts();
            });
        });

        document.querySelectorAll('[data-filter-link]').forEach(link => {
            link.addEventListener('click', () => {
                activeFilter = link.dataset.filterLink;
                filterButtons.forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.filter === activeFilter);
                });
                setTimeout(applyProducts, 150);
            });
        });

        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');
            applyProducts();
            document.getElementById('products').scrollIntoView({
                behavior: 'smooth'
            });
        });

        searchInput.addEventListener('input', () => {
            activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');
            applyProducts();
        });

        sortSelect.addEventListener('change', applyProducts);

        function applyProducts() {
            let visibleCards = productCards.filter(card => {
                const categoryMatch = activeFilter === 'all' || card.dataset.category === activeFilter;
                const searchMatch = !activeSearch || card.dataset.name.toLocaleLowerCase('tr-TR').includes(
                    activeSearch) || card.innerText.toLocaleLowerCase('tr-TR').includes(activeSearch);
                return categoryMatch && searchMatch;
            });

            const sort = sortSelect.value;
            visibleCards.sort((a, b) => {
                const priceA = Number(a.dataset.price);
                const priceB = Number(b.dataset.price);
                const nameA = a.dataset.name;
                const nameB = b.dataset.name;
                if (sort === 'priceAsc') return priceA - priceB;
                if (sort === 'priceDesc') return priceB - priceA;
                if (sort === 'nameAsc') return nameA.localeCompare(nameB, 'tr');
                return 0;
            });

            productCards.forEach(card => card.style.display = 'none');
            visibleCards.forEach(card => {
                card.style.display = 'block';
                productGrid.appendChild(card);
            });

            productResult.textContent = `${visibleCards.length} ürün listeleniyor`;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('show');
            });
        }, {
            threshold: 0.12
        });

        reveals.forEach(item => observer.observe(item));

        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Kayıt başarılı!');
            this.reset();
        });
    </script>
</body>

</html>