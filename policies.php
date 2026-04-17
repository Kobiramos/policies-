<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['employee_name']) || !isset($_SESSION['employee_number'])) {
    header('Location: index.php');
    exit;
}

$employeeName = htmlspecialchars($_SESSION['employee_name']);
$employeeNumber = htmlspecialchars($_SESSION['employee_number']);
$employeeDepartment = isset($_SESSION['employee_department']) ? htmlspecialchars($_SESSION['employee_department']) : '';
$employeePosition = isset($_SESSION['employee_position']) ? htmlspecialchars($_SESSION['employee_position']) : '';
$canDownload = isset($_SESSION['can_download']) ? $_SESSION['can_download'] : false;
$isDefaultPin = isset($_SESSION['is_default_pin']) ? $_SESSION['is_default_pin'] : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Policies - Brand Soluxions Inc.</title>
    <link rel="icon" type="image/png" href="assets/images/Logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header -->
    <header class="policy-header">
        <div class="header-inner">
            <div class="header-left">
                <img src="assets/images/HeaderLogo.png" alt="Brand Soluxions Inc.">
            </div>
            <span class="header-center">Company Policies</span>
            <button class="burger-btn" id="burgerBtn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- Side Panel -->
    <div class="side-panel-overlay" id="sidePanelOverlay"></div>
    <aside class="side-panel" id="sidePanel">
        <div class="side-panel-header">
            <span>Menu</span>
            <button class="side-panel-close" id="sidePanelClose" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="side-panel-profile">
            <div class="side-panel-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="side-panel-info">
                <strong><?php echo $employeeName; ?></strong>
                <span><?php echo $employeeNumber; ?></span>
                <span class="side-panel-role"><?php echo $employeePosition; ?></span>
            </div>
        </div>
        <div class="side-panel-clock">
            <div class="side-panel-time" id="sidePanelTime"></div>
            <div class="side-panel-date" id="sidePanelDate"></div>
        </div>
        <nav class="side-panel-nav">
            <?php if ($canDownload): ?>
            <button class="side-panel-link" id="downloadBtn" onclick="downloadExcel(); closeSidePanel();">
                <i class="fas fa-file-excel"></i> Download Records
            </button>
            <?php endif; ?>
            <button class="side-panel-link" id="settingsBtn">
                <i class="fas fa-gear"></i> Settings
            </button>
            <a href="logout.php" class="side-panel-link side-panel-link-danger">
                <i class="fas fa-right-from-bracket"></i> Logout
            </a>
        </nav>
        <div class="side-panel-footer">
            <img src="assets/images/Logo.png" alt="Brand Soluxions Inc.">
            <p>&copy; <?php echo date('Y'); ?> Brand Soluxions Inc.</p>
        </div>
    </aside>

    <!-- Hero -->
    <section class="page-hero">
        <div class="container">
            <h1><i class="fas fa-file-shield" style="margin-right: 12px; opacity: 0.9;"></i>Brand Soluxions Inc. Policies</h1>
            <p>Know the standards. Own the excellence.</p>
        </div>
    </section>

    <!-- Content -->
    <section class="policies-content">
        <div class="container">

            <!-- Welcome Banner -->
            <div class="welcome-banner fade-in">
                <div class="welcome-icon">
                    <i class="fas fa-hand-sparkles"></i>
                </div>
                <div class="welcome-text">
                    <h2>Welcome, <?php echo explode(' ', $employeeName)[0]; ?>!</h2>
                    <p>Thank you for taking the time to review our company policies. These guidelines are the foundation of how we work together, uphold quality, and protect each other. Take your time reading through each section -- your understanding makes our workplace better for everyone.</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="quick-stats fade-in">
                <div class="stat-card">
                    <i class="fas fa-industry"></i>
                    <strong>7</strong>
                    <span>cGMP Areas</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-gavel"></i>
                    <strong>7</strong>
                    <span>Discipline Categories</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-layer-group"></i>
                    <strong>5</strong>
                    <span>Penalty Types (A-E)</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <strong>100%</strong>
                    <span>Applies to All</span>
                </div>
            </div>


            <!-- SECTION 1: Basic cGMP -->
            <div class="policy-section">
                <div class="policy-section-header" onclick="toggleSection(this)">
                    <h2><i class="fas fa-industry"></i> Current Good Manufacturing Practices (cGMP)</h2>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="policy-section-body open">
                    <div class="section-intro">
                        <i class="fas fa-quote-left"></i>
                        <p>Our cGMP standards align with <strong>PIC/S</strong> (Pharmaceutical Inspection Co-operation Scheme) &mdash; an international organization that harmonizes Good Manufacturing Practice standards across regulatory authorities worldwide. Every step you take in following these practices directly contributes to the safety and quality of our products.</p>
                    </div>

                    <!-- 1. Documentation -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">1</span> Documentation</h3>
                        <p>Every record tells a story. Keeping our documentation consistent ensures traceability and accountability across the board.</p>
                        <ul>
                            <li>Only <strong>BLACK INK pen</strong> will be used in writing documents.</li>
                            <li>Manner of signing must be clear and legible for paper trail or to identify approval.</li>
                            <li>Manner of writing the date must be uniform following: <strong>MM/DD/YYYY</strong> (e.g., 01/21/2026 or 01.21.2026 or 01-21-2026).</li>
                        </ul>
                        <div class="callout-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span><strong>Quick Reminder:</strong> When in doubt, write clearly. If someone can't read your signature or date 5 years from now, it's as good as missing.</span>
                        </div>
                    </div>

                    <!-- 2. Quality Control -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">2</span> Quality Control</h3>
                        <p>Quality isn't just a department &mdash; it's everyone's responsibility. All quality control documents must be properly maintained and accessible. QC procedures ensure that products meet established specifications and standards before release.</p>
                        <div class="callout-tip">
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Think of it this way:</strong> Would you use a product that skipped quality checks? Neither would our customers.</span>
                        </div>
                    </div>

                    <!-- 3. Premises -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">3</span> Premises</h3>
                        <p>Our workspace reflects our standards. Company premises must be maintained in a clean, orderly, and sanitary condition at all times. All areas must comply with the prescribed environmental and safety standards for manufacturing operations.</p>
                    </div>

                    <!-- 4. Equipment -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">4</span> Equipment</h3>
                        <p>Well-maintained equipment produces well-made products. All equipment used in manufacturing must be properly maintained, calibrated, and operated according to standard procedures. Equipment logs must be kept up to date.</p>
                    </div>

                    <!-- 5. Sanitation & Hygiene -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">5</span> Sanitation &amp; Hygiene</h3>
                        <p>Clean hands, clean products. Strict sanitation and hygiene practices must be followed by all personnel at all times within the manufacturing facility &mdash; proper handwashing, wearing of appropriate attire, and maintaining cleanliness in all work areas.</p>
                        <div class="callout-tip">
                            <i class="fas fa-hand-sparkles"></i>
                            <span><strong>Small habits, big impact:</strong> A 20-second handwash can prevent contamination that could affect thousands of products.</span>
                        </div>
                    </div>

                    <!-- 6. Production -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">6</span> Production</h3>
                        <p>Precision in production means confidence in results.</p>
                        <ul>
                            <li>All production processes must follow approved standard operating procedures.</li>
                            <li>Calibration labels must be posted on a visible side showing:
                                <ul>
                                    <li>Date CALIBRATED</li>
                                    <li>DATE NEXT CALIBRATION</li>
                                    <li>Legible Signature</li>
                                </ul>
                            </li>
                            <li>All materials and products must be properly labeled, documented, and tracked throughout the production process.</li>
                        </ul>
                    </div>

                    <!-- 7. Personnel -->
                    <div class="cgmp-subsection">
                        <h3><span class="num">7</span> Personnel</h3>
                        <p>An informed team is an empowered team. All personnel involved in manufacturing operations must be adequately trained and qualified. Training records must be maintained and updated regularly. You are expected to understand and comply with all cGMP requirements relevant to your duties.</p>
                        <div class="callout-tip">
                            <i class="fas fa-graduation-cap"></i>
                            <span><strong>Your growth matters:</strong> Training isn't just a requirement &mdash; it's an investment in your skills and our shared success.</span>
                        </div>
                    </div>

                    <div class="key-takeaway">
                        <div class="key-takeaway-icon"><i class="fas fa-star"></i></div>
                        <div>
                            <strong>Key Takeaway</strong>
                            <p>cGMP isn't about paperwork &mdash; it's about building products we're all proud of. When you follow these practices, you're protecting our customers, our company, and your fellow team members.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Code of Discipline -->
            <div class="policy-section">
                <div class="policy-section-header" onclick="toggleSection(this)">
                    <h2><i class="fas fa-gavel"></i> Code of Discipline</h2>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="policy-section-body open">

                    <div class="section-intro">
                        <i class="fas fa-quote-left"></i>
                        <p>A great workplace is built on mutual respect, accountability, and shared responsibility. This Code of Discipline exists not to restrict you, but to create a fair and safe environment where everyone can do their best work. Know the rules, and you'll never have to worry about them.</p>
                    </div>

                    <!-- General Policies -->
                    <div class="general-policies">
                        <h3><i class="fas fa-balance-scale" style="color: var(--primary-color); margin-right: 8px;"></i>Scope &amp; General Policies</h3>
                        <ul>
                            <li>This Code of Conduct shall apply to <strong>ALL employees</strong>.</li>
                            <li>The term "EMPLOYEE" or "CO-EMPLOYEE" refers to all directly hired by Brand Soluxions Inc. regardless of level.</li>
                            <li>The term "PROPERTY" pertains to company equipment, machines, vehicles, documents, records, labels, raw and finished products.</li>
                            <li>Brand Soluxions Inc. reserves the right to implement the provisions of the Labor Code of the Philippines.</li>
                            <li>All actions to resolve or settle grievances shall abide by the relevant provisions of any mechanism installed for such purpose.</li>
                            <li>Penalties imposed are without prejudice to Brand Sol's right to recover material losses as provided for in the Civil Code and revised Penal Code.</li>
                            <li>Employees with offense subject to Type D or committed an offense that warranted 30 working days suspension within 12 months will <strong>NOT</strong> be entitled to any bonuses.</li>
                            <li>Publication in any social media network or giving malicious statements about the Company and/or its products even after employment will be coursed through legal action.</li>
                            <li>Ignorance of the policies declared in this Code shall not justify an employee from non-observance nor from the disciplinary action to be imposed thereon.</li>
                        </ul>
                    </div>

                    <!-- Penalty Schedule Carousel -->
                    <div class="penalty-schedule">
                        <h3><i class="fas fa-list-ol"></i> Schedule of Penalties</h3>
                        <p class="penalty-desc">Offenses that incur disciplinary action are classified under five (5) types: <span style="font-size:12px; color:#888;">(tap a card to view details)</span></p>
                        <div class="penalty-carousel" id="penaltyCarousel">
                            <div class="penalty-track" id="penaltyTrack">
                                <?php
                                $penaltyCards = [
                                    ['type' => 'a', 'badge' => 'A', 'title' => 'Type A', 'items' => ['1st: Verbal Warning','2nd: Written Reprimand','3rd: 3-6 days suspension','4th: 7-15 days suspension','5th: 16-30 days with warning','6th: Dismissal'], 'footer' => 'Condoned after 1 year'],
                                    ['type' => 'b', 'badge' => 'B', 'title' => 'Type B', 'items' => ['1st: Written Reprimand','2nd: 3-6 days suspension','3rd: 7-15 days suspension','4th: 16-30 days with warning','5th: Dismissal'], 'footer' => 'Condoned after 2 years'],
                                    ['type' => 'c', 'badge' => 'C', 'title' => 'Type C', 'items' => ['1st: 7-15 days suspension','2nd: 16-30 days with warning','3rd: Dismissal'], 'footer' => 'Condoned after 3 years'],
                                    ['type' => 'd', 'badge' => 'D', 'title' => 'Type D', 'items' => ['1st: 16-30 days suspension with warning','2nd: Dismissal'], 'footer' => 'Condoned after 4 years'],
                                    ['type' => 'e', 'badge' => 'E', 'title' => 'Type E', 'items' => ['1st Offense: <strong>Dismissal</strong>'], 'footer' => 'Condoned after 5 years (if commuted by CEO)'],
                                ];
                                for ($loop = 0; $loop < 2; $loop++):
                                    foreach ($penaltyCards as $card): ?>
                                <div class="penalty-slide type-<?php echo $card['type']; ?>" onclick="openPenaltyModal('<?php echo $card['type']; ?>')" style="cursor:pointer;">
                                    <div class="penalty-slide-badge"><?php echo $card['badge']; ?></div>
                                    <strong><?php echo $card['title']; ?></strong>
                                    <ul>
                                        <?php foreach ($card['items'] as $item): ?>
                                        <li><?php echo $item; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="penalty-slide-footer"><i class="fas fa-clock"></i> <?php echo $card['footer']; ?></div>
                                </div>
                                <?php endforeach;
                                endfor; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Penalty Detail Modals -->
                    <div class="pin-modal-overlay" id="penaltyModalOverlay">
                        <div class="pin-modal penalty-detail-modal">
                            <div id="penaltyModalContent"></div>
                            <button class="btn btn-primary" id="penaltyModalClose" style="width: 100%; margin-top: 20px;">Close</button>
                        </div>
                    </div>

                    <!-- I. DISHONESTY -->
                    <div class="discipline-category" style="margin-top: 30px;">
                        <div class="discipline-category-title">
                            <i class="fas fa-ban"></i> I. Dishonesty
                        </div>
                        <p class="category-intro">Trust is the backbone of every team. These offenses address actions that undermine honesty and integrity in the workplace.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>I.1</td><td>Theft or stealing, misappropriating or embezzling Company funds or property.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.2</td><td>Theft of property belonging to another person, committed during working time or within Company premises.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.3</td><td>Fraudulent, unauthorized withdrawal/acquisition or release to other persons of Company funds or properties.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.4</td><td>Unauthorized or improper withdrawing of company records, equipment, tools, or other assets from company premises without authority.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.5</td><td>Losing or misplacing Company property.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>I.6</td><td>Concealing defective work or products.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.7</td><td>Unauthorized possession or use of Company property or products.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>I.8</td><td>Unauthorized possession or use of client-owned property or products.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>I.9</td><td>Unauthorized substitution of Company materials, supplies, tools, equipment or products with another.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>I.10</td><td>Concealing or refusing to report violations of Company rules and regulations.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>I.11</td><td>Obtaining or attempting to obtain materials based on fraudulent or falsified order and conniving with person(s) doing so.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.12</td><td>Unauthorized altering or forging of company records or documents, or making use of unauthorized altered or forged document.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.13</td><td>Punching in and out for another employee; tampering with or unauthorized altering of one's time record or the time record of another employee.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>I.14</td><td>Falsifying receipts, vouchers, and other documents.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.15</td><td>Knowingly giving false or misleading information in applications for employment, or giving false information to seek or qualify for any benefit from the Company.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.16</td><td>Offering, soliciting, obtaining or accepting money or anything of value by entering into unauthorized arrangement(s) with supplier(s), client(s) or other outsider(s).</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.17</td><td>Failure to report erroneous payment or overpayment of salary, commission, allowance within 72 hours.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>I.18</td><td>Borrowing or receiving money, commission, or soliciting material favor from suppliers or clients with which the company has business relationships.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.19</td><td>Acting as an accessory to acts or omissions affecting Company funds or property.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>I.20</td><td>Fraud committed by the employee resulting to the loss of trust and confidence reposed upon him by Management.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>I.21</td><td>Committing other acts of dishonesty, deceit, fraud, anomaly; conniving with other person(s) to do so.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- II. INEFFICIENCY -->
                    <div class="discipline-category">
                        <div class="discipline-category-title">
                            <i class="fas fa-exclamation-triangle"></i> II. Inefficiency, Negligence of Duty and Violation of Work Standards
                        </div>
                        <p class="category-intro">Excellence requires attention and effort. These standards ensure we all contribute our best to every task and responsibility.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>II.1</td><td>Negligence of employee in the care and use of Company equipment, tools or property resulting or causing damage or injury to persons, property or product.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>II.2</td><td>Unauthorized asking/requesting and receiving/acceptance of money or anything of value as consideration for an act, decision, or service.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>II.3</td><td>Fraud or misrepresentation for offering or accepting anything of value for a job or favorable condition of employment.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>II.4</td><td>Furnishing of incorrect or misleading data or information as a consequence of neglect or failure to conduct proper research.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>II.5</td><td>Neglect or failure to give due notice or provide needed information within the agreed/required time frame.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>II.6</td><td>Culpable carelessness, neglect, failure or refusal to follow verbal or written job instructions, established procedures, duties and responsibilities.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>II.7</td><td>Failure to immediately report theft, loss, spoilage or damage of Company property and concealing violations.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>II.8</td><td>Misuse or deliberately wasting company's materials / supplies / facilities / time without justifiable reason.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>II.9</td><td>Causing damage to or loss of materials, parts or equipment, documents and records.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>II.10</td><td>Tampering of machine setting, thereby compromising efficiency, safety, or disrupting operations.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>II.11</td><td>Refusing or failing to report for overtime work after confirming willingness or having been scheduled.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>II.12</td><td>Rendering overtime but not doing the intended task for the overtime period.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>II.13</td><td>Failure to follow Company Policies and Procedures, Good Manufacturing Practices and Company SOPs.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>II.14</td><td>Failure or refusal to attend the SOP/GMP or other required training or seminar/activity.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>II.15</td><td>Gross or habitual neglect of assigned duty.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>II.16</td><td>Failure to meet the agreed/established performance standards.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>II.17</td><td>Failure to submit reports on time.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>II.18</td><td>Sleeping while on duty or working hours.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>II.19</td><td>Insubordination.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>II.20</td><td>On the part of the superior &mdash; deliberately condoning, tolerating, or participating in an offense committed by a subordinate.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>II.21</td><td>On the part of the superior &mdash; allowing the employee to leave premises or change shift without justifiable reason.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- III. UNDESIRABLE CONDUCT -->
                    <div class="discipline-category">
                        <div class="discipline-category-title">
                            <i class="fas fa-user-slash"></i> III. Undesirable Conduct and Behavior
                        </div>
                        <p class="category-intro">How we treat each other defines who we are as a company. Professionalism and respect keep our workplace healthy.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>III.1</td><td>Committing acts which will destroy Company property or products; or impeding/hampering Company operations.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.2</td><td>Vandalism, defacing any part of Company property; unauthorized painting, marking, attaching, setting up, or removal of things.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.3</td><td>Vandalism or defacing any belonging of co-employee, clients, supplier and Company-guests.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.4</td><td>Improperly using or allowing unauthorized persons to use Company supplies, materials, facilities, tools or equipment.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.5</td><td>Operating, using, meddling with machines, tools, or equipment to which the employee had not been assigned or allowed to use.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.6</td><td>Disclosing of one's personal compensation or compensation of co-employees.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.7</td><td>Instigating, provoking or participating in concerted work stoppage, mass leave, riot or similar disruptive activities.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.8</td><td>Slowing down, holding back, hindering or limiting work output or intimidating other employees to do so.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>III.9</td><td>Encouraging, coercing, bribing or inducing others to violate Company rules and regulations.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.10</td><td>Giving wrong instruction(s) to co-employee(s)/co-worker(s).</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.11</td><td>Instigating or deliberately providing occasions to third parties to threaten or physically attack a co-employee.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.12</td><td>Verbal assault or use of profane language to co-employee.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.13</td><td>Libellous utterances or publication which tend to cause dishonor, discredit, contempt or embarrassment.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.14</td><td>Making false, vicious, malicious libellous statements against co-employee.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>III.15</td><td>Distribution of written or printed matters unfavorable or detrimental to the interest(s) of the Company.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.16</td><td>Unauthorized distribution of written or printed matters within company premises.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.17</td><td>Posting unauthorized reading materials on bulletin boards or removing officially posted notices.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.18</td><td>Removing, defacing, tearing or altering official posters, announcements, memoranda, circulars and other official documents.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.19</td><td>Committing other culpable acts not embraced by other provisions which cause damage to Company interest(s).</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.20</td><td>Flagrant discourtesy by use of disrespectful, impolite or obscene words and acts towards co-employees or superiors.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.21</td><td>Engaging in horseplay, running, scuffling, shoving, throwing things, shouting, singing or other disorderly conduct during working hours.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.22</td><td>Wasting time or engaging in non-work connected conversations and activities during working hours (loafing, idle chatting, personal phone calls, etc.).</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.23</td><td>Rumor-mongering, unnecessary disclosure of personal affairs or deliberate distortion of facts.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.24</td><td>Participating in loud and heated verbal arguments during working hours which disturb the work of others.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.25</td><td>Indecent, lewd, abusive, immoral conduct while on duty or within Company premises.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.26</td><td>Indecent, lewd, abusive, immoral, derogatory language while on duty or within Company premises.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>III.27</td><td>Engaging in immoral acts or acts contrary to law.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.28</td><td>Offering immoral goods, acts, or services contrary to law to employees or Company guests.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.29</td><td>Offering unethical goods or services to employees or Company guests.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>III.30</td><td>Engaging in money lending business inside Company premises.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.31</td><td>Selling goods or commodity of any kind; buying or collecting payments during working hours or within Company premises.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.32</td><td>Moonlighting or engaging in other business during working hours.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.33</td><td>Unauthorized selling or bartering of Company products.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.34</td><td>Any display of violence such as threatening, intimidating, coercing, provoking to a fight, harassing, assaulting or attacking a co-employee.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.35</td><td>Doing unauthorized or unofficial work during working hours.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>III.36</td><td>Sexual harassment (with physical contact).</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>III.37</td><td>Serious misconduct during official working hours or Company-sponsored activities.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.38</td><td>Committing acts which are indecent, inappropriate or scandalous which disturb peace and order within company premises.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>III.39</td><td>Any other undesirable conduct and behaviour.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- IV. DESTROYING GOODWILL -->
                    <div class="discipline-category">
                        <div class="discipline-category-title">
                            <i class="fas fa-building-circle-xmark"></i> IV. Destroying Goodwill
                        </div>
                        <p class="category-intro">Our reputation is built by all of us, every single day. Protecting the company name means protecting everyone's livelihood.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>IV.1</td><td>Damaging Company reputation or goodwill.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>IV.2</td><td>Making false or malicious statement(s) about the Company or its products/service.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>IV.3</td><td>Spreading derogatory information about any employee, supplier, client or third party doing business with the Company.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>IV.4</td><td>Flagrant discourtesy through disrespectful, offensive, obscene, insulting words or acts towards a supplier, client or other party.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>IV.5</td><td>Unauthorized use of Company name.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>IV.6</td><td>Extortion or any form of oppressive exaction of money or anything of value from co-employee or Company guest(s).</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>IV.7</td><td>Damaging or jeopardizing Company interest through acts affecting Company clients, guests, visitors or business friends.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>IV.8</td><td>Other culpable acts or omissions affecting the management or Company interest.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- V. CONFIDENTIALITY -->
                    <div class="discipline-category">
                        <div class="discipline-category-title">
                            <i class="fas fa-lock"></i> V. Confidentiality of Work and Information
                        </div>
                        <p class="category-intro">What happens at Brand Soluxions stays at Brand Soluxions. Our formulas, processes, and data are our competitive edge.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>V.1</td><td>Engaging in any activity which is directly competitive or similar with the Company's business.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>V.2</td><td>Unauthorized disclosure or use of confidential, classified, restricted information including company records, trade secrets, formulas, financial operations, and other company documents.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- VI. ATTENDANCE -->
                    <div class="discipline-category">
                        <div class="discipline-category-title">
                            <i class="fas fa-clock"></i> VI. Attendance &amp; Punctuality
                        </div>
                        <p class="category-intro">Showing up is the first step to showing what you can do. Your presence matters to the whole team.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>VI.1</td><td>Absence from work without prior notice and/or authorization &mdash; for 2 or more consecutive days.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VI.1</td><td>Absence from work without prior notice and/or authorization &mdash; for 1 day only.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>VI.2</td><td>Habitual absences &mdash; three (3) times or more absences per month.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>VI.3</td><td>Frequent Tardiness/Undertime &mdash; at least four (4) times or total of twenty (20) minutes within one (1) month.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>VI.4</td><td>Abandonment or leaving work place, job assignment, or Company premises during working hours without permission.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VI.5</td><td>Malingering or pretending to be sick; making or giving false excuse(s) for a leave or absence.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>VI.6</td><td>Failure to inform superior that he will not be able to report for work at least one hour before the schedule (emergency cases).</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- VII. SAFETY & SECURITY -->
                    <div class="discipline-category">
                        <div class="discipline-category-title">
                            <i class="fas fa-shield-halved"></i> VII. Violation on Good Order, Safety and Security
                        </div>
                        <p class="category-intro">Everyone deserves to go home safe at the end of the day. These rules keep us all protected.</p>
                        <div class="discipline-table-wrapper">
                            <table class="discipline-table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Offense</th>
                                        <th>Penalty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>VII.1</td><td>Gambling, placing or collecting bets, or participating in any game of chance in company premises.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>VII.2</td><td>Bringing in, carrying, unauthorized possession of firearms, explosives, or dangerous/lethal weapons.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>VII.3</td><td>Possessing, using, selling, or pushing prohibited drugs or their substitutes within Company premises.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>VII.4</td><td>Bringing, ingesting or taking any liquor, alcoholic beverages, cigarettes/tobacco during working hours.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>VII.5</td><td>Reporting for work under the influence of intoxicating drinks or narcotic drugs.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>VII.6</td><td>Smoking and vaping inside the Company premises.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>VII.7</td><td>Unauthorized cooking within Company premises.</td><td><span class="penalty-badge penalty-D">D</span></td></tr>
                                    <tr><td>VII.8</td><td>Eating in areas not designated.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>VII.9</td><td>Unauthorized removal of safety devices.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VII.10</td><td>Unauthorized entry into prohibited, restricted areas, or areas off-limits; also assisting another person to commit this act.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VII.11</td><td>Holding within company premises a meeting or gathering not allowed under Company policies.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VII.12</td><td>Creating or contributing to unclean or unsanitary conditions inside Company premises.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>VII.13</td><td>Failure or refusal to comply with sanitation, health or housekeeping rules.</td><td><span class="penalty-badge penalty-B">B</span></td></tr>
                                    <tr><td>VII.14</td><td>Failure or refusal to comply with company's safety or security requirements.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VII.15</td><td>Failure or refusal to wear official Company ID, uniform, shoes and/or prescribed safety equipment (goggles, mask, lab gown, etc.).</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>VII.16</td><td>Failure to report for work personally neat, clean and well-groomed. Slippers, shorts, undershirts and indecent attire are prohibited.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>VII.17</td><td>Failure to follow prescribed health procedure/medication in cases of sickness or personal injuries sustained at work.</td><td><span class="penalty-badge penalty-A">A</span></td></tr>
                                    <tr><td>VII.18</td><td>Failure to report while knowing another employee is suffering from contagious or communicable disease.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VII.19</td><td>Failure or refusal to report any accident or injury within Company premises involving co-employees or equipment.</td><td><span class="penalty-badge penalty-C">C</span></td></tr>
                                    <tr><td>VII.20</td><td>Failure to report for work due to detention or incarceration for 6 months or more for a non-bailable offense.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>VII.21</td><td>Conviction of any criminal offense under the law involving moral turpitude.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                    <tr><td>VII.22</td><td>Committing offenses penalized with suspension totaling 60 working days during a 12-month period.</td><td><span class="penalty-badge penalty-E">E</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="key-takeaway" style="margin-top: 30px;">
                        <div class="key-takeaway-icon"><i class="fas fa-heart"></i></div>
                        <div>
                            <strong>Remember</strong>
                            <p>These policies aren't just rules on a page &mdash; they're our shared commitment to building a workplace where everyone feels safe, valued, and proud to be part of the Brand Soluxions family. When we hold ourselves to high standards, we all rise together.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Default PIN Warning Modal -->
    <?php if ($isDefaultPin): ?>
    <div class="pin-modal-overlay" id="defaultPinModal">
        <div class="pin-modal">
            <div class="pin-modal-icon warning">
                <i class="fas fa-shield-halved"></i>
            </div>
            <h3>Change Your Default PIN</h3>
            <p>You are currently using the default PIN <strong>(1234)</strong>. For your security, please change it as soon as possible.</p>
            <button class="btn btn-primary" id="defaultPinDismiss" style="margin-top: 20px;">Change My PIN Now</button>
            <button class="pin-modal-cancel" id="defaultPinSkip">I'll do it later</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Change PIN Modal -->
    <div class="pin-modal-overlay" id="changePinModal">
        <div class="pin-modal">
            <div class="pin-modal-icon">
                <i class="fas fa-key"></i>
            </div>
            <h3>Change PIN</h3>
            <div id="changePinAlert"></div>
            <form id="changePinForm" style="text-align: left; margin-top: 16px;">
                <div class="pin-form-group">
                    <label>Current PIN</label>
                    <input type="password" id="currentPin" placeholder="Enter current PIN" autocomplete="off" maxlength="6">
                </div>
                <div class="pin-form-group">
                    <label>New PIN</label>
                    <input type="password" id="newPin" placeholder="4-6 digits" autocomplete="off" maxlength="6">
                </div>
                <div class="pin-form-group">
                    <label>Confirm New PIN</label>
                    <input type="password" id="confirmPin" placeholder="Re-enter new PIN" autocomplete="off" maxlength="6">
                </div>
                <button type="submit" class="btn btn-primary" id="changePinBtn" style="width: 100%; margin-top: 16px;">
                    <span id="changePinBtnText">SAVE NEW PIN</span>
                </button>
            </form>
            <button class="pin-modal-cancel" id="changePinCancel">Cancel</button>
        </div>
    </div>

    <style>
    .pin-modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.55);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .pin-modal-overlay.show { display: flex; }
    .pin-modal {
        background: #fff;
        border-radius: 20px;
        padding: 40px 32px;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        animation: slideUp 0.4s ease;
    }
    .pin-modal-icon {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px;
    }
    .pin-modal-icon.warning {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    }
    .pin-modal-icon i { color: #fff; font-size: 28px; }
    .pin-modal h3 { font-size: 20px; font-weight: 600; color: #1a1a2e; margin-bottom: 12px; }
    .pin-modal p { font-size: 14px; color: #555; line-height: 1.6; }
    .pin-form-group { margin-bottom: 14px; }
    .pin-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #444;
        margin-bottom: 5px;
    }
    .pin-form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.3s;
        box-sizing: border-box;
        letter-spacing: 4px;
        text-align: center;
    }
    .pin-form-group input:focus {
        border-color: var(--primary-color);
        outline: none;
    }
    .pin-modal-cancel {
        background: none;
        border: none;
        color: #888;
        font-size: 14px;
        cursor: pointer;
        margin-top: 12px;
        font-family: 'Poppins', sans-serif;
    }
    .pin-modal-cancel:hover { color: #333; }
    .pin-alert {
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 12px;
        text-align: center;
    }
    .pin-alert-error { background: #ffe0e0; color: #c0392b; }
    .pin-alert-success { background: #d4edda; color: #155724; }
    .penalty-detail-modal { max-width: 520px; text-align: left; }
    .penalty-detail-modal table { font-size: 13px; }
    @media (max-width: 768px) {
        .penalty-detail-modal { max-width: 95vw; }
    }
    @media (max-width: 480px) {
        .penalty-detail-modal { max-width: 100vw; }
        .penalty-detail-modal table { font-size: 12px; }
        .penalty-detail-modal table td,
        .penalty-detail-modal table th { padding: 9px 8px !important; }
    }
    @media (max-width: 768px) {
        .pin-modal-overlay { padding: 12px; }
        .pin-modal { padding: 28px 20px; max-width: 95vw; }
        .pin-modal h3 { font-size: 17px; }
    }
    @media (max-width: 480px) {
        .pin-modal-overlay { padding: 8px; }
        .pin-modal { padding: 24px 16px; max-width: 100vw; border-radius: 16px; }
        .pin-modal h3 { font-size: 16px; }
        .pin-modal p { font-size: 13px; }
        .pin-modal-icon { width: 52px; height: 52px; margin-bottom: 14px; }
        .pin-modal-icon i { font-size: 22px; }
        .pin-form-group input { padding: 10px 12px; font-size: 14px; }
        .pin-form-group label { font-size: 12px; }
    }
    </style>

    <!-- Footer -->
    <footer class="policy-footer">
        <div class="container">
            <img src="assets/images/Logo.png" alt="Brand Soluxions Inc." class="footer-logo">
            <p>&copy; <?php echo date('Y'); ?> Brand Soluxions Inc. All rights reserved.</p>
        </div>
    </footer>

    <!-- SheetJS for Excel generation -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var fadeEls = document.querySelectorAll('.fade-in');
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        fadeEls.forEach(function(el) { observer.observe(el); });
    });

    // Side Panel
    var burgerBtn = document.getElementById('burgerBtn');
    var sidePanel = document.getElementById('sidePanel');
    var sidePanelOverlay = document.getElementById('sidePanelOverlay');
    var sidePanelClose = document.getElementById('sidePanelClose');

    function setSidePanelHeight() {
        sidePanel.style.height = window.innerHeight + 'px';
    }

    var timeEl = document.getElementById('sidePanelTime');
    var dateEl = document.getElementById('sidePanelDate');
    function updateClock() {
        var now = new Date();
        var h = now.getHours(), m = now.getMinutes(), s = now.getSeconds();
        var ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        timeEl.textContent = String(h).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0') + ' ' + ampm;
        var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        dateEl.textContent = days[now.getDay()] + ', ' + months[now.getMonth()] + ' ' + now.getDate() + ', ' + now.getFullYear();
    }
    updateClock();
    setInterval(updateClock, 1000);
    setSidePanelHeight();
    window.addEventListener('resize', setSidePanelHeight);

    function openSidePanel() {
        setSidePanelHeight();
        sidePanel.classList.add('open');
        sidePanelOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeSidePanel() {
        sidePanel.classList.remove('open');
        sidePanelOverlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    burgerBtn.addEventListener('click', openSidePanel);
    sidePanelClose.addEventListener('click', closeSidePanel);
    sidePanelOverlay.addEventListener('click', closeSidePanel);

    // Penalty Carousel - Infinite continuous scroll (same as BrandSoluxions Featured Services)
    (function() {
        var carousel = document.getElementById('penaltyCarousel');
        var track = document.getElementById('penaltyTrack');
        var isDown = false;
        var startX;
        var scrollLeftPos;
        var currentTranslate = 0;
        var autoScrollSpeed = 0.8;
        var isAutoScrolling = true;
        var hasDragged = false;
        window._carouselDragged = false;

        function getTrackWidth() {
            return track.scrollWidth / 2;
        }

        function autoScroll() {
            if (isAutoScrolling && !isDown) {
                currentTranslate -= autoScrollSpeed;
                if (Math.abs(currentTranslate) >= getTrackWidth()) {
                    currentTranslate = 0;
                }
                track.style.transform = 'translateX(' + currentTranslate + 'px)';
            }
            requestAnimationFrame(autoScroll);
        }

        autoScroll();

        // Mouse drag
        carousel.addEventListener('mousedown', function(e) {
            isDown = true;
            hasDragged = false;
            window._carouselDragged = false;
            isAutoScrolling = false;
            startX = e.pageX - carousel.offsetLeft;
            scrollLeftPos = currentTranslate;
        });

        carousel.addEventListener('mouseleave', function() {
            if (isDown) { isDown = false; }
            isAutoScrolling = true;
        });

        carousel.addEventListener('mouseup', function() {
            isDown = false;
            setTimeout(function() { isAutoScrolling = true; }, 1500);
        });

        carousel.addEventListener('mousemove', function(e) {
            if (!isDown) return;
            e.preventDefault();
            hasDragged = true;
            window._carouselDragged = true;
            var x = e.pageX - carousel.offsetLeft;
            var walk = (x - startX) * 2;
            currentTranslate = scrollLeftPos + walk;
            var tw = getTrackWidth();
            if (currentTranslate > 0) currentTranslate = -tw + currentTranslate;
            else if (Math.abs(currentTranslate) >= tw) currentTranslate = currentTranslate + tw;
            track.style.transform = 'translateX(' + currentTranslate + 'px)';
        });

        // Touch drag
        carousel.addEventListener('touchstart', function(e) {
            isDown = true;
            hasDragged = false;
            window._carouselDragged = false;
            isAutoScrolling = false;
            startX = e.touches[0].pageX - carousel.offsetLeft;
            scrollLeftPos = currentTranslate;
        }, { passive: true });

        carousel.addEventListener('touchend', function() {
            isDown = false;
            setTimeout(function() { isAutoScrolling = true; }, 1500);
        });

        carousel.addEventListener('touchmove', function(e) {
            if (!isDown) return;
            hasDragged = true;
            window._carouselDragged = true;
            var x = e.touches[0].pageX - carousel.offsetLeft;
            var walk = (x - startX) * 2;
            currentTranslate = scrollLeftPos + walk;
            var tw = getTrackWidth();
            if (currentTranslate > 0) currentTranslate = -tw + currentTranslate;
            else if (Math.abs(currentTranslate) >= tw) currentTranslate = currentTranslate + tw;
            track.style.transform = 'translateX(' + currentTranslate + 'px)';
        }, { passive: true });

    })();

    function toggleSection(header) {
        const body = header.nextElementSibling;
        const icon = header.querySelector('.toggle-icon');
        body.classList.toggle('open');
        icon.classList.toggle('rotated');
    }

    // --- Penalty Detail Modals ---
    var penaltyData = {
        a: {
            color: '#28a745',
            title: 'Type A',
            subtitle: 'Condoned after 1 year',
            offenses: [
                { nth: '1st Offense', action: 'Verbal Warning' },
                { nth: '2nd Offense', action: 'Written Reprimand' },
                { nth: '3rd Offense', action: '3-6 days suspension' },
                { nth: '4th Offense', action: '7-15 days suspension' },
                { nth: '5th Offense', action: '16-30 days suspension with warning of dismissal' },
                { nth: '6th Offense', action: 'Dismissal' }
            ]
        },
        b: {
            color: '#ffc107',
            title: 'Type B',
            subtitle: 'Condoned after 2 years',
            offenses: [
                { nth: '1st Offense', action: 'Written Reprimand' },
                { nth: '2nd Offense', action: '3-6 days suspension' },
                { nth: '3rd Offense', action: '7-15 days suspension' },
                { nth: '4th Offense', action: '16-30 days suspension with warning of dismissal' },
                { nth: '5th Offense', action: 'Dismissal' }
            ]
        },
        c: {
            color: '#fd7e14',
            title: 'Type C',
            subtitle: 'Condoned after 3 years',
            offenses: [
                { nth: '1st Offense', action: '7-15 days suspension' },
                { nth: '2nd Offense', action: '16-30 days suspension with warning of dismissal' },
                { nth: '3rd Offense', action: 'Dismissal' }
            ]
        },
        d: {
            color: '#dc3545',
            title: 'Type D',
            subtitle: 'Condoned after 4 years',
            offenses: [
                { nth: '1st Offense', action: '16-30 days suspension with warning of dismissal' },
                { nth: '2nd Offense', action: 'Dismissal' }
            ]
        },
        e: {
            color: '#6c757d',
            title: 'Type E',
            subtitle: 'Condoned after 5 years (if commuted by CEO)',
            offenses: [
                { nth: '1st Offense', action: 'Dismissal' }
            ]
        }
    };

    var penaltyOverlay = document.getElementById('penaltyModalOverlay');
    var penaltyContent = document.getElementById('penaltyModalContent');

    document.getElementById('penaltyModalClose').addEventListener('click', function() {
        penaltyOverlay.classList.remove('show');
        document.body.style.overflow = '';
    });
    penaltyOverlay.addEventListener('click', function(e) {
        if (e.target === penaltyOverlay) {
            penaltyOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    function openPenaltyModal(type) {
        if (window._carouselDragged) return;
        var d = penaltyData[type];
        if (!d) return;

        var html = '<div style="text-align:center; margin-bottom: 20px;">';
        html += '<div style="width:56px;height:56px;border-radius:50%;background:' + d.color + ';display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px;">';
        html += '<span style="color:#fff;font-weight:700;font-size:22px;">' + type.toUpperCase() + '</span></div>';
        html += '<h3 style="font-size:20px;font-weight:600;color:#1a1a2e;margin:0 0 4px;">' + d.title + '</h3>';
        html += '<p style="font-size:13px;color:#888;margin:0;"><i class="fas fa-clock" style="margin-right:4px;"></i>' + d.subtitle + '</p>';
        html += '</div>';

        html += '<table style="width:100%;border-collapse:collapse;">';
        html += '<thead><tr>';
        html += '<th style="text-align:left;padding:10px 12px;font-size:13px;font-weight:600;color:#fff;background:' + d.color + ';border-radius:8px 0 0 0;">Offense</th>';
        html += '<th style="text-align:left;padding:10px 12px;font-size:13px;font-weight:600;color:#fff;background:' + d.color + ';border-radius:0 8px 0 0;">Penalty</th>';
        html += '</tr></thead><tbody>';

        d.offenses.forEach(function(o, i) {
            var bg = (i % 2 === 0) ? '#f9fafb' : '#fff';
            var isLast = (i === d.offenses.length - 1);
            var bleft = isLast ? 'border-radius:0 0 0 8px;' : '';
            var bright = isLast ? 'border-radius:0 0 8px 0;' : '';
            var isDismissal = o.action === 'Dismissal';
            var actionHtml = isDismissal ? '<strong style="color:#dc3545;">' + o.action + '</strong>' : o.action;
            html += '<tr style="background:' + bg + ';">';
            html += '<td style="padding:11px 12px;font-size:13px;color:#333;border-bottom:1px solid #eee;' + bleft + '">' + o.nth + '</td>';
            html += '<td style="padding:11px 12px;font-size:13px;color:#555;border-bottom:1px solid #eee;' + bright + '">' + actionHtml + '</td>';
            html += '</tr>';
        });

        html += '</tbody></table>';

        penaltyContent.innerHTML = html;
        penaltyOverlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function downloadExcel() {
        var btn = document.getElementById('downloadBtn');
        if (!btn) return;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner"></span> Generating...';

        window.location.href = 'api/download_records.php';

        setTimeout(function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-file-excel"></i> Download Records';
        }, 2000);
    }

    // --- Default PIN Warning Modal ---
    (function() {
        var defaultModal = document.getElementById('defaultPinModal');
        if (defaultModal) {
            defaultModal.classList.add('show');
            document.body.style.overflow = 'hidden';

            var changeNowBtn = document.getElementById('defaultPinDismiss');
            changeNowBtn.addEventListener('click', function(e) {
                e.preventDefault();
                defaultModal.classList.remove('show');
                document.body.style.overflow = '';
                document.getElementById('settingsBtn').click();
            });

            var skipBtn = document.getElementById('defaultPinSkip');
            skipBtn.addEventListener('click', function(e) {
                e.preventDefault();
                defaultModal.classList.remove('show');
                document.body.style.overflow = '';
            });

            defaultModal.addEventListener('click', function(e) {
                if (e.target === defaultModal) {
                    defaultModal.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        }
    })();

    // --- Change PIN Modal ---
    (function() {
        var changePinModal = document.getElementById('changePinModal');
        var settingsBtn = document.getElementById('settingsBtn');
        var cancelBtn = document.getElementById('changePinCancel');
        var changePinForm = document.getElementById('changePinForm');
        var alertDiv = document.getElementById('changePinAlert');

        function openChangePinModal() {
            closeSidePanel();
            changePinModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            alertDiv.innerHTML = '';
            changePinForm.reset();
            document.getElementById('currentPin').focus();
        }

        function closeChangePinModal() {
            changePinModal.classList.remove('show');
            document.body.style.overflow = '';
            changePinForm.reset();
            alertDiv.innerHTML = '';
        }

        settingsBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openChangePinModal();
        });

        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeChangePinModal();
        });

        changePinModal.addEventListener('click', function(e) {
            if (e.target === changePinModal) closeChangePinModal();
        });

        changePinForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var currentPin = document.getElementById('currentPin').value.trim();
            var newPin = document.getElementById('newPin').value.trim();
            var confirmPin = document.getElementById('confirmPin').value.trim();

            alertDiv.innerHTML = '';

            if (!currentPin) {
                alertDiv.innerHTML = '<div class="pin-alert pin-alert-error">Please enter your current PIN</div>';
                return;
            }
            if (!newPin) {
                alertDiv.innerHTML = '<div class="pin-alert pin-alert-error">Please enter a new PIN</div>';
                return;
            }
            if (!/^\d{4,6}$/.test(newPin)) {
                alertDiv.innerHTML = '<div class="pin-alert pin-alert-error">New PIN must be 4-6 digits</div>';
                return;
            }
            if (newPin !== confirmPin) {
                alertDiv.innerHTML = '<div class="pin-alert pin-alert-error">New PIN and confirmation do not match</div>';
                return;
            }

            var btn = document.getElementById('changePinBtn');
            var btnText = document.getElementById('changePinBtnText');
            btn.disabled = true;
            btnText.innerHTML = '<span class="spinner"></span> SAVING...';

            var formData = new FormData();
            formData.append('current_pin', currentPin);
            formData.append('new_pin', newPin);
            formData.append('confirm_pin', confirmPin);

            fetch('api/change_pin.php', {
                method: 'POST',
                body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                btn.disabled = false;
                btnText.textContent = 'SAVE NEW PIN';
                if (data.success) {
                    alertDiv.innerHTML = '<div class="pin-alert pin-alert-success"><i class="fas fa-check-circle"></i> ' + data.message + '</div>';
                    changePinForm.reset();
                    var defModal = document.getElementById('defaultPinModal');
                    if (defModal) defModal.remove();
                    setTimeout(function() { closeChangePinModal(); }, 2000);
                } else {
                    alertDiv.innerHTML = '<div class="pin-alert pin-alert-error"><i class="fas fa-exclamation-circle"></i> ' + data.message + '</div>';
                }
            })
            .catch(function() {
                btn.disabled = false;
                btnText.textContent = 'SAVE NEW PIN';
                alertDiv.innerHTML = '<div class="pin-alert pin-alert-error">Connection error. Please try again.</div>';
            });
        });
    })();
    </script>
</body>
</html>
