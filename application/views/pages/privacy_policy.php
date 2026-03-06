<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Side Desk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #5a67d8;
            --primary-darker: #4c51bf;
            --accent: #764ba2;
            --primary-light: #8b9cf7;
            --primary-lighter: #c3dafe;
            --primary-bg: #f8f9ff;
            --primary-bg-alt: #eef2ff;
            --primary-border: rgba(102, 126, 234, 0.12);
            --primary-border-hover: rgba(102, 126, 234, 0.35);
            --primary-shadow: rgba(102, 126, 234, 0.25);
            --primary-shadow-lg: rgba(102, 126, 234, 0.4);
            --primary-glow: rgba(102, 126, 234, 0.15);
            --text-dark: #1a202c;
            --text-medium: #4a5568;
            --text-light: #718096;
            --text-muted: #a0aec0;
            --bg-body: #f7f8fc;
            --bg-white: #ffffff;
            --border-color: #e2e8f0;
            --border-light: #edf2f7;
            --success: #48bb78;
            --success-bg: #f0fff4;
            --danger: #e53e3e;
            --warning: #f59e0b;
            --warning-bg: #fffbeb;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.18);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-smooth: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ===== Ambient Background ===== */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            right: -30%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.04) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -40%;
            left: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(118, 75, 162, 0.03) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* ===== Scroll Progress Bar ===== */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent), #e040fb);
            z-index: 1001;
            transition: width 0.08s linear;
            border-radius: 0 3px 3px 0;
            box-shadow: 0 0 20px var(--primary-shadow), 0 0 5px rgba(224, 64, 251, 0.3);
        }

        /* ===== Header ===== */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #5a67d8 30%, #764ba2 100%);
            color: white;
            padding: 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 30px rgba(102, 126, 234, 0.3), 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -100%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: headerOrb1 12s ease-in-out infinite;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -80%;
            left: -30%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: headerOrb2 10s ease-in-out infinite reverse;
        }

        @keyframes headerOrb1 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, 20px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 10px) scale(0.95);
            }
        }

        @keyframes headerOrb2 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(25px, -15px) scale(1.05);
            }
        }

        /* Header Particles */
        .header-particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .header-particles span {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particleFloat 6s ease-in-out infinite;
        }

        .header-particles span:nth-child(1) {
            left: 10%;
            top: 20%;
            animation-delay: 0s;
            animation-duration: 7s;
        }

        .header-particles span:nth-child(2) {
            left: 25%;
            top: 60%;
            animation-delay: 1s;
            animation-duration: 5s;
        }

        .header-particles span:nth-child(3) {
            left: 50%;
            top: 30%;
            animation-delay: 2s;
            animation-duration: 8s;
        }

        .header-particles span:nth-child(4) {
            left: 70%;
            top: 70%;
            animation-delay: 0.5s;
            animation-duration: 6s;
        }

        .header-particles span:nth-child(5) {
            left: 85%;
            top: 40%;
            animation-delay: 3s;
            animation-duration: 9s;
        }

        .header-particles span:nth-child(6) {
            left: 40%;
            top: 80%;
            animation-delay: 1.5s;
            animation-duration: 7s;
        }

        @keyframes particleFloat {

            0%,
            100% {
                transform: translateY(0) scale(1);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-15px) scale(1.5);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-8px) scale(1);
                opacity: 0.4;
            }

            75% {
                transform: translateY(-20px) scale(1.2);
                opacity: 0.5;
            }
        }

        .header-inner {
            position: relative;
            z-index: 2;
            padding: 26px 20px 22px;
        }

        .header .app-name {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            opacity: 0.9;
            margin-bottom: 8px;
            animation: fadeInDown 0.6s ease-out;
        }

        .header .app-name .brand-logo {
            height: 28px;
            filter: brightness(0) invert(1);
            opacity: 0.95;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.3px;
            animation: fadeInDown 0.6s ease-out 0.1s both;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .header h1 .emoji-icon {
            display: inline-block;
            animation: emojiWave 2s ease-in-out infinite;
            transform-origin: 70% 70%;
        }

        @keyframes emojiWave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            15% {
                transform: rotate(14deg);
            }

            30% {
                transform: rotate(-8deg);
            }

            40% {
                transform: rotate(14deg);
            }

            50% {
                transform: rotate(-4deg);
            }

            60% {
                transform: rotate(10deg);
            }

            70%,
            100% {
                transform: rotate(0deg);
            }
        }

        .header .last-updated {
            font-size: 11px;
            opacity: 0.8;
            margin-top: 8px;
            font-weight: 400;
            animation: fadeInDown 0.6s ease-out 0.2s both;
            letter-spacing: 0.3px;
        }

        .header .last-updated .material-symbols-outlined {
            font-size: 13px;
            vertical-align: middle;
            margin-right: 3px;
            animation: spin 3s linear infinite;
        }

        .header .last-updated.loaded .material-symbols-outlined {
            animation: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Header Pills */
        .header-pills {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 14px;
            flex-wrap: wrap;
            animation: fadeInDown 0.6s ease-out 0.3s both;
        }

        .header-pill {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 50px;
            padding: 6px 16px;
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all var(--transition-smooth);
            cursor: default;
            letter-spacing: 0.2px;
        }

        .header-pill:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .header-pill .material-symbols-outlined {
            font-size: 14px;
        }

        .header-pill .pill-dot {
            width: 6px;
            height: 6px;
            background: #48bb78;
            border-radius: 50%;
            animation: pulseDot 2s ease-in-out infinite;
            box-shadow: 0 0 6px rgba(72, 187, 120, 0.5);
        }

        @keyframes pulseDot {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.4);
                opacity: 0.7;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Loading Skeleton ===== */
        .loading-container {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .skeleton-container {
            max-width: 860px;
            margin: 0 auto;
            padding: 28px 16px 40px;
        }

        .skeleton-summary {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .skeleton-summary .skeleton-circle {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            flex-shrink: 0;
        }

        .skeleton-summary .skeleton-lines {
            flex: 1;
        }

        .skeleton-card {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            padding: 36px 30px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f2f5 25%, #e8eaef 37%, #f0f2f5 63%);
            background-size: 400% 100%;
            animation: shimmer 1.4s ease infinite;
            border-radius: var(--radius-sm);
            display: block;
        }

        .skeleton-title {
            height: 26px;
            width: 55%;
            margin-bottom: 22px;
            border-radius: 10px;
        }

        .skeleton-line {
            height: 14px;
            margin-bottom: 14px;
            border-radius: 6px;
        }

        .skeleton-divider {
            height: 3px;
            width: 50px;
            margin: 30px 0 22px;
            background: linear-gradient(90deg, var(--primary-lighter), transparent);
            border-radius: 2px;
        }

        @keyframes shimmer {
            0% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* ===== Content Container ===== */
        .content-container {
            max-width: 860px;
            margin: 0 auto;
            padding: 28px 16px 40px;
            position: relative;
            z-index: 1;
        }

        .content-container>* {
            animation: slideUp 0.5s ease-out both;
        }

        .content-container>*:nth-child(1) {
            animation-delay: 0.05s;
        }

        .content-container>*:nth-child(2) {
            animation-delay: 0.12s;
        }

        .content-container>*:nth-child(3) {
            animation-delay: 0.19s;
        }

        .content-container>*:nth-child(4) {
            animation-delay: 0.26s;
        }

        .content-container>*:nth-child(5) {
            animation-delay: 0.33s;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Summary Card ===== */
        .summary-card {
            background: linear-gradient(135deg, var(--primary-bg) 0%, var(--primary-bg-alt) 100%);
            border-radius: var(--radius-lg);
            padding: 22px 26px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border: 1px solid var(--primary-border);
            border-left: 5px solid var(--primary);
            position: relative;
            overflow: hidden;
            transition: all var(--transition-smooth);
        }

        .summary-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .summary-card:hover {
            border-color: var(--primary-border-hover);
            box-shadow: 0 4px 20px var(--primary-glow);
        }

        .summary-icon-wrap {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 14px var(--primary-shadow);
        }

        .summary-icon-wrap .material-symbols-outlined {
            color: #fff;
            font-size: 22px;
        }

        .summary-card p {
            font-size: 13.5px;
            color: var(--text-medium);
            line-height: 1.75;
            font-weight: 400;
            position: relative;
            z-index: 1;
        }

        .summary-card strong {
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ===== Quick Stats ===== */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .stat-card {
            background: var(--bg-white);
            border-radius: var(--radius-md);
            padding: 18px;
            text-align: center;
            border: 1px solid var(--border-light);
            transition: all var(--transition-smooth);
            cursor: default;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            opacity: 0;
            transition: opacity var(--transition-smooth);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-border-hover);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .stat-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-bg), var(--primary-bg-alt));
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            border: 1px solid var(--primary-border);
        }

        .stat-card .stat-icon .material-symbols-outlined {
            font-size: 20px;
            color: var(--primary);
        }

        .stat-card .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
            background: linear-gradient(135deg, var(--primary-dark), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-card .stat-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 4px;
        }

        /* ===== Table of Contents Card ===== */
        .toc-card {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            padding: 0;
            margin-bottom: 18px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-light);
            transition: all var(--transition-smooth);
            overflow: hidden;
        }

        .toc-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .toc-header {
            padding: 22px 26px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
            transition: background var(--transition-fast);
        }

        .toc-header:hover {
            background: var(--primary-bg);
        }

        .toc-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toc-card h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .toc-card h3 .icon-box {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px var(--primary-shadow);
        }

        .toc-card h3 .icon-box .material-symbols-outlined {
            font-size: 18px;
            color: #fff;
        }

        .toc-toggle {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-bg);
            border: 1px solid var(--primary-border);
            transition: all var(--transition-smooth);
        }

        .toc-toggle .material-symbols-outlined {
            font-size: 20px;
            color: var(--primary);
            transition: transform var(--transition-smooth);
        }

        .toc-card.collapsed .toc-toggle .material-symbols-outlined {
            transform: rotate(180deg);
        }

        .toc-body {
            padding: 0 26px 22px;
            max-height: 500px;
            overflow: hidden;
            transition: all var(--transition-smooth);
        }

        .toc-card.collapsed .toc-body {
            max-height: 0;
            padding-bottom: 0;
        }

        .toc-badge {
            background: linear-gradient(135deg, var(--primary-bg), var(--primary-bg-alt));
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 50px;
            border: 1px solid var(--primary-border);
        }

        .toc-list {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px;
        }

        .toc-list li a {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            border-radius: 11px;
            color: var(--text-medium);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all var(--transition-smooth);
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .toc-list li a::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-bg), var(--primary-bg-alt));
            opacity: 0;
            transition: opacity var(--transition-fast);
            border-radius: 11px;
        }

        .toc-list li a:hover::before {
            opacity: 1;
        }

        .toc-list li a:hover {
            color: var(--primary-dark);
            transform: translateX(4px);
        }

        .toc-list li a>* {
            position: relative;
            z-index: 1;
        }

        .toc-list li a .toc-num {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #f7f8fc 0%, var(--border-light) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--primary);
            flex-shrink: 0;
            transition: all var(--transition-smooth);
            border: 1px solid transparent;
        }

        .toc-list li a:hover .toc-num {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            box-shadow: 0 4px 12px var(--primary-shadow);
            transform: scale(1.05);
        }

        .toc-list li a .toc-arrow {
            margin-left: auto;
            opacity: 0;
            transform: translateX(-5px);
            transition: all var(--transition-smooth);
            font-size: 16px;
            color: var(--primary);
        }

        .toc-list li a:hover .toc-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        /* ===== Main Content Card ===== */
        .content {
            background: var(--bg-white);
            border-radius: var(--radius-xl);
            padding: 40px 34px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-light);
            transition: all var(--transition-smooth);
            position: relative;
        }

        .content:hover {
            box-shadow: 0 10px 45px rgba(0, 0, 0, 0.1);
        }

        .content::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary), var(--accent), var(--primary-light));
            border-radius: 4px 0 0 4px;
            opacity: 0.5;
        }

        .content h2 {
            color: var(--text-dark);
            font-size: 18px;
            font-weight: 800;
            margin: 40px 0 16px 0;
            padding: 16px 0 14px 0;
            border-bottom: none;
            position: relative;
            display: flex;
            align-items: center;
            gap: 14px;
            scroll-margin-top: 110px;
            letter-spacing: -0.2px;
        }

        .content h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 52px;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 2px;
            transition: width var(--transition-smooth);
        }

        .content h2:hover::after {
            width: 70px;
        }

        .content h2:first-child {
            margin-top: 0;
        }

        .content h2 .section-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary-bg), var(--primary-bg-alt));
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid var(--primary-border);
            transition: all var(--transition-smooth);
        }

        .content h2:hover .section-icon {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-color: transparent;
            box-shadow: 0 4px 14px var(--primary-shadow);
        }

        .content h2 .section-icon .material-symbols-outlined {
            font-size: 19px;
            color: var(--primary);
            transition: color var(--transition-fast);
        }

        .content h2:hover .section-icon .material-symbols-outlined {
            color: #fff;
        }

        .content h2 .anchor-link {
            opacity: 0;
            margin-left: auto;
            font-size: 14px;
            color: var(--text-muted);
            cursor: pointer;
            transition: all var(--transition-smooth);
            padding: 4px;
            border-radius: 6px;
        }

        .content h2:hover .anchor-link {
            opacity: 1;
        }

        .content h2 .anchor-link:hover {
            color: var(--primary);
            background: var(--primary-bg);
        }

        .content p {
            color: var(--text-medium);
            font-size: 14.5px;
            margin-bottom: 16px;
            text-align: justify;
            line-height: 1.85;
            letter-spacing: 0.01em;
        }

        .content ul,
        .content ol {
            margin: 14px 0 20px 8px;
            color: var(--text-medium);
            padding-left: 0;
            list-style: none;
        }

        .content ul li,
        .content ol li {
            font-size: 14px;
            margin-bottom: 8px;
            padding: 12px 16px 12px 44px;
            position: relative;
            background: linear-gradient(135deg, var(--primary-bg), rgba(238, 242, 255, 0.5));
            border-radius: 12px;
            border: 1px solid var(--primary-border);
            line-height: 1.75;
            transition: all var(--transition-smooth);
        }

        .content ul li:hover,
        .content ol li:hover {
            background: var(--primary-bg-alt);
            border-color: var(--primary-border-hover);
            transform: translateX(6px);
            box-shadow: 0 4px 15px var(--primary-glow);
        }

        .content ul li::before {
            content: '';
            position: absolute;
            left: 18px;
            top: 18px;
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.12);
            transition: all var(--transition-smooth);
        }

        .content ul li:hover::before {
            box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.2);
            transform: scale(1.2);
        }

        .content strong {
            color: var(--text-dark);
            font-weight: 700;
        }

        .content a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            border-bottom: 2px solid rgba(102, 126, 234, 0.3);
            transition: all var(--transition-fast);
            padding-bottom: 1px;
        }

        .content a:hover {
            color: var(--primary-dark);
            border-bottom-color: var(--primary);
            background: rgba(102, 126, 234, 0.06);
            padding: 0 2px 1px;
            border-radius: 2px;
        }

        .content .highlight-box {
            background: linear-gradient(135deg, #FFFBEB, #FFF8E1);
            border-left: 4px solid #F59E0B;
            border-radius: 0 14px 14px 0;
            padding: 18px 22px;
            margin: 18px 0;
            font-size: 13.5px;
            color: #92400E;
            line-height: 1.75;
            position: relative;
            overflow: hidden;
        }

        .content .highlight-box::before {
            content: '⚠️';
            position: absolute;
            top: 14px;
            right: 16px;
            font-size: 20px;
            opacity: 0.3;
        }

        /* Active section highlight */
        .content h2.active-section .section-icon {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-color: transparent;
            box-shadow: 0 4px 14px var(--primary-shadow);
        }

        .content h2.active-section .section-icon .material-symbols-outlined {
            color: #fff;
        }

        /* ===== Contact Section ===== */
        .contact-section {
            background: var(--bg-white);
            border-radius: var(--radius-xl);
            padding: 32px;
            margin-top: 18px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-light);
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.04) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .contact-section:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .contact-section h3 {
            color: var(--text-dark);
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .contact-section h3 .icon-box {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px var(--primary-shadow);
            position: relative;
        }

        .contact-section h3 .icon-box::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            opacity: 0.2;
            animation: iconPulse 2s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.2;
            }

            50% {
                transform: scale(1.15);
                opacity: 0;
            }
        }

        .contact-section h3 .icon-box .material-symbols-outlined {
            font-size: 22px;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .contact-card {
            display: flex;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, var(--primary-bg), var(--primary-bg-alt));
            border-radius: 16px;
            gap: 16px;
            transition: all var(--transition-smooth);
            cursor: pointer;
            border: 1px solid var(--primary-border);
            position: relative;
            overflow: hidden;
        }

        .contact-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            opacity: 0;
            transition: opacity var(--transition-smooth);
            border-radius: 16px;
        }

        .contact-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px var(--primary-shadow);
            border-color: transparent;
        }

        .contact-card:hover::after {
            opacity: 0.05;
        }

        .contact-card:active {
            transform: translateY(-2px);
        }

        .contact-card>* {
            position: relative;
            z-index: 1;
        }

        .contact-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 6px 18px var(--primary-shadow);
            transition: all var(--transition-smooth);
        }

        .contact-card:hover .contact-icon {
            transform: scale(1.08) rotate(-5deg);
            box-shadow: 0 8px 25px var(--primary-shadow-lg);
        }

        .contact-icon .material-symbols-outlined {
            font-size: 24px;
        }

        .contact-info {
            min-width: 0;
        }

        .contact-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .contact-value {
            font-size: 14px;
            color: var(--text-dark);
            font-weight: 700;
            word-break: break-all;
            letter-spacing: 0.2px;
        }

        .contact-card .contact-arrow {
            margin-left: auto;
            opacity: 0;
            transform: translateX(-8px);
            transition: all var(--transition-smooth);
        }

        .contact-card .contact-arrow .material-symbols-outlined {
            font-size: 18px;
            color: var(--primary);
        }

        .contact-card:hover .contact-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        /* ===== Error ===== */
        .error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 65vh;
            padding: 30px;
            text-align: center;
            animation: fadeIn 0.4s ease-out;
        }

        .error-graphic {
            width: 130px;
            height: 130px;
            background: linear-gradient(135deg, #FFF5F5, #FED7D7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            animation: errorFloat 3s ease-in-out infinite;
            position: relative;
            box-shadow: 0 10px 30px rgba(229, 62, 62, 0.1);
        }

        .error-graphic::after {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px dashed rgba(229, 62, 62, 0.2);
            animation: spin 10s linear infinite;
        }

        @keyframes errorFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .error-graphic .material-symbols-outlined {
            font-size: 52px;
            color: var(--danger);
        }

        .error-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }

        .error-message {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 32px;
            max-width: 340px;
            line-height: 1.75;
        }

        .retry-btn {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 6px 20px var(--primary-shadow);
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
        }

        .retry-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .retry-btn:hover::before {
            left: 100%;
        }

        .retry-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px var(--primary-shadow-lg);
        }

        .retry-btn:active {
            transform: translateY(-1px);
        }

        .retry-btn .material-symbols-outlined {
            font-size: 20px;
        }

        /* ===== Back to Top ===== */
        .back-to-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px var(--primary-shadow);
            transition: all var(--transition-bounce);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.8);
            z-index: 50;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .back-to-top:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 14px 35px var(--primary-shadow-lg);
        }

        .back-to-top:active {
            transform: translateY(-2px) scale(1);
        }

        .back-to-top .material-symbols-outlined {
            font-size: 26px;
            transition: transform var(--transition-smooth);
        }

        .back-to-top:hover .material-symbols-outlined {
            transform: translateY(-2px);
        }

        /* Reading Indicator */
        .reading-indicator {
            position: fixed;
            bottom: 88px;
            right: 28px;
            background: var(--bg-white);
            border-radius: 12px;
            padding: 8px 14px;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-light);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all var(--transition-smooth);
            z-index: 49;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .reading-indicator.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .reading-indicator .material-symbols-outlined {
            font-size: 14px;
            color: var(--primary);
        }

        /* Tooltip */
        .tooltip {
            position: fixed;
            background: var(--text-dark);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            pointer-events: none;
            opacity: 0;
            transition: opacity var(--transition-fast);
            z-index: 200;
            white-space: nowrap;
        }

        .tooltip.show {
            opacity: 1;
        }

        /* ===== Footer ===== */
        .footer {
            text-align: center;
            padding: 36px 20px;
            color: var(--text-muted);
            font-size: 12px;
            border-top: 1px solid var(--border-light);
            background: var(--bg-white);
            margin-top: 10px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 0 0 3px 3px;
        }

        .footer p {
            letter-spacing: 0.3px;
        }

        .footer-brand {
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-links {
            margin-top: 14px;
            display: flex;
            justify-content: center;
            gap: 28px;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all var(--transition-smooth);
            position: relative;
            letter-spacing: 0.2px;
        }

        .footer-links a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transition: width var(--transition-smooth);
            border-radius: 2px;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .footer-links a:hover::after {
            width: 100%;
        }

        .footer-made-with {
            margin-top: 12px;
            font-size: 11px;
            color: var(--text-muted);
        }

        .footer-made-with .heart {
            color: #e53e3e;
            animation: heartBeat 1.5s ease-in-out infinite;
            display: inline-block;
        }

        @keyframes heartBeat {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        /* ===== Hidden ===== */
        .hidden {
            display: none !important;
        }

        /* ===== Focus Styles ===== */
        *:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
            border-radius: 4px;
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .quick-stats {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .stat-card {
                padding: 14px 10px;
            }

            .stat-card .stat-value {
                font-size: 18px;
            }
        }

        @media (max-width: 600px) {
            .header-inner {
                padding: 18px 16px 16px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content-container,
            .skeleton-container {
                padding: 16px 12px 30px;
            }

            .content {
                padding: 28px 20px;
                border-radius: var(--radius-lg);
            }

            .toc-list {
                grid-template-columns: 1fr;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .summary-card {
                flex-direction: column;
                gap: 12px;
            }

            .content h2 {
                font-size: 16px;
            }

            .back-to-top {
                bottom: 18px;
                right: 18px;
                width: 46px;
                height: 46px;
                border-radius: 13px;
            }

            .reading-indicator {
                bottom: 72px;
                right: 18px;
            }

            .header-pills {
                display: none;
            }

            .quick-stats {
                grid-template-columns: repeat(3, 1fr);
                gap: 6px;
            }

            .stat-card {
                padding: 12px 6px;
            }

            .stat-card .stat-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
            }

            .stat-card .stat-icon .material-symbols-outlined {
                font-size: 16px;
            }

            .stat-card .stat-value {
                font-size: 16px;
            }

            .stat-card .stat-label {
                font-size: 9px;
            }

            .contact-section {
                padding: 24px 20px;
            }

            .footer-links {
                gap: 18px;
            }
        }

        /* ===== Custom Scrollbar ===== */
        ::-webkit-scrollbar {
            width: 7px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-body);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-lighter), var(--primary-light));
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        /* ===== Selection ===== */
        ::selection {
            background: rgba(102, 126, 234, 0.18);
            color: var(--text-dark);
        }

        /* ===== Print ===== */
        @media print {
            .header {
                position: static;
                box-shadow: none;
            }

            .scroll-progress,
            .back-to-top,
            .header-pills,
            .header-particles,
            .reading-indicator,
            .toc-toggle,
            .anchor-link {
                display: none !important;
            }

            .content,
            .toc-card,
            .contact-section {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            body::before,
            body::after {
                display: none;
            }
        }

        /* ===== Reduced Motion ===== */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>

    <!-- Scroll Progress -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Tooltip -->
    <div class="tooltip" id="tooltip"></div>

    <!-- Header -->
    <div class="header">
        <div class="header-particles">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>
        <div class="header-inner">
            <div class="app-name">
                <img src="<?= base_url('assets/images/main_logo.png') ?>" class="brand-logo" alt="Main Logo">
            </div>
            <h1><span class="emoji-icon">🔒</span> Privacy Policy</h1>
            <div class="last-updated" id="lastUpdated">
                <span class="material-symbols-outlined">schedule</span>
                Loading...
            </div>
            <div class="header-pills">
                <div class="header-pill">
                    <span class="pill-dot"></span>
                    <span class="material-symbols-outlined">verified</span>
                    GDPR Compliant
                </div>
                <div class="header-pill">
                    <span class="material-symbols-outlined">shield</span>
                    Data Protected
                </div>
                <div class="header-pill">
                    <span class="material-symbols-outlined">visibility_off</span>
                    Your Privacy Matters
                </div>
            </div>
        </div>
    </div>

    <!-- Loading with Skeleton -->
    <div id="loadingContainer" class="loading-container">
        <div class="skeleton-container">
            <div class="skeleton-summary">
                <div class="skeleton skeleton-circle"></div>
                <div class="skeleton-lines" style="flex:1">
                    <div class="skeleton skeleton-line" style="width:80%"></div>
                    <div class="skeleton skeleton-line" style="width:60%"></div>
                </div>
            </div>
            <div class="skeleton-card">
                <div class="skeleton skeleton-title"></div>
                <div class="skeleton skeleton-line" style="width:100%"></div>
                <div class="skeleton skeleton-line" style="width:92%"></div>
                <div class="skeleton skeleton-line" style="width:85%"></div>
                <div class="skeleton skeleton-line" style="width:60%"></div>
                <div class="skeleton-divider"></div>
                <div class="skeleton skeleton-title" style="width:45%; margin-top:8px;"></div>
                <div class="skeleton skeleton-line" style="width:100%"></div>
                <div class="skeleton skeleton-line" style="width:88%"></div>
                <div class="skeleton skeleton-line" style="width:95%"></div>
                <div class="skeleton skeleton-line" style="width:72%"></div>
                <div class="skeleton-divider"></div>
                <div class="skeleton skeleton-title" style="width:52%; margin-top:8px;"></div>
                <div class="skeleton skeleton-line" style="width:100%"></div>
                <div class="skeleton skeleton-line" style="width:80%"></div>
                <div class="skeleton skeleton-line" style="width:90%"></div>
                <div class="skeleton skeleton-line" style="width:65%"></div>
            </div>
        </div>
    </div>

    <!-- Error -->
    <div class="error-container hidden" id="errorContainer">
        <div class="error-graphic">
            <span class="material-symbols-outlined">cloud_off</span>
        </div>
        <div class="error-title">Oops! Something went wrong</div>
        <p class="error-message" id="errorMessage">
            Failed to load content. Please check your connection and try again.
        </p>
        <button class="retry-btn" onclick="fetchPrivacy()">
            <span class="material-symbols-outlined">refresh</span>
            Try Again
        </button>
    </div>

    <!-- Content -->
    <div class="content-container hidden" id="contentContainer">

        <!-- Summary Card -->
        <div class="summary-card">
            <div class="summary-icon-wrap">
                <span class="material-symbols-outlined">privacy_tip</span>
            </div>
            <p>
                <strong>Your privacy is important to us.</strong> This Privacy Policy explains how Side Desk collects,
                uses, discloses, and safeguards your information when you use our platform. Please read this policy
                carefully to understand our practices.
            </p>
        </div>

        <!-- Quick Stats -->
        <div class="quick-stats" id="quickStats">
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="material-symbols-outlined">article</span>
                </div>
                <div class="stat-value" id="sectionCount">—</div>
                <div class="stat-label">Sections</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="material-symbols-outlined">timer</span>
                </div>
                <div class="stat-value" id="readTime">—</div>
                <div class="stat-label">Min Read</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <span class="material-symbols-outlined">update</span>
                </div>
                <div class="stat-value" id="lastUpdateShort">—</div>
                <div class="stat-label">Updated</div>
            </div>
        </div>

        <!-- Table of Contents -->
        <div class="toc-card" id="tocCard">
            <div class="toc-header" onclick="toggleTOC()">
                <div class="toc-header-left">
                    <h3>
                        <span class="icon-box">
                            <span class="material-symbols-outlined">list_alt</span>
                        </span>
                        Table of Contents
                    </h3>
                    <span class="toc-badge" id="tocBadge">0 sections</span>
                </div>
                <div class="toc-toggle">
                    <span class="material-symbols-outlined">expand_less</span>
                </div>
            </div>
            <div class="toc-body">
                <ul class="toc-list" id="tocList">
                    <!-- Dynamically populated -->
                </ul>
            </div>
        </div>

        <!-- Privacy Content -->
        <div class="content" id="termsContent">
            <!-- Content will be loaded here -->
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h3>
                <span class="icon-box">
                    <span class="material-symbols-outlined">support_agent</span>
                </span>
                Privacy Concerns? Contact Us
            </h3>
            <div class="contact-grid">
                <div class="contact-card" id="emailCard" role="button" tabindex="0" aria-label="Send email">
                    <div class="contact-icon">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div class="contact-info">
                        <div class="contact-label">Email</div>
                        <div class="contact-value" id="contactEmail">—</div>
                    </div>
                    <div class="contact-arrow">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </div>
                </div>
                <div class="contact-card" id="phoneCard" role="button" tabindex="0" aria-label="Call phone">
                    <div class="contact-icon">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div class="contact-info">
                        <div class="contact-label">Phone</div>
                        <div class="contact-value" id="contactPhone">—</div>
                    </div>
                    <div class="contact-arrow">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reading Indicator -->
    <div class="reading-indicator" id="readingIndicator">
        <span class="material-symbols-outlined">visibility</span>
        <span id="readingPercent">0%</span> read
    </div>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" onclick="scrollToTop()" aria-label="Back to top">
        <span class="material-symbols-outlined">keyboard_arrow_up</span>
    </button>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 <span class="footer-brand">Side Desk</span>. All rights reserved.</p>
        <!-- <div class="footer-links">
            <a href="<?= base_url('pages/terms_conditions') ?>">Terms & Condition</a>
            <a href="<?= base_url('pages/delete_account') ?>">Delete Account</a>
        </div> -->
        <div class="footer-made-with">
            Made with <span class="heart">❤️</span> for your privacy
        </div>
    </div>

    <script>
        // ================= API URL =================
        const API_URL = "http://localhost/kaushik/realestate/api/privacy_policy";

        // ================= DOM ELEMENTS =================
        const loadingContainer = document.getElementById('loadingContainer');
        const errorContainer = document.getElementById('errorContainer');
        const contentContainer = document.getElementById('contentContainer');
        const termsContent = document.getElementById('termsContent');
        const lastUpdated = document.getElementById('lastUpdated');
        const errorMessage = document.getElementById('errorMessage');
        const contactEmail = document.getElementById('contactEmail');
        const contactPhone = document.getElementById('contactPhone');
        const scrollProgress = document.getElementById('scrollProgress');
        const backToTopBtn = document.getElementById('backToTop');
        const tocList = document.getElementById('tocList');
        const tocCard = document.getElementById('tocCard');
        const tocBadge = document.getElementById('tocBadge');
        const readingIndicator = document.getElementById('readingIndicator');
        const readingPercent = document.getElementById('readingPercent');
        const tooltip = document.getElementById('tooltip');

        // ================= UI FUNCTIONS =================
        function showLoading() {
            loadingContainer.classList.remove('hidden');
            errorContainer.classList.add('hidden');
            contentContainer.classList.add('hidden');
        }

        function showError(message) {
            loadingContainer.classList.add('hidden');
            errorContainer.classList.remove('hidden');
            contentContainer.classList.add('hidden');
            errorMessage.textContent = message;
        }

        function showContent() {
            loadingContainer.classList.add('hidden');
            errorContainer.classList.add('hidden');
            contentContainer.classList.remove('hidden');
        }

        // ================= SECTION ICONS =================
        const sectionIcons = [
            'privacy_tip', 'database', 'share', 'cookie',
            'security', 'shield', 'visibility_off', 'lock',
            'verified_user', 'admin_panel_settings', 'manage_accounts',
            'policy', 'gavel', 'contact_support', 'update',
            'child_care', 'language', 'dns'
        ];

        function getSectionIcon(index) {
            return sectionIcons[index % sectionIcons.length];
        }

        // ================= TOC TOGGLE =================
        function toggleTOC() {
            tocCard.classList.toggle('collapsed');
        }

        // ================= READING TIME =================
        function calculateReadTime(text) {
            const wordsPerMinute = 200;
            const words = text.trim().split(/\s+/).length;
            return Math.ceil(words / wordsPerMinute);
        }

        // ================= TOOLTIP =================
        function showTooltip(event, text) {
            tooltip.textContent = text;
            tooltip.style.left = event.clientX + 'px';
            tooltip.style.top = (event.clientY - 40) + 'px';
            tooltip.classList.add('show');
            setTimeout(() => {
                tooltip.classList.remove('show');
            }, 1500);
        }

        // ================= TABLE OF CONTENTS =================
        function buildTOC() {
            const headings = termsContent.querySelectorAll('h2');

            if (headings.length === 0) {
                tocCard.classList.add('hidden');
                return;
            }

            // Update stats
            document.getElementById('sectionCount').textContent = headings.length;
            tocBadge.textContent = headings.length + ' sections';

            // Calculate read time
            const readTime = calculateReadTime(termsContent.textContent);
            document.getElementById('readTime').textContent = readTime;

            tocList.innerHTML = '';

            headings.forEach((heading, index) => {
                const id = "section-" + (index + 1);
                heading.setAttribute("id", id);

                // Add icon
                const iconSpan = document.createElement("span");
                iconSpan.className = "section-icon";
                iconSpan.innerHTML = `<span class="material-symbols-outlined">${getSectionIcon(index)}</span>`;
                heading.insertBefore(iconSpan, heading.firstChild);

                // Add anchor link
                const anchorLink = document.createElement('span');
                anchorLink.className = 'anchor-link';
                anchorLink.innerHTML = '<span class="material-symbols-outlined">link</span>';
                anchorLink.title = 'Copy link to section';
                anchorLink.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const url = window.location.href.split('#')[0] + '#' + id;
                    navigator.clipboard.writeText(url).then(() => {
                        showTooltip(e, 'Link copied!');
                    });
                });
                heading.appendChild(anchorLink);

                // Create TOC item
                const li = document.createElement("li");
                const a = document.createElement("a");
                a.href = "#" + id;
                a.innerHTML = `<span class="toc-num">${String(index + 1).padStart(2, '0')}</span><span class="toc-text">${heading.textContent}</span><span class="toc-arrow"><span class="material-symbols-outlined">chevron_right</span></span>`;

                a.addEventListener("click", function(e) {
                    e.preventDefault();
                    const target = document.getElementById(id);
                    if (target) {
                        const headerHeight = document.querySelector('.header').offsetHeight;
                        const position = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 24;
                        window.scrollTo({
                            top: position,
                            behavior: "smooth"
                        });
                    }
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });
        }

        // ================= ACTIVE SECTION TRACKING =================
        function updateActiveSection() {
            const headings = termsContent.querySelectorAll('h2');
            const headerHeight = document.querySelector('.header').offsetHeight;

            headings.forEach(heading => heading.classList.remove('active-section'));

            let activeHeading = null;
            headings.forEach(heading => {
                const rect = heading.getBoundingClientRect();
                if (rect.top <= headerHeight + 100) {
                    activeHeading = heading;
                }
            });

            if (activeHeading) {
                activeHeading.classList.add('active-section');
            }
        }

        // ================= SCROLL EVENTS =================
        let ticking = false;
        window.addEventListener("scroll", () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

                    if (scrollHeight > 0) {
                        const progress = Math.min((scrollTop / scrollHeight) * 100, 100);
                        scrollProgress.style.width = progress + "%";
                        readingPercent.textContent = Math.round(progress) + '%';
                    }

                    if (scrollTop > 400) {
                        backToTopBtn.classList.add("visible");
                        readingIndicator.classList.add("visible");
                    } else {
                        backToTopBtn.classList.remove("visible");
                        readingIndicator.classList.remove("visible");
                    }

                    updateActiveSection();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // ================= BACK TO TOP =================
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }

        // ================= CONTACT CLICK =================
        function handleContactClick(element, prefix) {
            element.addEventListener('click', function() {
                const valueEl = this.querySelector('.contact-value');
                const value = valueEl.textContent;
                if (value && value !== '—') {
                    window.location.href = prefix + value;
                }
            });
            element.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        }

        handleContactClick(document.getElementById('emailCard'), 'mailto:');
        handleContactClick(document.getElementById('phoneCard'), 'tel:');

        // ================= FETCH PRIVACY POLICY =================
        async function fetchPrivacy() {
            showLoading();

            try {
                const response = await fetch(API_URL);

                if (!response.ok) {
                    throw new Error("Server error : " + response.status);
                }

                const result = await response.json();
                console.log("API RESPONSE :", result);

                if (result.status === true && result.data) {
                    const data = result.data;

                    // Last updated
                    if (data.last_updated) {
                        lastUpdated.innerHTML =
                            '<span class="material-symbols-outlined">schedule</span> Last Updated: ' + data.last_updated;
                        lastUpdated.classList.add('loaded');

                        // Short date for stats
                        try {
                            const dateObj = new Date(data.last_updated);
                            const shortDate = dateObj.toLocaleDateString('en-US', {
                                month: 'short',
                                year: '2-digit'
                            });
                            document.getElementById('lastUpdateShort').textContent = shortDate;
                        } catch (e) {
                            document.getElementById('lastUpdateShort').textContent = data.last_updated.substring(0, 6);
                        }
                    }

                    // Content
                    if (data.content) {
                        termsContent.innerHTML = data.content;
                    }

                    // Contact
                    if (data.contact) {
                        contactEmail.innerText = data.contact.email || "—";
                        contactPhone.innerText = data.contact.phone || "—";
                    }

                    // Build TOC
                    buildTOC();
                    showContent();

                    // Check for hash in URL
                    if (window.location.hash) {
                        setTimeout(() => {
                            const target = document.querySelector(window.location.hash);
                            if (target) {
                                const headerHeight = document.querySelector('.header').offsetHeight;
                                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 24;
                                window.scrollTo({
                                    top: targetPosition,
                                    behavior: 'smooth'
                                });
                            }
                        }, 500);
                    }

                } else {
                    showError("Failed to load Privacy Policy");
                }

            } catch (error) {
                console.error("Fetch Error:", error);
                showError("Network error. Please check your internet connection.");
            }
        }

        // ================= INIT =================
        document.addEventListener("DOMContentLoaded", fetchPrivacy);
    </script>
</body>

</html>