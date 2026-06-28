<?php
require_once 'data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CreditBridge — Trade Passport & Supply Chain Financing</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      background: #f5f6f8;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      color: #1a1a1a;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    .app {
      background: #f5f6f8;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .topbar {
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .logo {
      font-size: 16px;
      font-weight: 700;
      color: #1D9E75;
      letter-spacing: -.5px;
      display: flex;
      align-items: center;
    }
    .logo span {
      color: #333;
      font-weight: 400;
    }
    .nav {
      display: flex;
      gap: 6px;
    }
    .np {
      font-size: 12px;
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 20px;
      cursor: pointer;
      border: 1px solid #e5e7eb;
      color: #666;
      background: #fff;
      transition: all .2s ease;
    }
    .np:hover {
      border-color: #1D9E75;
      color: #1D9E75;
    }
    .np.active {
      background: #1D9E75;
      color: #fff;
      border-color: #1D9E75;
      box-shadow: 0 2px 4px rgba(29, 158, 117, 0.2);
    }
    .page {
      display: none;
      padding: 28px;
      flex-grow: 1;
      max-width: 1200px;
      width: 100%;
      margin: 0 auto;
      animation: fadeIn 0.4s ease-out forwards;
    }
    .page.active {
      display: block;
    }
    h2 {
      font-size: 22px;
      font-weight: 700;
      color: #1a1a1a;
      letter-spacing: -.5px;
      margin-bottom: 4px;
    }
    .sub {
      font-size: 14px;
      color: #666;
      margin-bottom: 24px;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      padding: 24px;
      margin-bottom: 18px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
    }
    .grid3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-bottom: 18px;
    }
    .grid2 {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      margin-bottom: 18px;
    }
    .mcard {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      padding: 20px 22px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
      transition: transform 0.2s;
    }
    .mcard:hover {
      transform: translateY(-2px);
    }
    .mlabel {
      font-size: 11px;
      color: #888;
      text-transform: uppercase;
      letter-spacing: .8px;
      margin-bottom: 6px;
      font-weight: 700;
    }
    .mval {
      font-size: 26px;
      font-weight: 700;
      color: #1a1a1a;
      letter-spacing: -1px;
    }
    .mval.red {
      color: #dc2626;
    }
    .mval.sm {
      font-size: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    thead th {
      background: #f9fafb;
      padding: 12px 18px;
      text-align: left;
      font-size: 11px;
      font-weight: 700;
      color: #666;
      text-transform: uppercase;
      letter-spacing: .5px;
      border-bottom: 1px solid #e5e7eb;
    }
    tbody td {
      padding: 16px 18px;
      font-size: 13px;
      color: #444;
      border-bottom: 1px solid #f3f4f6;
    }
    tbody tr:last-child td {
      border-bottom: none;
    }
    tbody tr:hover {
      background: #fafbfe;
    }
    .bold {
      font-weight: 600;
      color: #1a1a1a;
    }
    .mono {
      font-family: 'JetBrains Mono', monospace;
      font-size: 12px;
      color: #666;
    }
    .badge {
      display: inline-block;
      font-size: 10px;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: 20px;
      letter-spacing: .3px;
      text-transform: uppercase;
    }
    .b-over {
      background: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fee2e2;
    }
    .b-due {
      background: #fffbeb;
      color: #92400e;
      border: 1px solid #fef3c7;
    }
    .b-paid {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #dcfce7;
    }
    .b-fin {
      background: #eff6ff;
      color: #1d4ed8;
      border: 1px solid #dbeafe;
    }
    .b-prime {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #dcfce7;
    }
    .b-amber {
      background: #fffbeb;
      color: #92400e;
      border: 1px solid #fef3c7;
    }
    .b-toxic {
      background: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fee2e2;
    }
    .btn {
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all .15s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }
    .btn-g {
      background: #1D9E75;
      color: #fff;
    }
    .btn-g:hover {
      background: #157f5d;
      box-shadow: 0 4px 6px -1px rgba(29, 158, 117, 0.2);
    }
    .btn-b {
      background: #2563eb;
      color: #fff;
    }
    .btn-b:hover {
      background: #1d4ed8;
      box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }
    .btn-ghost {
      background: #fff;
      color: #555;
      border: 1px solid #d1d5db;
    }
    .btn-ghost:hover {
      background: #f9fafb;
      border-color: #9ca3af;
    }
    .btn-red {
      background: #dc2626;
      color: #fff;
    }
    .btn-red:hover {
      background: #b91c1c;
      box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);
    }
    .back {
      font-size: 13px;
      font-weight: 600;
      color: #666;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 18px;
      transition: color 0.15s;
    }
    .back:hover {
      color: #1a1a1a;
    }
    .warn-bar {
      background: #fffbeb;
      border: 1px solid #fde68a;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 13px;
      color: #92400e;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }
    .info-bar {
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 13px;
      color: #1e40af;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }
    .success-bar {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 13px;
      color: #166534;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }
    .step-row {
      display: flex;
      gap: 16px;
      margin-bottom: 16px;
      align-items: flex-start;
    }
    .step-dot {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #1D9E75;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 700;
      flex-shrink: 0;
      margin-top: 2px;
      box-shadow: 0 2px 4px rgba(29, 158, 117, 0.1);
    }
    .step-dot.done {
      background: #f0fdf4;
      color: #166534;
      border: 1.5px solid #bbf7d0;
    }
    .step-dot.pend {
      background: #f5f6f8;
      color: #888;
      border: 1.5px solid #e5e7eb;
    }
    .step-content {
      flex: 1;
    }
    .step-title {
      font-size: 14px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 4px;
    }
    .step-desc {
      font-size: 12px;
      color: #666;
      line-height: 1.6;
    }
    .step-code {
      background: #f8f9fa;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      padding: 10px 14px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 11px;
      color: #555;
      margin-top: 8px;
      line-height: 1.7;
    }
    .tri-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin: 18px 0;
    }
    .tri-card {
      border-radius: 12px;
      padding: 18px;
      border: 1px solid #e5e7eb;
      transition: all 0.2s ease;
    }
    .tri-card:hover {
      box-shadow: 0 4px 10px -2px rgba(0,0,0,0.05);
    }
    .tri-label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .8px;
      margin-bottom: 12px;
    }
    .tri-item {
      font-size: 13px;
      color: #555;
      padding: 5px 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .check-g {
      color: #1D9E75;
      font-size: 16px;
      font-weight: 700;
    }
    .check-p {
      color: #f59e0b;
      font-size: 16px;
      font-weight: 700;
    }
    .score-row {
      display: flex;
      align-items: center;
      gap: 24px;
      margin: 16px 0;
    }
    .score-circle {
      width: 120px;
      height: 120px;
      position: relative;
      flex-shrink: 0;
    }
    .score-circle svg {
      width: 120px;
      height: 120px;
    }
    .score-inner {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
    }
    .score-n {
      font-size: 26px;
      font-weight: 800;
      color: #1D9E75;
      letter-spacing: -1px;
    }
    .score-d {
      font-size: 11px;
      color: #888;
      font-weight: 500;
    }
    .score-details {
      flex: 1;
    }
    .score-row-item {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      border-bottom: 1px solid #f3f4f6;
      font-size: 13px;
    }
    .score-row-item:last-child {
      border-bottom: none;
    }
    .score-row-label {
      color: #666;
    }
    .score-row-val {
      font-weight: 600;
      color: #1a1a1a;
    }
    .pdpa-box {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      padding: 28px;
      max-width: 520px;
      margin: 0 auto;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }
    .pdpa-title {
      font-size: 18px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 6px;
    }
    .pdpa-sub {
      font-size: 13px;
      color: #666;
      margin-bottom: 20px;
      line-height: 1.5;
    }
    .pdpa-section {
      margin-bottom: 18px;
    }
    .pdpa-section-title {
      font-size: 11px;
      font-weight: 700;
      color: #666;
      text-transform: uppercase;
      letter-spacing: .8px;
      margin-bottom: 8px;
      border-bottom: 1px solid #f3f4f6;
      padding-bottom: 4px;
    }
    .pdpa-item {
      font-size: 13px;
      color: #555;
      padding: 5px 0;
      display: flex;
      gap: 10px;
      line-height: 1.5;
    }
    .consent-check {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      background: #f9fafb;
      border-radius: 8px;
      padding: 14px;
      margin-bottom: 12px;
      border: 1px solid #f3f4f6;
      transition: all 0.2s;
    }
    .consent-check:hover {
      background: #f3f4f6;
    }
    .consent-check input {
      margin-top: 3px;
      flex-shrink: 0;
      width: 16px;
      height: 16px;
      cursor: pointer;
    }
    .consent-check label {
      font-size: 12px;
      color: #444;
      line-height: 1.5;
      cursor: pointer;
      user-select: none;
    }
    .result-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #f3f4f6;
    }
    .result-row:last-child {
      border-bottom: none;
    }
    .rl {
      font-size: 13px;
      color: #666;
    }
    .rv {
      font-size: 14px;
      font-weight: 600;
      color: #1a1a1a;
    }
    .rv.g {
      color: #1D9E75;
    }
    .disclaimer {
      font-size: 11px;
      color: #888;
      text-align: center;
      margin-top: 18px;
      line-height: 1.5;
    }
    .tl-item {
      display: flex;
      gap: 16px;
      padding: 12px 0;
      border-bottom: 1px solid #f3f4f6;
      position: relative;
    }
    .tl-item:last-child {
      border-bottom: none;
    }
    .tl-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #1D9E75;
      margin-top: 4px;
      flex-shrink: 0;
      box-shadow: 0 0 0 4px rgba(29, 158, 117, 0.1);
    }
    .tl-dot.pend {
      background: #d1d5db;
      box-shadow: none;
    }
    .tl-info {
      flex: 1;
    }
    .tl-title {
      font-size: 13px;
      font-weight: 600;
      color: #1a1a1a;
    }
    .tl-sub {
      font-size: 11px;
      color: #666;
      margin-top: 3px;
    }
    .input-row {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 14px;
    }
    .input-row label {
      font-size: 12px;
      font-weight: 600;
      color: #555;
    }
    .input-row input, .input-row select {
      padding: 10px 14px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 13px;
      color: #1a1a1a;
      background: #fff;
      transition: all 0.15s ease;
      font-family: inherit;
    }
    .input-row input:focus, .input-row select:focus {
      outline: none;
      border-color: #1D9E75;
      box-shadow: 0 0 0 3px rgba(29, 158, 117, 0.1);
    }
    .upload-box {
      border: 2px dashed #d1d5db;
      border-radius: 12px;
      padding: 24px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s ease;
      margin-bottom: 12px;
      background: #fafafa;
    }
    .upload-box:hover {
      border-color: #1D9E75;
      background: #f0fdf4;
    }
    .upload-icon {
      font-size: 28px;
      color: #888;
      margin-bottom: 8px;
    }
    .upload-label {
      font-size: 13px;
      color: #444;
      font-weight: 500;
    }
    .upload-sub {
      font-size: 11px;
      color: #888;
      margin-top: 4px;
    }
    .progress-bar {
      background: #e5e7eb;
      border-radius: 20px;
      height: 8px;
      margin: 10px 0;
      overflow: hidden;
    }
    .progress-fill {
      background: #1D9E75;
      border-radius: 20px;
      height: 8px;
      transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
      width: 0%;
    }
    .row-between {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    /* Animation Keyframes and classes */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(8px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    .animate-spin {
      animation: spin 1s linear infinite;
    }
    .hidden {
      display: none !important;
    }
    
    /* Success Toast styling */
    #toast-notification {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #1a1a1a;
      color: #fff;
      padding: 14px 24px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 500;
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
      transform: translateY(100px);
      opacity: 0;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      z-index: 1000;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    #toast-notification.show {
      transform: translateY(0);
      opacity: 1;
    }
  </style>
</head>
<body>

<div class="app">
  <!-- TOPBAR -->
  <div class="topbar">
    <div class="logo">
      Credit<span>Bridge</span>
      <span id="active-company-badge" style="font-size: 11px; background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 12px; margin-left: 10px; font-weight: 600; border: 1px solid #bae6fd;">Loading...</span>
    </div>
    
    <!-- Topbar Navigation -->
    <div class="nav">
      <div class="np active" onclick="go('onboard')" id="n-onboard">Setup</div>
      <div class="np" onclick="go('ingest')" id="n-ingest">Data in</div>
      <div class="np" onclick="go('dashboard')" id="n-dashboard">Dashboard</div>
      <div class="np" onclick="go('passport')" id="n-passport">Trade Passport</div>
      <div class="np" onclick="go('pdpa')" id="n-pdpa">PDPA consent</div>
      <div class="np" onclick="go('result')" id="n-result">Result</div>
    </div>
    
    <!-- Company Quick-Switch Dropdown -->
    <div style="display:flex; align-items:center; gap:8px;">
      <span style="font-size:12px; font-weight:600; color:#666">Profile:</span>
      <select id="topbar-company-select" onchange="switchCompany(this.value)" style="padding: 5px 10px; border-radius: 6px; border: 1px solid #e5e7eb; font-size: 12px; font-weight: 600; color: #333; outline: none; background: #fff; cursor: pointer;">
        <!-- Filled by JS -->
      </select>
    </div>
  </div>

  <!-- STAGE 0: COMPANY SETUP -->
  <div class="page active" id="page-onboard">
    <h2>Company setup</h2>
    <div class="sub">Stage 0 — one-time registration and LHDN authorisation</div>
    <div class="grid2">
      <div class="card">
        <div style="font-size:13px;font-weight:600;color:#555;margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px">Company details</div>
        <div class="input-row"><label>Company name</label><input id="setup-company-name" value="" /></div>
        <div class="input-row"><label>Tax identification number (TIN)</label><input id="setup-tin" value="" /></div>
        <div class="input-row"><label>SSM registration no.</label><input id="setup-ssm" value="" /></div>
        <div class="input-row">
          <label>Industry</label>
          <select id="setup-industry">
            <option>Hardware distribution</option>
            <option>Construction</option>
            <option>Logistics</option>
            <option>Manufacturing</option>
            <option>Retail</option>
          </select>
        </div>
        <button class="btn btn-g" style="width:100%;margin-top:4px" onclick="saveActiveCompanyProfile()">Save company profile</button>
      </div>
      
      <div class="card">
        <div style="font-size:13px;font-weight:600;color:#555;margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px">Create New Company Profile</div>
        <div class="input-row"><label>New Company Name</label><input id="new-company-name" placeholder="e.g. Apex Distribution Sdn Bhd" /></div>
        <div class="input-row"><label>TIN</label><input id="new-tin" placeholder="e.g. C98765432100" /></div>
        <div class="input-row"><label>SSM No.</label><input id="new-ssm" placeholder="e.g. 201001099887 (987654-A)" /></div>
        <div class="input-row">
          <label>Industry</label>
          <select id="new-industry">
            <option>Hardware distribution</option>
            <option>Construction</option>
            <option>Logistics</option>
            <option>Manufacturing</option>
            <option>Retail</option>
          </select>
        </div>
        <button class="btn btn-b" style="width:100%;margin-top:4px;" onclick="createNewCompanyProfile()">Create & Switch Profile</button>
      </div>
    </div>
    
    <div class="grid2">
      <div class="card">
        <div style="font-size:13px;font-weight:600;color:#555;margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px">LHDN eInvoice connection</div>
        <div class="step-row">
          <div class="step-dot done">✓</div>
          <div class="step-content">
            <div class="step-title">Register ERP integration on MyInvois</div>
            <div class="step-desc">Log in to MyInvois Portal → ERP System → Register. Select read-only scope only.</div>
            <div class="step-code">Scope: GetDocuments · GetDocumentDetails<br>No Submit / Cancel rights granted</div>
          </div>
        </div>
        <div class="step-row">
          <div class="step-dot" id="cred-step-dot">2</div>
          <div class="step-content">
            <div class="step-title">Enter your LHDN credentials</div>
            <div class="input-row" style="margin-top:8px"><label>Client ID</label><input id="setup-client-id" placeholder="From MyInvois ERP registration" /></div>
            <div class="input-row"><label>Client Secret</label><input id="setup-client-secret" type="password" placeholder="Encrypted at rest — never stored plain" /></div>
          </div>
        </div>
        <div class="step-row">
          <div class="step-dot pend" id="step-do-dot">3</div>
          <div class="step-content">
            <div class="step-title">Set delivery order (DO) upload method</div>
            <div class="step-desc">Choose how your lorry drivers submit signed receipts.</div>
            <div style="display:flex;gap:8px;margin-top:8px" id="do-method-container">
              <div id="do-whatsapp" class="do-option-btn" onclick="setDoMethod('whatsapp')" style="flex:1;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px;text-align:center;font-size:11px;cursor:pointer;font-weight:500;">WhatsApp bot</div>
              <div id="do-driver_app" class="do-option-btn" onclick="setDoMethod('driver_app')" style="flex:1;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px;text-align:center;font-size:11px;cursor:pointer;font-weight:500;">Driver app</div>
              <div id="do-manual" class="do-option-btn" onclick="setDoMethod('manual')" style="flex:1;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px;text-align:center;font-size:11px;cursor:pointer;font-weight:500;">Manual upload</div>
            </div>
          </div>
        </div>
        <button class="btn btn-g" style="width:100%;margin-top:8px" onclick="saveCredentialsAndContinue()">Connect and continue →</button>
      </div>

      <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="font-size:13px;font-weight:600;color:#555;margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px">Demo Controls</div>
          <p style="font-size: 13px; color: #555; line-height: 1.6; margin-bottom: 16px;">This prototype demonstrates dynamic multi-company credit scoring. You can customize the active supplier company, register custom buyers (debtors), issue custom invoices, and simulate bank statement reconciliation via CSV.</p>
          <div class="info-bar" style="margin-bottom: 0;">💡 You can restore the original sandbox datasets at any time using the button below.</div>
        </div>
        <button class="btn btn-red" style="width:100%; margin-top:20px;" onclick="resetDemoDatabase()">Reset Database to Initial Seed</button>
      </div>
    </div>
  </div>

  <!-- STAGE 1: DATA INGESTION -->
  <div class="page" id="page-ingest">
    <h2>Daily data ingestion</h2>
    <div class="sub">Stage 1 — three data sources triangulated per invoice automatically</div>
    
    <div class="tri-grid">
      <div class="tri-card" style="background:#f0fdf4;border-color:#bbf7d0">
        <div class="tri-label" style="color:#166534">① eInvoice (LHDN)</div>
        <div class="tri-item"><span class="check-g">✓</span>Auto-synced via API</div>
        <div class="tri-item"><span class="check-g">✓</span>Invoice UUID verified</div>
        <div class="tri-item"><span class="check-g">✓</span>Buyer TIN matched</div>
        <div class="tri-item"><span class="check-g">✓</span>Amount and date</div>
        <div id="ingest-lhdn-count" style="margin-top:10px;font-size:11px;color:#166534;font-weight:600">0 invoices synced today</div>
      </div>
      
      <div class="tri-card" style="background:#fffbeb;border-color:#fde68a">
        <div class="tri-label" style="color:#92400e">② Bank statement</div>
        <div class="tri-item"><span class="check-p" id="ingest-bank-check">↑</span>Upload CSV monthly</div>
        <div class="upload-box" style="padding:14px;margin:8px 0 0" onclick="simulateBankCsvDrop()">
          <div style="font-size:20px;color:#d97706">↑</div>
          <div class="upload-label" style="font-size:12px" id="bank-upload-label">Drop bank CSV here</div>
          <div class="upload-sub">Maybank / CIMB / RHB export</div>
        </div>
        <div id="ingest-bank-status" style="font-size:11px;color:#92400e;font-weight:600">Last upload: 2 days ago</div>
      </div>
      
      <div class="tri-card" style="background:#eff6ff;border-color:#bfdbfe">
        <div class="tri-label" style="color:#1e40af">③ Delivery receipts (DO)</div>
        <div class="tri-item"><span style="color:#2563eb;font-size:14px">✓</span>Driver WhatsApp photo</div>
        <div class="tri-item"><span style="color:#2563eb;font-size:14px">✓</span>OCR extracts signature</div>
        <div class="tri-item"><span style="color:#2563eb;font-size:14px">✓</span>Timestamp matched</div>
        <div id="ingest-do-count" style="margin-top:10px;font-size:11px;color:#1e40af;font-weight:600">0/0 DOs confirmed</div>
      </div>
    </div>

    <!-- Alert bar for successful reconcile -->
    <div id="ingest-success-alert" class="success-bar" style="display: none;"></div>

    <div class="grid3" style="grid-template-columns: 2fr 1fr; gap: 16px; align-items: start;">
      <div class="card">
        <div class="row-between">
          <div style="font-size:13px;font-weight:600;color:#555;text-transform:uppercase;letter-spacing:.5px">Triangulation status — June 2026</div>
          <div style="display:flex; align-items:center; gap:8px;">
            <span style="font-size:12px; color:#555; font-weight:500;">Filter Buyer:</span>
            <select id="ingest-client-filter" onchange="render()" style="padding: 4px 8px; border-radius: 6px; border: 1px solid #e5e7eb; font-size: 12px; outline: none; background: #fff;">
              <!-- Filled by JS -->
            </select>
          </div>
        </div>
        
        <div style="overflow-x:auto;">
          <table style="margin-bottom: 12px;">
            <thead><tr><th>Invoice</th><th>Customer</th><th>Amount</th><th>eInvoice</th><th>Bank</th><th>DO</th><th>Status</th></tr></thead>
            <tbody id="ingest-table-body">
              <!-- Rendered dynamically -->
            </tbody>
          </table>
        </div>
        
        <div style="margin-top:18px">
          <div style="font-size:12px;color:#666;margin-bottom:4px">Monthly verification rate</div>
          <div class="progress-bar"><div id="ingest-progress-bar" class="progress-fill" style="width:0%"></div></div>
          <div id="ingest-progress-label" style="font-size:11px;color:#888">0% fully verified</div>
        </div>
      </div>

      <div class="card">
        <div style="font-size:13px;font-weight:600;color:#555;margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px">Issue/Sync e-Invoice</div>
        <div class="input-row">
          <label>Customer/Client</label>
          <select id="invoice-client-select">
            <!-- Filled by JS -->
          </select>
        </div>
        <div class="input-row"><label>Invoice No.</label><input id="invoice-no" value="INV-2026-0442" /></div>
        <div class="input-row"><label>Amount (RM)</label><input id="invoice-amount" type="number" value="35000" /></div>
        <div class="input-row"><label>Date Issued</label><input id="invoice-date" type="date" value="2026-06-28" /></div>
        <div class="input-row">
          <label>Initial Status</label>
          <select id="invoice-status">
            <option value="Overdue">Overdue</option>
            <option value="Due Soon" selected>Due Soon</option>
            <option value="Paid">Paid</option>
          </select>
        </div>
        <div style="font-size:11px; font-weight:700; color:#666; margin-bottom: 8px; text-transform:uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #f3f4f6; padding-bottom: 4px;">Triangulation Sources</div>
        <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:18px;">
          <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:#555; cursor:pointer;"><input type="checkbox" id="invoice-chk-lhdn" checked /> eInvoice Sync (LHDN)</label>
          <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:#555; cursor:pointer;"><input type="checkbox" id="invoice-chk-bank" /> Bank Statement Reconciled</label>
          <label style="display:flex; align-items:center; gap:8px; font-size:12px; color:#555; cursor:pointer;"><input type="checkbox" id="invoice-chk-do" /> Delivery Receipt (DO) Confirmed</label>
        </div>
        <button class="btn btn-g" style="width:100%" onclick="addInvoice()">Add Invoice</button>
      </div>
    </div>
    
    <div style="text-align:right; margin-top: 10px;"><button class="btn btn-g" onclick="go('dashboard')">View dashboard →</button></div>
  </div>

  <!-- STAGE 2: DASHBOARD -->
  <div class="page" id="page-dashboard">
    <div class="row-between">
      <div>
        <h2 id="dashboard-company-title">Company Name</h2>
        <div class="sub">Stage 2 — accounts receivable overview · June 2026</div>
      </div>
      <button class="btn btn-g" onclick="goToPassportFromDashboard()">Generate Trade Passport</button>
    </div>
    
    <div class="grid3">
      <div class="mcard"><div class="mlabel">Total receivables</div><div class="mval" id="dash-total-receivables">RM 0</div></div>
      <div class="mcard"><div class="mlabel">Overdue</div><div class="mval red" id="dash-overdue">RM 0</div></div>
      <div class="mcard"><div class="mlabel">Avg collection days</div><div class="mval sm" id="dash-avg-collection">0 days</div></div>
    </div>
    
    <div class="grid3" style="grid-template-columns: 2fr 1fr; gap: 16px; align-items: start;">
      <div class="card" style="overflow-x:auto;">
        <table>
          <thead><tr><th>Customer/Buyer</th><th>Total Outstanding AR</th><th>Health rating</th><th>Status</th><th>Overdue/Due</th><th>Action</th></tr></thead>
          <tbody id="dash-table-body">
            <!-- Rendered dynamically -->
          </tbody>
        </table>
      </div>
      
      <div class="card">
        <div style="font-size:13px;font-weight:600;color:#555;margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px">Register Customer/Buyer</div>
        <div class="input-row"><label>Customer Name</label><input id="new-client-name" placeholder="e.g. Chuan Luck Construction" /></div>
        <div class="input-row"><label>Cooperation (Years)</label><input id="new-client-coop" type="number" value="3" /></div>
        <div class="input-row"><label>Avg Payment Days</label><input id="new-client-paydays" type="number" value="65" /></div>
        <div class="input-row"><label>Promised Payment Days</label><input id="new-client-promised" type="number" value="60" /></div>
        <div class="input-row">
          <label>Transaction Frequency</label>
          <select id="new-client-frequency">
            <option value="High">High</option>
            <option value="Medium" selected>Medium</option>
            <option value="Low">Low</option>
          </select>
        </div>
        <div class="input-row">
          <label>Volume Trend</label>
          <select id="new-client-trend">
            <option value="Growing" selected>Growing</option>
            <option value="Stable">Stable</option>
            <option value="Shrinking">Shrinking</option>
          </select>
        </div>
        <div class="input-row">
          <label>Est. Risk Grade</label>
          <select id="new-client-health">
            <option value="Prime">Prime (Low Risk)</option>
            <option value="Amber" selected>Amber (Medium Risk)</option>
            <option value="Toxic">Toxic (High Risk)</option>
          </select>
        </div>
        <button class="btn btn-g" style="width: 100%" onclick="addCustomer()">Register Customer</button>
      </div>
    </div>
    
    <div class="card" style="margin-bottom:0">
      <div style="font-size:12px;font-weight:600;color:#555;text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Customer risk triage</div>
      <div style="display:flex;gap:10px">
        <div style="flex:1;background:#f0fdf4;border-radius:8px;padding:12px;border:.5px solid #bbf7d0"><div style="font-size:11px;font-weight:700;color:#166534;margin-bottom:4px">Prime</div><div style="font-size:12px;color:#166534">Reliable payer. Extend credit, offer factoring at best rate.</div></div>
        <div style="flex:1;background:#fffbeb;border-radius:8px;padding:12px;border:.5px solid #fde68a"><div style="font-size:11px;font-weight:700;color:#92400e;margin-bottom:4px">Amber</div><div style="font-size:12px;color:#92400e">History of delays. Proceed with caution, shorter credit terms.</div></div>
        <div style="flex:1;background:#fef2f2;border-radius:8px;padding:12px;border:.5px solid #fecaca"><div style="font-size:11px;font-weight:700;color:#b91c1c;margin-bottom:4px">Toxic</div><div style="font-size:12px;color:#b91c1c">High default risk. Manual override required to extend credit.</div></div>
      </div>
    </div>
  </div>

  <!-- STAGE 3: TRADE PASSPORT -->
  <div class="page" id="page-passport">
    <div class="back" onclick="go('dashboard')">← Back to dashboard</div>
    
    <!-- Loading State -->
    <div id="loading-state" style="display: flex; flex-direction: column; align-items: center; justify-content: center; py-32; text-align: center; margin: 100px 0;">
      <svg class="animate-spin" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="10" stroke="#e5e7eb" stroke-width="4" style="opacity: 0.25;"></circle>
        <path fill="#1D9E75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" style="opacity: 0.75;"></path>
      </svg>
      <div id="loading-text" style="font-size:15px; font-weight:600; color:#555; margin-top:16px;">Syncing LHDN e-Invoice API...</div>
    </div>

    <!-- Loaded State -->
    <div id="loaded-state" class="hidden">
      <div id="passport-warn-bar" class="warn-bar">⚠ PDPA consent required before submitting to CapBay. Generate passport to review — submit only after buyer consents.</div>
      
      <div class="row-between">
        <div>
          <h2 id="passport-buyer-title">Customer Name</h2>
          <div class="sub" id="passport-buyer-sub">Chuan Luck Construction Sdn Bhd · INV-2026-0441 · Generated June 28, 2026</div>
        </div>
        <div style="display:flex;gap:6px">
          <span style="background:#f0f9ff;color:#0369a1;font-size:10px;font-weight:700;padding:3px 8px;border-radius:4px">LHDN</span>
          <span style="background:#fffbeb;color:#92400e;font-size:10px;font-weight:700;padding:3px 8px;border-radius:4px">Bank</span>
          <span style="background:#f0fdf4;color:#166534;font-size:10px;font-weight:700;padding:3px 8px;border-radius:4px">DO</span>
        </div>
      </div>

      <!-- INVOICE CHECKLIST FOR BUNDLING -->
      <div class="card" style="padding: 18px 22px; margin-bottom:16px;">
        <div style="font-size:13px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px; border-bottom:1px solid #f3f4f6; padding-bottom:6px;">Select Invoices to Package for Financing under this Passport</div>
        <div id="passport-invoice-checklist" style="display:flex; flex-direction:column; gap:10px; margin-bottom:8px;">
          <!-- Filled dynamically by JS -->
        </div>
      </div>

      <div class="grid2">
        <div class="card">
          <div style="font-size:12px;font-weight:600;color:#555;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Credit score breakdown</div>
          <div class="score-row">
            <div class="score-circle">
              <svg viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                <circle id="passport-score-gauge" cx="50" cy="50" r="40" fill="none" stroke="#1D9E75" stroke-width="8" stroke-dasharray="251" stroke-dashoffset="251" stroke-linecap="round" transform="rotate(-90 50 50)" style="transition: stroke-dashoffset 0.8s ease-out;"/>
              </svg>
              <div class="score-inner">
                <div class="score-n" id="passport-score-num">0</div>
                <div class="score-d">/ 1000</div>
              </div>
            </div>
            <div class="score-details">
              <div class="score-row-item"><span class="score-row-label">Payment timeliness</span><span class="score-row-val" id="score-val-timeliness">0 / 300</span></div>
              <div class="score-row-item"><span class="score-row-label">Transaction frequency</span><span class="score-row-val" id="score-val-frequency">0 / 200</span></div>
              <div class="score-row-item"><span class="score-row-label">Cooperation history</span><span class="score-row-val" id="score-val-coop">0 / 200</span></div>
              <div class="score-row-item"><span class="score-row-label">Volume trend</span><span class="score-row-val" id="score-val-trend">0 / 150</span></div>
              <div class="score-row-item"><span class="score-row-label">Verification ratio</span><span class="score-row-val" id="score-val-verification">0 / 150</span></div>
              <div style="margin-top:8px"><span class="badge" id="passport-score-badge" style="font-size:12px;padding:4px 14px">Prime — 782</span></div>
            </div>
          </div>
        </div>
        
        <div class="card">
          <div style="font-size:12px;font-weight:600;color:#555;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Verified transaction data</div>
          <div class="result-row"><span class="rl">Transaction frequency</span><span class="rv" id="p-data-freq">0× / month</span></div>
          <div class="result-row"><span class="rl">Avg payment days</span><span class="rv" id="p-data-paydays">0 days</span></div>
          <div class="result-row"><span class="rl">Cooperation since</span><span class="rv" id="p-data-coop">0 years</span></div>
          <div class="result-row"><span class="rl">Total transacted</span><span class="rv" id="p-data-total">RM 0</span></div>
          <div class="result-row"><span class="rl">LHDN invoices matched</span><span class="rv" id="p-data-lhdn">0 / 0 ✓</span></div>
          <div class="result-row"><span class="rl">Bank reconciled</span><span class="rv" id="p-data-bank">0 / 0 ✓</span></div>
          <div class="result-row"><span class="rl">DO confirmed</span><span class="rv" id="p-data-do">0 / 0 ✓</span></div>
        </div>
      </div>
      
      <!-- Action Panel (Print DO / Submit to CapBay) -->
      <div id="passport-action-panel">
        <!-- Rendered dynamically -->
      </div>
    </div>
  </div>

  <!-- STAGE 4: PDPA CONSENT -->
  <div class="page" id="page-pdpa">
    <div class="back" onclick="go('passport')">← Back to Trade Passport</div>
    <h2>PDPA data consent</h2>
    <div class="sub">Stage 3 — buyer consent must be obtained before any data is shared with financiers</div>
    <div class="grid2">
      <div>
        <div class="info-bar" id="pdpa-sent-info">📨 Consent request sent...</div>
        <div class="pdpa-box">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
            <div style="width:36px;height:36px;background:#e5e7eb;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#555" id="pdpa-buyer-initials">CL</div>
            <div>
              <div style="font-size:14px;font-weight:600;color:#1a1a1a" id="pdpa-buyer-name">Chuan Luck Construction Sdn Bhd</div>
              <div style="font-size:11px;color:#888">Data subject — buyer</div>
            </div>
          </div>
          <div class="pdpa-title">Data processing consent</div>
          <div class="pdpa-sub">CreditBridge is requesting permission to share your transaction data with a licensed financier (CapBay Malaysia Sdn Bhd) for the purpose of supply chain financing.</div>
          
          <div class="pdpa-section">
            <div class="pdpa-section-title">Data to be shared</div>
            <div class="pdpa-item"><span style="color:#1D9E75">•</span>Payment history with <strong class="pdpa-active-supplier">Defong Enterprise</strong> (<span id="pdpa-shared-history">24 invoices, 2018–2026</span>)</div>
            <div class="pdpa-item"><span style="color:#1D9E75">•</span>Average payment duration and frequency</div>
            <div class="pdpa-item"><span style="color:#1D9E75">•</span>LHDN eInvoice transaction UUIDs (read-only)</div>
            <div class="pdpa-item"><span style="color:#1D9E75">•</span>Derived credit score (<strong id="pdpa-shared-score">782/1000, Prime</strong>)</div>
          </div>
          
          <div class="pdpa-section">
            <div class="pdpa-section-title">Purpose and legal basis</div>
            <div class="pdpa-item"><span style="color:#2563eb">•</span>Purpose: enable <span class="pdpa-active-supplier">Defong Enterprise</span> to receive early payment financing</div>
            <div class="pdpa-item"><span style="color:#2563eb">•</span>Recipient: CapBay Malaysia Sdn Bhd (licensed under BNMRH/GL000010)</div>
            <div class="pdpa-item"><span style="color:#2563eb">•</span>Retention: 7 years per PDPA s.10 and financial record requirements</div>
            <div class="pdpa-item"><span style="color:#2563eb">•</span>Your rights: access, correction, withdrawal of consent (future transactions)</div>
          </div>
          
          <div class="pdpa-section">
            <div class="pdpa-section-title">Your agreement</div>
            <div class="consent-check">
              <input type="checkbox" id="c1" />
              <label for="c1">I understand that my payment behaviour will be quantified into a credit score and shared with CapBay for financing assessment purposes.</label>
            </div>
            <div class="consent-check">
              <input type="checkbox" id="c2" />
              <label for="c2">I consent to CreditBridge processing the data listed above under PDPA 2010 s.6(1)(a) and sharing it with CapBay Malaysia Sdn Bhd.</label>
            </div>
            <div class="consent-check">
              <input type="checkbox" id="c3" />
              <label for="c3">I acknowledge I may withdraw consent for future transactions by contacting privacy@creditbridge.my, but this does not affect the current submission.</label>
            </div>
          </div>
          <button class="btn btn-g" style="width:100%" onclick="signConsent()">I agree — sign consent</button>
          <div class="disclaimer">Consent is timestamped and stored in audit log. Reference: <span id="pdpa-consent-ref" class="mono">CBR-PDPA-2026-0441</span></div>
        </div>
      </div>
      
      <div>
        <div class="card">
          <div style="font-size:12px;font-weight:600;color:#555;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Consent audit trail</div>
          <div class="tl-item">
            <div class="tl-dot"></div>
            <div class="tl-info">
              <div class="tl-title">Consent request sent</div>
              <div class="tl-sub" id="audit-sent-time">June 28, 2026 · 14:32 · WhatsApp + email</div>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot pend" id="audit-sign-dot"></div>
            <div class="tl-info">
              <div class="tl-title" style="color:#888" id="audit-sign-title">Buyer signs consent</div>
              <div class="tl-sub" id="audit-sign-sub">Awaiting — expires June 29, 2026 at 14:32</div>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot pend" id="audit-submit-dot"></div>
            <div class="tl-info">
              <div class="tl-title" style="color:#888" id="audit-submit-title">Trade Passport submitted to CapBay</div>
              <div class="tl-sub" id="audit-submit-sub">Triggered automatically on consent</div>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot pend" id="audit-decision-dot"></div>
            <div class="tl-info">
              <div class="tl-title" style="color:#888" id="audit-decision-title">Financing decision</div>
              <div class="tl-sub" id="audit-decision-sub">CapBay reviews and disburses</div>
            </div>
          </div>
        </div>
        
        <div class="card">
          <div style="font-size:12px;font-weight:600;color:#dc2626;text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Why consent must come first</div>
          <div style="font-size:12px;color:#555;line-height:1.7">Under PDPA 2010, the buyer is the data subject. Their payment behaviour belongs to them — not to the supplier, not to CreditBridge. Consent must be obtained <strong>before</strong> data processing begins, not after. The Trade Passport is generated for supplier's internal review only. It is only transmitted to CapBay after this signed consent is recorded.</div>
        </div>
      </div>
    </div>
  </div>

  <!-- STAGE 5: RESULT -->
  <div class="page" id="page-result">
    <div class="back" onclick="go('pdpa')">← Back to consent</div>
    <div class="success-bar" id="result-success-bar">✓ Consent signed...</div>
    <div class="grid2">
      <div class="card">
        <div style="text-align:center;margin-bottom:16px">
          <div style="width:48px;height:48px;background:#f0fdf4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:22px;color:#1D9E75">✓</div>
          <div style="font-size:16px;font-weight:600;color:#1a1a1a">Financing approved</div>
          <div style="font-size:13px;color:#1D9E75;margin-top:4px">CapBay has accepted the Trade Passport</div>
        </div>
        <div class="result-row"><span class="rl">Invoice</span><span class="rv mono" id="res-invoice-no">INV-2026-0441</span></div>
        <div class="result-row"><span class="rl">Invoice amount</span><span class="rv" id="res-invoice-amount">RM 85,000</span></div>
        <div class="result-row"><span class="rl">Rate offered</span><span class="rv g" id="res-rate-offered">1.2% / month</span></div>
        <div class="result-row"><span class="rl">Expected disbursement</span><span class="rv g">Today</span></div>
        <div class="result-row"><span class="rl">Payment route</span><span class="rv">Direct to Supplier account</span></div>
        <div class="result-row"><span class="rl">Invoice status</span><span class="rv"><span class="badge b-fin">Financed</span></span></div>
        <div class="disclaimer">Funds will not pass through Buyer's account.<br>Direct Pay to supplier only · Regulated under BNMRH/GL000010</div>
      </div>
      
      <div>
        <div class="card">
          <div style="font-size:12px;font-weight:600;color:#555;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Full transaction timeline</div>
          <div class="tl-container" id="result-timeline">
            <!-- Filled dynamically -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- TOAST NOTIFICATION CONTAINER -->
<div id="toast-notification">
  <span style="font-weight: bold; color: #1D9E75;">✓</span>
  <span id="toast-message">Action completed successfully.</span>
</div>

<script>
// Seed Data from PHP
const SEED_DATABASE = <?php echo json_encode($initial_database); ?>;

// State Management
let db;
try {
  db = JSON.parse(localStorage.getItem('creditbridge_db'));
} catch (e) {
  db = null;
}
if (!db || !db.defong || !db.defong.clients || !db.defong.clients.chuan_luck) {
  db = SEED_DATABASE;
  localStorage.setItem('creditbridge_db', JSON.stringify(db));
}

let activeCompanyId = localStorage.getItem('creditbridge_active_company') || 'defong';
if (!db[activeCompanyId]) {
  activeCompanyId = Object.keys(db)[0];
}

// Sub-state for current passport client and invoice bundle tracking
let activeClientId = localStorage.getItem('creditbridge_active_client') || 'chuan_luck';
let selectedInvoiceNumbers = [];
try {
  selectedInvoiceNumbers = JSON.parse(localStorage.getItem('creditbridge_selected_invoices'));
} catch (e) {
  selectedInvoiceNumbers = null;
}
if (!Array.isArray(selectedInvoiceNumbers)) {
  selectedInvoiceNumbers = ['INV-2026-0441'];
}

// Validate active client exists for active company
if (!activeClientId || !db[activeCompanyId].clients[activeClientId]) {
  const clients = db[activeCompanyId].clients;
  if (Object.keys(clients).length > 0) {
    activeClientId = Object.keys(clients)[0];
  } else {
    activeClientId = '';
  }
}

// Validate that selected invoice numbers belong to this client and are outstanding
if (activeClientId) {
  const clientInvoices = db[activeCompanyId].clients[activeClientId].invoices;
  const outstandingInvs = clientInvoices.filter(i => i.status !== 'Paid' && i.financing_status !== 'Financed');
  
  // Clean invalid or completed invoices from the selection list
  selectedInvoiceNumbers = selectedInvoiceNumbers.filter(invNo => {
    return outstandingInvs.some(i => i.invoice_no === invNo);
  });
  
  // Default to first outstanding invoice if selection is empty
  if (selectedInvoiceNumbers.length === 0 && outstandingInvs.length > 0) {
    selectedInvoiceNumbers = [outstandingInvs[0].invoice_no];
  }
} else {
  selectedInvoiceNumbers = [];
}

// Persistence helpers
function saveState() {
  localStorage.setItem('creditbridge_db', JSON.stringify(db));
  localStorage.setItem('creditbridge_active_company', activeCompanyId);
  localStorage.setItem('creditbridge_active_client', activeClientId);
  localStorage.setItem('creditbridge_selected_invoices', JSON.stringify(selectedInvoiceNumbers));
}

function showToast(message) {
  const toast = document.getElementById('toast-notification');
  document.getElementById('toast-message').textContent = message;
  toast.classList.add('show');
  setTimeout(() => {
    toast.classList.remove('show');
  }, 3500);
}

// Format Currency
function formatCurrency(amount) {
  return 'RM ' + parseFloat(amount).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
}

// Initialize on load
window.addEventListener('DOMContentLoaded', () => {
  populateCompanySelects();
  updateSetupFormFields();
  render();
});

// Populate topbar and settings selects
function populateCompanySelects() {
  const topSelect = document.getElementById('topbar-company-select');
  topSelect.innerHTML = '';
  
  for (let cId in db) {
    const option = document.createElement('option');
    option.value = cId;
    option.textContent = db[cId].name;
    if (cId === activeCompanyId) {
      option.selected = true;
    }
    topSelect.appendChild(option);
  }
  
  // Also update badge
  document.getElementById('active-company-badge').textContent = db[activeCompanyId].name;
}

// Update settings inputs based on active company
function updateSetupFormFields() {
  const company = db[activeCompanyId];
  document.getElementById('setup-company-name').value = company.name;
  document.getElementById('setup-tin').value = company.tin;
  document.getElementById('setup-ssm').value = company.ssm;
  document.getElementById('setup-industry').value = company.industry;
  document.getElementById('setup-client-id').value = company.client_id || '';
  document.getElementById('setup-client-secret').value = company.client_secret || '';
  
  // Set DO Options UI
  setDoMethodUI(company.do_method || 'whatsapp');
}

function setDoMethodUI(method) {
  document.querySelectorAll('.do-option-btn').forEach(btn => {
    btn.style.borderColor = '#e5e7eb';
    btn.style.color = '#888';
    btn.style.background = '#fff';
  });
  
  const activeBtn = document.getElementById('do-' + method);
  if (activeBtn) {
    activeBtn.style.borderColor = '#1D9E75';
    activeBtn.style.color = '#1D9E75';
    activeBtn.style.background = '#f0fdf4';
  }
}

// Handlers for Setup page
function switchCompany(cId) {
  activeCompanyId = cId;
  
  // Auto switch default client/invoice
  const company = db[activeCompanyId];
  if (Object.keys(company.clients).length > 0) {
    activeClientId = Object.keys(company.clients)[0];
    const client = company.clients[activeClientId];
    const outstandingInvs = client.invoices.filter(i => i.status !== 'Paid' && i.financing_status !== 'Financed');
    if (outstandingInvs.length > 0) {
      selectedInvoiceNumbers = [outstandingInvs[0].invoice_no];
    } else if (client.invoices.length > 0) {
      selectedInvoiceNumbers = [client.invoices[0].invoice_no];
    } else {
      selectedInvoiceNumbers = [];
    }
  } else {
    activeClientId = '';
    selectedInvoiceNumbers = [];
  }
  
  saveState();
  populateCompanySelects();
  updateSetupFormFields();
  render();
  showToast(`Switched active profile to ${company.name}`);
}

function setDoMethod(method) {
  db[activeCompanyId].do_method = method;
  saveState();
  setDoMethodUI(method);
  showToast(`DO delivery method updated to: ${method}`);
}

function saveActiveCompanyProfile() {
  const comp = db[activeCompanyId];
  comp.name = document.getElementById('setup-company-name').value;
  comp.tin = document.getElementById('setup-tin').value;
  comp.ssm = document.getElementById('setup-ssm').value;
  comp.industry = document.getElementById('setup-industry').value;
  
  saveState();
  populateCompanySelects();
  render();
  showToast('Company profile saved successfully!');
}

function createNewCompanyProfile() {
  const name = document.getElementById('new-company-name').value.trim();
  const tin = document.getElementById('new-tin').value.trim();
  const ssm = document.getElementById('new-ssm').value.trim();
  const industry = document.getElementById('new-industry').value;
  
  if (!name || !tin || !ssm) {
    alert('Please enter Company Name, TIN, and SSM Registration number.');
    return;
  }
  
  const id = name.toLowerCase().replace(/[^a-z0-9]/g, '_').replace(/_+/g, '_');
  if (db[id]) {
    alert('A profile with this name or ID already exists.');
    return;
  }
  
  db[id] = {
    id: id,
    name: name,
    tin: tin,
    ssm: ssm,
    industry: industry,
    client_id: 'ERP-' + Math.floor(100000 + Math.random() * 900000),
    client_secret: '••••••••••••••••',
    do_method: 'whatsapp',
    clients: {}
  };
  
  // Clear forms
  document.getElementById('new-company-name').value = '';
  document.getElementById('new-tin').value = '';
  document.getElementById('new-ssm').value = '';
  
  switchCompany(id);
  showToast(`New company profile "${name}" successfully registered!`);
}

function saveCredentialsAndContinue() {
  const client_id = document.getElementById('setup-client-id').value;
  const client_secret = document.getElementById('setup-client-secret').value;
  
  if (!client_id || !client_secret) {
    alert('Please provide your ERP Client ID and Secret to authorise LHDN connection.');
    return;
  }
  
  db[activeCompanyId].client_id = client_id;
  db[activeCompanyId].client_secret = client_secret.replace(/./g, '•'); // encrypt/mask in mock DB
  
  // Update step visual in Setup page
  document.getElementById('cred-step-dot').classList.add('done');
  document.getElementById('cred-step-dot').textContent = '✓';
  document.getElementById('step-do-dot').classList.remove('pend');
  
  saveState();
  showToast('LHDN credentials connected! Sync established.');
  
  // Redirect to Ingestion tab
  setTimeout(() => {
    go('ingest');
  }, 500);
}

function resetDemoDatabase() {
  if (confirm('Are you sure you want to reset all records back to the initial demo configuration? Any custom profiles, customers, or invoices you added will be lost.')) {
    localStorage.removeItem('creditbridge_db');
    localStorage.removeItem('creditbridge_selected_invoices');
    db = SEED_DATABASE;
    activeCompanyId = 'defong';
    activeClientId = 'chuan_luck';
    selectedInvoiceNumbers = ['INV-2026-0441'];
    saveState();
    populateCompanySelects();
    updateSetupFormFields();
    render();
    showToast('Demo database successfully re-seeded!');
    go('onboard');
  }
}

// Stage 1: Data Ingestion Functions
function simulateBankCsvDrop() {
  const company = db[activeCompanyId];
  let matchedCount = 0;
  
  for (let cId in company.clients) {
    company.clients[cId].invoices.forEach(inv => {
      if (inv.bank === 'pending') {
        inv.bank = 'verified';
        matchedCount++;
      }
    });
  }
  
  if (matchedCount > 0) {
    saveState();
    render();
    
    const alertBar = document.getElementById('ingest-success-alert');
    alertBar.innerHTML = `<strong>✓ Bank Statement Reconciled:</strong> Match completed successfully! ${matchedCount} invoice(s) verified via Maybank/CIMB CSV audit match.`;
    alertBar.style.display = 'flex';
    
    showToast(`Successfully reconciled ${matchedCount} invoices!`);
  } else {
    showToast('All invoices already reconciled with bank statements.');
  }
}

function addInvoice() {
  const cId = document.getElementById('invoice-client-select').value;
  const invNo = document.getElementById('invoice-no').value.trim();
  const amount = parseFloat(document.getElementById('invoice-amount').value);
  const date = document.getElementById('invoice-date').value;
  const status = document.getElementById('invoice-status').value;
  
  const chkLhdn = document.getElementById('invoice-chk-lhdn').checked ? 'verified' : 'pending';
  const chkBank = document.getElementById('invoice-chk-bank').checked ? 'verified' : 'pending';
  const chkDo = document.getElementById('invoice-chk-do').checked ? 'verified' : 'pending';
  
  if (!invNo || isNaN(amount) || amount <= 0 || !date) {
    alert('Please fill out all invoice parameters correctly.');
    return;
  }
  
  // Check if invoice number is duplicate
  let duplicate = false;
  for (let clientKey in db[activeCompanyId].clients) {
    const client = db[activeCompanyId].clients[clientKey];
    if (client.invoices.some(i => i.invoice_no === invNo)) {
      duplicate = true;
      break;
    }
  }
  if (duplicate) {
    alert(`Invoice number "${invNo}" already exists in the database.`);
    return;
  }
  
  const newInv = {
    invoice_no: invNo,
    amount: amount,
    date: date,
    status: status,
    overdue_days: status === 'Overdue' ? 14 : (status === 'Due Soon' ? 10 : 0),
    einvoice: chkLhdn,
    bank: chkBank,
    do: chkDo,
    pdpa_signed: false,
    pdpa_reference: 'CBR-PDPA-' + invNo.replace(/[^A-Za-z0-9]/g, ''),
    pdpa_requested_at: new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) + ' at ' + new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false }),
    financing_status: 'none'
  };
  
  db[activeCompanyId].clients[cId].invoices.unshift(newInv);
  
  // Auto set active client and check the newly created invoice by default
  activeClientId = cId;
  selectedInvoiceNumbers = [invNo];
  
  saveState();
  render();
  
  // Reset fields
  document.getElementById('invoice-no').value = 'INV-2026-0' + Math.floor(443 + Math.random() * 50);
  document.getElementById('invoice-amount').value = '45000';
  
  showToast(`Invoice ${invNo} issued and synced!`);
}

