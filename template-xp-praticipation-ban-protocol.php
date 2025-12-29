<?php
/*
 Template Name: xp Participation Proticol
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>XP Participation Ban Protocol • Small Street Applied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="XP Participation Ban Protocol for the Small Street Applied cooperative XP ledger and Discord membership space.">
    <style>
        :root {
            --bg: #050816;
            --bg-alt: #0b1020;
            --card: #11152a;
            --accent: #ffb347;
            --accent-soft: rgba(255, 179, 71, 0.1);
            --accent-2: #44ffd2;
            --text-main: #f5f5f7;
            --text-muted: #a0a3b1;
            --border-subtle: #23263a;
            --danger: #ff4b81;
            --success: #44ffd2;
            --shadow-soft: 0 20px 45px rgba(0, 0, 0, 0.55);
            --radius-lg: 18px;
            --radius-pill: 999px;
            --transition-fast: 160ms ease-out;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text", "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #151a33 0, #050816 55%, #000 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 32px 16px;
        }

        .page-shell {
            max-width: 1180px;
            width: 100%;
            background: linear-gradient(135deg, rgba(255, 179, 71, 0.08), rgba(68, 255, 210, 0.05));
            border-radius: 28px;
            padding: 2px;
            box-shadow: var(--shadow-soft);
        }

        .page-inner {
            background: radial-gradient(circle at top left, #141b35 0, #050816 45%, #050816 100%);
            border-radius: 26px;
            padding: 24px;
            display: grid;
            grid-template-columns: minmax(0, 260px) minmax(0, 1fr);
            gap: 24px;
        }

        @media (max-width: 840px) {
            .page-inner {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar */
        .sidebar {
            border-radius: 20px;
            background: linear-gradient(160deg, rgba(15, 23, 42, 0.95), rgba(5, 8, 22, 0.98));
            border: 1px solid var(--border-subtle);
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-header {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-soft);
            padding: 4px 12px;
            border-radius: var(--radius-pill);
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 600;
        }

        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 4px rgba(255, 179, 71, 0.25);
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 650;
        }

        .sidebar-subtext {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .nav-label {
            margin-top: 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
        }

        .menu-list {
            list-style: none;
            margin-top: 4px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            border-radius: 12px;
            font-size: 13px;
            text-decoration: none;
            color: var(--text-main);
            border: 1px solid transparent;
            background: transparent;
            transition: background var(--transition-fast), border-color var(--transition-fast), transform 140ms ease-out;
        }

        .menu-item a span.label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .menu-item a span.bullet {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: var(--accent-2);
            box-shadow: 0 0 0 3px rgba(68, 255, 210, 0.25);
        }

        .menu-item a span.chevron {
            font-size: 13px;
            color: var(--text-muted);
        }

        .menu-item a:hover {
            background: rgba(15, 23, 42, 0.85);
            border-color: var(--accent-soft);
            transform: translateY(-1px);
        }

        .menu-item a:active {
            transform: translateY(0);
        }

        .legend {
            margin-top: 12px;
            padding: 10px 10px 10px 11px;
            border-radius: 14px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px dashed var(--border-subtle);
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.45;
        }

        .legend strong {
            color: var(--accent-2);
            font-weight: 600;
        }

        /* Main content */
        .content {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .content-header {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .content-kicker {
            font-size: 12px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent-2);
        }

        .content-title {
            font-size: 26px;
            font-weight: 680;
        }

        .content-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            max-width: 620px;
            line-height: 1.5;
        }

        .pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px;
        }

        .pill {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: var(--radius-pill);
            border: 1px solid var(--border-subtle);
            color: var(--text-muted);
            background: rgba(5, 8, 22, 0.9);
        }

        .pill--danger {
            border-color: rgba(255, 75, 129, 0.4);
            color: var(--danger);
            background: rgba(68, 13, 35, 0.55);
        }

        .section-card {
            margin-top: 4px;
            border-radius: var(--radius-lg);
            background: var(--card);
            border: 1px solid rgba(35, 38, 58, 0.95);
            padding: 18px 18px 16px;
        }

        .section-card+.section-card {
            margin-top: 10px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 10px;
        }

        .section-heading h2 {
            font-size: 15px;
            font-weight: 600;
        }

        .section-tag {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: var(--radius-pill);
            background: rgba(15, 23, 42, 0.9);
            color: var(--text-muted);
            border: 1px solid var(--border-subtle);
        }

        .section-body {
            font-size: 13px;
            color: var(--text-main);
            line-height: 1.55;
        }

        .section-body p+p {
            margin-top: 8px;
        }

        .section-body ul {
            margin-top: 8px;
            margin-left: 16px;
            display: grid;
            gap: 4px;
            padding-left: 0;
        }

        .section-body li {
            position: relative;
            list-style: none;
            padding-left: 14px;
            color: var(--text-muted);
        }

        .section-body li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: var(--accent-2);
            font-size: 12px;
        }

        .callout {
            margin-top: 10px;
            padding: 10px 11px;
            border-radius: 14px;
            border: 1px solid rgba(68, 255, 210, 0.22);
            background: radial-gradient(circle at left, rgba(68, 255, 210, 0.12), transparent 55%);
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .callout strong {
            color: var(--success);
            font-weight: 600;
        }

        .label-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: var(--text-muted);
        }

        .label-pill span.dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: var(--accent);
        }

        .two-col {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
            gap: 12px;
        }

        @media (max-width: 720px) {
            .two-col {
                grid-template-columns: 1fr;
            }
        }

        .list-label {
            font-size: 11px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .keyline {
            height: 1px;
            width: 100%;
            background: radial-gradient(circle, rgba(255, 179, 71, 0.35), transparent 60%);
            margin: 6px 0 10px;
            opacity: 0.6;
        }

        .inline-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 2px 8px;
            border-radius: var(--radius-pill);
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid var(--border-subtle);
            font-size: 11px;
            color: var(--text-muted);
        }

        .inline-badge span.dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: var(--danger);
        }
    </style>
