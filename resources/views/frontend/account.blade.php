<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eymen Optik | Hesabım</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f4f6fb;
            --dark: #07111f;
            --text: #1a2435;
            --muted: #707b8d;
            --white: #fff;
            --soft: #eef2f8;
            --line: rgba(7, 17, 31, .09);
            --gold: #c79a3a;
            --blue: #2854d9;
            --green: #16a36b;
            --red: #e33b3b;
            --shadow: 0 24px 70px rgba(7, 17, 31, .1);
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
                radial-gradient(circle at 0% 0%, rgba(40, 84, 217, .13), transparent 34%),
                radial-gradient(circle at 100% 4%, rgba(199, 154, 58, .18), transparent 30%),
                var(--bg);
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

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, .78);
            backdrop-filter: blur(26px);
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
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--dark), #223f67);
            color: white;
            font-weight: 950;
            box-shadow: 0 16px 32px rgba(7, 17, 31, .2);
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
            letter-spacing: 2.4px;
            font-weight: 900;
        }

        .search-box {
            width: min(500px, 100%);
            justify-self: center;
            background: white;
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 9px 12px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 10px;
            box-shadow: 0 14px 34px rgba(7, 17, 31, .05);
        }

        .search-box input {
            border: 0;
            outline: 0;
            min-width: 0;
            color: var(--dark);
            font-weight: 650;
        }

        .search-box button {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 12px;
            background: var(--dark);
            color: white;
            cursor: pointer;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-btn {
            width: 46px;
            height: 46px;
            border: 1px solid var(--line);
            background: white;
            border-radius: 17px;
            cursor: pointer;
            display: grid;
            place-items: center;
            position: relative;
            transition: .28s ease;
            font-weight: 900;
        }

        .icon-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 34px rgba(7, 17, 31, .1);
        }

        .count {
            position: absolute;
            top: -7px;
            right: -7px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--gold);
            color: white;
            border: 2px solid white;
            display: grid;
            place-items: center;
            font-size: 11px;
        }

        .user-chip {
            height: 46px;
            border: 1px solid var(--line);
            background: white;
            border-radius: 999px;
            padding: 5px 12px 5px 5px;
            display: flex;
            align-items: center;
            gap: 9px;
            cursor: pointer;
            transition: .28s ease;
            font-weight: 900;
            color: var(--dark);
        }

        .user-chip:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 34px rgba(7, 17, 31, .1);
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--gold));
            color: white;
            display: grid;
            place-items: center;
            font-size: 13px;
            font-weight: 950;
        }

        .page {
            padding: 34px 0 70px;
            flex: 1;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 22px;
            align-items: start;
        }

        .sidebar {
            position: sticky;
            top: 106px;
            background: rgba(255, 255, 255, .84);
            border: 1px solid var(--line);
            border-radius: 32px;
            padding: 18px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px);
        }

        .profile-card {
            padding: 18px;
            border-radius: 26px;
            background:
                radial-gradient(circle at 80% 0%, rgba(199, 154, 58, .25), transparent 32%),
                linear-gradient(135deg, var(--dark), #17375f);
            color: white;
            margin-bottom: 16px;
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .profile-card .avatar {
            width: 48px;
            height: 48px;
        }

        .profile-card b {
            display: block;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .profile-card span {
            color: rgba(255, 255, 255, .66);
            font-size: 12px;
            font-weight: 800;
        }

        .profile-card p {
            color: rgba(255, 255, 255, .72);
            line-height: 1.55;
            font-size: 13px;
        }

        .side-menu {
            display: grid;
            gap: 8px;
        }

        .side-menu a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 13px 14px;
            border-radius: 17px;
            color: #394456;
            font-weight: 850;
            font-size: 14px;
            transition: .25s ease;
        }

        .side-menu a.active,
        .side-menu a:hover {
            background: var(--dark);
            color: white;
        }

        .logout {
            margin-top: 14px;
            width: 100%;
            border: 0;
            background: #fff0f0;
            color: var(--red);
            border-radius: 18px;
            padding: 13px;
            font-weight: 950;
            cursor: pointer;
        }

        .welcome {
            border-radius: 38px;
            padding: 32px;
            background:
                radial-gradient(circle at 86% 0%, rgba(199, 154, 58, .28), transparent 34%),
                radial-gradient(circle at 20% 80%, rgba(40, 84, 217, .18), transparent 34%),
                rgba(255, 255, 255, .86);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 26px;
            align-items: center;
            margin-bottom: 22px;
            overflow: hidden;
            position: relative;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 13px;
            border-radius: 999px;
            background: white;
            border: 1px solid var(--line);
            color: var(--dark);
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 17px;
        }

        .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 0 7px rgba(22, 163, 107, .12);
        }

        .welcome h1 {
            color: var(--dark);
            font-size: clamp(34px, 4.5vw, 58px);
            line-height: 1;
            letter-spacing: -2.8px;
            margin-bottom: 14px;
        }

        .welcome h1 span {
            background: linear-gradient(135deg, var(--blue), var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome p {
            color: var(--muted);
            line-height: 1.75;
            max-width: 620px;
            margin-bottom: 22px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            border: 0;
            border-radius: 18px;
            padding: 14px 20px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 950;
            cursor: pointer;
            transition: .28s ease;
        }

        .btn-primary {
            background: var(--dark);
            color: white;
            box-shadow: 0 20px 44px rgba(7, 17, 31, .22);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
        }

        .btn-light {
            background: white;
            color: var(--dark);
            border: 1px solid var(--line);
        }

        .welcome-product {
            position: relative;
            min-height: 260px;
            border-radius: 30px;
            background: linear-gradient(180deg, #f8fafc, #e9eef7);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .8);
        }

        .welcome-product img {
            height: 100%;
            min-height: 260px;
            max-width: 100%;
            object-fit: cover;
            filter: drop-shadow(0 24px 26px rgba(7, 17, 31, .18));
        }

        .floating-badge {
            position: absolute;
            left: 18px;
            bottom: 18px;
            background: rgba(255, 255, 255, .82);
            border: 1px solid var(--line);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 13px 15px;
            box-shadow: 0 16px 38px rgba(7, 17, 31, .1);
        }

        .floating-badge b {
            display: block;
            color: var(--dark);
            margin-bottom: 3px;
        }

        .floating-badge span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 850;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: rgba(255, 255, 255, .84);
            border: 1px solid var(--line);
            border-radius: 26px;
            padding: 18px;
            box-shadow: 0 14px 38px rgba(7, 17, 31, .05);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 17px;
            background: var(--soft);
            display: grid;
            place-items: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .stat-card b {
            display: block;
            color: var(--dark);
            font-size: 25px;
            letter-spacing: -1.2px;
            margin-bottom: 4px;
        }

        .stat-card span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 22px;
            margin-bottom: 22px;
        }

        .panel {
            background: rgba(255, 255, 255, .84);
            border: 1px solid var(--line);
            border-radius: 32px;
            padding: 22px;
            box-shadow: 0 16px 44px rgba(7, 17, 31, .06);
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .panel-head h2 {
            color: var(--dark);
            font-size: 24px;
            letter-spacing: -1px;
        }

        .panel-head a {
            color: var(--blue);
            font-size: 13px;
            font-weight: 950;
        }

        .order-list {
            display: grid;
            gap: 12px;
        }

        .order-item {
            border: 1px solid var(--line);
            background: white;
            border-radius: 22px;
            padding: 14px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 13px;
            align-items: center;
        }

        .order-icon {
            width: 50px;
            height: 50px;
            border-radius: 18px;
            background: var(--soft);
            display: grid;
            place-items: center;
            font-size: 22px;
        }

        .order-item b {
            display: block;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .order-item span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 750;
        }

        .status {
            padding: 8px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 950;
            white-space: nowrap;
        }

        .status.green {
            background: rgba(22, 163, 107, .12);
            color: var(--green);
        }

        .status.gold {
            background: rgba(199, 154, 58, .14);
            color: #9b741d;
        }

        .status.blue {
            background: rgba(40, 84, 217, .12);
            color: var(--blue);
        }

        .coupon-card {
            min-height: 252px;
            border-radius: 28px;
            padding: 22px;
            background:
                radial-gradient(circle at 100% 0%, rgba(199, 154, 58, .32), transparent 34%),
                linear-gradient(135deg, var(--dark), #183b67);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }

        .coupon-card::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 50%;
            right: -90px;
            bottom: -90px;
        }

        .coupon-card h3 {
            position: relative;
            z-index: 2;
            font-size: 32px;
            letter-spacing: -1.6px;
            line-height: 1.05;
            margin-bottom: 10px;
        }

        .coupon-card p {
            position: relative;
            z-index: 2;
            color: rgba(255, 255, 255, .68);
            line-height: 1.6;
            font-size: 14px;
        }

        .coupon-code {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, .13);
            border: 1px dashed rgba(255, 255, 255, .32);
            border-radius: 18px;
            padding: 13px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-weight: 950;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin: 26px 0 18px;
        }

        .section-title h2 {
            color: var(--dark);
            font-size: 30px;
            letter-spacing: -1.4px;
        }

        .section-title p {
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        .category-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .category-card {
            background: rgba(255, 255, 255, .84);
            border: 1px solid var(--line);
            border-radius: 26px;
            padding: 17px;
            box-shadow: 0 14px 38px rgba(7, 17, 31, .05);
            transition: .28s ease;
        }

        .category-card:hover {
            background: var(--dark);
            color: white;
            transform: translateY(-6px);
        }

        .category-card .cat-icon {
            width: 48px;
            height: 48px;
            border-radius: 17px;
            background: var(--soft);
            display: grid;
            place-items: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .category-card:hover .cat-icon {
            background: rgba(255, 255, 255, .12);
        }

        .category-card b {
            display: block;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .category-card span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 850;
        }

        .category-card:hover span {
            color: rgba(255, 255, 255, .68);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .product-card {
            background: rgba(255, 255, 255, .86);
            border: 1px solid var(--line);
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 16px 42px rgba(7, 17, 31, .05);
            transition: .32s ease;
            display: flex;
            flex-direction: column;
            min-height: 400px;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 70px rgba(7, 17, 31, .12);
        }

        .product-label {
            position: absolute;
            top: 14px;
            left: 14px;
            z-index: 3;
            padding: 8px 11px;
            border-radius: 999px;
            background: var(--dark);
            color: white;
            font-size: 11px;
            font-weight: 950;
        }

        .heart {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 3;
            width: 38px;
            height: 38px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, .84);
            backdrop-filter: blur(12px);
            border-radius: 14px;
            cursor: pointer;
            transition: .25s ease;
        }

        .heart:hover,
        .heart.active {
            background: #fff0f5;
            color: #e11d48;
        }

        .product-img {
            height: 220px;
            background: linear-gradient(180deg, #f8fafc, #e9eef7);
            padding: 25px;
            overflow: hidden;
        }

        .product-img img {
            height: 100%;
            max-width: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 22px;
            filter: drop-shadow(0 18px 22px rgba(7, 17, 31, .15));
        }

        .product-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex: 1
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            color: var(--muted);
            font-size: 12px;
            font-weight: 850;
            margin-bottom: 8px;
        }

        .rating {
            color: var(--gold);
        }

        .product-body h3 {
            color: var(--dark);
            font-size: 17px;
            letter-spacing: -.5px;
            margin-bottom: 11px;
        }

        .specs {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
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
            gap: 10px;
            margin-top: auto;
        }

        .price {
            font-size: 22px;
            font-weight: 950;
            color: var(--dark);
            letter-spacing: -1px;
        }

        .add-cart {
            width: 46px;
            height: 46px;
            border: 0;
            border-radius: 16px;
            background: var(--dark);
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: .28s ease;
        }

        .add-cart:hover {
            background: var(--gold);
            transform: rotate(8deg) scale(1.06);
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

        .cart-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            font-size: 13px;
            font-weight: 850;
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

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: .68s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 1120px) {
            .search-box {
                display: none;
            }

            .nav-inner {
                grid-template-columns: auto auto;
                justify-content: space-between;
            }

            .dashboard-grid,
            .welcome,
            .content-grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .side-menu {
                grid-template-columns: repeat(3, 1fr);
            }

            .stats-grid,
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .category-row {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 680px) {
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
                display: none;
            }

            .user-chip span {
                display: none;
            }

            .page {
                padding-top: 22px;
            }

            .welcome {
                padding: 23px;
                border-radius: 30px;
            }

            .welcome h1 {
                letter-spacing: -2px;
            }

            .side-menu,
            .stats-grid,
            .category-row,
            .product-grid {
                grid-template-columns: 1fr;
            }

            .panel {
                border-radius: 28px;
                padding: 18px;
            }

            .order-item {
                grid-template-columns: auto 1fr;
            }

            .order-item .status {
                grid-column: 1 / -1;
                width: max-content;
            }

            .section-title {
                display: block;
            }

            .section-title p {
                margin-top: 7px;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="container nav-inner">
            <a href="#" class="brand">
                <span class="brand-mark">EO</span>
                <span class="brand-title">Eymen Optik<small>PREMIUM EYEWEAR</small></span>
            </a>

            <form class="search-box" id="searchForm">
                <span>⌕</span>
                <input type="search" id="searchInput" placeholder="Gözlük, optik çerçeve, kampanya ara...">
                <button type="submit">→</button>
            </form>

            <div class="nav-actions">
                <button class="icon-btn" aria-label="Favoriler">♡<span class="count" id="favCount">3</span></button>
                <button class="icon-btn" id="cartOpen" aria-label="Sepet">🛒<span class="count" id="cartCount">0</span></button>
                <button class="user-chip" type="button"><span class="avatar">{{ mb_substr(auth()->user()->name,0,1) }}</span><span>{{ auth()->user()->name }}</span></button>
            </div>
        </div>
    </header>

    <main class="page">
        <div class="container dashboard-grid">
            <aside class="sidebar reveal">
                <div class="profile-card">
                    <div class="profile-top">
                        <span class="avatar">{{ mb_substr(auth()->user()->name,0,1) }}</span>
                        <div>
                            <b>Merhaba, {{ auth()->user()->name }}</b>
                            <span>Premium Üye</span>
                        </div>
                    </div>
                    <p>Favorilerini, siparişlerini ve sana özel kampanyaları buradan yönetebilirsin.</p>
                </div>

                <nav class="side-menu">
                    <a href="#overview" class="active">Genel Bakış <span>→</span></a>
                    <a href="#orders">Siparişlerim <span>3</span></a>
                    <a href="#favorites">Favorilerim <span>3</span></a>
                    <a href="#products">Alışveriş <span>12</span></a>
                    <a href="#coupon">Kuponlarım <span>1</span></a>
                    <a href="#settings">Hesap Ayarları <span>→</span></a>
                </nav>

                <form method="POST" action="{{ route('logout') }}">@csrf<button class="logout" type="submit">Çıkış Yap</button></form>
            </aside>

            <section>
                <div class="welcome reveal" id="overview">
                    <div>
                        <div class="eyebrow"><span class="dot"></span> Giriş Başarılı</div>
                        <h1>Hoş geldin {{ auth()->user()->name }}, <span>alışverişe devam edelim.</span></h1>
                        <p>Senin için seçilen yeni sezon gözlükleri, favorilerini ve devam eden siparişlerini tek ekranda topladık.</p>
                        <div class="hero-actions">
                            <a href="#products" class="btn btn-primary">Ürünleri İncele →</a>
                            <a href="#orders" class="btn btn-light">Siparişlerime Git</a>
                        </div>
                    </div>

                    <div class="welcome-product">
                        <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=900&q=85" alt="Yeni sezon gözlük">
                        <div class="floating-badge">
                            <b>Yeni sezon önerisi</b>
                            <span>Royal Smoke • ₺2.899</span>
                        </div>
                    </div>
                </div>

                <div class="stats-grid reveal">
                    <div class="stat-card">
                        <div class="stat-icon">📦</div><b>3</b><span>Aktif sipariş</span>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">♡</div><b>3</b><span>Favori ürün</span>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🎁</div><b>1</b><span>Aktif kupon</span>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🛒</div><b id="miniCartCount">0</b><span>Sepette ürün</span>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="panel reveal" id="orders">
                        <div class="panel-head">
                            <h2>Son Siparişler</h2>
                            <a href="#">Tümünü Gör</a>
                        </div>

                        <div class="order-list">
                            <div class="order-item">
                                <div class="order-icon">🕶️</div>
                                <div>
                                    <b>#EO-1024 • Milano Black</b>
                                    <span>12 Mayıs 2026 • ₺1.249</span>
                                </div>
                                <span class="status green">Teslim edildi</span>
                            </div>
                            <div class="order-item">
                                <div class="order-icon">👓</div>
                                <div>
                                    <b>#EO-1025 • Classic Frame</b>
                                    <span>15 Mayıs 2026 • ₺899</span>
                                </div>
                                <span class="status blue">Kargoda</span>
                            </div>
                            <div class="order-item">
                                <div class="order-icon">✨</div>
                                <div>
                                    <b>#EO-1026 • Gold Edition</b>
                                    <span>17 Mayıs 2026 • ₺2.499</span>
                                </div>
                                <span class="status gold">Hazırlanıyor</span>
                            </div>
                        </div>
                    </div>

                    <div class="panel reveal" id="coupon">
                        <div class="panel-head">
                            <h2>Kuponum</h2>
                            <a href="#">Detay</a>
                        </div>

                        <div class="coupon-card">
                            <div>
                                <h3>%15 ekstra indirim</h3>
                                <p>Yeni sezon seçili gözlüklerde kullanılabilir özel üye kuponu.</p>
                            </div>
                            <div class="coupon-code">
                                <span>EYEMEN15</span>
                                <span>Kopyala</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-title reveal">
                    <div>
                        <h2>Kategoriler</h2>
                        <p>Hızlıca kategori seçip alışverişe devam et.</p>
                    </div>
                </div>

                <div class="category-row reveal">
                    <a href="#products" class="category-card">
                        <div class="cat-icon">🕶️</div><b>Güneş Gözlüğü</b><span>64 ürün</span>
                    </a>
                    <a href="#products" class="category-card">
                        <div class="cat-icon">👓</div><b>Optik Çerçeve</b><span>48 ürün</span>
                    </a>
                    <a href="#products" class="category-card">
                        <div class="cat-icon">✨</div><b>Luxury Seri</b><span>22 ürün</span>
                    </a>
                    <a href="#products" class="category-card">
                        <div class="cat-icon">🏃</div><b>Spor</b><span>36 ürün</span>
                    </a>
                    <a href="#products" class="category-card">
                        <div class="cat-icon">🧒</div><b>Çocuk</b><span>18 ürün</span>
                    </a>
                </div>

                <div class="section-title reveal" id="products">
                    <div>
                        <h2>Sana Özel Öneriler</h2>
                        <p>Giriş yapan kullanıcı için önerilen ürün alanı.</p>
                    </div>
                </div>

                <div class="product-grid" id="productGrid">
                    <article class="product-card reveal" data-name="Eymen Royal Smoke">
                        <span class="product-label">Önerilen</span>
                        <button class="heart active">♡</button>
                        <div class="product-img"><img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=700&q=80" alt="Eymen Royal Smoke"></div>
                        <div class="product-body">
                            <div class="product-meta"><span>Luxury Seri</span><span class="rating">★★★★★</span></div>
                            <h3>Eymen Royal Smoke</h3>
                            <div class="specs"><span>UV400</span><span>Luxury</span><span>Unisex</span></div>
                            <div class="price-row"><span class="price">₺2.899</span><button class="add-cart" data-name="Eymen Royal Smoke" data-price="2899" data-img="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=700&q=80">+</button></div>
                        </div>
                    </article>

                    <article class="product-card reveal" data-name="Eymen Milano Black">
                        <span class="product-label">Yeni</span>
                        <button class="heart active">♡</button>
                        <div class="product-img"><img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80" alt="Eymen Milano Black"></div>
                        <div class="product-body">
                            <div class="product-meta"><span>Güneş Gözlüğü</span><span class="rating">★★★★★</span></div>
                            <h3>Eymen Milano Black</h3>
                            <div class="specs"><span>Polarize</span><span>UV400</span><span>Siyah</span></div>
                            <div class="price-row"><span class="price">₺1.249</span><button class="add-cart" data-name="Eymen Milano Black" data-price="1249" data-img="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80">+</button></div>
                        </div>
                    </article>

                    <article class="product-card reveal" data-name="Eymen Classic Frame">
                        <span class="product-label">Popüler</span>
                        <button class="heart">♡</button>
                        <div class="product-img"><img src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=700&q=80" alt="Eymen Classic Frame"></div>
                        <div class="product-body">
                            <div class="product-meta"><span>Optik Çerçeve</span><span class="rating">★★★★☆</span></div>
                            <h3>Eymen Classic Frame</h3>
                            <div class="specs"><span>Hafif</span><span>Mat</span><span>Günlük</span></div>
                            <div class="price-row"><span class="price">₺899</span><button class="add-cart" data-name="Eymen Classic Frame" data-price="899" data-img="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=700&q=80">+</button></div>
                        </div>
                    </article>

                    <article class="product-card reveal" data-name="Eymen Active Sport">
                        <span class="product-label">Spor</span>
                        <button class="heart">♡</button>
                        <div class="product-img"><img src="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80" alt="Eymen Active Sport"></div>
                        <div class="product-body">
                            <div class="product-meta"><span>Spor Gözlük</span><span class="rating">★★★★☆</span></div>
                            <h3>Eymen Active Sport</h3>
                            <div class="specs"><span>Spor</span><span>Dayanıklı</span><span>Konfor</span></div>
                            <div class="price-row"><span class="price">₺1.599</span><button class="add-cart" data-name="Eymen Active Sport" data-price="1599" data-img="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=700&q=80">+</button></div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </main>

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
        const cartOpen = document.getElementById('cartOpen');
        const cartClose = document.getElementById('cartClose');
        const cartDrawer = document.getElementById('cartDrawer');
        const overlay = document.getElementById('overlay');
        const cartCount = document.getElementById('cartCount');
        const miniCartCount = document.getElementById('miniCartCount');
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        const addCartButtons = document.querySelectorAll('.add-cart');
        const heartButtons = document.querySelectorAll('.heart');
        const favCount = document.getElementById('favCount');
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const productCards = document.querySelectorAll('.product-card');
        const reveals = document.querySelectorAll('.reveal');

        let cart = [];
        let favoriteCount = 3;

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
            miniCartCount.textContent = cart.length;

            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="cart-empty">Sepetiniz şu an boş. Ürünlerden birini sepete ekleyebilirsiniz.</p>';
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

        heartButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.toggle('active');
                favoriteCount += button.classList.contains('active') ? 1 : -1;
                favCount.textContent = favoriteCount;
            });
        });

        searchForm.addEventListener('submit', e => e.preventDefault());

        searchInput.addEventListener('input', () => {
            const value = searchInput.value.trim().toLocaleLowerCase('tr-TR');

            productCards.forEach(card => {
                const match = card.dataset.name.toLocaleLowerCase('tr-TR').includes(value) || card.innerText.toLocaleLowerCase('tr-TR').includes(value);
                card.style.display = match ? 'block' : 'none';
            });
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('show');
            });
        }, {
            threshold: 0.12
        });

        reveals.forEach(item => observer.observe(item));
    </script>
</body>

</html>