// Stage 2: Dashboard Functions
function addCustomer() {
  const name = document.getElementById('new-client-name').value.trim();
  const coop = parseInt(document.getElementById('new-client-coop').value);
  const paydays = parseInt(document.getElementById('new-client-paydays').value);
  const promised = parseInt(document.getElementById('new-client-promised').value) || 60;
  const freq = document.getElementById('new-client-frequency').value;
  const trend = document.getElementById('new-client-trend').value;
  const health = document.getElementById('new-client-health').value;
  
  if (!name || isNaN(coop) || isNaN(paydays)) {
    alert('Please enter Customer Name, Years of cooperation, and Average payment duration.');
    return;
  }
  
  const cId = name.toLowerCase().replace(/[^a-z0-9]/g, '_').replace(/_+/g, '_');
  if (db[activeCompanyId].clients[cId]) {
    alert('A customer with this name already exists.');
    return;
  }
  
  // Set health score base estimate
  let healthScore = 780;
  if (health === 'Amber') healthScore = 550;
  if (health === 'Toxic') healthScore = 320;
  
  db[activeCompanyId].clients[cId] = {
    id: cId,
    name: name,
    relationship: `${coop}-year customer · avg ${paydays} days`,
    health_status: health,
    health_score: healthScore,
    frequency: freq,
    frequency_rate: freq === 'High' ? '3.5× / month' : (freq === 'Medium' ? '1.8× / month' : '0.6× / month'),
    payment_days: paydays,
    promised_days: promised,
    coop_years: coop,
    trend: trend,
    total_transacted: 'RM ' + ((paydays * coop * 5000) / 1000).toFixed(0) + 'k',
    invoices: []
  };
  
  // Clear forms
  document.getElementById('new-client-name').value = '';
  document.getElementById('new-client-coop').value = '3';
  document.getElementById('new-client-paydays').value = '65';
  
  saveState();
  render();
  showToast(`Registered Customer: "${name}"`);
}