</head>

<body>
    <div class="page-shell">
        <div class="page-inner"> <!-- Sidebar / Menu -->
            <aside class="sidebar">
                <div class="sidebar-header">
                    <div class="badge"> <span class="badge-dot"></span> XP governance • internal use </div>
                    <div class="sidebar-title"> XP Participation Ban Protocol </div>
                    <div class="sidebar-subtext"> Internal rules for suspending, limiting, or revoking XP participation
                        within the Small Street Applied cooperative ledger and Discord space. </div>
                </div>
                <div class="nav-label">Content Menu</div>
                <ul class="menu-list">
                    <li class="menu-item"> <a href="#overview"> <span class="label"> <span class="bullet"></span>
                                Overview &amp; Purpose </span> <span class="chevron">⇢</span> </a> </li>
                    <li class="menu-item"> <a href="#conditions"> <span class="label"> <span class="bullet"></span>
                                Conditions for XP Ban </span> <span class="chevron">⇢</span> </a> </li>
                    <li class="menu-item"> <a href="#types"> <span class="label"> <span class="bullet"></span> Types of
                                Restrictions </span> <span class="chevron">⇢</span> </a> </li>
                    <li class="menu-item"> <a href="#enforcement"> <span class="label"> <span class="bullet"></span>
                                Enforcement Flow </span> <span class="chevron">⇢</span> </a> </li>
                    <li class="menu-item"> <a href="#extinguish"> <span class="label"> <span class="bullet"></span> XP
                                Extinguishing </span> <span class="chevron">⇢</span> </a> </li>
                    <li class="menu-item"> <a href="#appeals"> <span class="label"> <span class="bullet"></span> Appeals
                                &amp; Restoration </span> <span class="chevron">⇢</span> </a> </li>
                    <li class="menu-item"> <a href="#legal-safety"> <span class="label"> <span class="bullet"></span>
                                Legal &amp; Compliance Notes </span> <span class="chevron">⇢</span> </a> </li>
                </ul>
                <div class="legend"> <strong>Note:</strong> XP is a non-financial, non-redeemable cooperative metric.
                    Participation bans affect reputation and standing only, not money or property. </div>
            </aside> <!-- Main Content -->
            <main class="content">
                <header class="content-header">
                    <div class="content-kicker">Governance • XP Integrity</div>
                    <div class="content-title">XP Participation Ban Protocol</div>
                    <p class="content-subtitle"> This page documents how and why a member’s XP participation may be
                        suspended, limited, or permanently revoked inside the Small Street Applied cooperative ledger
                        and Discord environment. It protects the integrity of the 2-scan PoD system, the Peace Pentagon,
                        and the Serendipity Protocol without touching fiat or financial assets. </p>
                    <div class="pill-row"> <span class="pill">Non-custodial • Non-financial</span> <span
                            class="pill">Discord-first cooperative governance</span> <span
                            class="pill pill--danger">Tool of last resort</span> </div>
                </header> <!-- Section: Overview -->
                <section id="overview" class="section-card">
                    <div class="section-heading">
                        <h2>1. Overview &amp; Purpose</h2> <span class="section-tag">Read this first</span>
                    </div>
                    <div class="section-body">
                        <p> XP (Experience Points) in Small Street Applied is a <strong>non-transferable,
                                non-redeemable, extinguishable</strong> cooperative metric. It tracks contribution,
                            trust, and participation in 2-scan Proof-of-Delivery (PoD), Peace Pentagon roles, and
                            referral activity. </p>
                        <p> Because XP is <em>not money</em> and has no direct redemption path, restricting or banning
                            XP participation is a structural, reputational action—not a financial penalty. The XP
                            Participation Ban Protocol exists to protect: </p>
                        <ul>
                            <li>Integrity of the PoD and XP ledger</li>
                            <li>Cooperative trust and Member Capitalism</li>
                            <li>Peace Pentagon branch operations and POC rotation</li>
                            <li>Internal narrative, IP, and movement identity</li>
                        </ul>
                    </div>
                    <div class="callout"> <strong>Key principle:</strong> XP bans never remove fiat, tokens, or
                        property. They only adjust a member’s ability to earn, hold, or appear in XP-based records
                        within the cooperative ledger. </div>
                </section> <!-- Section: Conditions -->
                <section id="conditions" class="section-card">
                    <div class="section-heading">
                        <h2>2. Conditions for XP Ban or Suspension</h2> <span class="section-tag">When action can be
                            taken</span>
                    </div>
                    <div class="section-body two-col">
                        <div>
                            <div class="list-label">Misuse &amp; Misrepresentation</div>
                            <div class="keyline"></div>
                            <ul>
                                <li>Falsifying PoD scans or tampering with device/GPS data</li>
                                <li>Simulating deliveries to inflate XP or referral trails</li>
                                <li>Misusing logos, hang-tags, or Peace Pentagon imagery</li>
                                <li>Presenting cloned projects as “official” Small Street Applied</li>
                            </ul>
                        </div>
                        <div>
                            <div class="list-label">Social &amp; Cooperative Harm</div>
                            <div class="keyline"></div>
                            <ul>
                                <li>Harassment or targeted disruption inside the Discord channel</li>
                                <li>Coaching others to bypass XP or PoD rules</li>
                                <li>Attempting to sell XP, POC roles, or governance influence</li>
                                <li>Intentional sabotage of the Serendipity or Cookie Jar ethos</li>
                            </ul>
                        </div>
                    </div>
                    <div class="callout"> <span class="label-pill"> <span class="dot"></span> FAITH alignment check
                        </span> &nbsp;Before any ban is applied, moderators should ask: “Is this decision Fair,
                        Accepting, Insightful, Transparent, and Humble?” </div>
                </section> <!-- Section: Types of Restrictions -->
                <section id="types" class="section-card">
                    <div class="section-heading">
                        <h2>3. Types of XP Participation Restrictions</h2> <span class="section-tag">Soft, hard, and
                            permanent</span>
                    </div>
                    <div class="section-body two-col">
                        <div>
                            <div class="list-label">Soft Ban (Temporary Suspension)</div>
                            <div class="keyline"></div>
                            <ul>
                                <li>Member cannot earn new XP across all categories</li>
                                <li>Blocked from appearing in new PoD events</li>
                                <li>Referral XP accrual paused for defined period</li>
                                <li>Discord access remains, with observed probation</li>
                            </ul>
                            <p> Typically used for first-time or lower-risk issues that can be corrected through
                                coaching and community dialogue. </p>
                        </div>
                        <div>
                            <div class="list-label">Hard Ban &amp; Permanent XP Ban</div>
                            <div class="keyline"></div>
                            <ul>
                                <li>Existing XP marked as historical or extinguished</li>
                                <li>Member removed from POC rotation and XP leaderboards</li>
                                <li>Participation in PoD and referral flows disabled</li>
                                <li>For permanent bans, Discord and device-level access revoked</li>
                            </ul>
                            <p> Reserved for repeated, intentional, or high-impact violations that threaten cooperative
                                trust or system integrity. </p>
                        </div>
                    </div>
                </section> <!-- Section: Enforcement -->
                <section id="enforcement" class="section-card">
                    <div class="section-heading">
                        <h2>4. Enforcement Flow</h2> <span class="section-tag">From report to action</span>
                    </div>
                    <div class="section-body">
                        <p> Enforcement is driven by the moderation team and, in future phases, by DAO-based governance
                            structures. No automated XP bans should occur without human review. </p>
                        <ul>
                            <li> <strong>1. Report &amp; log</strong> — A concern is reported inside the Discord channel
                                or via a designated form. Moderators log the event with timestamp and member ID. </li>
                            <li> <strong>2. Review &amp; dialogue</strong> — Moderators verify facts, review PoD/XP
                                data, and, where appropriate, speak directly with the member to clarify intent and
                                context. </li>
                            <li> <strong>3. Decision</strong> — A soft ban, hard ban, or permanent XP ban is applied, or
                                the case is dismissed with a coaching note. </li>
                            <li> <strong>4. Update records</strong> — XP ledger entries and POC assignments are updated
                                to reflect the decision. </li>
                            <li> <strong>5. Communicate outcome</strong> — The member is informed privately, and, if
                                appropriate, an anonymized summary is shared with the community for transparency. </li>
                        </ul>
                    </div>
                    <div class="callout"> <strong>Moderation principle:</strong> XP participation bans are a tool of
                        last resort. Whenever possible, education and repair are preferred over exclusion. </div>
                </section> <!-- Section: XP Extinguishing -->
                <section id="extinguish" class="section-card">
                    <div class="section-heading">
                        <h2>5. XP Extinguishing for Banned Members</h2> <span class="section-tag">Structural, not
                            financial</span>
                    </div>
                    <div class="section-body">
                        <p> When a member receives a hard or permanent XP ban, their XP may be: </p>
                        <ul>
                            <li>Flagged as “historical only” (no future XP accrual)</li>
                            <li>Partially or fully extinguished in the XP ledger</li>
                            <li>Disconnected from POC and referral structures</li>
                            <li>Prevented from appearing in dashboards or leaderboards</li>
                        </ul>
                        <p> The extinguishing event is recorded as a ledger entry: </p>
                        <p class="inline-badge"> <span class="dot"></span> <span>type: "extinguish" • category:
                                "disciplinary" • xp_amount: defined by protocol</span> </p>
                    </div>
                    <div class="callout"> <strong>Compliance note:</strong> Because XP is not a financial instrument and
                        has no redemption path, extinguishing XP does not remove property or create financial loss. It
                        is a cooperative governance action only. </div>
                </section> <!-- Section: Appeals -->
                <section id="appeals" class="section-card">
                    <div class="section-heading">
                        <h2>6. Appeals &amp; Restoration</h2> <span class="section-tag">FAITH in action</span>
                    </div>
                    <div class="section-body">
                        <p> Members who receive a soft or hard ban may request review through a structured appeals
                            process administered by the Membership branch of the Peace Pentagon (and, later, DAO
                            governance). </p>
                        <ul>
                            <li>Appeal requests must be submitted in writing via Discord or form</li>
                            <li>Moderators review new information or changes in behavior</li>
                            <li>Restoration may include a monitored probation period</li>
                            <li>XP accrual can be reactivated; historical XP may remain archived</li>
                        </ul>
                        <p> Appeals are evaluated under FAITH principles and the long-term health of the cooperative
                            ledger. </p>
                    </div>
                </section> <!-- Section: Legal & Compliance -->
                <section id="legal-safety" class="section-card">
                    <div class="section-heading">
                        <h2>7. Legal &amp; Compliance Notes</h2> <span class="section-tag">Why this is
                            regulator-safe</span>
                    </div>
                    <div class="section-body">
                        <p> The XP Participation Ban Protocol is explicitly designed to be compliant with global
                            regulatory expectations: </p>
                        <ul>
                            <li>XP is not money, credit, or a redeemable asset</li>
                            <li>Small Street Applied does not custody fiat or crypto</li>
                            <li>All real-world payments occur through licensed MSBs</li>
                            <li>XP bans affect cooperative standing, not financial rights</li>
                            <li> Discord functions as the private membership space where these rules are voluntarily
                                accepted </li>
                        </ul>
                        <p> As a result, XP participation bans operate as <strong>internal membership
                                discipline</strong>, not as financial sanctions or market controls. </p>
                    </div>
                    <div class="callout"> <strong>Summary:</strong> XP bans are a structural tool that protect the
                        ledger, the story, and the community—while leaving all fiat flows and financial systems
                        untouched. </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>