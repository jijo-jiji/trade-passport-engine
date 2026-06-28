# 🚀 eCredit Bridge (Trade Passport Engine)
**Mandatory eInvoice Integration for Instant supply Chain Financing**

Live Deployment URL: **[https://trade-passport-engine-blond.vercel.app](https://trade-passport-engine-blond.vercel.app)**

---

## 💡 The Problem

The Malaysian B2B supply chain suffers from two parallel liquidity bottlenecks:
1. **Upstream Suppliers (e.g., Defong Enterprise)**: Face severe cash flow constraints as their working capital is locked in 30–90 day Accounts Receivable (AR) payment cycles.
2. **Downstream Buyers/Contractors (e.g., Ah Kow Construction)**: Have legitimate, high-volume transactional histories but lack collateral, making it extremely difficult to secure traditional bank loans.
3. **Financiers (e.g., CapBay)**: Are eager to finance SME trades but lack low-cost, fraud-resistant risk assessment data to underwrite these transactions confidently.

---

## 🏛️ Why Now? The e-Invoice Catalyst

Starting in 2024, the Malaysian Government is mandating **e-Invoicing (LHDN)** across all B2B transactions. This creates a critical 3–5 year window:
- **Fraud Eradication**: Invoices are digitally certified by the tax authority (LHDN). Falsifying invoices now carries severe legal penalties equivalent to tax evasion.
- **Clean Data Pipelines**: Every transaction is standardized, machine-readable, and verified at the source, eliminating the need for manual OCR or document collection.

**eCredit Bridge is the first platform to convert this tax-mandated compliance data into active SME financing power.**

---

## 🛠️ Technical Architecture

The following diagram illustrates how eCredit Bridge bridges the gap between supplier ERPs, LHDN registries, and financing institutions:

```mermaid
graph TD
    subgraph Supplier System (ERP/SaaS)
        A[eCredit Bridge SPA] -->|ERP API Sync| B[Supplier Ledger Database]
    end
    
    subgraph Government Registry
        C[LHDN e-Invoice API Registry]
    end
    
    subgraph eCredit Bridge Core Backend
        D[Python Flask Risk Scoring Engine] -->|API Registry Validation| C
        A -->|Request Client Rating| D
        D -->|Calculates Credit Score 1000pts| A
    end
    
    subgraph Institutional Financier
        E[CapBay Funding Portal]
        A -->|PDPA Consent & Bundle Routing| E
        E -->|Direct Disbursal of Funds| B
    end

    style A fill:#f0fdf4,stroke:#1D9E75,stroke-width:2px;
    style D fill:#eff6ff,stroke:#2563eb,stroke-width:2px;
    style C fill:#fffbeb,stroke:#d97706,stroke-width:2px;
    style E fill:#fef2f2,stroke:#dc2626,stroke-width:2px;
```

### 🔌 LHDN MyInvois SDK API Mapping
To ensure enterprise robustness, eCredit Bridge integrates directly with the official Malaysian tax authority APIs. Below is the mapping of consumed LHDN SDK endpoints implemented in our pipeline:

| Integration Phase | SDK API Endpoint | Method | Purpose & Params |
|---|---|---|---|
| **1. Authentication** | `/connect/token` | `POST` | Authenticates eCredit Bridge with LHDN Identity Server using `grant_type=client_credentials` and `scope=InvoicingAPI`. |
| **2. Identity Validation** | `/api/v1.0/taxpayer/validate/{tin}` | `GET` | Validates downstream buyer registration details by checking their TIN against active SSM registry data (`idType`, `idValue`). |
| **3. Real-time Ingestion** | `/api/v1.0/documents/recent` | `GET` | Pulls verified e-Invoices issued between the supplier and buyers, filtering by `submissionDateFrom` and `status=Valid`. |
| **4. Fraud Reconciliation** | `/api/v1.0/documents/{uuid}/details` | `GET` | Retrieves full cryptographic e-Invoice hashes and status metadata to prevent double-financing and verify billing terms. |

---

## 🎯 How It Works

### Step 1: e-Invoice & Bank Triangulation
The supplier connects their ERP system. The platform automatically pulls e-Invoice data from LHDN, bank statement records, and Delivery Orders (DO). By matching these three sources, the platform validates transaction legitimacy and flags partial or unconfirmed items.

### Step 2: Trade Passport Generation (1 Buyer = 1 Passport)
The engine aggregates the data to construct a single, comprehensive **Trade Passport** for each buyer. This includes:
- Transaction frequency and volume stability.
- Historical payment timeliness (actual average payment velocity vs. promised credit terms).
- Years of active trade relationship.
- Matched LHDN/DO verification ratios.

This score is calculated by our Flask-powered risk evaluator, providing financiers with objective data backed by LHDN registries.

### Step 3: Bundle Financing & Direct-Pay Disbursement
Suppliers check one or multiple verified outstanding invoices to package into a funding bundle under the buyer's passport. The platform requests PDPA consent from the buyer. Once signed, the bundle is routed to CapBay, who disburses funds **directly to the supplier's verified bank account**, mitigating default and diversion risk.

---

## 💰 Commercial Model

We capture value through two distinct revenue streams:

1. **SaaS Subscription (Supplier-side)**: Suppliers pay RM 200 - RM 500 / month to use eCredit Bridge as their core dashboard for tracking receivables, triggering auto-reminders, and performing bank reconciliation.
2. **Factoring Commission (Financier-side)**: We charge financiers a **0.5% transaction commission** on all funded bundles routed through our platform.

### Defensive Moat:
Financing partners cannot easily bypass eCredit Bridge because the supplier's day-to-day operations and ledger reconciliations run on our platform. The migration cost for a supplier to move their operational data is exceptionally high.

---

## 🗺️ Roadmap & Implementation

- **Q3 2026**: ERP plugin integration development (SQL, AutoCount, SQL Account) and initial sandbox testing with LHDN SDK.
- **Q4 2026**: Pilot launch with selected construction suppliers and CapBay financing integration.
- **Q1 2027**: General availability release in Malaysia, expanding into retail and manufacturing distribution channels.