function selectClientAndGeneratePassport(cId, invNo) {
  activeClientId = cId;
  const client = db[activeCompanyId].clients[cId];
  
  selectedInvoiceNumbers = [];
  if (invNo) {
    selectedInvoiceNumbers.push(invNo);
  } else {
    const outstanding = client.invoices.find(i => i.status !== 'Paid' && i.financing_status !== 'Financed');
    if (outstanding) {
      selectedInvoiceNumbers.push(outstanding.invoice_no);
    }
  }
  
  saveState();
  go('passport');
}

function goToPassportFromDashboard() {
  const company = db[activeCompanyId];
  const cIds = Object.keys(company.clients);
  if (cIds.length === 0) {
    alert('Please register at least one client/buyer first.');
    return;
  }
  
  let selectedClientId = cIds[0];
  let selectedInvoiceNo = '';
  
  for (let cId of cIds) {
    const client = company.clients[cId];
    const outstanding = client.invoices.find(i => i.status !== 'Paid' && i.financing_status !== 'Financed');
    if (outstanding) {
      selectedClientId = cId;
      selectedInvoiceNo = outstanding.invoice_no;
      break;
    }
  }
  
  selectClientAndGeneratePassport(selectedClientId, selectedInvoiceNo);
}

// Stage 3: Trade Passport Evaluation
let globalApiResponse = null;
let globalActiveClient = null;

