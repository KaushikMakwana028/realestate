<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">
    <title>Delete Account - Site Desk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F8F9FC;
            color: #333;
            line-height: 1.7;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Subtle Background Pattern */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            background-image: 
                radial-gradient(circle at 20% 20%, rgba(211, 47, 47, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 152, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(33, 150, 243, 0.02) 0%, transparent 50%);
        }

        .bg-dots {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, #e0e0e0 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.4;
        }

        /* Header */
        .header {
            position: relative;
            z-index: 10;
            background: linear-gradient(135deg, #C62828 0%, #D32F2F 40%, #E53935 100%);
            color: white;
            padding: 45px 20px 60px;
            text-align: center;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header .app-name {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 18px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .header .app-name img {
            max-height: 42px;
            filter: brightness(0) invert(1);
        }

        .header h1 {
            font-size: 30px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }

        .header-icon {
            font-size: 38px;
            display: inline-block;
            animation: iconPulse 2.5s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.12) rotate(-5deg); }
        }

        .header-subtitle {
            margin-top: 14px;
            font-size: 15px;
            opacity: 0.85;
            font-weight: 300;
            letter-spacing: 0.3px;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            color: white;
            padding: 6px 16px;
            border-radius: 25px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: 1px solid rgba(255,255,255,0.25);
            margin-top: 18px;
        }

        .badge .dot {
            width: 7px;
            height: 7px;
            background: #FFCDD2;
            border-radius: 50%;
            animation: blink 1.5s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* Wave Separator */
        .wave-separator {
            position: relative;
            z-index: 10;
            margin-top: -2px;
        }

        .wave-separator svg {
            display: block;
            width: 100%;
        }

        /* Main Container */
        .main-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 10px 20px 30px;
            position: relative;
            z-index: 5;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 15px 0 20px;
            font-size: 13px;
            color: #999;
        }

        .breadcrumb a {
            color: #D32F2F;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #B71C1C;
        }

        .breadcrumb .separator {
            color: #ccc;
        }

        /* Card Base */
        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06), 0 1px 5px rgba(0,0,0,0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1), 0 2px 10px rgba(0,0,0,0.05);
            transform: translateY(-3px);
        }

        /* Warning Banner */
        .warning-banner {
            background: linear-gradient(135deg, #FFF8E1 0%, #FFF3E0 50%, #FFE0B2 100%);
            border-left: 5px solid #FF9800;
            border-radius: 0 18px 18px 0;
            padding: 24px 28px;
            margin-bottom: 28px;
            display: flex;
            align-items: flex-start;
            gap: 18px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(255, 152, 0, 0.1);
            animation: slideInLeft 0.7s ease-out;
        }

        .warning-banner::after {
            content: '';
            position: absolute;
            top: -40%;
            right: -15%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(255, 152, 0, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .warning-icon {
            font-size: 34px;
            flex-shrink: 0;
            animation: shake 4s ease-in-out infinite;
        }

        @keyframes shake {
            0%, 100% { transform: rotate(0); }
            3% { transform: rotate(-18deg); }
            6% { transform: rotate(18deg); }
            9% { transform: rotate(-12deg); }
            12% { transform: rotate(12deg); }
            15% { transform: rotate(0); }
        }

        .warning-content h3 {
            color: #E65100;
            font-size: 17px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .warning-content p {
            color: #6D4C41;
            font-size: 14px;
            line-height: 1.7;
        }

        .warning-content p strong {
            color: #BF360C;
            font-weight: 700;
        }

        /* Info Card */
        .info-card {
            padding: 35px;
            margin-bottom: 28px;
        }

        .info-card h2 {
            color: #222;
            font-size: 24px;
            text-align: center;
            margin-bottom: 12px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .info-card .subtitle {
            text-align: center;
            color: #999;
            font-size: 14px;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 2px solid #f5f5f5;
        }

        /* Steps Container */
        .steps-container {
            position: relative;
        }

        .steps-container::before {
            content: '';
            position: absolute;
            left: 28px;
            top: 60px;
            bottom: 60px;
            width: 3px;
            background: linear-gradient(to bottom, #EF5350, #F44336, #E53935, #D32F2F);
            border-radius: 3px;
        }

        /* Animated dots on the line */
        .steps-container::after {
            content: '';
            position: absolute;
            left: 26px;
            width: 7px;
            height: 7px;
            background: #FF8A80;
            border-radius: 50%;
            animation: moveDot 3s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes moveDot {
            0% { top: 60px; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { top: calc(100% - 60px); opacity: 0; }
        }

        /* Step Item */
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 24px;
            position: relative;
        }

        .step-item:last-child {
            margin-bottom: 0;
        }

        /* Step Number */
        .step-number {
            width: 58px;
            height: 58px;
            background: linear-gradient(145deg, #D32F2F 0%, #EF5350 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 6px 25px rgba(211, 47, 47, 0.3), 0 2px 8px rgba(211, 47, 47, 0.2);
            position: relative;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .step-item:hover .step-number {
            transform: scale(1.12) rotate(8deg);
            box-shadow: 0 10px 35px rgba(211, 47, 47, 0.45);
        }

        .step-number::after {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            border: 2px solid rgba(211, 47, 47, 0.2);
            animation: pulseRing 2.5s ease-out infinite;
        }

        @keyframes pulseRing {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.5); opacity: 0; }
        }

        .step-item:nth-child(1) .step-number::after { animation-delay: 0s; }
        .step-item:nth-child(2) .step-number::after { animation-delay: 0.6s; }
        .step-item:nth-child(3) .step-number::after { animation-delay: 1.2s; }
        .step-item:nth-child(4) .step-number::after { animation-delay: 1.8s; }

        /* Step Content */
        .step-content {
            flex: 1;
            background: linear-gradient(135deg, #FAFAFA 0%, #F5F5F5 100%);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #EEEEEE;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .step-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #D32F2F, #FF5252, #D32F2F);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .step-item:hover .step-content::before {
            transform: scaleX(1);
        }

        .step-content:hover {
            border-color: #FFCDD2;
            background: linear-gradient(135deg, #FFF5F5 0%, #FFEBEE 100%);
            box-shadow: 0 8px 30px rgba(211, 47, 47, 0.08);
            transform: translateX(6px);
        }

        .step-content h3 {
            color: #C62828;
            font-size: 17px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .step-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
        }

        .step-content p strong {
            color: #D32F2F;
            font-weight: 700;
        }

        .step-icon {
            font-size: 22px;
        }

        /* Highlight Box */
        .highlight-box {
            background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%);
            border: 1px solid #EF9A9A;
            border-radius: 14px;
            padding: 18px 20px;
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .highlight-box code {
            background: linear-gradient(135deg, #C62828, #D32F2F);
            color: white;
            padding: 10px 28px;
            border-radius: 10px;
            font-family: 'JetBrains Mono', 'Courier New', monospace;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: 5px;
            box-shadow: 0 4px 18px rgba(211, 47, 47, 0.35);
            animation: codeGlow 2.5s ease-in-out infinite;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        @keyframes codeGlow {
            0%, 100% { box-shadow: 0 4px 18px rgba(211, 47, 47, 0.35); }
            50% { box-shadow: 0 6px 30px rgba(211, 47, 47, 0.55); }
        }

        .highlight-box span {
            color: #B71C1C;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 2px solid #f5f5f5;
        }

        .stat-item {
            text-align: center;
            background: linear-gradient(135deg, #FFF5F5 0%, #FFEBEE 100%);
            padding: 16px 22px;
            border-radius: 14px;
            border: 1px solid #FFCDD2;
            min-width: 85px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(211, 47, 47, 0.1);
        }

        .stat-item .number {
            font-size: 28px;
            font-weight: 800;
            color: #D32F2F;
            display: block;
            line-height: 1.2;
        }

        .stat-item .label {
            font-size: 10px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 700;
            margin-top: 4px;
        }

        /* Section Divider */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 32px 0;
            padding: 0 10px;
        }

        .section-divider .line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #ddd, transparent);
        }

        .section-divider .diamond {
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #D32F2F, #EF5350);
            transform: rotate(45deg);
            border-radius: 2px;
            box-shadow: 0 0 12px rgba(211, 47, 47, 0.25);
        }

        /* Data Loss Section */
        .data-loss-section {
            padding: 35px;
            margin-bottom: 28px;
        }

        .data-loss-section h3 {
            color: #C62828;
            font-size: 22px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
        }

        .data-loss-subtitle {
            color: #999;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .data-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .data-item {
            display: flex;
            align-items: center;
            gap: 14px;
            background: linear-gradient(135deg, #FFF8F8 0%, #FFF0F0 100%);
            padding: 18px 20px;
            border-radius: 14px;
            border: 1px solid #FFCDD2;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: default;
            position: relative;
            overflow: hidden;
        }

        .data-item::before {
            content: '✕';
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #FFCDD2;
            font-size: 18px;
            font-weight: 800;
            opacity: 0;
            transition: all 0.3s;
        }

        .data-item:hover::before {
            opacity: 1;
            color: #EF5350;
        }

        .data-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(211, 47, 47, 0.04), transparent);
            transition: left 0.6s;
        }

        .data-item:hover::after {
            left: 100%;
        }

        .data-item:hover {
            border-color: #EF9A9A;
            background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 25px rgba(211, 47, 47, 0.12);
        }

        .data-item-icon {
            font-size: 26px;
            flex-shrink: 0;
        }

        .data-item-text {
            display: flex;
            flex-direction: column;
        }

        .data-item-text .title {
            color: #444;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .data-item:hover .data-item-text .title {
            text-decoration: line-through;
            color: #D32F2F;
        }

        .data-item-text .desc {
            color: #aaa;
            font-size: 11px;
            margin-top: 2px;
        }

        /* Note Section */
        .note-section {
            background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 50%, #E1F5FE 100%);
            border: 1px solid #90CAF9;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 28px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(33, 150, 243, 0.1);
            animation: slideInRight 0.7s ease-out 0.3s both;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .note-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(33, 150, 243, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .note-icon {
            font-size: 34px;
            flex-shrink: 0;
            animation: bounce 2.5s ease infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .note-content h4 {
            color: #1565C0;
            font-size: 17px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .note-content p {
            color: #37474F;
            font-size: 14px;
            line-height: 1.7;
        }

        /* Contact Section */
        .contact-section {
            padding: 40px 35px;
            text-align: center;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2196F3, #4CAF50);
        }

        .contact-section h3 {
            color: #222;
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 800;
        }

        .contact-section > p {
            color: #999;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .contact-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .contact-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .contact-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .contact-btn:hover::before {
            opacity: 1;
        }

        .contact-btn.email {
            background: linear-gradient(135deg, #2E7D32, #43A047);
            color: white;
            box-shadow: 0 6px 25px rgba(46, 125, 50, 0.25);
        }

        .contact-btn.email:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 12px 40px rgba(46, 125, 50, 0.4);
        }

        .contact-btn.phone {
            background: linear-gradient(135deg, #1565C0, #1E88E5);
            color: white;
            box-shadow: 0 6px 25px rgba(21, 101, 192, 0.25);
        }

        .contact-btn.phone:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 12px 40px rgba(21, 101, 192, 0.4);
        }

        .contact-btn span:first-child {
            font-size: 20px;
        }

        /* FAQ Accordion */
        .faq-section {
            padding: 35px;
            margin-bottom: 28px;
        }

        .faq-section h3 {
            color: #222;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 800;
            text-align: center;
        }

        .faq-item {
            border: 1px solid #eee;
            border-radius: 14px;
            margin-bottom: 12px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .faq-item:hover {
            border-color: #FFCDD2;
        }

        .faq-question {
            padding: 18px 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FAFAFA;
            font-weight: 600;
            font-size: 14px;
            color: #444;
            transition: all 0.3s;
            user-select: none;
        }

        .faq-question:hover {
            background: #FFF5F5;
            color: #D32F2F;
        }

        .faq-question .arrow {
            font-size: 18px;
            transition: transform 0.3s;
            color: #D32F2F;
        }

        .faq-item.active .faq-question .arrow {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
            background: white;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
            padding: 18px 22px;
        }

        .faq-answer p {
            color: #666;
            font-size: 13px;
            line-height: 1.7;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 35px 20px;
            color: #aaa;
            font-size: 13px;
            position: relative;
            z-index: 5;
        }

        .footer p:first-child {
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #888;
        }

        .footer .sad-emoji {
            font-size: 26px;
            display: inline-block;
            animation: sadFace 3s ease-in-out infinite;
            vertical-align: middle;
        }

        @keyframes sadFace {
            0%, 100% { transform: rotate(0); }
            25% { transform: rotate(-8deg) scale(1.1); }
            75% { transform: rotate(8deg) scale(1.1); }
        }

        .footer-links {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .footer-links a {
            color: #D32F2F;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #B71C1C;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .data-list {
                grid-template-columns: 1fr;
            }

            .contact-buttons {
                flex-direction: column;
            }

            .contact-btn {
                justify-content: center;
            }

            .step-item {
                gap: 16px;
            }

            .step-number {
                width: 46px;
                height: 46px;
                font-size: 18px;
            }

            .steps-container::before {
                left: 23px;
            }

            .steps-container::after {
                left: 21px;
            }

            .header h1 {
                font-size: 24px;
            }

            .info-card, .data-loss-section, .contact-section, .faq-section {
                padding: 24px;
            }

            .stats-bar {
                gap: 10px;
                flex-wrap: wrap;
            }

            .stat-item {
                min-width: 75px;
                padding: 14px 18px;
            }

            .highlight-box {
                flex-direction: column;
                text-align: center;
            }

            .header {
                padding: 35px 20px 50px;
            }
        }

        /* Scroll Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(35px);
            transition: all 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-on-scroll:nth-child(2) { transition-delay: 0.1s; }
        .animate-on-scroll:nth-child(3) { transition-delay: 0.2s; }
        .animate-on-scroll:nth-child(4) { transition-delay: 0.3s; }

        /* Step animations */
        .step-item {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step-item:nth-child(1) { animation-delay: 0.2s; }
        .step-item:nth-child(2) { animation-delay: 0.4s; }
        .step-item:nth-child(3) { animation-delay: 0.6s; }
        .step-item:nth-child(4) { animation-delay: 0.8s; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            background: #FFCDD2;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #EF9A9A;
        }

        /* Selection */
        ::selection {
            background: rgba(211, 47, 47, 0.15);
            color: #C62828;
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #D32F2F, #EF5350);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 25px rgba(211, 47, 47, 0.35);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s;
            z-index: 100;
        }

        .back-to-top.show {
            opacity: 1;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 10px 35px rgba(211, 47, 47, 0.5);
        }
    </style>
</head>
<body>

    <!-- Subtle Background -->
    <div class="bg-pattern"></div>
    <div class="bg-dots"></div>

    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="app-name">
                <img src="<?= base_url('assets/images/main_logo.png') ?>" class="brand-logo" alt="Main Logo">
            </div>
            <h1>
                <span class="header-icon">🗑️</span>
                Delete Account
            </h1>
            <p class="header-subtitle">Follow the steps below to permanently delete your account</p>
            <span class="badge"><span class="dot"></span> Irreversible Action</span>
        </div>
    </div>

    <!-- Wave Separator -->
    <div class="wave-separator">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0L60 8C120 16 240 32 360 40C480 48 600 48 720 42.7C840 37 960 27 1080 24C1200 21 1320 27 1380 29.3L1440 32V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0V0Z" fill="#F8F9FC"/>
        </svg>
    </div>

    <!-- Main Container -->
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb animate-on-scroll">
            <a href="<?= base_url('dashboard') ?>">Home</a>
            <span class="separator">›</span>
            <span>Delete Account</span>
        </div>

        <!-- Warning Banner -->
        <div class="warning-banner animate-on-scroll">
            <span class="warning-icon">⚠️</span>
            <div class="warning-content">
                <h3>⛔ Important Notice</h3>
                <p>Deleting your account is <strong>permanent</strong> and <strong>cannot be undone</strong>. All your data, site history, saved plots, expense records, and user information will be permanently removed from our servers.</p>
            </div>
        </div>

        <!-- Steps Card -->
        <div class="info-card card animate-on-scroll">
            <h2>📋 How to Delete Your Account</h2>
            <p class="subtitle">Complete these 4 simple steps to remove your account</p>

            <div class="steps-container">

                <!-- Step 1 -->
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>
                            <span class="step-icon">🔐</span>
                            Login to Application
                        </h3>
                        <p>Open the <strong>Site Desk</strong> app and login to your account using your registered mobile number and password.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>
                            <span class="step-icon">👤</span>
                            Navigate to Profile Section
                        </h3>
                        <p>Tap on the <strong>"Profile"</strong> icon located at the bottom navigation bar or in the menu to access your account settings.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>
                            <span class="step-icon">👇</span>
                            Scroll to Bottom
                        </h3>
                        <p>Scroll down to the bottom of the Profile page. You will find the <strong>"Delete Account"</strong> button highlighted in red.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="step-item">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>
                            <span class="step-icon">✅</span>
                            Confirm Deletion
                        </h3>
                        <p>Click on the <strong>"Delete Account"</strong> button. A confirmation popup will appear asking you to type the word to confirm.</p>
                        <div class="highlight-box">
                            <code>DELETE</code>
                            <span>Type this word exactly to confirm your account deletion</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Stats Bar -->
            <div class="stats-bar">
                <div class="stat-item">
                    <span class="number">4</span>
                    <span class="label">Steps</span>
                </div>
                <div class="stat-item">
                    <span class="number">2</span>
                    <span class="label">Minutes</span>
                </div>
                <div class="stat-item">
                    <span class="number">∞</span>
                    <span class="label">Permanent</span>
                </div>
            </div>
        </div>

        <!-- Section Divider -->
        <div class="section-divider">
            <div class="line"></div>
            <div class="diamond"></div>
            <div class="line"></div>
        </div>

        <!-- Data Loss Section -->
        <div class="data-loss-section card animate-on-scroll">
            <h3>
                <span>🚨</span>
                What You Will Lose
            </h3>
            <p class="data-loss-subtitle">All the following data will be permanently deleted</p>
            <div class="data-list">
                <div class="data-item">
                    <span class="data-item-icon">📦</span>
                    <div class="data-item-text">
                        <span class="title">Site History & Data</span>
                        <span class="desc">All site records</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">📍</span>
                    <div class="data-item-text">
                        <span class="title">Saved Plots</span>
                        <span class="desc">Plot information</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">💰</span>
                    <div class="data-item-text">
                        <span class="title">Your Expense Records</span>
                        <span class="desc">Financial data</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">👥</span>
                    <div class="data-item-text">
                        <span class="title">Your Users</span>
                        <span class="desc">Team members</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">📊</span>
                    <div class="data-item-text">
                        <span class="title">Your Upad Data</span>
                        <span class="desc">Upad records</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">📅</span>
                    <div class="data-item-text">
                        <span class="title">Attendance Data</span>
                        <span class="desc">Attendance logs</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">🏷️</span>
                    <div class="data-item-text">
                        <span class="title">Buyer Information</span>
                        <span class="desc">Buyer records</span>
                    </div>
                </div>
                <div class="data-item">
                    <span class="data-item-icon">💳</span>
                    <div class="data-item-text">
                        <span class="title">Payment Data</span>
                        <span class="desc">Payment history</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Note Section -->
        <div class="note-section animate-on-scroll">
            <span class="note-icon">💡</span>
            <div class="note-content">
                <h4>Before You Delete</h4>
                <p>If you're facing any issues with the app or have concerns, please contact our support team first. We'd love to help resolve any problems and keep you as our valued user. Most issues can be resolved quickly!</p>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section card animate-on-scroll">
            <h3>❓ Frequently Asked Questions</h3>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Can I recover my account after deletion?</span>
                    <span class="arrow">▼</span>
                </div>
                <div class="faq-answer">
                    <p>No, once your account is deleted, it cannot be recovered. All data associated with your account will be permanently removed from our servers. Please make sure you have backed up any important information before proceeding.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>How long does the deletion process take?</span>
                    <span class="arrow">▼</span>
                </div>
                <div class="faq-answer">
                    <p>The account deletion is processed immediately after confirmation. Your data will be removed from our active systems instantly, and from backup systems within 30 days.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Can I create a new account with the same number?</span>
                    <span class="arrow">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Yes, after your account is deleted, you can register a new account using the same mobile number. However, none of your previous data will be available in the new account.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>What happens to my shared data with team members?</span>
                    <span class="arrow">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Any data you shared with team members or other users will also be removed. Team members will no longer have access to sites, plots, or records that were created under your account.</p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section card animate-on-scroll">
            <h3>Need Help? 🤝</h3>
            <p>Contact our support team if you have any questions or need assistance</p>
            <div class="contact-buttons">
                <a href="mailto:support@sitedesk.com" class="contact-btn email">
                    <span>✉️</span>
                    support@sitedesk.com
                </a>
                <a href="tel:+911800XXXXXX" class="contact-btn phone">
                    <span>📞</span>
                    +91-1800-XXX-XXXX
                </a>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2026 Site Desk. All rights reserved.</p>
        <p style="margin-top: 10px;">We're sad to see you go <span class="sad-emoji">😢</span></p>
        <!-- <div class="footer-links">
            <a href="<?= base_url('pages/privacy_policy') ?>">Privacy Policy</a>
            <a href="<?= base_url('pages/terms_conditions') ?>">Terms & Condition</a>
        </div> -->
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>

    <script>
        // Scroll animation observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

        // Back to top button
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        // FAQ Accordion
        function toggleFaq(element) {
            const faqItem = element.parentElement;
            const isActive = faqItem.classList.contains('active');
            
            // Close all
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Open clicked if it wasn't active
            if (!isActive) {
                faqItem.classList.add('active');
            }
        }

        // Add subtle parallax to header
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            const scrolled = window.scrollY;
            if (scrolled < 400) {
                header.style.transform = `translateY(${scrolled * 0.3}px)`;
                header.style.opacity = 1 - (scrolled / 500);
            }
        });
    </script>

</body>
</html>