function toggleInvoiceSelection(invNo, checked) {
  if (checked) {
    if (!selectedInvoiceNumbers.includes(invNo)) {
      selectedInvoiceNumbers.push(invNo);
    }
  } else {
    selectedInvoiceNumbers = selectedInvoiceNumbers.filter(n => n !== invNo);
  }
  saveState();
  
  // Re-calculate bundle sum and update action panel dynamically
  if (globalApiResponse && globalActiveClient) {
    updatePassportCalculations(globalApiResponse, globalActiveClient);
  }
}

function calculateClientVerifiedRatio(client) {
  if (!client.invoices || client.invoices.length === 0) return 1.0;
  let verifiedCount = 0;
  client.invoices.forEach(i => {
    if (i.einvoice === 'verified' && i.bank === 'verified' && i.do === 'verified') {
      verifiedCount++;
    }
  });
  return verifiedCount / client.invoices.length;
}

function evaluateTradePassport() {
  const loadingState = document.getElementById('loading-state');
  const loadedState = document.getElementById('loaded-state');
  const loadingText = document.getElementById('loading-text');
  
  const company = db[activeCompanyId];
  const client = company.clients[activeClientId];
  
  loadingState.classList.remove('hidden');
  loadedState.classList.add('hidden');
  
  // Simulate API delay text sequence with actual LHDN SDK endpoints
  const sequence = [
    "POST /connect/token ➔ Authenticating taxpayer client credentials...",
    `GET /api/v1.0/taxpayer/validate/${client ? (client.tin || 'C2584563222') : 'C2584563222'} ➔ Validating buyer TIN registry...`,
    "GET /api/v1.0/documents/recent ➔ Pulling recent B2B LHDN e-Invoices...",
    "GET /api/v1.0/documents/details ➔ Reconciling validation hashes & DO terms...",
    "Executing CreditBridge Algorithmic Risk Triage..."
  ];
  let seqIndex = 0;
  loadingText.textContent = "Initializing ERP e-Invoice Sync...";
  
  const intervalId = setInterval(() => {
    if (seqIndex < sequence.length) {
      loadingText.style.opacity = 0;
      setTimeout(() => {
        loadingText.textContent = sequence[seqIndex];
        loadingText.style.opacity = 1;
        seqIndex++;
      }, 150);
    }
  }, 750);
  
  if (!client) {
    clearInterval(intervalId);
    loadingState.classList.add('hidden');
    loadedState.classList.remove('hidden');
    document.getElementById('loaded-state').innerHTML = `
      <div style="padding: 60px; text-align: center; color: #888;">
        <h3>No active buyer selected</h3>
        <p style="margin-top: 10px;">Please select a buyer from the Dashboard first.</p>
      </div>
    `;
    return;
  }
  
  const verifiedRatio = calculateClientVerifiedRatio(client);
  const hasLhdn = client.invoices.some(i => i.einvoice === 'verified');

  // Call the dynamic Flask math engine backend!
  const url = `/api/evaluate?id=${client.id}` +
              `&name=${encodeURIComponent(client.name)}` +
              `&promised=${client.promised_days}` +
              `&actual=${client.payment_days}` +
              `&frequency=${client.frequency}` +
              `&coop=${client.coop_years}` +
              `&trend=${client.trend}` +
              `&verified_ratio=${verifiedRatio}` +
              `&lhdn=${hasLhdn}`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      clearInterval(intervalId);
      setTimeout(() => {
        loadingState.classList.add('hidden');
        loadedState.classList.remove('hidden');
        
        // Cache globally for toggles
        globalApiResponse = data;
        globalActiveClient = client;
        
        renderPassportResults(data, client);
      }, 300);
    })
    .catch(err => {
      console.warn("Backend evaluation API error. Falling back to local scoring calculation...", err);
      clearInterval(intervalId);
      setTimeout(() => {
        loadingState.classList.add('hidden');
        loadedState.classList.remove('hidden');
        
        // Local fallback preset generator
        const fallbackData = {
          contractor_name: client.name,
          trade_passport: {
            transaction_frequency: client.frequency_rate,
            years_cooperation: client.coop_years,
            amount_trend: client.trend,
            payment_days: client.payment_days,
            promised_days: client.promised_days,
            total_transacted: client.total_transacted,
            scores: {
              timeliness: client.health_status === 'Prime' ? 218 : (client.health_status === 'Amber' ? 145 : 65),
              frequency: client.frequency === 'High' ? 176 : 120,
              coop: Math.min(200, 90 + 11 * client.coop_years),
              trend: client.trend === 'Growing' ? 120 : 90,
              verification: Math.round(verifiedRatio * 150)
            },
            total_score: client.health_score
          },
          advisory_action: {
            status: client.health_status,
            funder_message: client.health_status === 'Prime' ? "Eligible for 1.2% CapBay Premium Financing" : (client.health_status === 'Amber' ? "Eligible for 2.5% CapBay Standard Financing" : "Rejected for Financing. Supplier holds 100% Risk")
          }
        };
        globalApiResponse = fallbackData;
        globalActiveClient = client;
        
        renderPassportResults(fallbackData, client);
      }, 300);
    });
}

function updatePassportCalculations(apiResponse, client) {
  let totalSelectedAmount = 0;
  
  selectedInvoiceNumbers.forEach(invNo => {
    const inv = client.invoices.find(i => i.invoice_no === invNo);
    if (inv) {
      totalSelectedAmount += inv.amount;
    }
  });
  
  const adv = apiResponse.advisory_action;
  
  // Render warn bar
  const warnBar = document.getElementById('passport-warn-bar');
  if (selectedInvoiceNumbers.length === 0) {
    warnBar.className = 'warn-bar';
    warnBar.style.background = '#fafafa';
    warnBar.style.borderColor = '#e5e7eb';
    warnBar.style.color = '#666';
    warnBar.innerHTML = `⚙ Please select at least one outstanding invoice to finance.`;
  } else if (adv.status === 'Toxic') {
    warnBar.className = 'warn-bar';
    warnBar.style.background = '#fef2f2';
    warnBar.style.borderColor = '#fecaca';
    warnBar.style.color = '#b91c1c';
    warnBar.innerHTML = `⚠ <strong>High default risk warning:</strong> CapBay has rejected this transaction for automated routing due to late payments. Defong Enterprise holds 100% credit default risk.`;
  } else {
    warnBar.className = 'warn-bar';
    warnBar.style.background = '#fffbeb';
    warnBar.style.borderColor = '#fde68a';
    warnBar.style.color = '#92400e';
    warnBar.innerHTML = `⚠ PDPA consent required before submitting to CapBay. Select invoices below — submit only after buyer consents.`;
  }
  
  // Render action panel
  renderPassportActionPanel(adv.status, adv.funder_message, totalSelectedAmount);
}

function renderPassportResults(apiResponse, client) {
  const tp = apiResponse.trade_passport;
  const adv = apiResponse.advisory_action;
  
  // Update header titles
  document.getElementById('passport-buyer-title').innerHTML = apiResponse.contractor_name + ` <span style="font-size:14px; font-weight: normal; color:#666;">(Buyer Passport)</span>`;
  document.getElementById('passport-buyer-sub').textContent = `Credit score and trade analytics generated dynamically from LHDN verified records`;
  
  // Update score breakdown details
  const scoreNumEl = document.getElementById('passport-score-num');
  const scoreBadgeEl = document.getElementById('passport-score-badge');
  const gaugeEl = document.getElementById('passport-score-gauge');
  
  scoreNumEl.textContent = tp.total_score;
  
  // Score badge color setup
  scoreBadgeEl.className = 'badge';
  if (adv.status === 'Prime') {
    scoreBadgeEl.classList.add('b-prime');
    scoreBadgeEl.textContent = `Prime — ${tp.total_score} / 1000`;
    scoreNumEl.style.color = '#1D9E75';
    gaugeEl.setAttribute('stroke', '#1D9E75');
  } else if (adv.status === 'Amber') {
    scoreBadgeEl.classList.add('b-amber');
    scoreBadgeEl.textContent = `Amber — ${tp.total_score} / 1000`;
    scoreNumEl.style.color = '#d97706';
    gaugeEl.setAttribute('stroke', '#d97706');
  } else {
    scoreBadgeEl.classList.add('b-toxic');
    scoreBadgeEl.textContent = `Toxic — ${tp.total_score} / 1000`;
    scoreNumEl.style.color = '#dc2626';
    gaugeEl.setAttribute('stroke', '#dc2626');
  }
  
  // Render SVG offset
  const dashArray = 251; // circle circumference
  const offset = dashArray * (1 - tp.total_score / 1000);
  gaugeEl.style.strokeDashoffset = offset;
  
  // Individual Score breakdown rows
  document.getElementById('score-val-timeliness').textContent = `${tp.scores.timeliness} / 300`;
  document.getElementById('score-val-frequency').textContent = `${tp.scores.frequency} / 200`;
  document.getElementById('score-val-coop').textContent = `${tp.scores.coop} / 200`;
  document.getElementById('score-val-trend').textContent = `${tp.scores.trend} / 150`;
  document.getElementById('score-val-verification').textContent = `${tp.scores.verification} / 150`;
  
  // Verified Transaction Data Table
  document.getElementById('p-data-freq').textContent = tp.transaction_frequency;
  document.getElementById('p-data-paydays').innerHTML = `${tp.payment_days} days <span style="font-size:11px;color:#888;font-weight:400">(promised ${tp.promised_days})</span>`;
  document.getElementById('p-data-coop').textContent = `${tp.years_cooperation} years`;
  document.getElementById('p-data-total').textContent = tp.total_transacted;
  
  // Calculate specific matched metrics
  let lhdnMatches = 0;
  let bankMatches = 0;
  let doMatches = 0;
  client.invoices.forEach(i => {
    if (i.einvoice === 'verified') lhdnMatches++;
    if (i.bank === 'verified') bankMatches++;
    if (i.do === 'verified') doMatches++;
  });
  
  const totalInvs = client.invoices.length;
  document.getElementById('p-data-lhdn').innerHTML = `${lhdnMatches} / ${totalInvs} ` + (lhdnMatches === totalInvs ? '<span style="color:#1D9E75">✓</span>' : '<span style="color:#f59e0b">⏳</span>');
  document.getElementById('p-data-bank').innerHTML = `${bankMatches} / ${totalInvs} ` + (bankMatches === totalInvs ? '<span style="color:#1D9E75">✓</span>' : '<span style="color:#f59e0b">⏳</span>');
  document.getElementById('p-data-do').innerHTML = `${doMatches} / ${totalInvs} ` + (doMatches === totalInvs ? '<span style="color:#1D9E75">✓</span>' : '<span style="color:#f59e0b">⏳</span>');
  
  // Clear and populate invoice checklist container
  const checklistContainer = document.getElementById('passport-invoice-checklist');
  checklistContainer.innerHTML = '';
  
  // Filter for outstanding invoices (i.e. not financed and not paid)
  const outstandingInvoices = client.invoices.filter(i => i.financing_status !== 'Financed' && i.status !== 'Paid');
  
  if (outstandingInvoices.length === 0) {
    checklistContainer.innerHTML = `<div style="font-size:13px; color:#888; font-style:italic; padding: 4px 0;">No outstanding invoices available for financing under this buyer's passport.</div>`;
  } else {
    outstandingInvoices.forEach(i => {
      const row = document.createElement('label');
      row.style.display = 'flex';
      row.style.alignItems = 'center';
      row.style.justifyContent = 'space-between';
      row.style.background = '#fafafa';
      row.style.border = '1px solid #e5e7eb';
      row.style.borderRadius = '8px';
      row.style.padding = '10px 14px';
      row.style.fontSize = '13px';
      row.style.cursor = 'pointer';
      
      const isChecked = selectedInvoiceNumbers.includes(i.invoice_no);
      
      row.innerHTML = `
        <div style="display:flex; align-items:center; gap:10px;">
          <input type="checkbox" value="${i.invoice_no}" ${isChecked ? 'checked' : ''} onchange="toggleInvoiceSelection(this.value, this.checked)" style="width:16px; height:16px; cursor:pointer;" />
          <strong class="mono" style="font-size:13px;">${i.invoice_no}</strong>
          <span style="color:#888; font-size:12px;">Issued: ${i.date}</span>
        </div>
        <div style="display:flex; align-items:center; gap:8px;">
          <span class="badge ${i.status === 'Overdue' ? 'b-over' : 'b-due'}">${i.status}</span>
          <strong style="color:#1a1a1a;">${formatCurrency(i.amount)}</strong>
        </div>
      `;
      checklistContainer.appendChild(row);
    });
  }
  
  // Calculate selected total and action panel
  updatePassportCalculations(apiResponse, client);
}

function renderPassportActionPanel(riskStatus, advisoryMsg, totalSelectedAmount) {
  const panel = document.getElementById('passport-action-panel');
  panel.className = ''; // remove grid
  panel.style.background = 'transparent';
  panel.style.padding = '0';
  panel.style.display = 'grid';
  panel.style.gridTemplateColumns = '1fr 1fr';
  panel.style.gap = '16px';
  panel.style.marginTop = '18px';
  
  // Left: Lorry delivery instructions
  let leftCardContent = '';
  if (riskStatus === 'Prime') {
    leftCardContent = `
      <div class="card" style="margin-bottom:0; display:flex; flex-direction:column; height:100%;">
        <h2 style="font-size:16px; margin-bottom:12px;">New Delivery Order</h2>
        <p style="font-size:13px; color:#555; line-height:1.6; flex-grow:1; margin-bottom:16px;">This contractor has an excellent payment history. Frictionless processing enabled for logistics and warehouse dispatch.</p>
        <button class="btn btn-g" style="width:100%" onclick="printDeliveryOrder()">Print Delivery Order</button>
      </div>
    `;
  } else if (riskStatus === 'Amber') {
    leftCardContent = `
      <div class="card" style="margin-bottom:0; display:flex; flex-direction:column; height:100%;">
        <h2 style="font-size:16px; margin-bottom:12px;">New Delivery Order</h2>
        <div class="warn-bar" style="font-size:11px; padding:10px; margin-bottom:12px;">
          <span><strong>Late Payer History:</strong> Buyer average collections is ${db[activeCompanyId].clients[activeClientId].payment_days} days. Proceed with standard credit check.</span>
        </div>
        <button class="btn btn-g" style="width:100%" onclick="printDeliveryOrder()">Print Delivery Order</button>
      </div>
    `;
  } else {
    leftCardContent = `
      <div class="card" style="margin-bottom:0; display:flex; flex-direction:column; height:100%;">
        <h2 style="font-size:16px; margin-bottom:12px;">New Delivery Order</h2>
        <div class="warn-bar" style="background:#fef2f2; border-color:#fee2e2; color:#b91c1c; font-size:11px; padding:10px; margin-bottom:12px;">
          <span><strong>High Default Risk:</strong> This contractor exhibits severe delays and declining trends. Manual manager bypass required to authorize DO.</span>
        </div>
        <label style="display:flex; align-items:flex-start; gap:8px; font-size:12px; color:#555; margin-bottom:14px; cursor:pointer; line-height:1.4;">
          <input type="checkbox" id="toxic-override-chk" onchange="toggleToxicButton(this.checked)" style="margin-top:2px;" />
          <span>I acknowledge the credit default risks and authorize delivery anyway.</span>
        </label>
        <button id="toxic-print-btn" class="btn" style="width:100%; background:#e5e7eb; color:#888; cursor:not-allowed;" disabled onclick="printDeliveryOrder()">Print Delivery Order</button>
      </div>
    `;
  }
  
  // Right: CapBay bridge routing
  let rightCardContent = '';
  if (selectedInvoiceNumbers.length === 0) {
    rightCardContent = `
      <div class="card" style="margin-bottom:0; background:#f8fafc; border-style:dashed; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; height:100%; padding:20px;">
        <div style="font-size:24px; margin-bottom:10px;">📄</div>
        <h3 style="font-size:15px; font-weight:700; color:#1a1a1a; margin-bottom:6px;">No Invoices Selected</h3>
        <p style="font-size:12px; color:#666; max-width:240px;">Please check at least one invoice in the list above to proceed with financing.</p>
      </div>
    `;
  } else if (riskStatus === 'Toxic') {
    rightCardContent = `
      <div class="card" style="margin-bottom:0; background:#fef2f2; border-color:#fee2e2; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; height:100%; padding:20px;">
        <div style="font-size:28px; margin-bottom:8px;">✖</div>
        <h3 style="font-size:15px; font-weight:700; color:#b91c1c; margin-bottom:6px;">Financing Unavailable</h3>
        <p style="font-size:12px; color:#7f1d1d; max-width:220px; line-height:1.5;">${advisoryMsg}</p>
      </div>
    `;
  } else {
    rightCardContent = `
      <div class="card" style="margin-bottom:0; background:#f8fafc; display:flex; flex-direction:column; justify-content:space-between; height:100%; padding:20px;">
        <div style="text-align:center;">
          <div style="width:36px; height:36px; background:#eff6ff; color:#2563eb; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:16px; margin: 0 auto 10px; font-weight:700;">💸</div>
          <h3 style="font-size:15px; font-weight:700; color:#1a1a1a; margin-bottom:4px;">Institutional Financing</h3>
          <p style="font-size:12px; color:#666; max-width:220px; margin: 0 auto; line-height:1.5;">
            Bundle selected: <strong>${selectedInvoiceNumbers.length} Invoice(s)</strong><br>
            Total Amount: <strong>${formatCurrency(totalSelectedAmount)}</strong>
          </p>
        </div>
        <button class="btn btn-b" style="width:100%; margin-top:14px;" onclick="proceedToConsent()">Submit Bundle (RM ${totalSelectedAmount.toLocaleString()}) →</button>
      </div>
    `;
  }
  
  panel.innerHTML = leftCardContent + rightCardContent;
}

function toggleToxicButton(checked) {
  const btn = document.getElementById('toxic-print-btn');
  if (checked) {
    btn.disabled = false;
    btn.style.background = '#1D9E75';
    btn.style.color = '#fff';
    btn.style.cursor = 'pointer';
  } else {
    btn.disabled = true;
    btn.style.background = '#e5e7eb';
    btn.style.color = '#888';
    btn.style.cursor = 'not-allowed';
  }
}

function printDeliveryOrder() {
  alert(`Triggered Delivery Order dispatch printing for ${db[activeCompanyId].clients[activeClientId].name}`);
  showToast("Delivery Order printed successfully!");
}

function proceedToConsent() {
  go('pdpa');
}

// Stage 4: PDPA Consent Functions
function renderConsentPage() {
  const company = db[activeCompanyId];
  const client = company.clients[activeClientId];
  
  if (selectedInvoiceNumbers.length === 0) return;
  
  let totalSelectedAmount = 0;
  selectedInvoiceNumbers.forEach(invNo => {
    const inv = client.invoices.find(i => i.invoice_no === invNo);
    if (inv) {
      totalSelectedAmount += inv.amount;
    }
  });
  
  const invoicesListStr = selectedInvoiceNumbers.join(', ');
  
  document.getElementById('pdpa-sent-info').innerHTML = `
    📨 Consent request sent to <strong>${client.name}</strong> for invoice bundle (<strong>${invoicesListStr}</strong>) totalling <strong>${formatCurrency(totalSelectedAmount)}</strong>.
  `;
  
  // Buyer profile card
  document.getElementById('pdpa-buyer-name').textContent = client.name;
  
  // Get Initials
  const initials = client.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
  document.getElementById('pdpa-buyer-initials').textContent = initials;
  
  // Update supplier names in text
  document.querySelectorAll('.pdpa-active-supplier').forEach(el => {
    el.textContent = company.name;
  });
  
  document.getElementById('pdpa-shared-history').textContent = `${selectedInvoiceNumbers.length} outstanding invoice(s): ${invoicesListStr}`;
  document.getElementById('pdpa-shared-score').textContent = `${client.health_score}/1000, ${client.health_status}`;
  
  const firstInvRef = selectedInvoiceNumbers[0];
  const consentRef = `CBR-PDPA-${firstInvRef}-${selectedInvoiceNumbers.length}`;
  document.getElementById('pdpa-consent-ref').textContent = consentRef;
  
  // Uncheck checkboxes
  document.getElementById('c1').checked = false;
  document.getElementById('c2').checked = false;
  document.getElementById('c3').checked = false;
  
  // Render Consent audit trail timeline
  const signDot = document.getElementById('audit-sign-dot');
  const signTitle = document.getElementById('audit-sign-title');
  const signSub = document.getElementById('audit-sign-sub');
  
  const submitDot = document.getElementById('audit-submit-dot');
  const submitTitle = document.getElementById('audit-submit-title');
  const submitSub = document.getElementById('audit-submit-sub');
  
  const decisionDot = document.getElementById('audit-decision-dot');
  const decisionTitle = document.getElementById('audit-decision-title');
  const decisionSub = document.getElementById('audit-decision-sub');
  
  document.getElementById('audit-sent-time').textContent = `June 28, 2026 at 14:32 · WhatsApp + email`;
  
  const isBundleFinanced = selectedInvoiceNumbers.every(invNo => {
    const inv = client.invoices.find(i => i.invoice_no === invNo);
    return inv && inv.financing_status === 'Financed';
  });
  
  if (isBundleFinanced) {
    signDot.className = 'tl-dot';
    signTitle.style.color = '#1a1a1a';
    signTitle.textContent = 'Buyer signed consent';
    signSub.textContent = `Completed on consent receipt`;
    
    submitDot.className = 'tl-dot';
    submitTitle.style.color = '#1a1a1a';
    submitSub.textContent = 'Submitted to CapBay';
    
    decisionDot.className = 'tl-dot';
    decisionTitle.style.color = '#1a1a1a';
    decisionSub.textContent = 'Approved. Funds disbursed';
  } else {
    signDot.className = 'tl-dot pend';
    signTitle.style.color = '#888';
    signTitle.textContent = 'Buyer signs consent';
    signSub.textContent = 'Awaiting response...';
    
    submitDot.className = 'tl-dot pend';
    submitTitle.style.color = '#888';
    submitSub.textContent = 'Triggered automatically on consent';
    
    decisionDot.className = 'tl-dot pend';
    decisionTitle.style.color = '#888';
    decisionSub.textContent = 'CapBay reviews and disburses';
  }
}

function signConsent() {
  const c1 = document.getElementById('c1').checked;
  const c2 = document.getElementById('c2').checked;
  const c3 = document.getElementById('c3').checked;
  
  if (!c1 || !c2 || !c3) {
    alert('Please check all three consent checkboxes before signing the legal agreement.');
    return;
  }
  
  const company = db[activeCompanyId];
  const client = company.clients[activeClientId];
  
  let countFinanced = 0;
  selectedInvoiceNumbers.forEach(invNo => {
    const invoice = client.invoices.find(i => i.invoice_no === invNo);
    if (invoice) {
      invoice.pdpa_signed = true;
      invoice.financing_status = 'Financed';
      invoice.status = 'Paid'; // mark invoice paid since supplier gets funded immediately
      countFinanced++;
    }
  });
  
  if (countFinanced > 0) {
    saveState();
    showToast(`PDPA consent recorded! Reconciled and financed ${countFinanced} invoices with CapBay.`);
  }
  
  go('result');
}

// Stage 5: Result Page Functions
function renderResultPage() {
  const company = db[activeCompanyId];
  const client = company.clients[activeClientId];
  
  if (selectedInvoiceNumbers.length === 0) return;
  
  let totalSelectedAmount = 0;
  selectedInvoiceNumbers.forEach(invNo => {
    const inv = client.invoices.find(i => i.invoice_no === invNo);
    if (inv) {
      totalSelectedAmount += inv.amount;
    }
  });
  
  const signTime = new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) + ' at ' + new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
  const firstInvRef = selectedInvoiceNumbers[0];
  const consentRef = `CBR-PDPA-${firstInvRef}-${selectedInvoiceNumbers.length}`;
  
  document.getElementById('result-success-bar').innerHTML = `✓ Consent signed by <strong>${client.name}</strong> · ${signTime} · Ref: ${consentRef}`;
  
  document.getElementById('res-invoice-no').textContent = selectedInvoiceNumbers.join(', ');
  document.getElementById('res-invoice-amount').textContent = formatCurrency(totalSelectedAmount);
  
  // Rate offered based on score
  const rate = client.health_status === 'Prime' ? '1.2% / month' : '2.5% / month';
  const normalRate = client.health_status === 'Prime' ? '2.8%' : '4.5%';
  document.getElementById('res-rate-offered').innerHTML = `${rate} <span style="font-size:11px;color:#888;font-weight:400">vs normal <s style="color:#dc2626">${normalRate}</s></span>`;
  
  // Create dynamic timeline list
  const tl = document.getElementById('result-timeline');
  tl.innerHTML = '';
  
  const timelineItems = [
    { title: `Invoice bundle created for ${client.name}`, sub: `${selectedInvoiceNumbers.join(', ')} · Total: ${formatCurrency(totalSelectedAmount)}` },
    { title: `eInvoices validated by LHDN`, sub: `All invoices checked and matched via eCredit Bridge API` },
    { title: `Warehouse dispatch DOs confirmed`, sub: `Lorry delivery receipts verified` },
    { title: `Trade Passport credit rating evaluated`, sub: `Score ${client.health_score} / 1000 (${client.health_status})` },
    { title: `PDPA consent signed by buyer`, sub: `Consent Ref: ${consentRef} recorded` },
    { title: `CapBay approved and disbursed`, sub: `Disbursing ${formatCurrency(totalSelectedAmount)} directly to ${company.name}` },
    { title: `${client.name} repays CapBay`, sub: `Terms: 60 days cycle from invoice date`, isPending: true }
  ];
  
  timelineItems.forEach(item => {
    const el = document.createElement('div');
    el.className = 'tl-item';
    el.innerHTML = `
      <div class="tl-dot ${item.isPending ? 'pend' : ''}"></div>
      <div class="tl-info">
        <div class="tl-title" ${item.isPending ? 'style="color:#888"' : ''}>${item.title}</div>
        <div class="tl-sub">${item.sub}</div>
      </div>
    `;
    tl.appendChild(el);
  });
}

function verifyInvoiceSource(clientId, invoiceNo, source) {
  const company = db[activeCompanyId];
  const client = company.clients[clientId];
  const invoice = client.invoices.find(i => i.invoice_no === invoiceNo);
  if (invoice) {
    invoice[source] = 'verified';
    
    // Check if fully verified, and update status if so
    const isFullyVerified = invoice.einvoice === 'verified' && invoice.bank === 'verified' && invoice.do === 'verified';
    if (isFullyVerified && invoice.status !== 'Paid') {
      invoice.status = 'Paid'; // mark verified
    }
    
    saveState();
    render();
    
    let label = '';
    if (source === 'einvoice') label = 'LHDN eInvoice';
    if (source === 'bank') label = 'Bank Statement';
    if (source === 'do') label = 'Delivery Order (DO)';
    
    showToast(`${invoiceNo} successfully verified via ${label}!`);
  }
}

function renderIngestInvoices() {
  const tbody = document.getElementById('ingest-table-body');
  const filterSelect = document.getElementById('ingest-client-filter');
  const filterVal = filterSelect.value || 'all';
  
  tbody.innerHTML = '';
  
  const company = db[activeCompanyId];
  let totalInvoices = 0;
  let verifiedInvoices = 0;
  
  for (let cId in company.clients) {
    if (filterVal !== 'all' && cId !== filterVal) continue;
    
    const client = company.clients[cId];
    client.invoices.forEach(inv => {
      totalInvoices++;
      
      const isVerified = inv.einvoice === 'verified' && inv.bank === 'verified' && inv.do === 'verified';
      if (isVerified) verifiedInvoices++;
      
      // Determine status badge
      let statusBadge = '';
      if (inv.financing_status === 'Financed') {
        statusBadge = '<span class="badge b-fin">Financed</span>';
      } else if (inv.status === 'Paid' || isVerified) {
        statusBadge = '<span class="badge b-paid">Verified</span>';
      } else {
        statusBadge = '<span class="badge b-due">Partial</span>';
      }
      
      // Clickable triggers for demo
      const lhdnCell = inv.einvoice === 'verified'
        ? '<span style="color:#1D9E75; font-weight:bold;">✓</span>'
        : `<span style="color:#f59e0b; font-weight:bold; cursor:pointer; font-size:14px;" title="Click to verify eInvoice" onclick="verifyInvoiceSource('${cId}', '${inv.invoice_no}', 'einvoice')">⏳</span>`;
        
      const bankCell = inv.bank === 'verified'
        ? '<span style="color:#1D9E75; font-weight:bold;">✓</span>'
        : `<span style="color:#f59e0b; font-weight:bold; cursor:pointer; font-size:14px;" title="Click to reconcile with Bank" onclick="verifyInvoiceSource('${cId}', '${inv.invoice_no}', 'bank')">⏳</span>`;
        
      const doCell = inv.do === 'verified'
        ? '<span style="color:#1D9E75; font-weight:bold;">✓</span>'
        : `<span style="color:#f59e0b; font-weight:bold; cursor:pointer; font-size:14px;" title="Click to confirm delivery DO" onclick="verifyInvoiceSource('${cId}', '${inv.invoice_no}', 'do')">⏳</span>`;
      
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="mono">${inv.invoice_no}</td>
        <td class="bold">${client.name}</td>
        <td class="bold">${formatCurrency(inv.amount)}</td>
        <td style="text-align:center;">${lhdnCell}</td>
        <td style="text-align:center;">${bankCell}</td>
        <td style="text-align:center;">${doCell}</td>
        <td>${statusBadge}</td>
      `;
      tbody.appendChild(tr);
    });
  }
  
  // Update ingestion stats
  let lhdnSyncedCount = 0;
  for (let cId in company.clients) {
    company.clients[cId].invoices.forEach(inv => {
      if (inv.einvoice === 'verified') lhdnSyncedCount++;
    });
  }
  document.getElementById('ingest-lhdn-count').textContent = `${lhdnSyncedCount} invoices synced today`;
  
  let doConfirmedCount = 0;
  let doTotalCount = 0;
  for (let cId in company.clients) {
    company.clients[cId].invoices.forEach(inv => {
      doTotalCount++;
      if (inv.do === 'verified') doConfirmedCount++;
    });
  }
  document.getElementById('ingest-do-count').textContent = `${doConfirmedCount}/${doTotalCount} DOs confirmed`;
  
  const verRate = totalInvoices > 0 ? Math.round((verifiedInvoices / totalInvoices) * 100) : 0;
  document.getElementById('ingest-progress-bar').style.width = verRate + '%';
  document.getElementById('ingest-progress-label').textContent = `${verRate}% fully verified (${verifiedInvoices}/${totalInvoices} invoices)`;
}

function renderDashboard() {
  const tbody = document.getElementById('dash-table-body');
  tbody.innerHTML = '';
  
  const company = db[activeCompanyId];
  document.getElementById('dashboard-company-title').textContent = company.name;
  
  let totalAR = 0;
  let totalOverdue = 0;
  let avgCollectionDaysSum = 0;
  let clientsCount = 0;
  
  for (let cId in company.clients) {
    const client = company.clients[cId];
    clientsCount++;
    avgCollectionDaysSum += client.payment_days;
    
    let clientAR = 0;
    let clientOverdue = 0;
    let clientStatus = 'Paid';
    let clientOverdueDays = 0;
    
    client.invoices.forEach(inv => {
      if (inv.financing_status !== 'Financed' && inv.status !== 'Paid') {
        const isFullyVerified = inv.einvoice === 'verified' && inv.bank === 'verified' && inv.do === 'verified';
        if (isFullyVerified) return; // ignore fully verified/paid
        
        clientAR += inv.amount;
        if (inv.status === 'Overdue') {
          clientOverdue += inv.amount;
          clientStatus = 'Overdue';
          clientOverdueDays = Math.max(clientOverdueDays, inv.overdue_days);
        } else if (inv.status === 'Due Soon' && clientStatus !== 'Overdue') {
          clientStatus = 'Due Soon';
          clientOverdueDays = Math.max(clientOverdueDays, inv.overdue_days);
        }
      }
    });
    
    totalAR += clientAR;
    totalOverdue += clientOverdue;
    
    const badgeColor = client.health_status === 'Prime' ? 'b-prime' : (client.health_status === 'Amber' ? 'b-amber' : 'b-toxic');
    
    let statusBadge = '';
    if (clientStatus === 'Overdue') {
      statusBadge = '<span class="badge b-over">Overdue</span>';
    } else if (clientStatus === 'Due Soon') {
      statusBadge = '<span class="badge b-due">Due Soon</span>';
    } else {
      statusBadge = '<span class="badge b-paid">Paid</span>';
    }
    
    let actionBtn = '';
    const outstandingInvoice = client.invoices.find(inv => inv.financing_status !== 'Financed' && inv.status !== 'Paid' && !(inv.einvoice === 'verified' && inv.bank === 'verified' && inv.do === 'verified'));
    if (outstandingInvoice) {
      actionBtn = `<button class="btn btn-g" style="padding:5px 12px;font-size:11px" onclick="selectClientAndGeneratePassport('${cId}', '${outstandingInvoice.invoice_no}')">Trade Passport</button>`;
    } else {
      const anyInvoice = client.invoices[0];
      actionBtn = `<button class="btn btn-ghost" style="padding:5px 12px;font-size:11px" onclick="selectClientAndGeneratePassport('${cId}', '${anyInvoice ? anyInvoice.invoice_no : ''}')">View Passport</button>`;
    }
    
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        <div class="bold">${client.name}</div>
        <div class="mono">${client.relationship}</div>
      </td>
      <td class="bold">${formatCurrency(clientAR)}</td>
      <td><span class="badge ${badgeColor}">${client.health_status} (${client.health_score})</span></td>
      <td>${statusBadge}</td>
      <td style="color:${clientStatus === 'Overdue' ? '#dc2626' : (clientStatus === 'Due Soon' ? '#92400e' : '#555')}; font-weight:600;">
        ${clientStatus === 'Overdue' ? clientOverdueDays + ' days' : (clientStatus === 'Due Soon' ? clientOverdueDays + ' days' : '—')}
      </td>
      <td>${actionBtn}</td>
    `;
    tbody.appendChild(tr);
  }
  
  document.getElementById('dash-total-receivables').textContent = formatCurrency(totalAR);
  document.getElementById('dash-overdue').textContent = formatCurrency(totalOverdue);
  
  const avgCollection = clientsCount > 0 ? Math.round(avgCollectionDaysSum / clientsCount) : 0;
  document.getElementById('dash-avg-collection').textContent = `${avgCollection} days`;
}

// Master Render loop based on active tab state
function render() {
  // 1. Setup client filter dropdowns in Data Ingest and invoice select inputs
  const comp = db[activeCompanyId];
  
  const filterSelect = document.getElementById('ingest-client-filter');
  const clientSelect = document.getElementById('invoice-client-select');
  
  const selectedFilterVal = filterSelect.value || 'all';
  
  filterSelect.innerHTML = '<option value="all">All Buyers</option>';
  clientSelect.innerHTML = '';
  
  for (let cId in comp.clients) {
    // Ingest page filter
    const optFilter = document.createElement('option');
    optFilter.value = cId;
    optFilter.textContent = comp.clients[cId].name;
    if (cId === selectedFilterVal) optFilter.selected = true;
    filterSelect.appendChild(optFilter);
    
    // Add Invoice form select
    const optClient = document.createElement('option');
    optClient.value = cId;
    optClient.textContent = comp.clients[cId].name;
    clientSelect.appendChild(optClient);
  }
  
  // Render sub sections
  renderIngestInvoices();
  renderDashboard();
  
  if (currentPage === 'passport') {
    evaluateTradePassport();
  } else if (currentPage === 'pdpa') {
    renderConsentPage();
  } else if (currentPage === 'result') {
    renderResultPage();
  }
}

// Intercept routing function
let currentPage = 'onboard';
function go(id) {
  currentPage = id;
  
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.np').forEach(n => n.classList.remove('active'));
  
  const pageEl = document.getElementById('page-' + id);
  if (pageEl) pageEl.classList.add('active');
  
  const navEl = document.getElementById('n-' + id);
  if (navEl) navEl.classList.add('active');
  
  render();
}
</script>

</body>
</html>
